<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sso extends CI_Controller
{
    private $ssoConfig;
    private $clientSecret;

    public function __construct()
    {
        parent::__construct();
        $this->config->load('portal_sso', TRUE);
        $this->config->load('portal_sso_local', TRUE, TRUE);
        $this->ssoConfig = $this->config->item('portal_sso');
        $localConfig = $this->config->item('portal_sso_local');
        if (is_array($localConfig)) {
            foreach (['portal_base_url', 'callback_url', 'ca_bundle'] as $key) {
                if (!empty($localConfig[$key])) $this->ssoConfig[$key] = $localConfig[$key];
            }
        }
        $this->clientSecret = isset($localConfig['client_secret']) ? trim((string) $localConfig['client_secret']) : '';
    }

    public function login()
    {
        $this->clearLocalIdentity();
        $this->session->sess_regenerate(TRUE);
        if (!$this->isHttpsRequest()) {
            return $this->fail('Login SSO hanya tersedia melalui HTTPS.');
        }
        if ($this->clientSecret === '') {
            return $this->fail('Konfigurasi SSO Portal belum lengkap.');
        }

        try {
            $verifier = $this->base64UrlEncode(random_bytes(32));
            $state = bin2hex(random_bytes(32));
        } catch (Exception $exception) {
            log_message('error', 'Portal SSO tidak dapat membuat nonce kriptografis.');
            return $this->fail('SSO Portal tidak dapat dimulai. Silakan coba kembali.');
        }

        $challenge = $this->base64UrlEncode(hash('sha256', $verifier, TRUE));
        $this->session->set_userdata('portal_sso_pending', [
            'state' => $state,
            'verifier' => $verifier,
            'started_at' => time(),
        ]);

        $authorizeUrl = rtrim($this->ssoConfig['portal_base_url'], '/') . '/sso/authorize';
        $query = http_build_query([
            'client_id' => $this->ssoConfig['app_code'],
            'redirect_uri' => $this->ssoConfig['callback_url'],
            'state' => $state,
            'code_challenge' => $challenge,
            'code_challenge_method' => 'S256',
        ], '', '&', PHP_QUERY_RFC3986);

        redirect($authorizeUrl . '?' . $query);
    }

    public function callback()
    {
        if (!$this->isHttpsRequest()) {
            return $this->fail('Callback SSO hanya tersedia melalui HTTPS.');
        }
        $pending = $this->session->userdata('portal_sso_pending');
        $receivedState = (string) $this->input->get('state', TRUE);
        $code = (string) $this->input->get('code', TRUE);
        $ttl = isset($this->ssoConfig['transaction_ttl']) ? (int) $this->ssoConfig['transaction_ttl'] : 300;

        if (!is_array($pending) || empty($pending['state']) || empty($pending['verifier']) ||
            !hash_equals((string) $pending['state'], $receivedState) ||
            empty($pending['started_at']) || time() - (int) $pending['started_at'] > $ttl) {
            $this->session->unset_userdata('portal_sso_pending');
            return $this->fail('Transaksi SSO tidak valid atau sudah kedaluwarsa. Silakan mulai login kembali.');
        }

        $portalError = (string) $this->input->get('error', TRUE);
        if ($portalError !== '') {
            $this->session->unset_userdata('portal_sso_pending');
            return $this->fail($portalError === 'access_denied'
                ? 'Akun Portal belum diberi akses ke POERP.'
                : 'Login melalui Portal tidak berhasil. Silakan coba kembali.');
        }
        if ($code === '' || $this->clientSecret === '') {
            $this->session->unset_userdata('portal_sso_pending');
            return $this->fail('Callback SSO tidak lengkap. Silakan mulai login kembali.');
        }

        $expectedState = (string) $pending['state'];
        // Konsumsi transaksi sebelum request jaringan agar callback tidak dapat dipakai ulang.
        $this->session->unset_userdata('portal_sso_pending');
        $token = $this->exchangeCode($code, $pending['verifier']);
        if ($token === NULL) {
            return $this->fail('Portal tidak dapat memvalidasi login. Silakan coba kembali.');
        }

        $data = isset($token['data']) && is_array($token['data']) ? $token['data'] : [];
        $identity = isset($data['user']) && is_array($data['user']) ? $data['user'] : [];
        if (empty($token['success']) || !isset($data['app_code']) ||
            !hash_equals((string) $this->ssoConfig['app_code'], (string) $data['app_code']) ||
            !isset($data['state']) || !hash_equals($expectedState, (string) $data['state']) ||
            empty($identity['sub']) || empty($identity['auth_source']) ||
            !in_array($identity['auth_source'], ['tb_users', 'tb_karyawan'], TRUE) ||
            empty($identity['user_id']) ||
            $identity['sub'] !== $identity['auth_source'] . ':' . (int)$identity['user_id']) {
            return $this->fail('Respons identitas Portal tidak valid.');
        }

        $assignedAccountUsername = isset($data['client_account_username']) ? $data['client_account_username'] : NULL;
        if ($assignedAccountUsername === NULL) {
            return $this->fail('Akun kerja belum ditetapkan oleh administrator Portal.');
        }
        if (!is_string($assignedAccountUsername) || trim($assignedAccountUsername) === '' || strlen($assignedAccountUsername) > 190) {
            return $this->fail('Akun kerja yang ditetapkan Portal tidak valid. Hubungi administrator.');
        }
        $assignedUsers = $this->db->get_where('tb_user', ['username' => $assignedAccountUsername])->result();
        if (count($assignedUsers) !== 1) {
            return $this->fail('Akun kerja yang ditetapkan tidak tersedia secara unik di POERP. Hubungi administrator.');
        }
        $user = $assignedUsers[0];
        if (!$user || !hash_equals($assignedAccountUsername, (string)$user->username)
            || empty($user->id_user) || empty($user->kode_user)
            || !in_array((string)$user->aksess_lv, ['1', '2', '3', '4', '5'], TRUE)) {
            return $this->fail('Akun atau level akses POERP tidak valid. Hubungi administrator aplikasi.');
        }

        try {
            $eventId = bin2hex(random_bytes(32));
        } catch (Exception $exception) {
            return $this->fail('Histori login tidak dapat disiapkan. Silakan coba kembali.');
        }
        if (!$this->recordLoginEvent($identity, $assignedAccountUsername, $eventId)) {
            return $this->fail('Login dihentikan karena Portal belum mengonfirmasi histori penggunaan akun kerja.');
        }

        // Terbitkan identitas lokal hanya sesudah Portal mengonfirmasi histori.
        $this->clearLocalIdentity();
        $this->session->sess_regenerate(TRUE);
        $this->session->set_userdata([
            'id' => $user->id_user,
            'kode' => $user->kode_user,
            'username' => $user->username,
            'nama_user' => $user->nama_user,
            'departemen' => $user->departement,
            'lv' => $user->aksess_lv,
            'status' => 'is_login',
            'auth_method' => 'karismaerp_sso',
            'portal_sub' => $identity['sub'],
        ]);
        redirect('dashboard');
    }

    private function recordLoginEvent($identity, $accountUsername, $eventId)
    {
        if (!function_exists('curl_init') || empty($identity['sub']) || empty($this->ssoConfig['app_code'])) {
            return FALSE;
        }
        $body = http_build_query([
            'client_id' => $this->ssoConfig['app_code'],
            'client_secret' => $this->clientSecret,
            'sub' => $identity['sub'],
            'account_username' => $accountUsername,
            'event_id' => $eventId,
            'source_ip' => $this->input->ip_address(),
            'user_agent' => (string) $this->input->server('HTTP_USER_AGENT'),
        ], '', '&', PHP_QUERY_RFC3986);
        $url = rtrim($this->ssoConfig['portal_base_url'], '/') . '/api/sso/login-event';
        $curl = curl_init($url);
        curl_setopt_array($curl, [
            CURLOPT_POST => TRUE,
            CURLOPT_POSTFIELDS => $body,
            CURLOPT_HTTPHEADER => ['Content-Type: application/x-www-form-urlencoded', 'Accept: application/json'],
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_CONNECTTIMEOUT => 5,
            CURLOPT_TIMEOUT => 15,
            CURLOPT_FOLLOWLOCATION => FALSE,
            CURLOPT_SSL_VERIFYPEER => TRUE,
            CURLOPT_SSL_VERIFYHOST => 2,
            CURLOPT_PROTOCOLS => CURLPROTO_HTTPS,
            CURLOPT_REDIR_PROTOCOLS => CURLPROTO_HTTPS,
        ]);
        if (!empty($this->ssoConfig['ca_bundle'])) curl_setopt($curl, CURLOPT_CAINFO, $this->ssoConfig['ca_bundle']);
        $response = curl_exec($curl);
        $status = (int) curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $curlError = curl_errno($curl);
        curl_close($curl);
        if ($response === FALSE || $curlError !== 0 || $status < 200 || $status >= 300) {
            return FALSE;
        }
        $decoded = json_decode($response, TRUE);
        return is_array($decoded) && !empty($decoded['success']);
    }

    private function clearLocalIdentity()
    {
        $this->session->unset_userdata(['id', 'kode', 'username', 'nama_user', 'departemen', 'lv', 'status', 'auth_method', 'portal_sub']);
    }

    private function isHttpsRequest()
    {
        $https = strtolower((string) $this->input->server('HTTPS'));
        return ($https !== '' && $https !== 'off') || (string) $this->input->server('SERVER_PORT') === '443';
    }

    private function exchangeCode($code, $verifier)
    {
        if (!function_exists('curl_init')) {
            log_message('error', 'Portal SSO token exchange requires the PHP cURL extension.');
            return NULL;
        }

        $url = rtrim($this->ssoConfig['portal_base_url'], '/') . '/api/sso/token';
        $body = http_build_query([
            'client_id' => $this->ssoConfig['app_code'],
            'client_secret' => $this->clientSecret,
            'code' => $code,
            'redirect_uri' => $this->ssoConfig['callback_url'],
            'code_verifier' => $verifier,
        ], '', '&', PHP_QUERY_RFC3986);

        $curl = curl_init($url);
        curl_setopt_array($curl, [
            CURLOPT_POST => TRUE,
            CURLOPT_POSTFIELDS => $body,
            CURLOPT_HTTPHEADER => ['Content-Type: application/x-www-form-urlencoded', 'Accept: application/json'],
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_CONNECTTIMEOUT => 5,
            CURLOPT_TIMEOUT => 15,
            CURLOPT_SSL_VERIFYPEER => TRUE,
            CURLOPT_SSL_VERIFYHOST => 2,
            CURLOPT_FOLLOWLOCATION => FALSE,
            CURLOPT_PROTOCOLS => CURLPROTO_HTTPS,
            CURLOPT_REDIR_PROTOCOLS => CURLPROTO_HTTPS,
        ]);
        if (!empty($this->ssoConfig['ca_bundle'])) curl_setopt($curl, CURLOPT_CAINFO, $this->ssoConfig['ca_bundle']);
        $response = curl_exec($curl);
        $status = (int) curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $curlError = curl_errno($curl);
        curl_close($curl);

        if ($response === FALSE || $curlError !== 0 || $status < 200 || $status >= 300) {
            log_message('error', 'Portal SSO token exchange failed; HTTP status ' . $status . ', cURL error ' . $curlError . '.');
            return NULL;
        }

        $decoded = json_decode($response, TRUE);
        return is_array($decoded) ? $decoded : NULL;
    }

    private function base64UrlEncode($value)
    {
        return rtrim(strtr(base64_encode($value), '+/', '-_'), '=');
    }

    private function fail($message)
    {
        $this->clearLocalIdentity();
        $this->session->unset_userdata('portal_sso_pending');
        $this->session->set_flashdata('gagal', $message);
        redirect('Auth');
    }
}
