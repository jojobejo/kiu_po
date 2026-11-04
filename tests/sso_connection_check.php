<?php
// Pemeriksaan CLI baca-saja; secret tidak ditampilkan dan tidak dikirim ke browser.
if (PHP_SAPI !== 'cli') { http_response_code(404); exit; }
define('BASEPATH', __DIR__ . '/../system/');
$config = [];
require __DIR__ . '/../application/config/portal_sso.php';
$settings = $config;
$config = [];
require __DIR__ . '/../application/config/portal_sso_local.php';
$settings = array_merge($settings, $config);
$subject = $argv[1] ?? '';
if (!preg_match('/^(tb_users|tb_karyawan):[1-9][0-9]*$/D', $subject)) {
    fwrite(STDERR, "Penggunaan: php tests/sso_connection_check.php tb_users:27\n");
    exit(1);
}
$handle = curl_init(rtrim($settings['portal_base_url'], '/') . '/api/sso/check');
curl_setopt_array($handle, [
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => http_build_query([
        'client_id' => $settings['app_code'], 'client_secret' => $settings['client_secret'],
        'sub' => $subject, 'redirect_uri' => $settings['callback_url'],
    ], '', '&', PHP_QUERY_RFC3986),
    CURLOPT_RETURNTRANSFER => true, CURLOPT_FOLLOWLOCATION => false,
    CURLOPT_CONNECTTIMEOUT => 5, CURLOPT_TIMEOUT => 15,
    CURLOPT_SSL_VERIFYPEER => true, CURLOPT_SSL_VERIFYHOST => 2,
    CURLOPT_PROTOCOLS => CURLPROTO_HTTPS,
]);
if (!empty($settings['ca_bundle'])) curl_setopt($handle, CURLOPT_CAINFO, $settings['ca_bundle']);
$response = curl_exec($handle);
$status = curl_getinfo($handle, CURLINFO_HTTP_CODE);
$error = curl_errno($handle);
curl_close($handle);
$data = json_decode((string)$response, true);
$ready = $status === 200 && !empty($data['data']['portal_ready']);
echo json_encode(['http_status' => $status, 'curl_errno' => $error,
    'portal_ready' => $ready, 'client_session_verified' => false,
    'checks' => $data['data']['checks'] ?? [], 'error' => $data['error'] ?? null,
], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . PHP_EOL;
exit($ready ? 0 : 1);
