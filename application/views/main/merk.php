<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between flex-wrap">
          <h4 class="m-0 text-dark font-weight-bold">
            <?= $title ?>
          </h4>
          <div class="btn-group">
            <button type="button" class="btn btn-dark" id="btn-add-merk">
              <i class="fas fa-plus fa-sm"></i>
              Tambah
            </button>
          </div>

        </div>
        <div class="card-body" style="font-size:13px;">
          <div class="table-responsive">
            <table class="table table-bordered table-hover" id="merkTables" width="100%">
              <thead class="thead-dark text-center">
                <tr>
                  <th class="align-middle">No</th>
                  <th class="align-middle">Merk</th>
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

<!-- add Merk -->
<div class="modal fade p-0" id="addMerk" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content p-2">
      <div class="modal-header">
        <h5 class="modal-title text-dark font-weight-bold">Tambah Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="far fa-times-circle"></i>
        </button>
      </div>
      <div class="modal-body" style="font-size:13px;">
        <form id="form_addMerk">
          <div class="form-row">
            <div class="form-group col-md-12">
              <label class="text-dark font-weight-bold" for="merk">
                Nama Merk
              </label>
              <input type="text" class="form-control text-capitalize" name="merk" id="merk" autocomplete="off" required oninvalid="this.setCustomValidity('Merk wajib di isi!')" oninput="setCustomValidity('')">
            </div>
            <div class="form-group col-md-12">
              <button type="submit" id="add-merk" class="btn btn-primary btn-block">
                Simpan
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- edit Merk -->
<div class="modal fade p-0" id="editMerk" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content p-2">
      <div class="modal-header">
        <h4 class="modal-title text-dark font-weight-bold">Edit Data</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="far fa-times-circle"></i>
        </button>
      </div>
      <div class="modal-body" style="font-size:13px;">
        <form id="form_editMerk">

          <div class="form-row">
            <div class="form-group col-md-12">
              <label class="text-dark font-weight-bold" for="merkedit">
                Nama Merk
              </label>
              <input type="hidden" name="idmerk" id="idmerk" class="form-control" readonly required>
              <input type="text" class="form-control text-capitalize" name="merkedit" id="merkedit" placeholder="Nama Merk.." autocomplete="off" required oninvalid="this.setCustomValidity('Nama Merk wajib di isi!')" oninput="setCustomValidity('')">
            </div>
            <div class="form-group col-md-12">
              <button type="submit" id="edit-merk" class="btn btn-primary btn-block">
                Simpan
              </button>
            </div>
          </div>
          <div>

          </div>
        </form>
      </div>
    </div>
  </div>
</div>