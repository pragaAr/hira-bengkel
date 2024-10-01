<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ban_model extends CI_Model
{
  public function getData()
  {
    $this->datatables->select('ban.id_ban, ban.no_seri, ban.ukuran_ban, ban.jml_ban, ban.status_ban, ban.vulk, ban.sudah_vulk, ban.date_ban_add, merk.id_merk, merk.nama_merk');
    $this->datatables->from('ban');
    $this->datatables->join('merk', 'merk.id_merk = ban.merk_ban_id', 'left');

    // --for searching needed
    $this->datatables->add_column(
      'view',
      '<div class="btn-group" role="group"> 
     
      </div>',
      'id_ban, no_seri, ukuran_ban, jml_ban, status_ban, vulk, nama_merk'
    );
    // --for searching needed

    $results = $this->datatables->generate();

    $data = json_decode($results, true);

    foreach ($data['data'] as &$row) {

      if ($row['status_ban'] == 'Gudang' || $row['status_ban'] == 'gudang') {

        $row['view'] = '<div class="btn-group" role="group">
                            <a href="http://localhost/he-bengkel/ban/riwayat/' . $row['no_seri'] . '" class="btn btn-sm btn-info text-white" data-toggle="tooltip" title="History">
                              <i class="fas fa-history fa-sm"></i>
                            </a>
                            <a href="javascript:void(0);" class="btn btn-sm btn-warning text-white btn-ubah-kondisi-ban" data-seri="' . $row['no_seri'] . '" data-toggle="tooltip" title="Ubah Kondisi">
                              <i class="fas fa-exclamation-circle fa-sm"></i>
                            </a>
                          </div>';
      } else {
        $row['view'] = '<div class="btn-group" role="group">
                            <a href="http://localhost/he-bengkel/ban/riwayat/' . $row['no_seri'] . '" class="btn btn-sm btn-info text-white" data-toggle="tooltip" title="History">
                              <i class="fas fa-history fa-sm"></i>
                            </a>
                          </div>';
      }
    }

    $results = json_encode($data);

    echo $results;
  }

  // for select2 and search
  public function getDataBan()
  {
    $this->db->select('ban.id_ban, ban.no_seri, ban.ukuran_ban, ban.vulk, merk.id_merk, merk.nama_merk')
      ->from('ban')
      ->join('merk', 'merk.id_merk = ban.merk_ban_id', 'left')
      ->where('status_ban', 'gudang')
      ->order_by('no_seri', 'asc');

    $res = $this->db->get()->result();

    return $res;
  }

  public function getSearchDataBan($keyword)
  {
    $this->db->select('ban.id_ban, ban.no_seri, ban.ukuran_ban, ban.vulk, merk.id_merk, merk.nama_merk')
      ->from('ban')
      ->join('merk', 'merk.id_merk = ban.merk_ban_id', 'left')
      ->where('status_ban', 'gudang')
      ->like('no_seri', $keyword);

    $res = $this->db->get()->result();

    return $res;
  }
  // end for select2 and search

  public function getId($id)
  {
    $this->db->select('*');
    $this->db->from('ban');
    $this->db->join('merk', 'merk.id_merk=ban.merk_ban_id');
    $this->db->where('no_seri', $id);
    $query = $this->db->get();

    return $query->row();
  }

  public function getBan() // for print
  {
    $this->db->select('*');
    $this->db->from('ban');
    $this->db->join('merk', 'merk.id_merk=ban.merk_ban_id');
    $query = $this->db->get();

    return $query->result();
  }

  public function selectBan() // for vulkanisir
  {
    $status = "Gudang";
    // $vulk   = 0;

    $this->db->select('ban.id_ban, ban.no_seri, ban.ukuran_ban, merk.nama_merk')
      ->from('ban')
      ->where('status_ban', $status)
      // ->where('vulk', $vulk)
      ->join('merk', 'merk.id_merk = ban.merk_ban_id');

    $query = $this->db->get()->result();

    return $query;
  }

  public function selectSearchBan($keyword) // for vulkanisir
  {
    $status = "Gudang";
    // $vulk   = 0;

    $this->db->select('ban.id_ban, ban.no_seri, ban.ukuran_ban, merk.nama_merk')
      ->from('ban')
      ->where('status_ban', $status)
      // ->where('vulk', $vulk)
      ->like('no_seri', $keyword)
      ->join('merk', 'merk.id_merk = ban.merk_ban_id');

    $query = $this->db->get()->result();

    return $query;
  }

  public function getBanPakai()
  {
    $status = "Gudang";

    $this->db->select('*');
    $this->db->from('ban');
    $this->db->join('merk', 'merk.id_merk=ban.merk_ban_id');
    $this->db->where('status_ban', $status);
    $query = $this->db->get();
    return $query->result_array();
  }

  public function getBanVulk()
  {
    $status = "Gudang";
    $vulk   = 0;

    $this->db->select('*')
      ->from('ban')
      ->where('status_ban', $status)
      ->where('vulk', $vulk)
      ->join('merk', 'merk.id_merk=ban.merk_ban_id');

    $query = $this->db->get()->result();

    return $query;
  }

  public function getBanOut($a)
  {
    $status = "Gudang";
    $this->db->select('*');
    $this->db->from('ban');
    $this->db->join('merk', 'merk.id_merk=ban.merk_ban_id');
    $this->db->where(['id_ban' => $a]);
    $query = $this->db->get();
    return $query->row();
  }

  public function banWithCondition($a)
  {
    $this->db->select('*');
    $this->db->from('ban');
    $this->db->join('merk', 'merk.id_merk=ban.merk_ban_id');
    $this->db->where(['id_ban' => $a]);
    $query = $this->db->get();
    return $query->row();
  }

  public function getHistory($id)
  {
    $this->db->select('*');
    $this->db->from('history_ban');
    $this->db->join('ban', 'ban.no_seri=history_ban.no_seri_history', 'left');
    $this->db->where(['no_seri_history' => $id]);
    $query = $this->db->get();
    return $query->result();
  }

  public function getNoSeri($id)
  {
    return $this->db->get_where('ban', ['no_seri' => $id])->row();
  }

  public function getBanSeri($seri)
  {
    return $this->db->get_where('ban', ['no_seri' => $seri])->row();
  }

  public function addBan($databan)
  {
    $this->db->insert('ban', $databan);
  }

  // public function updateStatus($dataStok, $noseri)
  // {
  //   $this->db->update('ban', $dataStok, $noseri);
  // }

  public function moveBan($datamove)
  {
    $this->db->insert('movement', $datamove);
  }
}
