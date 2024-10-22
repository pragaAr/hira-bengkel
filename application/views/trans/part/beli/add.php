<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between flex-wrap">
          <h4 class="m-0 text-dark font-weight-bold">
            <?= $title ?>
          </h4>
          <div class="btn-group">
            <a href="<?= base_url('beli') ?>" class="btn btn-dark mb-2">
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
          <form action="<?= base_url('beli/proses') ?>" id="form-tambah" method="POST">
            <div class="form-row">
              <div class="form-group col-lg-3 col-md-6">
                <label class="font-weight-bold text-dark" for="kd_beli">No. D.O</label>
                <input type="text" name="kd_beli" id="kd_beli" class="form-control text-uppercase" value="<?= $kd ?>" readonly>
              </div>
              <div class="form-group col-lg-3 col-md-6">
                <label class="font-weight-bold text-dark" for="petugas">Petugas</label>
                <input type="text" name="petugas" id="petugas" value="<?= $this->session->userdata('username') ?>" class="form-control" readonly>
              </div>
              <div class="form-group col-lg-3 col-md-6">
                <label class="font-weight-bold text-dark" for="belipart_add">Tanggal</label>
                <input type="date" name="belipart_add" id="belipart_add" value="<?= date('Y-m-d') ?>" class="form-control" autofocus required oninvalid="this.setCustomValidity('Tanggal wajib di isi!')" oninput="setCustomValidity('')">
              </div>
              <div class="form-group col-lg-3 col-md-6">
                <label class="font-weight-bold text-dark" for="nota_belipart">No Nota</label>
                <input type="text" name="nota_belipart" id="nota_belipart" value="" class="form-control text-capitalize" autofocus autocomplete="off">
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-lg-5 col-md-6">
                <label class="font-weight-bold text-dark" for="toko_belipart">Toko</label>
                <div class="input-group">
                  <select name="toko_belipart" id="toko_belipart" class="form-control selecttoko" style="width:100%" required oninvalid="this.setCustomValidity('Toko wajib di isi!')" oninput="setCustomValidity('')">
                    <option value=""></option>
                  </select>
                  <div class="input-group-append">
                    <button type="button" class="btn btn-secondary btn-add-toko" data-toggle="modal" data-target="#modal-addnew-toko">
                      <i class="fas fa-plus"></i>
                    </button>
                  </div>
                </div>
                <input type="hidden" name="toko" id="toko" class="form-control" readonly>
              </div>
              <div class="form-group col-lg-3 col-md-6">
                <label class="font-weight-bold text-dark" for="status_bayar">Pembayaran</label>
                <select name="status_bayar" id="status_bayar" class="form-control status_bayar" style="width:100%;" required oninvalid="this.setCustomValidity('Pembayaran wajib di isi!')" oninput="setCustomValidity('')">
                  <option value=""></option>
                  <option value="lunas">Lunas</option>
                  <option value="tempo">Tempo</option>
                </select>
              </div>
              <div class="form-group col-lg-2 col-md-6">
                <label class="font-weight-bold text-dark" for="diskon_belipart">Diskon/all</label>
                <input type="text" name="diskon_belipart" id="diskon_belipart" class="form-control" min='0' value='0'>
              </div>
              <div class="form-group col-lg-2 col-md-6">
                <label class="font-weight-bold text-dark" for="ppn_belipart">PPN</label>
                <input type="text" name="ppn_belipart" id="ppn_belipart" class="form-control" min='0' value='0'>
              </div>
            </div>
            <h5 class="text-dark font-weight-bold mt-3">Data Sparepart</h5>
            <hr>
            <div class="form-row">
              <?php if ($this->session->userdata('user_role') === 'admin') { ?>
                <div class="form-group col-lg-6 col-md-12">
                  <label class="font-weight-bold text-dark" for="part_belipart">Sparepart</label>
                  <div class="input-group">
                    <select name="part_belipart" id="part_belipart" class="form-control selectpart" style="width:100%">
                      <option value=""></option>
                    </select>
                    <div class="input-group-append">
                      <button type="button" class="btn btn-secondary btn-add-part" data-toggle="modal" data-target="#modal-addnew-part">
                        <i class="fas fa-plus"></i>
                      </button>
                    </div>
                  </div>
                  <input type="hidden" class="form-control" name="partid" id="partid" readonly>
                  <input type="hidden" class="form-control" name="partname" id="partname" readonly>
                </div>
              <?php } else { ?>
                <div class="form-group col-lg-6 col-md-12">
                  <label class="font-weight-bold text-dark" for="part_belipart">Sparepart</label>
                  <div class="input-group">
                    <select name="part_belipart" id="part_belipart" class="form-control selectpart" style="width:100%">
                      <option value=""></option>
                    </select>
                    <input type="hidden" class="form-control" name="partid" id="partid" readonly>
                    <input type="hidden" class="form-control" name="partname" id="partname" readonly>
                  </div>
                </div>
              <?php } ?>

              <div class="form-group col-lg-3 col-md-6">
                <label class="font-weight-bold text-dark" for="sat">Satuan</label>
                <input type="text" name="sat" id="sat" class="form-control" readonly>
              </div>
              <div class="form-group col-lg-3 col-md-6">
                <label class="font-weight-bold text-dark" for="merk_part">Merk</label>
                <input type="text" name="merk_part" id="merk_part" class="form-control" readonly>
                <input type="hidden" name="merk_partid" id="merk_partid" class="form-control" readonly>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-lg-2 col-md-6">
                <label class="font-weight-bold text-dark" for="jml_beli">Jumlah</label>
                <input type="text" name="jml_beli" id="jml_beli" value="1" min="1" class="form-control" readonly>
              </div>
              <div class="form-group col-lg-3 col-md-6">
                <label class="font-weight-bold text-dark" for="harga_pcs">Harga/pcs</label>
                <input type="text" name="harga_pcs" id="harga_pcs" value="0" min="0" class="form-control" readonly>
              </div>
              <div class="form-group col-lg-3 col-md-6">
                <label class="font-weight-bold text-dark" for="diskon">Diskon/item</label>
                <input type="text" name="diskon" id="diskon" value="0" min="0" class="form-control" readonly>
              </div>
              <div class="form-group col-lg-4 col-md-6">
                <label class="font-weight-bold text-dark" for="status_part_beli">Status</label>
                <select name="status_part_beli" id="status_part_beli" class="form-control status_part_beli" style="width:100%;" disabled="true">
                  <option value=""></option>
                  <option value="baru">Baru</option>
                  <option value="bekas">Bekas</option>
                </select>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-lg-5 col-md-6">
                <label class="font-weight-bold text-dark" for="ket_beli">Keterangan</label>
                <input type="text" name="ket_beli" id="ket_beli" value="" class="form-control text-capitalize" readonly>
              </div>
              <div class="form-group col-lg-5 col-md-6">
                <label class="font-weight-bold text-dark" for="total_min_diskon">Sub Total</label>
                <input type="text" name="total_min_diskon" id="total_min_diskon" value="" class="form-control" readonly>
              </div>
              <div class="form-group col-lg-2 col-md-12 d-flex align-items-end">
                <button type="button" class="btn btn-secondary btn-block mt-4" id="tambah" style="height:calc(1.5em + 0.75rem + 2px);" disabled>
                  <i class="fa fa-plus"></i>
                  Tambah
                </button>
              </div>
            </div>

            <div class="mt-4">
              <h5 class="text-dark font-weight-bold">Data Pembelian</h5>
              <hr>
              <div class="table-responsive">
                <table class="table table-bordered" id="cart" width="100%">
                  <thead class="thead-dark text-center">
                    <tr>
                      <th class="align-middle" width="20%">Part</th>
                      <th class="align-middle" width="15%">Jumlah</th>
                      <th class="align-middle" width="15%">Sat</th>
                      <th class="align-middle" width="20%">Harga/pcs</th>
                      <th class="align-middle" width="15%">Diskon</th>
                      <th class="align-middle" width="15%">Status</th>
                      <th class="align-middle" width="25%">Total</th>
                      <th class="align-middle" width="20%">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                  <tfoot class="text-center">
                    <tr>
                      <td colspan="4">
                        <h5>Total Pembelian : </h5>
                      </td>
                      <td>
                        <h5 class="text-danger font-weight-bold" id="totalpart"></h5>
                      </td>
                      <td colspan="2">
                        <h5 class="text-danger text-right font-weight-bold" id="total"> </h5>
                      </td>
                      <td>
                        <input type="hidden" name="totalpart_hidden" id="totalpart_hidden" value="">
                        <input type="hidden" name="total_hidden" id="total_hidden" value="">
                        <button type="submit" class="btn btn-sm btn-success" id="btn-submitBeli" title="Simpan">
                          <i class="fa fa-save fa-sm"></i></button>
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
        <h5 class="modal-title text-dark font-weight-bold" id="modal-addnew-toko">Tambah Data Toko</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="far fa-times-circle"></i>
        </button>
      </div>
      <form>
        <div class="modal-body" style="font-size:13px">
          <div class="form-group">
            <label class="font-weight-bold text-dark" for="namatoko">Nama</label>
            <input type="text" class="form-control text-uppercase" name="namatoko" id="namatoko" autocomplete="off" required oninvalid="this.setCustomValidity('Nama Toko wajib diisi!')" oninput="setCustomValidity('')">
          </div>
          <div class="form-group">
            <label class="font-weight-bold text-dark" for="telptoko">Telepon</label>
            <input type="text" class="form-control text-uppercase" name="telptoko" id="telptoko" autocomplete="off">
          </div>
          <div class="form-group text-right">
            <button type="submit" id="btn-submit-toko" class="btn btn-primary btn-block">Tambah</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- add Part -->
