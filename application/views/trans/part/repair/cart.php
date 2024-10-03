<tr class="cart text-center">

  <td class="align-middle partname">
    <?= $this->input->post('partname') ?>
    <input type="hidden" name="partname_hidden[]" value="<?= $this->input->post('partname') ?>">
  </td>

  <?= $this->input->post('partid') ?>
  <input type="hidden" name="partid_hidden[]" value="<?= $this->input->post('partid') ?>">

  <td class="align-middle merk">
    <?= $this->input->post('merk') ?>
    <input type="hidden" name="merk_hidden[]" value="<?= $this->input->post('merk') ?>">
  </td>

  <?= $this->input->post('merkid') ?>
  <input type="hidden" name="merkid_hidden[]" value="<?= $this->input->post('merkid') ?>">

  <td class="align-middle statpart">
    <?= $this->input->post('statpart') ?>
    <input type="hidden" name="statpart_hidden[]" value="<?= $this->input->post('statpart') ?>">
  </td>
  <td class="align-middle jml">
    <?= $this->input->post('jml') ?>
    <input type="hidden" name="jml_hidden[]" value="<?= $this->input->post('jml') ?>">
  </td>
  <td class="align-middle sat">
    <?= $this->input->post('sat') ?>
    <input type="hidden" name="sat_hidden[]" value="<?= $this->input->post('sat') ?>">
  </td>

  <?= $this->input->post('ket') ?>
  <input type="hidden" name="ket_hidden[]" value="<?= $this->input->post('ket') ?>">

  <?= $this->input->post('totalpart') ?>
  <input type="hidden" name="totalpart_hidden[]" value="<?= $this->input->post('totalpart') ?>">

  <td class="align-middle aksi">
    <button type="button" class="btn btn-warning" id="tombol-hapus" data-toggle="tooltip" title="Delete" data-partid="<?= $this->input->post('partid') ?>">
      <i class="fa fa-trash"></i>
    </button>
  </td>
</tr>