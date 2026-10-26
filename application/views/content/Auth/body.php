<body class="hold-transition login-page">
    <?php if ($this->session->flashdata('session_expired')) : ?>
        <style>
            .session-notice-backdrop{position:fixed;inset:0;z-index:1050;display:grid;place-items:center;padding:20px;background:rgba(15,23,42,.56);backdrop-filter:blur(5px);animation:sessionFadeIn .2s ease-out}
            .session-notice{width:min(100%,410px);overflow:hidden;border:1px solid rgba(255,255,255,.7);border-radius:20px;background:#fff;box-shadow:0 24px 70px rgba(15,23,42,.28);text-align:center;animation:sessionPopIn .24s cubic-bezier(.2,.8,.2,1)}
            .session-notice__content{padding:34px 32px 26px}
            .session-notice__icon{display:grid;width:64px;height:64px;margin:0 auto 19px;place-items:center;border-radius:20px;background:#fff4e5;color:#e28b16;font-size:27px}
            .session-notice__title{margin:0 0 8px;color:#172033;font-size:21px;font-weight:700;letter-spacing:-.3px}
            .session-notice__text{margin:0;color:#687386;font-size:15px;line-height:1.6}
            .session-notice__actions{padding:0 32px 30px}
            .session-notice__button{width:100%;padding:11px 18px;border:0;border-radius:11px;background:#2563eb;color:#fff;font-size:15px;font-weight:600;transition:background .15s,transform .15s}
            .session-notice__button:hover{transform:translateY(-1px);background:#1d4ed8}
            .session-notice__button:focus{outline:3px solid rgba(37,99,235,.28);outline-offset:3px}
            @keyframes sessionFadeIn{from{opacity:0}to{opacity:1}}
            @keyframes sessionPopIn{from{opacity:0;transform:translateY(10px) scale(.97)}to{opacity:1;transform:translateY(0) scale(1)}}
            @media(prefers-reduced-motion:reduce){.session-notice-backdrop,.session-notice{animation:none}.session-notice__button{transition:none}}
        </style>
        <div class="session-notice-backdrop" id="sessionExpiredModal" role="presentation">
            <section class="session-notice" role="alertdialog" aria-modal="true" aria-labelledby="sessionNoticeTitle" aria-describedby="sessionNoticeMessage">
                <div class="session-notice__content">
                    <div class="session-notice__icon" aria-hidden="true"><i class="fas fa-clock"></i></div>
                    <h2 class="session-notice__title" id="sessionNoticeTitle">Sesi berakhir</h2>
                    <p class="session-notice__text" id="sessionNoticeMessage">sesi telah berakhir. Silakan masuk kembali untuk melanjutkan.</p>
                </div>
                <div class="session-notice__actions">
                    <button type="button" class="session-notice__button" autofocus onclick="document.getElementById('sessionExpiredModal').remove();document.getElementById('user_isi').focus();">Kembali ke login</button>
                </div>
            </section>
        </div>
        <script>document.body.style.overflow='hidden';document.getElementById('sessionExpiredModal').querySelector('button').focus();</script>
    <?php endif; ?>
    <div class="login-box">
        <div class="login-logo">
            <img src="" alt="">
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in terlebih dahulu</p>
                <form action="<?= base_url('login') ?>" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Username" id="user_isi" name="user_isi">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" id="pass_isi" name="pass_isi">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                    </div>
                </form>
                <?php if ($this->session->flashdata("gagal")) : ?>
                    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                        <?php echo "<center>" . $this->session->flashdata("gagal") . "</center>" ?>
                    </div>
                <?php elseif ($this->session->flashdata("logout")) : ?>
                    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                        <?php echo "<center>" . $this->session->flashdata("logout") . "</center>" ?>
                    </div>
                    <?php elseif ($this->session->flashdata("edited")) : ?>
                    <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
                        <?php echo "<center>" . $this->session->flashdata("edited") . "</center>" ?>
                    </div>
                <?php endif ?>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->
