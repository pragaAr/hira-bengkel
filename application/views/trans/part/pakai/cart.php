<tr class="text-center cart-pakai">
  <td class="part">
    <?= $this->input->post('part') ?>
    <input type="hidden" name="part_hidden[]" value="<?= $this->input->post('part') ?>">
  </td>

  <?= $this->input->post('partid') ?>
  <input type="hidden" name="partid_hidden[]" value="<?= $this->input->post('partid') ?>">

  <td class="merk">
    <?= $this->input->post('merk') ?>
    <input type="hidden" name="merk_hidden[]" value="<?= $this->input->post('merk') ?>">
  </td>

  <?= $this->input->post('merkid') ?>
  <input type="hidden" name="merkid_hidden[]" value="<?= $this->input->post('merkid') ?>">

  <td class="statuspart">
    <?= $this->input->post('statuspart') ?>
    <input type="hidden" name="statuspart_hidden[]" value="<?= $this->input->post('statuspart') ?>">
  </td>
  <td class="jml">
    <?= $this->input->post('jml') ?>
    <input type="hidden" name="jml_hidden[]" value="<?= $this->input->post('jml') ?>">
  </td>
  <td class="sat">
    <?= $this->input->post('sat') ?>
    <input type="hidden" name="sat_hidden[]" value="<?= $this->input->post('sat') ?>">
  </td>

  <?= $this->input->post('ket') ?>
  <input type="hidden" name="ket_hidden[]" value="<?= $this->input->post('ket') ?>">

  <?= $this->input->post('totalpart') ?>
  <input type="hidden" name="totalpart_hidden[]" value="<?= $this->input->post('totalpart') ?>">

  <td class="aksi">
    <button type="button" class="btn btn-danger btn-sm" id="tombol-hapus" data-toggle="tooltip" title="Delete" data-partid="<?= $this->input->post('partid') ?>">
      <i class="fa fa-trash fa-sm"></i>
    </button>
  </td>
</tr>