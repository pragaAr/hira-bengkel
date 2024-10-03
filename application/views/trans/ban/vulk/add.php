<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between flex-wrap">
          <h4 class="m-0 text-dark font-weight-bold">
            <?= $title ?>
          </h4>
          <div class="btn-group">
            <a href="<?= base_url('vulkanisir') ?>" class="btn btn-dark mb-2">
              <i class="fas fa-arrow-left fa-sm"></i>
              Kembali
            </a>
          </div>

        </div>
        <div class="card-body" style="font-size:13px">
          <p class="text-danger font-weight-bold mb-3">
            <em>--Harap teliti dalam menginput data--</em>
          </p>
          <hr>
          <form action="<?= base_url('vulkanisir/proses') ?>" method="POST">

            <div class="form-row">
              <div class="form-group col-md-4">
                <label class="font-weight-bold text-dark" for="kd">Kd Vulk</label>
                <input type="text" name="kd" id="kd" value="<?= $kd ?>" class="form-control text-uppercase" readonly>
              </div>
              <div class="form-group col-md-4">
                <label class="font-weight-bold text-dark" for="tgl">Tanggal</label>
                <input type="date" name="tgl" id="tgl" value="<?= date('Y-m-d') ?>" class="form-control" autofocus required oninvalid="this.setCustomValidity('Tanggal wajib di isi!')" oninput="setCustomValidity('')">
              </div>
              <div class="form-group col-md-4">
                <label class="font-weight-bold text-dark" for="tokoid">Tempat Vulk</label>
                <select name="tokoid" id="tokoid" class="form-control selecttoko" style="width:100%" required>
                  <option value=""></option>

                </select>
                <input type="hidden" name="toko" id="toko" class="form-control" required readonly>
              </div>
            </div>

            <h5 class="font-weight-bold text-dark">Data Ban</h5>
            <hr>

            <div class="form-row">
              <div class="form-group col-md-3">
                <label class="font-weight-bold text-dark" for="banid">No Seri</label>
                <select name="banid" id="banid" class="form-control selectban" style="width:100%">
                  <option value=""></option>

                </select>
                <input type="hidden" name="noseri" id="noseri" class="form-control" readonly>
              </div>
              <div class="form-group col-md-3">
                <label class="font-weight-bold text-dark" for="merk">Merk Ban</label>
                <input type="text" name="merk" id="merk" class="form-control" readonly>
              </div>
              <div class="form-group col-md-3">
                <label class="font-weight-bold text-dark" for="size">Ukuran Ban</label>
                <input type="text" name="size" id="size" class="form-control" readonly>
              </div>
              <div class="form-group col-md-3">
                <label class="font-weight-bold text-dark" for="jml">Jumlah Ban</label>
                <input type="number" name="jml" id="jml" class="form-control" readonly>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-8">
                <label class="font-weight-bold text-dark" for="ket">Keterangan</label>
                <input type="text" name="ket" id="ket" class="form-control text-capitalize" readonly>
              </div>
              <div class="form-group col-md-4 d-flex align-items-end">
                <button type="button" class="btn btn-primary btn-block" id="tambah" style="height:calc(1.5em + 0.75rem + 2px);" disabled>
                  <i class="fa fa-plus"></i>
                  Tambah
                </button>
              </div>
            </div>

            <div class="mt-4">
              <h5 class="font-weight-bold text-dark">List Vulkanisir Ban</h5>
              <div class="table-responsive">
                <table class="table table-bordered" id="cart" style="width:100%" cellspacing="0">
                  <thead class="thead-dark text-center">
                    <tr>
                      <th class="align-middle">No Seri</th>
                      <th class="align-middle">Merk</th>
                      <th class="align-middle">Ukuran</th>
                      <th class="align-middle">Jumlah</th>
                      <th class="align-middle">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                  <tfoot class="text-center">
                    <tr>
                      <td colspan="3" class="align-middle">
                        <h5 class="font-weight-bold m-0">Total Ban Vulkanisir : </h5>
                      </td>
                      <td class="align-middle">
                        <h5 class="font-weight-bold text-danger m-0" id="totalban"></h5>
                      </td>
                      <td class="align-middle">
                        <input type="hidden" name="totalban_hidden" value="">
                        <button type="submit" class="btn btn-success" id="btn-submitVulk">
                          <i class="fas fa-save"></i>
                        </button>
                      </td>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>