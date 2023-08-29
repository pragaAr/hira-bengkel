<div class="container-fluid">

  <div class="flashlogin" data-flashdata="<?= $this->session->flashdata('flashLogin'); ?>"></div>
  <div class="flashrole" data-flashdata="<?= $this->session->flashdata('flashrole'); ?>"></div>

  <div class="d-sm-flex align-items-baseline justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <div class="form-group">
      <input type="month" class="form-control" name="changeperiod" id="changeperiod" value="<?= date('Y-m') ?>">
    </div>
  </div>

  <div class="row">

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                Total Belanja Part
              </div>
              <div class="p mb-0 font-weight-bold text-gray-800" id="partpriceTotal"></div>
              <div class="p mb-0 font-weight-bold text-gray-800" id="partItems"></div>
            </div>
            <div class="col-auto">
              <a href="<?= base_url('beli') ?>">
                <i class="fas fa-cog fa-2x text-primary"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                Part Tunai & Tempo
              </div>
              <div class="p mb-0 font-weight-bold text-gray-800" id="partTunai"></div>
              <div class="p mb-0 font-weight-bold text-gray-800" id="partTempo"></div>
            </div>
            <div class="col-auto">
              <i class=" fas fa-dollar-sign fa-2x text-success"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                Total Belanja Ban
              </div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <div class="p mb-0 mr-3 font-weight-bold text-gray-800" id="banPriceTotal"></div>
                  <div class="p mb-0 mr-3 font-weight-bold text-gray-800" id="banItems"></div>
                </div>
              </div>
            </div>
            <div class="col-auto">
              <a href="<?= base_url('beli_ban') ?>">
                <i class="fas fa-dot-circle fa-2x text-info"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                Ban Tunai & Tempo
              </div>
              <div class="p mb-0 font-weight-bold text-gray-800" id="banTunai"></div>
              <div class="p mb-0 font-weight-bold text-gray-800" id="banTempo"></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-dollar-sign fa-2x text-warning"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg mb-4">
      <div class="card border-left-danger shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                Perbaikan Cabang
              </div>
              <div class="p mb-0 font-weight-bold text-gray-800" id="percabPriceTotal"></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-tools fa-2x text-danger"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">

    <div class="col-lg">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-baseline justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Pembelian Tahunan</h6>
          <div class="form-group">
            <input type="number" class="form-control" name="changeyear" id="changeyear" min="2020" value="<?= date('Y') ?>">
          </div>
        </div>
        <div class="card-body">
          <canvas id="partTahunan" style="height:550px !important"></canvas>
        </div>
      </div>
    </div>

  </div>
</div>
</div>

<footer class="sticky-footer bg-white">
  <div class="container my-auto">
    <div class="copyright text-center my-auto">
      <span>
        &copy; <?= date('Y') ?>
        Dibuat Dengan
      </span>
      <i class="fas fa-heart text-danger"></i>
      <a target="_blank" href="https://hira-express.com">PT. Hira Adya Naranata</a> Hak cipta di lindungi <div class="bullet"></div>
    </div>
  </div>
</footer>
</div>
</div>

<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>

<script src="<?= base_url('public/') ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('public/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="<?= base_url('public/') ?>vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="<?= base_url('public/') ?>vendor/sweetalert2/sweetalert2.all.min.js"></script>

<script src="<?= base_url('public/') ?>js/sb-admin-2.min.js"></script>

<script src="<?= base_url('public/') ?>vendor/chart.js/Chart.min.js"></script>

<script src="<?= base_url('public/') ?>js/pages/auth/swal.js"></script>

<script src="<?= base_url('public/') ?>js/pages/main/format.js"></script>

<script src="<?= base_url('public/') ?>js/pages/main/dashboard.js"></script>

<script src="<?= base_url('public/') ?>js/pages/main/jam.js"></script>

</body>

</html>