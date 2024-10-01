<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between flex-wrap">
          <h4 class="m-0 font-weight-bold">
            <?= $title ?>
          </h4>
          <div class="btn-group">
            <a href="<?= base_url('beli_ban') ?>" class="btn btn-sm btn-dark mb-2">
              <i class="fas fa-arrow-left fa-sm"></i>
              Kembali
            </a>
          </div>

        </div>
        <div class="card-body">
          <h6 class="text-danger font-weight-bold mb-3">
            <em>--Harap teliti dalam menginput data--</em>
          </h6>
          <hr>
          <form action="<?= base_url('beli_ban/proses') ?>" method="POST">
            <div class="form-row">

              <div class="form-group col-lg-3 col-md-3">
                <label class="font-weight-bold" for="kdbeli">No. D.O</label>
                <input type="text" name="kdbeli" id="kdbeli" class="form-control text-uppercase" value="<?= $kd ?>" readonly>
              </div>
              <div class="form-group col-lg-3 col-md-3">
                <label class="font-weight-bold" for="tglbeli">Tanggal Nota</label>
                <input type="date" name="tglbeli" id="tglbeli" value="<?= date('Y-m-d') ?>" class="form-control" autofocus required oninvalid="this.setCustomValidity('Toko wajib di isi!')" oninput="setCustomValidity('')">
              </div>
              <div class="form-group col-lg-6 col-md-6">
                <label class="font-weight-bold" for="nota">Nomor Nota</label>
                <input type="text" name="nota" id="nota" class="form-control text-uppercase" autocomplete="off">
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-lg-3 col-md-3">
                <label class="font-weight-bold" for="tokoid">Toko</label>
                <div class="input-group">
                  <select name="tokoid" id="tokoid" class="form-control selecttoko" style="width:100%" required oninvalid="this.setCustomValidity('Toko wajib di isi!')" oninput="setCustomValidity('')">
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
              <div class="form-group col-lg-3 col-md-3">
                <label class="font-weight-bold" for="statusbayar">Pembayaran</label>
                <select name="statusbayar" id="statusbayar" class="form-control selectstatusbayar" style="width:100%" required>
                  <option value=""></option>
                  <option value="Lunas">Lunas</option>
                  <option value="Tempo">Tempo</option>
                </select>
              </div>
              <div class="form-group col-lg-3 col-md-3">
                <label class="font-weight-bold" for="diskall">Diskon/all</label>
                <input type="text" name="diskall" id="diskall" class="form-control" min='0' value='0'>
              </div>
              <div class="form-group col-lg-3 col-md-3">
                <label class="font-weight-bold" for="ppn">PPN</label>
                <input type="text" name="ppn" id="ppn" class="form-control" min='0' value='0'>
              </div>
            </div>

            <h5>Data Ban</h5>
            <hr>

            <div class="form-row">
              <div class="form-group col-lg-4 col-md-4">
                <label class="font-weight-bold" for="noseri">No Seri</label>
                <input type="text" name="noseri" id="noseri" value="" class="form-control text-uppercase">
                <div class="output"></div>
              </div>
              <div class="form-group col-lg-4 col-md-4">
                <label class="font-weight-bold" for="merkid">Merk</label>
                <select name="merkid" id="merkid" class="form-control selectmerk" style="width:100%" required disabled>
                  <option value="">-</option>

                </select>
                <input type="hidden" name="merk" id="merk" readonly>
              </div>
              <div class="form-group col-lg-4 col-md-4">
                <label class="font-weight-bold" for="size">Ukuran</label>
                <select name="size" id="size" class="form-control selectsize" style="width:100%" required disabled>
                  <option value=""></option>
                  <option value="600-13">600-13</option>
                  <option value="700-14">700-14</option>
                  <option value="750-15">750-15</option>
                  <option value="750-16">750-16</option>
                  <option value="900-20">900-20</option>
                  <option value="1000-20">1000-20</option>
                </select>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-lg-2 col-md-2">
                <label class="font-weight-bold" for="jmlbeli">Jumlah</label>
                <input type="text" name="jmlbeli" id="jmlbeli" value="1" class="form-control" readonly required>
              </div>
              <div class="form-group col-lg-4 col-md-4">
                <label class="font-weight-bold" for="hrg">Harga</label>
                <input type="text" name="hrg" id="hrg" value='0' min='0' class="form-control" required readonly>
              </div>
              <div class="form-group col-lg-3 col-md-3">
                <label class="font-weight-bold" for="disk">Diskon/item</label>
                <input type="text" name="disk" id="disk" value='0' min='0' class="form-control" readonly required>
              </div>
              <div class="form-group col-lg-3 col-md-3">
                <label class="font-weight-bold" for="stat">Status Ban</label>
                <select name="stat" id="stat" class="form-control selectstat" style="width:100%" disabled>
                  <option value=""></option>
                  <option value="0">Ori</option>
                  <option value="1">Vulkanisir</option>
                </select>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-lg-6 col-md-4">
                <label class="font-weight-bold" for="ket">Keterangan</label>
                <input type="text" name="ket" id="ket" class="form-control text-capitalize" required readonly autocomplete="off">
              </div>
              <div class="form-group col-lg-4 col-md-4">
                <label class="font-weight-bold" for="totmindisk">Sub Total</label>
                <input type="text" name="totmindisk" id="totmindisk" class="form-control"value='0' readonly>
              </div>
              <div class="form-group col-lg-2 col-md-4 d-flex align-items-end">
                <button type="button" class="btn btn-secondary btn-block mt-4" id="tambah" style="height:calc(1.5em + 0.75rem + 2px);" disabled>
                  <i class="fa fa-plus"></i>
                  Tambah
                </button>
              </div>
            </div>

            <div class="mt-4">
              <h5>List Pembelian</h5>
              <div class="table-responsive">
                <table class="table table-bordered" id="cart" width="100%" cellspacing="0">
                  <thead class="text-center">
                    <tr>
                      <td>No Seri</td>
                      <td>Merk</td>
                      <td>Ukuran</td>
                      <td>Harga</td>
                      <td>Diskon</td>
                      <td>Jumlah</td>
                      <td>Total</td>
                      <td>Aksi</td>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                  <tfoot class="text-center">
                    <tr>
                      <td colspan="4" class="align-middle">
                        <h5 class="font-weight-bold m-0">Total Pembelian : </h5>
                      </td>
                      <td class="align-middle">
                        <h5 class="text-danger font-weight-bold m-0" id="totalban"></h5>
                      </td>
                      <td colspan="2" class="align-middle">
                        <h5 class="text-danger text-right font-weight-bold m-0" id="total"> </h5>
                      </td>
                      <td class="align-middle">
                        <input type="hidden" name="totalban_hidden" value="">
                        <input type="hidden" name="total_hidden" value="">
                        <button type="submit" class="btn btn-success" id="btn-submitBan">
                          Simpan
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

