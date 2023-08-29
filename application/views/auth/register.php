<body class="bg-dark d-flex align-items-center justify-content-center vh-100">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-5">
        <div class="card">
          <div class="card-body">
            <div class="py-5 px-3">
              <div class="text-center">
                <h2 class="text-gray-900 font-weight-bold mb-4">Silahkan Registrasi</h2>
              </div>
              <form class="user" action="<?= base_url('auth/register') ?>" method="POST">
                <div class="form-group">
                  <label class="text-dark font-weight-bold" for="nama">Nama Lengkap</label>
                  <input type="text" class="form-control" name="nama" id="nama" required autofocus autocomplete="off">
                </div>
                <div class="form-group">
                  <label class="text-dark font-weight-bold" for="notelp">No Telepon</label>
                  <input type="text" class="form-control" name="notelp" id="notelp" required autocomplete="off">
                </div>
                <div class="form-group">
                  <label class="text-dark font-weight-bold" for="username">Username</label>
                  <input type="text" class="form-control" name="username" id="username" required autocomplete="off">
                </div>
                <div class="form-group">
                  <label class="text-dark font-weight-bold" for="password">Password</label>
                  <input type="password" class="form-control" name="password" id="password" required>
                </div>
                <div class="form-group mt-4">
                  <button type="submit" class="btn btn-primary btn-block">
                    Register
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>