<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between flex-wrap">
          <h4 class="m-0 text-dark font-weight-bold">
            <?= $title ?>
          </h4>

        </div>
        <div class="card-body" style="font-size:13px;">
          <div class="table-responsive">
            <table class="table table-bordered table-hover" id="banTables" width="100%">
              <thead class="thead-dark text-center">
                <tr>
                  <th class="align-middle">No</th>
                  <th class="align-middle">Seri</th>
                  <th class="align-middle">Merk</th>
                  <th class="align-middle">Ukuran</th>
                  <th class="align-middle">Qty</th>
                  <th class="align-middle">Kondisi</th>
                  <th class="align-middle">Status</th>
                  <th class="align-middle">Di Vulkanisir</th>
                  <th class="align-middle">In</th>
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

<!-- vulk Ban -->
<div class="modal fade p-0" id="vulkBan" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content p-2">
      <div class="modal-header">
        <h5 class="modal-title text-dark font-weight-bold">Ubah Kondisi Ban</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="far fa-times-circle"></i>
        </button>
      </div>
      <div class="modal-body" style="font-size:13px;">
        <form id="form_vulkBan">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="text-dark font-weight-bold" for="no_seri">No Seri</label>
                <input type="text" class="form-control" name="no_seri" id="no_seri" readonly>
              </div>
              <div class="form-group">
                <label class="text-dark font-weight-bold" for="nama_merk">Merk</label>
                <input type="text" class="form-control" name="nama_merk" id="nama_merk" readonly>
              </div>
              <div class="form-group">
                <label class="text-dark font-weight-bold" for="jml_ban">Jumlah</label>
                <input type="text" class="form-control" name="jml_ban" id="jml_ban" readonly>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="text-dark font-weight-bold" for="ukuran_ban">Ukuran</label>
                <input type="text" class="form-control" name="ukuran_ban" id="ukuran_ban" readonly>
              </div>
              <div class="form-group">
                <label class="text-dark font-weight-bold" for="vulk">Kondisi/V-1</label>
                <input type="text" class="form-control" name="vulk" id="vulk" readonly>
              </div>
              <div class="form-group">
                <label class="text-dark font-weight-bold" for="aksi">Pilih Aksi</label>
                <select name="aksi" id="aksi" class="form-control selectaksi" required>
                  <option value=""></option>
                  <option value="void">Void</option>
                  <option value="diberikan ke bengkel paket">Berikan ke Bengkel Paket</option>
                </select>
              </div>

            </div>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>