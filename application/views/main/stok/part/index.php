<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card shadow">
        <div class="card-header py-3 d-flex align-items-center justify-content-between flex-wrap">
          <h4 class="m-0 text-dark font-weight-bold">
            <?= $title ?>
          </h4>
          <div class="btn-group">
            <button type="button" class="btn btn-dark" id="btn-add-stok">
              <i class="fas fa-plus fa-sm"></i>
              Tambah
            </button>
          </div>

        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-hover" id="stokTables" width="100%">
              <thead class="thead-dark text-center">
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Merk</th>
                  <th scope="col">Sat</th>
                  <th scope="col">Baru</th>
                  <th scope="col">Bks</th>
                  <th scope="col">Jml</th>
                  <th scope="col">Rak</th>
                  <th scope="col">In</th>
                  <th scope="col">Aksi</th>
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

<!-- add Stok -->
<div class="modal fade p-0" id="addStok" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content p-2">
      <div class="modal-header">
        <h5 class="modal-title text-dark font-weight-bold">Tambah Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="far fa-times-circle"></i>
        </button>
      </div>
      <div class="modal-body" style="font-size:13px;">
        <form id="form_addStok">
          <div class="form-row">
            <div class="form-group col-md-6 col-sm-6">
              <label class="text-dark font-weight-bold" for="nama">Nama</label>
              <input type="text" class="form-control text-uppercase" name="nama" id="nama" autocomplete="off" required oninvalid="this.setCustomValidity('Nama Sparepart wajib diisi!')" oninput="setCustomValidity('')">
            </div>
            <div class="form-group col-md-6 col-sm-6">
              <label class="text-dark font-weight-bold" for="merk">Pilih Merk</label>
              <select name="merk" id="merk" class="form-control selectmerk" style="width:100%;" required oninvalid="this.setCustomValidity('Merk wajib di isi!')" oninput="setCustomValidity('')">
                <option value=""></option>
              </select>
            </div>

          </div>
          <div class="form-row">
            <div class="form-group col-md-6 col-sm-6">
              <label class="text-dark font-weight-bold" for="baru">Baru</label>
              <input type="number" class="form-control" name="baru" id="baru" value="0" step="0.01" autocomplete="off" required oninvalid="this.setCustomValidity('Part Baru wajib diisi!')" oninput="setCustomValidity('')">
            </div>
            <div class="form-group col-md-6 col-sm-6">
              <label class="text-dark font-weight-bold" for="bekas">Bekas</label>
              <input type="number" class="form-control" name="bekas" id="bekas" value="0" step="0.01" autocomplete="off" required oninvalid="this.setCustomValidity('Part Bekas wajib diisi!')" oninput="setCustomValidity('')">
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6 col-sm-6">
              <label class="text-dark font-weight-bold" for="satuan">Satuan</label>
              <input type="text" class="form-control text-uppercase" name="satuan" id="satuan" autocomplete="off" required oninvalid="this.setCustomValidity('Satuan wajib diisi!')" oninput="setCustomValidity('')">
            </div>
            <div class="form-group col-md-6 col-sm-6">
              <label class="text-dark font-weight-bold" for="rak">Rak</label>
              <input type="text" class="form-control text-uppercase" name="rak" id="rak" autocomplete="off" required oninvalid="this.setCustomValidity('Rak wajib diisi!')" oninput="setCustomValidity('')">
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-12">
              <button type="submit" class="btn btn-primary btn-block">Simpan</button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>

<!-- edit Stok -->
<div class="modal fade p-0" id="editStok" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content p-2">
      <div class="modal-header">
        <h5 class="modal-title text-dark font-weight-bold">Edit Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="far fa-times-circle"></i>
        </button>
      </div>
      <div class="modal-body" style="font-size:13px;">
        <form id="form_editStok">
          <div class="form-row">
            <div class="form-group col-md-6 col-sm-6">
              <label class="text-dark font-weight-bold" for="namaedit">Nama</label>
              <input type="hidden" class="form-control" name="idstok" id="idstok" readonly>
              <input type="text" class="form-control text-uppercase" name="namaedit" id="namaedit" autocomplete="off" required oninvalid="this.setCustomValidity('Nama Sparepart wajib diisi!')" oninput="setCustomValidity('')">
            </div>
            <div class="form-group col-md-6 col-sm-6">
              <label class="text-dark font-weight-bold" for="merkedit">Pilih Merk</label>
              <select name="merkedit" id="merkedit" class="form-control selectmerkedit" style="width:100%;" required oninvalid="this.setCustomValidity('Merk wajib di isi!')" oninput="setCustomValidity('')">
                <option value=""></option>
              </select>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6 col-sm-6">
              <label class="text-dark font-weight-bold" for="baruedit">Baru</label>
              <input type="number" class="form-control" name="baruedit" id="baruedit" value="0" step="0.01" autocomplete="off" required oninvalid="this.setCustomValidity('Part Baru wajib diisi!')" oninput="setCustomValidity('')">
            </div>
            <div class="form-group col-md-6 col-sm-6">
              <label class="text-dark font-weight-bold" for="bekasedit">Bekas</label>
              <input type="number" class="form-control" name="bekasedit" id="bekasedit" value="0" step="0.01" autocomplete="off" required oninvalid="this.setCustomValidity('Part Bekas wajib diisi!')" oninput="setCustomValidity('')">
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6 col-sm-6">
              <label class="text-dark font-weight-bold" for="satuanedit">Satuan</label>
              <input type="text" class="form-control text-uppercase" name="satuanedit" id="satuanedit" autocomplete="off" required oninvalid="this.setCustomValidity('Satuan wajib diisi!')" oninput="setCustomValidity('')">
            </div>
            <div class="form-group col-md-6 col-sm-6">
              <label class="text-dark font-weight-bold" for="rakedit">Rak</label>
              <input type="text" class="form-control text-uppercase" name="rakedit" id="rakedit" autocomplete="off" required oninvalid="this.setCustomValidity('Rak wajib diisi!')" oninput="setCustomValidity('')">
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-12">
              <button type="submit" class="btn btn-primary btn-block">Simpan</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>