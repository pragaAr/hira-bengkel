<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ban_model extends CI_Model
{
  public function getData()
  {
    $this->datatables->select('
                              a.id_ban, a.no_seri, a.ukuran_ban, 
                              a.jml_ban, a.status_ban, a.vulk, 
                              a.sudah_vulk, a.date_ban_add, 
                              b.id_merk, b.nama_merk
                              ')
      ->from('ban a')
      ->join('merk b', 'b.id_merk = a.merk_ban_id', 'left')

      ->add_column(
        'view',
        '<div class="btn-group" role="group"> 
     
      </div>',
        'id_ban, no_seri, ukuran_ban, jml_ban, status_ban, vulk, nama_merk'
      );

    $results = $this->datatables->generate();

    $data = json_decode($results, true);

    foreach ($data['data'] as &$row) {

      if ($row['status_ban'] == 'Gudang' || $row['status_ban'] == 'gudang') {

        $row['view'] = '<div class="btn-group" role="group">
                            <a href="http://localhost/he-bengkel/ban/riwayat/' . $row['no_seri'] . '" class="btn btn-sm border border-light btn-info text-white" title="History">
                              <i class="fas fa-history fa-sm"></i>
                            </a>
                            <a href="javascript:void(0);" class="btn btn-sm border border-light btn-warning text-white btn-ubah-kondisi-ban" data-seri="' . $row['no_seri'] . '" title="Ubah Kondisi">
                              <i class="fas fa-exclamation-circle fa-sm"></i>
                            </a>
                          </div>';
      } else {
        $row['view'] = '<div class="btn-group" role="group">
                            <a href="http://localhost/he-bengkel/ban/riwayat/' . $row['no_seri'] . '" class="btn btn-sm border border-light btn-info text-white" title="History">
                              <i class="fas fa-history fa-sm"></i>
                            </a>
                          </div>';
      }
    }

    $results = json_encode($data);

    echo $results;
  }

  public function getDataBan()
  {
    $this->db->select('
                      a.id_ban, a.no_seri, 
                      a.ukuran_ban, a.vulk, 
                      b.id_merk, b.nama_merk
                      ')
      ->from('ban a')
      ->join('merk b', 'b.id_merk = a.merk_ban_id', 'left')
      ->where('a.status_ban', 'gudang')
      ->order_by('a.no_seri', 'asc');

    $res = $this->db->get()->result();

    return $res;
  }

  public function getSearchDataBan($key)
  {
    $this->db->select('
                      a.id_ban, a.no_seri, 
                      a.ukuran_ban, a.vulk, 
                      b.id_merk, b.nama_merk
                      ')
      ->from('ban a')
      ->join('merk b', 'b.id_merk = a.merk_ban_id', 'left')
      ->where('a.status_ban', 'gudang')
      ->like('a.no_seri', $key);

    $res = $this->db->get()->result();

    return $res;
  }
  // end for select2 and search

  public function getId($id)
  {
    $this->db->select('*')
      ->from('ban')
      ->join('merk', 'merk.id_merk=ban.merk_ban_id')
      ->where('no_seri', $id);

    $query = $this->db->get();

    return $query->row();
  }

  public function getBan()
  {
    $this->db->select('*')
      ->from('ban')
      ->join('merk', 'merk.id_merk=ban.merk_ban_id');

    $query = $this->db->get();

    return $query->result();
  }

  public function selectBan()
  {
    $status = "Gudang";
    // $vulk   = 0;

    $this->db->select('a.id_ban, a.no_seri, a.ukuran_ban, b.nama_merk')
      ->from('ban a')
      // ->where('vulk', $vulk)
      ->join('merk b', 'b.id_merk = a.merk_ban_id')
      ->where('a.status_ban', $status);

    $query = $this->db->get()->result();

    return $query;
  }

  public function selectSearchBan($key) // for vulkanisir
  {
    $status = "Gudang";
    // $vulk   = 0;

    $this->db->select('a.id_ban, a.no_seri, a.ukuran_ban, b.nama_merk')
      ->from('ban a')
      ->join('merk b', 'b.id_merk = a.merk_ban_id')
      ->where('a.status_ban', $status)
      // ->where('vulk', $vulk)
      ->like('a.no_seri', $key);

    $query = $this->db->get()->result();

    return $query;
  }

  public function getBanPakai()
  {
    $status = "Gudang";

    $this->db->select('*')
      ->from('ban')
      ->join('merk', 'merk.id_merk=ban.merk_ban_id')
      ->where('status_ban', $status);

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
    $this->db->select('*')
      ->from('ban')
      ->join('merk', 'merk.id_merk=ban.merk_ban_id')
      ->where(['id_ban' => $a]);

    $query = $this->db->get();

    return $query->row();
  }

  public function banWithCondition($a)
  {
    $this->db->select('*')
      ->from('ban')
      ->join('merk', 'merk.id_merk=ban.merk_ban_id')
      ->where(['id_ban' => $a]);

    $query = $this->db->get();

    return $query->row();
  }

  public function getHistory($id)
  {
    $this->db->select('*')
      ->from('history_ban')
      ->join('ban', 'ban.no_seri=history_ban.no_seri_history', 'left')
      ->where(['no_seri_history' => $id]);

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

  public function addBan($data)
  {
    $this->db->insert('ban', $data);
  }

  // public function updateStatus($dataStok, $noseri)
  // {
  //   $this->db->update('ban', $dataStok, $noseri);
  // }

  public function moveBan($data)
  {
    $this->db->insert('movement', $data);
  }
}
