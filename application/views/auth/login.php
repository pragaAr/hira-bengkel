<div class="flashceklogin" data-flashdata="<?= $this->session->flashdata('flashceklogin'); ?>"></div>
<div class="flashreg" data-flashdata="<?= $this->session->flashdata('flashReg'); ?>"></div>
<div class="flashlogout" data-flashdata="<?= $this->session->flashdata('flashLogout'); ?>"></div>
<div class="wrongpassoruser" data-flashdata="<?= $this->session->flashdata('wrongpassoruser'); ?>"></div>



<body class="d-flex align-items-center justify-content-center vh-100" style="background-image:url(<?= base_url('public/img/bg-img.jpg') ?>); background-size:cover; background-repeat:no-repeat;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-5">
        <div class="card">
          <div class="card-body">
            <div class="py-4 px-3">
              <div class="text-center">
                <h2 class="text-gray-900 font-weight-bold mb-4">Silahkan Login</h2>
              </div>
              <form class="user" action="<?= base_url('auth') ?>" method="POST">
                <div class="form-group">
                  <label class="text-dark font-weight-bold" for="username">Username</label>
                  <input type="text" class="form-control" name="username" id="username" required autofocus autocomplete="off">
                </div>
                <div class="form-group">
                  <label class="text-dark font-weight-bold" for="password">Password</label>
                  <input type="password" class="form-control" name="password" id="password" required>
                </div>
                <div class="form-group mt-4">
                  <button type="submit" class="btn btn-primary btn-block">
                    Login
                  </button>
                </div>
              </form>

            </div>
            <div class="text-center mb-3">
              <span class="text-secondary font-sm">Belum punya akun ? Hubungi Admin</span><br>

              Made With 💖 <?= date('Y') ?>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>