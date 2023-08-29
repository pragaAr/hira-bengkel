<tr class="cart-selesai text-center">

  <td class="seri">
    <?= strtoupper($this->input->post('seri')) ?>
    <input type="hidden" name="seri_hidden[]" value="<?= strtoupper($this->input->post('seri')) ?>">
  </td>

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

  <td class="biaya">
    <?= number_format($this->input->post('biaya')) ?>
    <input type="hidden" name="biaya_hidden[]" value="<?= $this->input->post('biaya') ?>">
  </td>

  <?= $this->input->post('totalban') ?>
  <input type="hidden" name="totalban_hidden[]" value="<?= $this->input->post('totalban') ?>">

  <?= $this->input->post('totalbiaya') ?>
  <input type="hidden" name="totalbiaya_hidden[]" value="<?= $this->input->post('totalbiaya') ?>">

  <td class="aksi">
    <button type="button" class="btn btn-warning btn-sm" id="tombol-hapus" data-toggle="tooltip" title="Delete" data-seri="<?= $this->input->post('seri') ?>">
      <i class="fa fa-trash fa-sm"></i>
    </button>
  </td>
</tr>