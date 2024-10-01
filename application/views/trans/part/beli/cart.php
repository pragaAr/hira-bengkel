<tr class="row-cart text-center">
  <?= $this->input->post('partid') ?>
  <input type="hidden" name="partid_hidden[]" value="<?= $this->input->post('partid') ?>">

  <td class="partname">
    <?= $this->input->post('partname') ?>
    <input type="hidden" name="partname_hidden[]" value="<?= $this->input->post('partname') ?>">
  </td>

  <?= $this->input->post('merkid') ?>
  <input type="hidden" name="merkid_hidden[]" value="<?= $this->input->post('merkid') ?>">

  <?= $this->input->post('merkname') ?>
  <input type="hidden" name="merkname_hidden[]" value="<?= $this->input->post('merkname') ?>">

  <td class="jmlbeli">
    <?= $this->input->post('jmlbeli') ?>
    <input type="hidden" name="jmlbeli_hidden[]" value="<?= $this->input->post('jmlbeli') ?>">
  </td>

  <td class="sat">
    <?= $this->input->post('sat') ?>
    <input type="hidden" name="sat_hidden[]" value="<?= $this->input->post('sat') ?>">
  </td>

  <td class="hrgpcs">
    <?= number_format($this->input->post('hrgpcs'), 2) ?>
    <input type="hidden" name="hrgpcs_hidden[]" value="<?= $this->input->post('hrgpcs') ?>">
  </td>

  <td class="diskon">
    <?= $this->input->post('diskon') ?>
    <input type="hidden" name="diskon_hidden[]" value="<?= $this->input->post('diskon') ?>">
  </td>

  <?= $this->input->post('ppn') ?>
  <input type="hidden" name="ppn_hidden[]" value="<?= $this->input->post('ppn') ?>">

  <?= $this->input->post('keterangan') ?>
  <input type="hidden" name="keterangan_hidden[]" value="<?= $this->input->post('keterangan') ?>">

  <td class="status_part">
    <?= ucwords($this->input->post('statuspart')) ?>
    <input type="hidden" name="statuspart_hidden[]" value="<?= $this->input->post('statuspart') ?>">
  </td>

  <td class="subtotal">
    <?= number_format($this->input->post('subtotal'), 2) ?>
    <input type="hidden" name="subtotal_hidden[]" value="<?= $this->input->post('subtotal') ?>">
  </td>

  <?= $this->input->post('totalpart') ?>
  <input type="hidden" name="totalpart_hidden[]" value="<?= $this->input->post('totalpart') ?>">

  <td class="aksi">
    <button type="button" class="btn btn-warning btn-sm" id="tombol-hapus" data-toggle="tooltip" title="Delete" data-partid="<?= $this->input->post('partid') ?>">
      <i class="fa fa-trash fa-sm"></i>
    </button>
  </td>
</tr>