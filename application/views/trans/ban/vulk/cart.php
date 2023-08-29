<tr class="cart text-center">

  <td class="noseri">
    <?= strtoupper($this->input->post('noseri')) ?>
    <input type="hidden" name="noseri_hidden[]" value="<?= strtoupper($this->input->post('noseri')) ?>">
  </td>

  <?= $this->input->post('banid') ?>
  <input type="hidden" name="banid_hidden[]" value="<?= $this->input->post('banid') ?>">

  <td class="merk">
    <?= $this->input->post('merk') ?>
    <input type="hidden" name="merk_hidden[]" value="<?= $this->input->post('merk') ?>">
  </td>

  <td class="size">
    <?= $this->input->post('size') ?>
    <input type="hidden" name="size_hidden[]" value="<?= $this->input->post('size') ?>">
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
    <button type="button" class="btn btn-warning btn-sm" id="tombol-hapus" data-toggle="tooltip" title="Delete" data-no-seri-ban="<?= $this->input->post('noseri') ?>">
      <i class="fa fa-trash fa-sm"></i>
    </button>
  </td>
</tr>