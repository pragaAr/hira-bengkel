<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('home') ?>">
    <div class="sidebar-brand-icon">
      Hira
    </div>
  </a>

  <hr class="sidebar-divider my-0">

  <li class="nav-item <?= $this->uri->segment(1) == 'home' || $this->uri->segment(1) == '' ? 'active' : '' ?>">
    <a class="nav-link" href="<?= base_url('home') ?>">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>

  <hr class="sidebar-divider">

  <div class="sidebar-heading">
    Master Data
  </div>

  <li class="nav-item <?= $this->uri->segment(1) == 'stok' || $this->uri->segment(1) == 'ban' ? 'active' : '' ?>">
    <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseStok" aria-expanded="true" aria-controls="collapseStok">
      <i class="fas fa-box-open"></i>
      <span>Stok</span>
    </a>
    <div id="collapseStok" class="collapse <?= $this->uri->segment(1) == 'stok' || $this->uri->segment(1) == 'ban' ? 'show' : '' ?>" aria-labelledby=" headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item <?= $this->uri->segment(1) == 'stok' || $this->uri->segment(1) == '' ? 'active' : '' ?>" href="<?= base_url('stok') ?>">Part</a>
        <a class="collapse-item <?= $this->uri->segment(1) == 'ban' || $this->uri->segment(1) == '' ? 'active' : '' ?>" href="<?= base_url('ban') ?>">Ban</a>
      </div>
    </div>
  </li>

  <li class="nav-item <?= $this->uri->segment(1) == 'merk' || $this->uri->segment(1) == '' ? 'active' : '' ?>">
    <a class="nav-link" href="<?= base_url('merk') ?>">
      <i class="fas fa-fw fa-tag"></i>
      <span>Merk</span></a>
  </li>

  <li class="nav-item <?= $this->uri->segment(1) == 'truck' || $this->uri->segment(1) == '' ? 'active' : '' ?>">
    <a class="nav-link" href="<?= base_url('truck') ?>">
      <i class="fas fa-fw fa-truck"></i>
      <span>Truck</span></a>
  </li>

  <li class="nav-item <?= $this->uri->segment(1) == 'toko' || $this->uri->segment(1) == '' ? 'active' : '' ?>">
    <a class="nav-link" href="<?= base_url('toko') ?>">
      <i class="fas fa-fw fa-store"></i>
      <span>Toko</span></a>
  </li>

  <hr class="sidebar-divider">

  <div class="sidebar-heading">
    Transaksi
  </div>

  <li class="nav-item <?= $this->uri->segment(1) == 'beli' || $this->uri->segment(1) == 'pakai' || $this->uri->segment(1) == 'oper' || $this->uri->segment(1) == 'retur' || $this->uri->segment(1) == 'repair' ? 'active' : '' ?>">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePart" aria-expanded="true" aria-controls="collapsePart">
      <i class="fas fa-fw fa-cog"></i>
      <span>Part</span>
    </a>
    <div id="collapsePart" class="collapse <?= $this->uri->segment(1) == 'beli' || $this->uri->segment(1) == 'pakai' || $this->uri->segment(1) == 'oper' || $this->uri->segment(1) == 'retur' || $this->uri->segment(1) == 'repair' ? 'show' : '' ?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item <?= $this->uri->segment(1) == 'beli' || $this->uri->segment(1) == '' ? 'active' : '' ?>" href="<?= base_url('beli') ?>">Masuk</a>
        <a class="collapse-item <?= $this->uri->segment(1) == 'pakai' || $this->uri->segment(1) == '' ? 'active' : '' ?>" href="<?= base_url('pakai') ?>">Keluar</a>
        <a class="collapse-item <?= $this->uri->segment(1) == 'oper' || $this->uri->segment(1) == '' ? 'active' : '' ?>" href="<?= base_url('oper') ?>">Operan</a>
        <a class="collapse-item <?= $this->uri->segment(1) == 'retur' || $this->uri->segment(1) == '' ? 'active' : '' ?>" href="<?= base_url('retur') ?>">Retur</a>
        <a class="collapse-item <?= $this->uri->segment(1) == 'repair' || $this->uri->segment(1) == '' ? 'active' : '' ?>" href="<?= base_url('repair') ?>">Repair</a>
      </div>
    </div>
  </li>

  <li class="nav-item <?= $this->uri->segment(1) == 'beli_ban' || $this->uri->segment(1) == 'movement' || $this->uri->segment(1) == 'pakai_ban' || $this->uri->segment(1) == 'oper_ban' || $this->uri->segment(1) == 'retur_ban' || $this->uri->segment(1) == 'vulkanisir' ? 'active' : '' ?>">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBan" aria-expanded="true" aria-controls="collapseBan">
      <i class="far fa-dot-circle"></i>
      <span>Ban</span>
    </a>
    <div id="collapseBan" class="collapse <?= $this->uri->segment(1) == 'beli_ban' || $this->uri->segment(1) == 'movement' || $this->uri->segment(1) == 'pakai_ban' || $this->uri->segment(1) == 'oper_ban' || $this->uri->segment(1) == 'retur_ban' || $this->uri->segment(1) == 'vulkanisir' ? 'show' : '' ?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item <?= $this->uri->segment(1) == 'beli_ban' || $this->uri->segment(1) == '' ? 'active' : '' ?>" href="<?= base_url('beli_ban') ?>">Masuk</a>
        <a class="collapse-item <?= $this->uri->segment(1) == 'movement' || $this->uri->segment(1) == '' ? 'active' : '' ?>" href="<?= base_url('movement') ?>">Movement</a>
        <a class="collapse-item <?= $this->uri->segment(1) == 'pakai_ban' || $this->uri->segment(1) == '' ? 'active' : '' ?>" href="<?= base_url('pakai_ban') ?>">Keluar</a>
        <a class="collapse-item <?= $this->uri->segment(1) == 'oper_ban' || $this->uri->segment(1) == '' ? 'active' : '' ?>" href="<?= base_url('oper_ban') ?>">Operan</a>
        <a class="collapse-item <?= $this->uri->segment(1) == 'retur_ban' || $this->uri->segment(1) == '' ? 'active' : '' ?>" href="<?= base_url('retur_ban') ?>">Retur</a>
        <a class="collapse-item <?= $this->uri->segment(1) == 'vulkanisir' || $this->uri->segment(1) == '' ? 'active' : '' ?>" href="<?= base_url('vulkanisir') ?>">Vulkanisir</a>
      </div>
    </div>
  </li>

  <li class="nav-item <?= $this->uri->segment(1) == 'percab' || $this->uri->segment(1) == '' ? 'active' : '' ?>">
    <a class="nav-link" href="<?= base_url('percab') ?>">
      <i class="fas fa-fw fa-tools"></i>
      <span>Perbaikan Cabang</span></a>
  </li>

  <?php if ($this->session->userdata('user_role') == 'admin') { ?>
    <li class="nav-item <?= $this->uri->segment(1) == 'user' || $this->uri->segment(1) == '' ? 'active' : '' ?>">
      <a class="nav-link" href="<?= base_url('user') ?>">
        <i class="fas fa-fw fa-users"></i>
        <span>User</span></a>
    </li>
  <?php } ?>

  <hr class="sidebar-divider d-none d-md-block">

  <li class="nav-item">
    <a class="nav-link" href="<?= base_url('auth/logout') ?>">
      <i class="fas fa-sign-out-alt"></i>
      <span>Logout</span></a>
  </li>

  <hr class="sidebar-divider d-none d-md-block">

  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>