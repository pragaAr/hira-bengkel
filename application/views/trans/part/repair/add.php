<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between flex-wrap">
          <h4 class="m-0 text-dark font-weight-bold">
            <?= $title ?>
          </h4>
          <div class="btn-group">
            <a href="<?= base_url('repair') ?>" class="btn btn-dark mb-2">
              <i class="fas fa-arrow-left fa-sm"></i>
              Kembali
            </a>
          </div>

        </div>
        <div class="card-body" style="font-size:13px">
          <h6 class="text-danger font-weight-bold mb-3">
            <em>--Harap teliti dalam menginput data--</em>
          </h6>
          <hr>
          <form action="<?= base_url('repair/proses') ?>" id="form-tambah" method="POST">
            <div class="form-row">
              <div class="form-group col-lg-4 col-md-4">
                <label class="font-weight-bold text-dark" for="kd">Kd Repair</label>
                <input type="text" name="kd" id="kd" class="form-control text-uppercase" value="<?= $kd ?>" readonly>
              </div>
              <div class="form-group col-lg-4 col-md-4">
                <label class="font-weight-bold text-dark" for="tokoid">Tempat Repair</label>
                <div class="input-group">
                  <select name="tokoid" id="tokoid" class="form-control selecttoko" required>
                    <option value=""></option>

                  </select>
                  <div class="input-group-append">
                    <button type="button" class="btn btn-secondary btn-add-toko" data-toggle="modal" data-target="#modal-addnew-toko">
                      <i class="fas fa-plus fa-sm"></i>
                    </button>
                  </div>
                </div>
                <input type="hidden" name="toko" id="toko" class="form-control" readonly>
              </div>
              <div class="form-group col-lg-4 col-md-4">
                <label class="font-weight-bold text-dark" for="tgl">Tanggal</label>
                <input type="text" name="tgl" id="tgl" class="form-control" value="<?= date('d-m-Y') ?>" readonly>
              </div>
            </div>

            <h5 class="text-dark font-weight-bold">Data Part</h5>
            <hr>

            <div class="form-row">
              <div class="form-group col-lg-6 col-md-6">
                <label class="font-weight-bold text-dark" for="partid">Jenis Part</label>
                <select name="partid" id="partid" class="form-control selectpart">
                  <option value=""></option>

                </select>
                <input type="hidden" name="partname" id="partname" class="form-control" required readonly>
              </div>
              <div class="form-group col-lg-3 col-md-3">
                <label class="font-weight-bold text-dark" for="merk">Merk</label>
                <input type="text" name="merk" id="merk" class="form-control" readonly>
                <input type="hidden" name="merkid" id="merkid" class="form-control" readonly>
              </div>
              <div class="form-group col-lg-3 col-md-3">
                <label class="font-weight-bold text-dark" for="sat">Satuan</label>
                <input type="text" name="sat" id="sat" class="form-control" readonly>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-lg-2 col-md-2">
                <label class="font-weight-bold text-dark" for="jml">Jumlah</label>
                <input type="number" name="jml" id="jml" class="form-control" required readonly>
              </div>
              <div class="form-group col-lg-2 col-md-2">
                <label class="font-weight-bold text-dark" for="statpart">Status</label>
                <select name="statpart" id="statpart" class="form-control selectstatpart" disabled="true">
                  <option value=""></option>
                  <option value="Baru">Baru</option>
                  <option value="Bekas">Bekas</option>
                </select>
                <input type="hidden" name="baru" id="baru" class="form-control" readonly>
                <input type="hidden" name="bekas" id="bekas" class="form-control" readonly>
              </div>
              <div class="form-group col-lg-6 col-md-6">
                <label class="font-weight-bold text-dark" for="ket">Keterangan</label>
                <input type="text" name="ket" id="ket" class="form-control text-capitalize" required readonly>
              </div>
              <div class="form-group col-lg-2 col-md-2 d-flex align-items-end">
                <button type="button" class="btn btn-secondary btn-block mt-4" id="tambah" style="border: 1px solid white; height:calc(1.5em + 0.75rem + 2px);" disabled>
                  <i class="fa fa-plus"></i>
                  Tambah
                </button>
              </div>
            </div>

            <div class="mt-4">
              <h5 class="text-dark font-weight-bold">Data Repair</h5>
              <hr>
              <div class="table-responsive">
                <table class="table table-bordered" id="cart" width="100%">
                  <thead class="thead-dark text-center">
                    <tr>
                      <th class="align-middle" width="25%">Part</th>
                      <th class="align-middle" width="25%">Merk</th>
                      <th class="align-middle" width="25%">Status</th>
                      <th class="align-middle" width="25%">Jumlah</th>
                      <th class="align-middle" width="15%">Sat</th>
                      <th class="align-middle" width="15%">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                  <tfoot class="text-center">
                    <tr>
                      <td colspan="3" class="align-middle">
                        <h5 class="font-weight-bold">Total Repair : </h5>
                      </td>
                      <td colspan="2" class="align-middle">
                        <h5 class="font-weight-bold text-danger" id="totalpart"></h5>
                      </td>
                      <td class="align-middle">
                        <input type="hidden" name="totalpart_hidden" value="">
                        <button type="submit" class="btn btn-success" data-toggle="tooltip" title="Simpan">
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

<!-- add Toko -->
<div class="modal fade p-0" id="modal-addnew-toko" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content p-2">
      <div class="modal-header">
        <h5 class="modal-title text-dark font-weight-bold" id="modal-addnew-toko">Tambah Toko</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="far fa-times-circle"></i>
        </button>
      </div>
      <form>
        <div class="modal-body" style="font-size:13px">
          <div class="row">
            <div class="col-lg">
              <div class="form-group">
                <label class="font-weight-bold text-dark" for="namatoko">Nama</label>
                <input type="text" class="form-control text-uppercase" name="namatoko" id="namatoko" autocomplete="off" required oninvalid="this.setCustomValidity('Nama Toko wajib diisi!')" oninput="setCustomValidity('')">
              </div>
              <div class="form-group">
                <label class="font-weight-bold text-dark" for="telptoko">Telepon</label>
                <input type="text" class="form-control text-uppercase" name="telptoko" id="telptoko" autocomplete="off">
              </div>
              <div class="form-group">
                <button type="submit" id="btn-submit-toko" class="btn btn-primary btn-block">Tambah</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>