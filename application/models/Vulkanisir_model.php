<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vulkanisir_model extends CI_Model
{
  public function cekKd()
  {
    $date = date('mdYHis');
    $tr   = "vlk-";
    $kd   = $tr .  $date;

    return $kd;
  }

  public function getData()
  {
    $this->datatables->select('id_vulk, kd_vulk, nama_toko, jml_total_vulk, tgl_vulk')
      ->from('vulkanisir')
      ->join('toko', 'toko.id_toko = vulkanisir.tempat_vulk', 'left')
      ->add_column(
        'view',
        '<div class="btn-group" role="group">
          <a href="http://localhost/he-bengkel/vulkanisir/suratJalanKeluar/$2" target="_blank" class="btn btn-info btn-sm border border-light btn-print" title="Cetak">
            <i class="fas fa-print fa-sm"></i>
          </a>
          <a href="javascript:void(0);" class="btn btn-sm border border-light btn-success text-white btn-detail" data-kd="$2" title="Detail">
            <i class="fas fa-eye fa-sm"></i>
          </a>
          <a href="javascript:void(0);" class="btn btn-sm border border-light btn-danger text-white btn-delete" data-kd="$2" title="Delete">
            <i class="fas fa-trash fa-sm"></i>
          </a>
        </div>',
        'id_vulk, kd_vulk, tempat_vulk, jml_total_vulk, tgl_vulk'
      );

    return $this->datatables->generate();
  }

  public function addData($data_vulk, $detail_vulk, $update_ban)
  {
    $this->db->insert('vulkanisir', $data_vulk);

    $this->db->insert_batch('detail_vulk', $detail_vulk);

    $this->db->update_batch('ban', $update_ban, 'id_ban');
  }

  public function getDetailByKd($kd)
  {
    $this->db->select('no_seri_vulk, merk_vulk, ukuran_ban_vulk, status')
      ->from('detail_vulk')
      ->where('kd_vulk', $kd);

    $query = $this->db->get()->result();

    return $query;
  }

  public function getVulkKd($kd)
  {
    $this->db->select('a.kd_vulk, a.tgl_vulk, b.nama_toko')
      ->from('vulkanisir a')
      ->join('toko b', 'b.id_toko = a.tempat_vulk')
      ->where('a.kd_vulk', $kd);

    $query = $this->db->get()->row();

    return $query;
  }

  public function getAllData()
  {
    $this->db->select('*')
      ->from('vulkanisir')
      ->join('detail_vulk', 'detail_vulk.kd_vulk = vulkanisir.kd_vulk');

    $query = $this->db->get();

    return $query->result_array();
  }

  public function getVulkByTempat($id)
  {
    $status = 0;

    $this->db->select('*')
      ->from('vulkanisir')
      ->join('detail_vulk', 'detail_vulk.kd_vulk = vulkanisir.kd_vulk')
      ->where('tempat_vulk', $id)
      ->where('status', $status);

    $query = $this->db->get()->result();

    return $query;
  }

  public function getBanBySeri($kd, $seri)
  {
    $status = 0;

    $this->db->select('*')
      ->from('detail_vulk')
      ->join('ban', 'ban.no_seri = detail_vulk.no_seri_vulk')
      ->where('no_seri_vulk', $seri)
      ->where('kd_vulk', $kd)
      ->where('status', $status);

    $query = $this->db->get()->row();

    return $query;
  }

  public function getDetailAllVulk()
  {
    $this->datatables->select('
                              a.id_detail_vulk, a.kd_vulk, a.no_seri_vulk, 
                              a.merk_vulk, a.ukuran_ban_vulk, a.jml_vulk, a.status, 
                              a.no_nota, a.tgl_update, b.tgl_vulk, c.nama_toko
                              ')
      ->from('detail_vulk a')
      ->join('vulkanisir b', 'b.kd_vulk = a.kd_vulk')
      ->join('toko c', 'c.id_toko = b.tempat_vulk')
      ->add_column(
        'view',
        '<div class="btn-group" role="group">
          
        </div>',
        'id_detail_vulk, kd_vulk, no_seri_vulk, merk_vulk, ukuran_ban_vulk, jml_vulk, status, no_nota, tgl_update, nama_toko, tgl_vulk'
      );

    return $this->datatables->generate();
  }

  public function getDetailAllVulkDone()
  {
    $this->datatables->select('
                              a.id_detail_vulk_selesai, a.no_nota, a.kd_vulk, 
                              a.no_seri, a.merk, a.ukuran, a.ongkos, 
                              b.tgl_selesai, c.nama_toko
                              ')
      ->from('detail_vulk_selesai a')
      ->join('vulk_done b', 'b.no_nota = a.no_nota', 'left')
      ->join('toko c', 'c.id_toko = b.tempat_vulk')
      ->add_column(
        'view',
        '<div class="btn-group" role="group">
          
        </div>',
        'id_detail_vulk_selesai, no_nota, kd_vulk, no_seri, merk, ukuran, tgl_update, nama_toko, tgl_selesai'
      );

    return $this->datatables->generate();
  }

  public function selectNota()
  {
    $this->db->select('id_vulk_done, no_nota')
      ->from('vulk_done')
      ->order_by('id_vulk_done', 'desc');

    $query = $this->db->get()->result();

    return $query;
  }

  public function selectSearcNota($keyword)
  {
    $this->db->select('id_vulk_done, no_nota')
      ->from('vulk_done')
      ->like('no_nota', $keyword);

    $query = $this->db->get()->result();

    return $query;
  }

  public function getDataByNota($nota)
  {
    $this->db->select('*')
      ->from('vulk_done a')
      ->join('detail_vulk_selesai b', 'b.no_nota = a.no_nota')
      ->join('vulkanisir c', 'c.kd_vulk = b.kd_vulk')
      ->where('a.no_nota', $nota);

    $query = $this->db->get()->result();

    return $query;
  }

  public function getDataSuratJalan($kd)
  {
    $this->db->select('*')
      ->from('detail_vulk')
      ->where('kd_vulk', $kd);

    $query = $this->db->get()->result();

    return $query;
  }

  public function getKdByNota($nota)
  {
    $this->db->select('a.no_nota, a.pembayaran, a.tgl_selesai, a.biaya, b.nama_toko')
      ->from('vulk_done a')
      ->join('toko b', 'b.id_toko = a.tempat_vulk')
      ->where('a.no_nota', $nota);

    $query = $this->db->get()->row();

    return $query;
  }

  public function getBanVulkSeri($kd)
  {
    $this->db->select('no_seri_vulk')
      ->from('detail_vulk')
      ->where('kd_vulk', $kd);

    $query = $this->db->get()->result_array();

    return $query;
  }

  public function addDataDone($vulkDone, $vulkDoneItems)
  {
    $this->db->insert('vulk_done', $vulkDone);
    $this->db->insert_batch('detail_vulk_selesai', $vulkDoneItems);
  }

  public function updateDetailStatus($kdvulk, $arr, $updateDetailStatus)
  {
    // Filter data berdasarkan kd_vulk dan no_seri array
    $this->db->where_in('kd_vulk', $kdvulk);

    $this->db->where_in('no_seri_vulk', $arr);

    // Ambil data yang akan diperbarui
    $query = $this->db->get('detail_vulk');

    $data_to_update = $query->result_array();

    if (!empty($data_to_update)) {
      // Looping hasil untuk persiapan update_batch
      $update_data = [];
      foreach ($data_to_update as $row) {
        // Gabungkan data asli dengan data yang akan diperbarui
        $update_item = [
          'no_seri_vulk'  => $row['no_seri_vulk'],
          'status'        => $updateDetailStatus['status'],
          'no_nota'       => $updateDetailStatus['no_nota'],
          'tgl_update'    => $updateDetailStatus['tgl_update']
        ];

        $update_data[] = $update_item;
      }

      // Lakukan update_batch jika ada data yang akan diperbarui
      if (!empty($update_data)) {
        $this->db->update_batch('detail_vulk', $update_data, 'no_seri_vulk');
      }
    }
  }

  public function updateStatusBan($updateStatusBan)
  {
    $this->db->update_batch('ban', $updateStatusBan, 'no_seri');
  }

  public function addHistoryVulkDone($historyVulk)
  {
    $this->db->insert_batch('history_ban', $historyVulk);
  }

  public function addHistory($historyVulk)
  {
    $this->db->insert_batch('history_ban', $historyVulk);
  }

  public function addSelesaiVulk($selesai, $updateban)
  {
    $this->db->insert('vulk_done', $selesai);

    $this->db->update_batch('ban', $updateban, 'no_seri');
  }

  public function getDataSuccess($kd)
  {
    $this->db->select('*')
      ->from('vulkanisir')
      ->where('vulkanisir.kd_vulk', $kd)
      ->join('detail_vulk', 'detail_vulk.kd_vulk = vulkanisir.kd_vulk')
      ->join('toko', 'toko.id_toko = vulkanisir.tempat_vulk');

    $query = $this->db->get()->result_array();

    return $query;
  }

  public function updateDetailData($data)
  {
    $this->db->update_batch('detail_vulk', $data, 'no_seri_vulk');
  }

  public function delete($kd)
  {
    $this->db->delete('vulkanisir', ['kd_vulk' => $kd]);

    $this->db->delete('detail_vulk', ['kd_vulk' => $kd]);

    $this->db->delete('detail_vulk_selesai', ['kd_vulk' => $kd]);

    $this->db->delete('history_ban', ['kd_history_ban' => $kd]);
  }

  public function updateStatus($databan)
  {
    $this->db->update_batch('ban', $databan, 'no_seri');
  }
}
