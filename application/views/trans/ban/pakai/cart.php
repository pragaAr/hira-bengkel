<tr class="cart text-center">

  <?= $this->input->post('truckid') ?>
  <input type="hidden" name="truckid_hidden[]" value="<?= $this->input->post('truckid') ?>">

  <?= $this->input->post('platno') ?>
  <input type="hidden" name="platno_hidden[]" value="<?= $this->input->post('platno') ?>">

  <?= $this->input->post('banid') ?>
  <input type="hidden" name="banid_hidden[]" value="<?= $this->input->post('banid') ?>">

  <td class="noseri">
    <?= $this->input->post('noseri') ?>
    <input type="hidden" name="noseri_hidden[]" value="<?= $this->input->post('noseri') ?>">
  </td>

  <td class="merk">
    <?= $this->input->post('merk') ?>
    <input type="hidden" name="merk_hidden[]" value="<?= $this->input->post('merk') ?>">
  </td>

  <?= $this->input->post('merkid') ?>
  <input type="hidden" name="merkid_hidden[]" value="<?= $this->input->post('merkid') ?>">

  <?= $this->input->post('status') ?>
  <input type="hidden" name="status_hidden[]" value="<?= $this->input->post('status') ?>">

  <td class="stat">
    <?= $this->input->post('stat') ?>
    <input type="hidden" name="stat_hidden[]" value="<?= $this->input->post('stat') ?>">
  </td>

  <td class="ukuran">
    <?= $this->input->post('ukuran') ?>
    <input type="hidden" name="ukuran_hidden[]" value="<?= $this->input->post('ukuran') ?>">
  </td>

  <td class="jml">
    <?= $this->input->post('jml') ?>
    <input type="hidden" name="jml_hidden[]" value="<?= $this->input->post('jml') ?>">
  </td>

  <?= $this->input->post('ket') ?>
  <input type="hidden" name="ket_hidden[]" value="<?= $this->input->post('ket') ?>">

  <?= $this->input->post('totalban') ?>
  <input type="hidden" name="totalban_hidden[]" value="<?= $this->input->post('totalban') ?>">

  <td class="aksi">
    <button type="button" class="btn btn-danger btn-sm" id="tombol-hapus" data-toggle="tooltip" title="Delete" data-noseri="<?= $this->input->post('noseri') ?>">
      <i class="fa fa-trash fa-sm"></i>
    </button>
  </td>
</tr>