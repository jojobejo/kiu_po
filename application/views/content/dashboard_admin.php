<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dashboard Admin</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="callout callout-info">
                <h5>Login berhasil</h5>
                <p class="mb-0">
                    Selamat datang, <?= html_escape((string) $this->session->userdata('nama_user')) ?>.
                    Akun administrator telah berhasil masuk ke aplikasi.
                </p>
            </div>
        </div>
    </section>
</div>
