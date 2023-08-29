<tr class="cart text-center">
  <?= $this->input->post('truck') ?>
  <input type="hidden" name="truck_hidden[]" value="<?= $this->input->post('truck') ?>">

  <td class="plat">
    <?= $this->input->post('plat') ?>
    <input type="hidden" name="plat_hidden[]" value="<?= $this->input->post('plat') ?>">
  </td>

  <?= $this->input->post('sopir') ?>
  <input type="hidden" name="sopir_hidden[]" value="<?= $this->input->post('sopir') ?>">

  <?= $this->input->post('ket') ?>
  <input type="hidden" name="ket_hidden[]" value="<?= $this->input->post('ket') ?>">

  <td class="bengkel">
    <?= ucwords($this->input->post('bengkel')) ?>
    <input type="hidden" name="bengkel_hidden[]" value="<?= $this->input->post('bengkel') ?>">
  </td>

  <td class="tglnota">
    <?= date('d/m/Y', strtotime($this->input->post('tglnota'))) ?>
    <input type="hidden" name="tglnota_hidden[]" value="<?= $this->input->post('tglnota') ?>">
  </td>

  <td class="part">
    <?= ucwords($this->input->post('part')) ?>
    <input type="hidden" name="part_hidden[]" value="<?= $this->input->post('part') ?>">
  </td>

  <td class="ongkos">
    <?= number_format($this->input->post('ongkos')) ?>
    <input type="hidden" name="ongkos_hidden[]" value="<?= $this->input->post('ongkos') ?>">
  </td>

  <?= $this->input->post('total') ?>
  <input type="hidden" name="total_hidden[]" value="<?= $this->input->post('total') ?>">

  <td class="aksi">
    <button type="button" class="btn btn-warning" id="tombol-hapus" data-toggle="tooltip" title="Delete" data-truck="<?= $this->input->post('platno') ?>">
      <i class="fa fa-trash fa-sm"></i>
    </button>
  </td>
</tr>