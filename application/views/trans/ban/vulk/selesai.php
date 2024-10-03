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
          <form action="<?= base_url('vulkanisir/prosesselesai') ?>" method="POST">

            <div class="form-row">
              <div class="form-group col-lg-3 col-md-3">
                <label class="font-weight-bold text-dark" for="tglselesai">Tanggal</label>
                <input type="date" name="tglselesai" id="tglselesai" value="<?= date('Y-m-d') ?>" class="form-control" autofocus required oninvalid="this.setCustomValidity('Tanggal wajib di isi!')" oninput="setCustomValidity('')">
              </div>
              <div class="form-group col-lg-3 col-md-3">
                <label class="font-weight-bold text-dark" for="nota">No Nota</label>
                <input type="text" name="nota" id="nota" class="form-control text-uppercase" required>
              </div>
              <div class="form-group col-lg-3 col-md-3">
                <label class="font-weight-bold text-dark" for="tempat">Tempat</label>
                <select name="tempat" id="tempat" class="form-control selecttoko" style="width:100%" required>
                  <option value=""></option>

                </select>
                <input type="hidden" name="toko" id="toko" class="form-control" readonly>
              </div>
              <div class="form-group col-lg-3 col-md-3">
                <label class="font-weight-bold text-dark" for="pay">Pembayaran</label>
                <select name="pay" id="pay" class="form-control selectpay" style="width:100%" required>
                  <option value=""></option>
                  <option value="Cash">Cash</option>
                  <option value="Tempo">Tempo</option>
                </select>
              </div>
            </div>

            <h5 class="font-weight-bold text-dark">Data Ban</h5>
            <hr>

            <div class="form-row">
              <div class="form-group col-lg-3 col-md-3">
                <label class="font-weight-bold text-dark" for="banid">No Seri</label>
                <select name="banid" id="banid" class="form-control selectban" style="width:100%" disabled>
                  <option value=""></option>

                </select>
                <input type="hidden" name="jmldivulk" id="jmldivulk" class="form-control" readonly>
              </div>
              <div class="form-group col-lg-3 col-md-3">
                <label class="font-weight-bold text-dark" for="merk">Merk</label>
                <input type="text" name="merk" id="merk" class="form-control" readonly>
                <input type="hidden" name="kdvulk" id="kdvulk" class="form-control" readonly>
              </div>
              <div class="form-group col-lg-3 col-md-3">
                <label class="font-weight-bold text-dark" for="size">Ukuran</label>
                <input type="text" name="size" id="size" class="form-control" readonly>
              </div>
              <div class="form-group col-lg-3 col-md-3">
                <label class="font-weight-bold text-dark" for="biaya">Biaya</label>
                <input type="text" name="biaya" id="biaya" class="form-control" readonly>
                <input type="hidden" name="jml" id="jml" class="form-control" readonly>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md mt-4">
                <button disabled type="button" class="btn btn-primary btn-block" id="tambah">
                  <i class="fa fa-plus fa-sm"></i>
                  Tambah
                </button>
              </div>
            </div>

            <div class="mt-4">
              <h5 class="font-weight-bold text-dark">List Vulkanisir Selesai</h5>
              <div class="table-responsive">
                <table class="table table-bordered" id="cart-selesai" style="width:100%">
                  <thead class="thead-dark text-center">
                    <tr>
                      <th class="align-middle">Seri</th>
                      <th class="align-middle">Merk</th>
                      <th class="align-middle">Ukuran</th>
                      <th class="align-middle">Jml</th>
                      <th class="align-middle">Biaya</th>
                      <th class="align-middle">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                  <tfoot class="text-center">
                    <tr>
                      <td colspan="3" class="align-middle">
                        <h5 class="font-weight-bold m-0">Total Ban Selesai Vulkanisir : </h5>
                      </td>
                      <td class="align-middle">
                        <h5 class="font-weight-bold text-danger m-0" id="totalban"></h5>
                      </td>
                      <td class="align-middle">
                        <h5 class="font-weight-bold text-danger m-0" id="totalbiaya"></h5>
                      </td>
                      <td class="align-middle">
                        <input type="hidden" name="totalban_hidden" value="">
                        <input type="hidden" name="total_hidden" value="">
                        <button type="submit" class="btn btn-success" id="btn-submitVulkDone">
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