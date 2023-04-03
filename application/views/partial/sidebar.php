<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="<?= base_url('dashboard') ?>" class="brand-link">
    <img src="<?= base_url('assets/images/karisma.png') ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
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
        <?php if ($this->session->userdata('lv') == '1') : ?>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-database"></i>
              <p>
                Master Data
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview ml-2">
              <li class="nav-item">
                <a href="<?= base_url('suplier') ?>" class="nav-link">
                  <i class="fas fa-light fa-building nav-icon"></i>
                  <p>Data Suplier</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('mbarang') ?>" class="nav-link">
                  <i class="fas fa-light fa-box nav-icon"></i>
                  <p>Data Barang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('user') ?>" class="nav-link">
                  <i class="fas fa-light fa-user nav-icon"></i>
                  <p>User Management</p>
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
                <a href="<?= base_url('noteseting') ?>" class="nav-link">
                  <i class="nav-icon fas fa-pen-nib"></i>
                  <p>
                    Note Template Setting
                  </p>
                </a>
              </li>
            </ul>
          </li>
        <?php endif; ?>

        <?php if ($this->session->userdata('lv') <= '2') : ?>
          <li class="nav-item">
            <a href="<?= base_url('purchase') ?>" class="nav-link">
              <i class="nav-icon fas fa-cash-register"></i>
              <p>
                Purchase Order
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('postatus') ?>" class="nav-link">
              <i class="nav-icon fas fa-money-check"></i>
              <p>
                Purchase Order Status
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
            <a href="<?= base_url('noteseting') ?>" class="nav-link">
              <i class="nav-icon fas fa-pen-nib"></i>
              <p>
                Note Template Setting
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

        <?php elseif ($this->session->userdata('lv') == '3') : ?>
          <li class="nav-item">
            <a href="<?= base_url('postatus') ?>" class="nav-link">
              <i class="nav-icon fas fa-money-check"></i>
              <p>
                Purchase Order Status
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