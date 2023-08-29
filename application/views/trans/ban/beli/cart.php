<tr class="cart text-center">

  <td class="noseri">
    <?= strtoupper($this->input->post('noseri')) ?>
    <input type="hidden" name="noseri_hidden[]" value="<?= strtoupper($this->input->post('noseri')) ?>">
  </td>

  <?= $this->input->post('merkid') ?>
  <input type="hidden" name="merkid_hidden[]" value="<?= $this->input->post('merkid') ?>">

  <td class="merk">
    <?= $this->input->post('merk') ?>
    <input type="hidden" name="merk_hidden[]" value="<?= $this->input->post('merk') ?>">
  </td>

  <td class="size">
    <?= $this->input->post('size') ?>
    <input type="hidden" name="size_hidden[]" value="<?= $this->input->post('size') ?>">
  </td>

  <td class="hrg">
    <?= number_format($this->input->post('hrg')) ?>
    <input type="hidden" name="hrg_hidden[]" value="<?= $this->input->post('hrg') ?>">
  </td>

  <td class="disk">
    <?= $this->input->post('disk') ?>
    <input type="hidden" name="disk_hidden[]" value="<?= $this->input->post('disk') ?>">
  </td>

  <?= $this->input->post('stat') ?>
  <input type="hidden" name="stat_hidden[]" value="<?= $this->input->post('stat') ?>">

  <?= $this->input->post('ppn') ?>
  <input type="hidden" name="ppn_hidden[]" value="<?= $this->input->post('ppn') ?>">

  <td class="jmlbeli">
    <?= $this->input->post('jmlbeli') ?>
    <input type="hidden" name="jmlbeli_hidden[]" value="<?= $this->input->post('jmlbeli') ?>">
  </td>

  <?= $this->input->post('ket') ?>
  <input type="hidden" name="ket_hidden[]" value="<?= $this->input->post('ket') ?>">

  <td class="totmindisk">
    <?= number_format($this->input->post('totmindisk')) ?>
    <input type="hidden" name="totmindisk_hidden[]" value="<?= $this->input->post('totmindisk') ?>">
  </td>

  <?= $this->input->post('totalban') ?>
  <input type="hidden" name="totalban_hidden[]" value="<?= $this->input->post('totalban') ?>">

  <td class="aksi">
    <button type="button" class="btn btn-warning btn-sm" id="tombol-hapus" data-toggle="tooltip" title="Delete" data-noseri="<?= $this->input->post('noseri') ?>">
      <i class="fa fa-trash fa-sm"></i>
    </button>
  </td>
</tr>