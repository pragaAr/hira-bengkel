<div id="content-wrapper" class="d-flex flex-column">

  <div id="content">

    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

      <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
      </button>

      <small class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100" id="jam">
      </small>

      <ul class="navbar-nav ml-auto">

        <div class="topbar-divider d-none d-sm-block"></div>

        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <small class="mr-2 d-none d-lg-inline text-gray-600 text-capitalize">
              Hello, <?= $this->session->userdata('nama_user') ?>
            </small>
            <img class="img-profile rounded-circle" src="<?= base_url('public/img/undraw_profile.svg') ?>">
          </a>
          <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="<?= base_url('auth/logout') ?>">
              <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-danger"></i>
              Logout
            </a>
          </div>
        </li>

      </ul>
    </nav>