<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="<?= base_url('dashboard') ?>" class="nav-link">Home</a>
    </li>
  </ul>
</nav>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="<?= base_url('dashboard') ?>" class="brand-link">
    <img src="<?= base_url('assets/images/Karisma.png') ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Purchase Order</span>
  </a>
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="<?= base_url('assets/images/user.png') ?>" class="img-circle elevation-1" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block"><?= $this->session->userdata('nama_user') ?></a>
          </div>
        </div>
        <?php if ($this->session->userdata('lv') <= '2' && $this->session->userdata('departemen') == 'KEUANGAN') : ?>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cash-register"></i>
              <p>
                Purchase Order
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('purchase') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Komersil</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Non Komersil
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                  <li class="nav-item">
                    <a href="<?= base_url('pononkomersiljasa') ?>" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>PO Jasa</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= base_url('pononkomersil') ?>" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>PO Pembelian</p>
                    </a>
                  </li>
                  <li class="nav-item">

                  </li>
                </ul>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-money-check"></i>
              <p>
                Purchase Order Status
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('postatus') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Komersil</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('postatusnk') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Non Komersil</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('masterbarangnk') ?>" class="nav-link">
              <i class="nav-icon fas fa-box"></i>
              <p>
                Master Barang
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cubes"></i>
              <p>
                Stok Barang
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('stockkomersil') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Komersil</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('stocknonkomersil') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Non Komersil</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('stockcontrollernk') ?>" class="nav-link">
              <i class="nav-icon fas fa-clipboard-check"></i>
              <p>
                Stock Controller
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('lap_nonkomersil') ?>" class="nav-link">
              <i class="nav-icon fas fa-file-excel"></i>
              <p>
                Laporan Pembelian
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('taxseting') ?>" class="nav-link">
              <i class="nav-icon fas fa-percent"></i>
              <p>
                Tax Setting
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('satuansetting') ?>" class="nav-link">
              <i class="nav-icon fa fa-weight-hanging"></i>
              <p>
                Satuan Setting
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('notetemplate') ?>" class="nav-link">
              <i class="nav-icon fas fa-pen-nib"></i>
              <p>
                Note Template Setting
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('usersetting') ?>" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Account Setting
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('logout') ?>" class="nav-link">
              <i class="nav-icon fas fa-unlock"></i>
              <p>
                Log Out
              </p>
            </a>
          </li>

        <?php elseif ($this->session->userdata('lv') == '4') : ?>
          <li class="nav-item">
            <a href="<?= base_url('pononkomersil') ?>" class="nav-link">
              <i class="nav-icon fas fa-cash-register"></i>
              <p>
                Purchase Order
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('postatusnk') ?>" class="nav-link">
              <i class="nav-icon fas fa-money-check"></i>
              <p>
                Purchase Order Status
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('usersetting') ?>" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Account Setting
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('logout') ?>" class="nav-link">
              <i class="nav-icon fas fa-unlock"></i>
              <p>
                Log Out
              </p>
            </a>
          </li>
          <!-- MENU KADEP -->
        <?php elseif ($this->session->userdata('lv') == '5') : ?>
          <li class="nav-item">
            <a href="<?= base_url('pononkomersil') ?>" class="nav-link">
              <i class="nav-icon fas fa-cash-register"></i>
              <p>
                Purchase Order
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('postatusnk') ?>" class="nav-link">
              <i class="nav-icon fas fa-money-check"></i>
              <p>
                Purchase Order Status
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('usersetting') ?>" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Account Setting
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('logout') ?>" class="nav-link">
              <i class="nav-icon fas fa-unlock"></i>
              <p>
                Log Out
              </p>
            </a>
          </li>

        <?php elseif ($this->session->userdata('lv') <= '2' && $this->session->userdata('departemen') == 'KEUANGAN' || $this->session->userdata('departemen') == 'SALES' || $this->session->userdata('departemen') == 'HRD') : ?>
          <!-- <li class="nav-item">
            <a href="<?= base_url('pononkomersil') ?>" class="nav-link">
              <i class="nav-icon fas fa-cash-register"></i>
              <p>
                PO Non Komersil
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('postatusnk') ?>" class="nav-link">
              <i class="nav-icon fas fa-money-check"></i>
              <p>
                PO non Komersil Status <span class="badge badge-warning right">!</span>
              </p>
            </a>
          </li> -->
          <li class="nav-item">
            <a href="<?= base_url('usersetting') ?>" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Account Setting
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('logout') ?>" class="nav-link">
              <i class="nav-icon fas fa-unlock"></i>
              <p>
                Log Out
              </p>
            </a>
          </li>
          <!-- MENU DIREKTUR -->
        <?php elseif ($this->session->userdata('lv') == '3' && $this->session->userdata('departemen') == 'KEUANGAN' || $this->session->userdata('departemen') == 'SALES' || $this->session->userdata('departemen') == 'LOGISTIK' || $this->session->userdata('departemen') == 'HRD') : ?>
          <li class="nav-item">
            <a href="<?= base_url('pononkomersil') ?>" class="nav-link">
              <i class="nav-icon fas fa-cash-register"></i>
              <p>
                PO Non Komersil
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('postatusnk') ?>" class="nav-link">
              <i class="nav-icon fas fa-money-check"></i>
              <p>
                PO non Komersil Status <span class="badge badge-warning right">!</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('usersetting') ?>" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Account Setting
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('logout') ?>" class="nav-link">
              <i class="nav-icon fas fa-unlock"></i>
              <p>
                Log Out
              </p>
            </a>
          </li>
          <!-- MENU DIREKTUR -->
        <?php elseif ($this->session->userdata('lv') == '3' && $this->session->userdata('departemen') == 'DIREKTUR') : ?>
          <li class="nav-item">
            <a href="<?= base_url('postatusnk') ?>" class="nav-link">
              <i class="nav-icon fas fa-money-check"></i>
              <p>
                PO non Komersil Status <span class="badge badge-warning right">!</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('postatus/today') ?>" class="nav-link">
              <i class="nav-icon fas fa-money-check"></i>
              <p>
                Purchase Order Status
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('usersetting') ?>" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Account Setting
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('logout') ?>" class="nav-link">
              <i class="nav-icon fas fa-unlock"></i>
              <p>
                Log Out
              </p>
            </a>
          </li>
        <?php endif; ?>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>