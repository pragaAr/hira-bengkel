<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between flex-wrap">
          <h4 class="m-0 text-dark font-weight-bold">
            <?= $title ?>
          </h4>
          <div class="btn-group">
            <a href="<?= base_url('percab') ?>" class="btn btn-dark mb-2">
              <i class="fas fa-arrow-left fa-sm"></i>
              Kembali
            </a>
          </div>

        </div>
        <div class="card-body" style="font-size:13px;">
          <p class="text-danger font-weight-bold mb-1">
            <em>--Harap teliti dalam menginput data--</em>
          </p>
          <p class="text-danger font-weight-bold">
            <em>--Gunakan tanda (-) untuk pemisah nomor surat !--</em>
          </p>
          <hr>
          <form action="<?= base_url('percab/proses') ?>" method="POST">
            <div class="form-row">
              <div class="form-group col-lg-4 col-md-4">
                <label class="font-weight-bold text-dark" for="nosurat">No Surat </label>
                <input type="text" name="nosurat" id="nosurat" class="form-control text-uppercase" autofocus autocomplete="off" required>
              </div>
              <div class="form-group col-lg-4 col-md-4">
                <label class="font-weight-bold text-dark" for="tglsurat">Tgl Surat</label>
                <input type="date" name="tglsurat" id="tglsurat" class="form-control" required>
              </div>
              <div class="form-group col-lg-4 col-md-4">
                <label class="font-weight-bold text-dark" for="cabang">Cabang</label>
                <input type="text" name="cabang" id="cabang" class="form-control text-uppercase" autocomplete="off" required>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-lg-3 col-md-3">
                <label class="font-weight-bold text-dark" for="truckid">Truck</label>
                <select name="truckid" id="truckid" class="form-control selecttruck">
                  <option value=""></option>

                </select>
                <input type="hidden" name="platno" id="platno" class="form-control text-uppercase" readonly>
              </div>
              <div class="form-group col-lg-3 col-md-3">
                <label class="font-weight-bold text-dark" for="sopir">Sopir</label>
                <input type="text" name="sopir" id="sopir" class="form-control text-capitalize" autocomplete="off">
              </div>
              <div class="form-group col-lg-3 col-md-3">
                <label class="font-weight-bold text-dark" for="bengkel">Bengkel</label>
                <input type="text" name="bengkel" id="bengkel" class="form-control text-capitalize" autocomplete="off">
              </div>
              <div class="form-group col-lg-3 col-md-3">
                <label class="font-weight-bold text-dark" for="tglnota">Tgl Nota</label>
                <input type="date" name="tglnota" id="tglnota" class="form-control">
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-lg-6 col-md-6">
                <label class="font-weight-bold text-dark" for="part">Sparepart</label>
                <input type="text" name="part" id="part" class="form-control text-capitalize" autocomplete="off">
              </div>
              <div class="form-group col-lg-6 col-md-6">
                <label class="font-weight-bold text-dark" for="ongkos">Ongkos</label>
                <input type="text" name="ongkos" id="ongkos" class="form-control" autocomplete="off">
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-lg-10 col-md-10">
                <label class="font-weight-bold text-dark" for="ket">Keterangan Perbaikan</label>
                <input type="text" name="ket" id="ket" class="form-control text-capitalize" autocomplete="off">
              </div>
              <div class="form-group col-lg-2 col-md-2 d-flex align-items-end">
                <button type="button" class="btn btn-primary btn-block mt-4" id="tambah" style="border: 1px solid white; height:calc(1.5em + 0.75rem + 2px);">
                  <i class="fa fa-plus"></i>
                  Tambah
                </button>
              </div>
            </div>

            <div class="mt-4">
              <h5 class="text-dark font-weight-bold">Data Perbaikan Cabang</h5>
              <hr>
              <div class="table-responsive">
                <table class="table table-bordered" id="cart" width="100%">
                  <thead class="thead-dark text-center">
                    <tr>
                      <th>Truck</th>
                      <th>Bengkel</th>
                      <th>Tgl Nota</th>
                      <th>Sparepart</th>
                      <th>Ongkos</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                  <tfoot class="text-center">
                    <tr>
                      <td colspan="4">
                        <h5 class="font-weight-bold">Total Ongkos : </h5>
                      </td>
                      <td>
                        <h5 class="text-danger text-right font-weight-bold" id="total"> </h5>
                      </td>
                      <td>
                        <input type="hidden" name="total_hidden" value="">
                        <button type="submit" class="btn btn-success" data-toggle="tooltip" title="Simpan" style="border:1px solid white">
                          <i class="fa fa-save"></i>
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