<div class="modal fade p-0" id="modal-addnew-part" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content p-2">
      <div class="modal-header">
        <h5 class="modal-title text-dark font-weight-bold" id="modal-addnew-part">Tambah Data Sparepart</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="far fa-times-circle"></i>
        </button>
      </div>
      <form>
        <div class="modal-body" style="font-size:13px">
          <div class="form-row">
            <div class="form-group col-lg-6 col-md-6">
              <label class="font-weight-bold text-dark" for="namapart">Nama Sparepart</label>
              <input type="text" class="form-control text-uppercase" name="namapart" id="namapart" autocomplete="off" required oninvalid="this.setCustomValidity('Nama Sparepart wajib diisi!')" oninput="setCustomValidity('')">
            </div>
            <div class="form-group col-lg-6 col-md-6">
              <label class="font-weight-bold text-dark" for="namamerk">Merk</label>
              <div class="input-group">
                <select name="namamerk" id="namamerk" class="form-control selectmerk" style="width:100%" required oninvalid="this.setCustomValidity('Merk wajib di isi!')" oninput="setCustomValidity('')">
                  <option value=""></option>
                </select>
                <div class="input-group-append">
                  <button type="button" class="btn btn-secondary" id="btn-add-merk">
                    <i class="fas fa-plus"></i>
                  </button>
                </div>
              </div>

              <input type="hidden" class="form-control" name="merknama" id="merknama" readonly>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-lg-6 col-md-6">
              <label class="font-weight-bold text-dark" for="baru">Part Baru</label>
              <input type="number" class="form-control" name="baru" id="baru" value="0" step="0.01" autocomplete="off" required oninvalid="this.setCustomValidity('Part Baru wajib diisi!')" oninput="setCustomValidity('')">
            </div>
            <div class="form-group col-lg-6 col-md-6">
              <label class="font-weight-bold text-dark" for="bekas">Part Bekas</label>
              <input type="text" class="form-control" name="bekas" id="bekas" value="0" step="0.01" autocomplete="off" required oninvalid="this.setCustomValidity('Part Bekas wajib diisi!')" oninput="setCustomValidity('')">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-lg-6 col-md-6">
              <label class="font-weight-bold text-dark" for="satuan">Satuan</label>
              <input type="text" class="form-control text-uppercase" name="satuan" id="satuan" autocomplete="off" required oninvalid="this.setCustomValidity('Satuan wajib diisi!')" oninput="setCustomValidity('')">
            </div>
            <div class="form-group col-lg-6 col-md-6">
              <label class="font-weight-bold text-dark" for="rak">Rak</label>
              <input type="text" class="form-control text-uppercase" name="rak" id="rak" autocomplete="off" required oninvalid="this.setCustomValidity('Rak wajib diisi!')" oninput="setCustomValidity('')">
            </div>
            <div class="form-group col-md-12">
              <button type="submit" id="btn-submit-part" class="btn btn-primary btn-block">Tambah</button>
            </div>
          </div>

        </div>
      </form>
    </div>
  </div>
</div>

<!-- add Merk -->
<div class="modal fade p-0" id="modal-addnew-merk" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content p-2">
      <div class="modal-header">
        <h5 class="modal-title text-dark font-weight-bold">Tambah Data Merk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="far fa-times-circle"></i>
        </button>
      </div>
      <form>
        <div class="modal-body" style="font-size:13px">
          <div class="form-group">
            <label class="font-weight-bold text-dark" for="addnewmerk">Merk</label>
            <input type="text" class="form-control text-uppercase" name="addnewmerk" id="addnewmerk" autocomplete="off" required oninvalid="this.setCustomValidity('Merk wajib diisi!')" oninput="setCustomValidity('')">
          </div>
          <div class="form-group">
            <button type="submit" id="btn-submit-merk" class="btn btn-primary btn-block">Tambah</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>