<footer class="sticky-footer bg-white">
  <div class="container my-auto">
    <div class="copyright text-center my-auto">
      <span>
        &copy; <?= date('Y') ?>
        Dibuat Dengan
      </span>
      <i class="fas fa-heart text-danger"></i>
      <a target="_blank" href="https://hira-express.com">PT. Hira Adya Naranata</a>
      Hak cipta di lindungi
      <div class="bullet"></div>
    </div>
  </div>
</footer>
</div>
</div>

<!-- add Toko -->
<div class="modal fade" id="modal-addnew-toko" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content p-3">
      <div class="modal-header">
        <h5 class="modal-title text-dark" id="modal-addnew-toko">Tambah Data Toko</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form>
        <div class="modal-body">
          <div class="row">
            <div class="col-lg">
              <div class="form-group">
                <label for="namatoko">Nama Toko</label>
                <input type="text" class="form-control text-uppercase" name="namatoko" id="namatoko" autocomplete="off" required oninvalid="this.setCustomValidity('Nama Toko wajib diisi!')" oninput="setCustomValidity('')">
              </div>
              <div class="form-group">
                <label for="telptoko">Telp Toko</label>
                <input type="text" class="form-control text-uppercase" name="telptoko" id="telptoko" autocomplete="off">
              </div>
              <div class="form-group text-right">
                <button type="submit" id="btn-submit-toko" class="btn btn-primary btn-sm">Tambah</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>

<script src="<?= base_url('public/') ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('public/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="<?= base_url('public/') ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<script src="<?= base_url('public/') ?>vendor/select2/select2-full.min.js"></script>

<script src="<?= base_url('public/') ?>vendor/sweetalert2/sweetalert2.all.min.js"></script>

<script src="<?= base_url('public/') ?>js/sb-admin-2.min.js"></script>

<script src="<?= base_url('public/') ?>js/pages/main/format.js"></script>

<script src="<?= base_url('public/') ?>js/pages/trans/ban/beli/add.js"></script>

<script src="<?= base_url('public/') ?>js/pages/main/jam.js"></script>

</body>

</html>