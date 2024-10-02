<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between flex-wrap">
          <h4 class="m-0 text-dark font-weight-bold">
            <?= $title ?>
          </h4>
          <div class="btn-group">
            <button type="button" class="btn btn-dark" id="btn-add-toko">
              <i class="fas fa-plus fa-sm"></i>
              Tambah
            </button>
          </div>

        </div>
        <div class="card-body" style="font-size:13px;">
          <div class="table-responsive">
            <table class="table table-bordered table-hover" id="tokoTables" width="100%">
              <thead class="thead-dark text-center">
                <tr>
                  <th class="align-middle">No</th>
                  <th class="align-middle">Nama</th>
                  <th class="align-middle">Telepon</th>
                  <th class="align-middle">Aksi</th>
                </tr>
              </thead>
              <tbody style="font-size:13px;">

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<!-- add Toko -->
<div class="modal fade p-0" id="addToko" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content p-2">
      <div class="modal-header">
        <h5 class="modal-title text-dark font-weight-bold">Tambah Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="far fa-times-circle"></i>
        </button>
      </div>
      <div class="modal-body" style="font-size:13px;">
        <form id="form_addToko">
          <div class="form-group">
            <label class="font-weight-bold text-dark" for="nama">
              Nama
            </label>
            <input type="text" class="form-control text-capitalize" name="nama" id="nama" autocomplete="off" required oninvalid="this.setCustomValidity('Nama Toko wajib di isi!')" oninput="setCustomValidity('')">
          </div>
          <div class="form-group">
            <label class="font-weight-bold text-dark" for="telp">
              Telepon
            </label>
            <input type="text" class="form-control text-capitalize" name="telp" id="telp" autocomplete="off">
          </div>
          <div class="form-group">
            <button type="submit" id="add-toko" class="btn btn-primary btn-block">
              Simpan
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- edit Toko -->
<div class="modal fade p-0" id="editToko" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content p-2">
      <div class="modal-header">
        <h4 class="modal-title text-dark font-weight-bold">Edit Data</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="far fa-times-circle"></i>
        </button>
      </div>
      <div class="modal-body" style="font-size:13px;">
        <form id="form_editToko">

          <div class="form-group">
            <label class="font-weight-bold text-dark" for="namaedit">
              Nama Toko
            </label>
            <input type="hidden" name="idtoko" id="idtoko" class="form-control" readonly required>
            <input type="text" class="form-control text-capitalize" name="namaedit" id="namaedit" autocomplete="off" required oninvalid="this.setCustomValidity('Nama Toko wajib di isi!')" oninput="setCustomValidity('')">
          </div>
          <div class="form-group">
            <label class="font-weight-bold text-dark" for="telpedit">
              No Telepon
            </label>
            <input type="text" class="form-control text-capitalize" name="telpedit" id="telpedit" autocomplete="off" required oninvalid="this.setCustomValidity('no Telepon Toko wajib di isi!')" oninput="setCustomValidity('')">
          </div>
          <div class="form-group">
            <button type="submit" id="edit-toko" class="btn btn-primary btn-block">
              Simpan
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>