<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between flex-wrap">
          <h4 class="m-0 text-dark font-weight-bold">
            <?= $title ?>
          </h4>
          <div class="btn-group">
            <button type="button" class="btn btn-dark" id="btn-add-truck">
              <i class="fas fa-plus fa-sm"></i>
              Tambah
            </button>
          </div>

        </div>
        <div class="card-body" style="font-size:13px;">
          <div class="table-responsive">
            <table class="table table-bordered table-hover" id="truckTables" width="100%">
              <thead class="thead-dark text-center">
                <tr>
                  <th class="align-middle">No</th>
                  <th class="align-middle">Plat No</th>
                  <th class="align-middle">Merk</th>
                  <th class="align-middle">Jenis</th>
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

<!-- add Truck -->
<div class="modal fade p-0" id="addTruck" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content p-2">
      <div class="modal-header">
        <h5 class="modal-title text-dark font-weight-bold">Tambah Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="far fa-times-circle"></i>
        </button>
      </div>
      <div class="modal-body" style="font-size:13px;">
        <form id="form_addTruck">
          <div class="form-group">
            <label class="text-dark font-weight-bold" for="platno">
              Plat No
            </label>
            <input type="text" class="form-control text-capitalize" name="platno" id="platno" autocomplete="off" required oninvalid="this.setCustomValidity('Plat No Truck wajib di isi!')" oninput="setCustomValidity('')">
          </div>
          <div class="form-group">
            <label class="text-dark font-weight-bold" for="merk">
              Merk
            </label>
            <input type="text" class="form-control text-capitalize" name="merk" id="merk" autocomplete="off">
          </div>
          <div class="form-group">
            <label class="text-dark font-weight-bold" for="jenis">
              Jenis
            </label>
            <input type="text" class="form-control text-capitalize" name="jenis" id="jenis" autocomplete="off">
          </div>
          <div class="form-group">
            <button type="submit" id="add-truck" class="btn btn-primary btn-block">
              Simpan
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- edit Truck -->
<div class="modal fade p-0" id="editTruck" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content p-2">
      <div class="modal-header">
        <h5 class="modal-title text-dark font-weight-bold">Edit Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="far fa-times-circle"></i>
        </button>
      </div>
      <div class="modal-body" style="font-size:13px;">
        <form id="form_editTruck">
          <div class="form-group">
            <label class="text-dark font-weight-bold" for="platnoedit">
              Plat No
            </label>
            <input type="hidden" name="idtruck" id="idtruck" class="form-control" readonly required>
            <input type="text" class="form-control text-capitalize" name="platnoedit" id="platnoedit" autocomplete="off" required oninvalid="this.setCustomValidity('Plat No Truck wajib di isi!')" oninput="setCustomValidity('')">
          </div>
          <div class="form-group">
            <label class="text-dark font-weight-bold" for="merkedit">
              Merk
            </label>
            <input type="text" class="form-control text-capitalize" name="merkedit" id="merkedit" autocomplete="off">
          </div>
          <div class="form-group">
            <label class="text-dark font-weight-bold" for="jenisedit">
              Jenis
            </label>
            <input type="text" class="form-control text-capitalize" name="jenisedit" id="jenisedit" autocomplete="off">
          </div>
          <div class="form-group">
            <button type="submit" id="edit-truck" class="btn btn-primary btn-block">
              Simpan
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>