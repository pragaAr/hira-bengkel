<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Truck_model extends CI_Model
{
  public function getData()
  {
    $this->datatables->select('id_truck, plat_no_truck, merk_truck, jenis_truck')
      ->from('truck')
      ->add_column(
        'view',
        '<div class="btn-group" role="group">
          <a href="javascript:void(0);" class="btn btn-sm border border-light btn-warning text-white btn-edit-truck" data-id="$1" title="Edit">
            <i class="fas fa-pencil-alt fa-sm"></i>
          </a>
          <a href="javascript:void(0);" class="btn btn-sm border border-light btn-danger text-white btn-delete-truck" data-id="$1" title="Hapus">
            <i class="fas fa-trash fa-sm"></i>
          </a>
        </div>',
        'id_truck, plat_no_truck, merk_truck, jenis_truck'
      );

    return $this->datatables->generate();
  }

  public function getId($id)
  {
    $this->db->select('*')
      ->from('truck')
      ->where('id_truck', $id);

    return $this->db->get()->row();
  }

  public function getDataTruck() // for select2
  {
    $this->db->select('id_truck, plat_no_truck, merk_truck')
      ->from('truck')
      ->order_by('plat_no_truck', 'asc');

    $res = $this->db->get()->result();

    return $res;
  }

  public function getSearchDataTruck($key) // for select2 search
  {
    $this->db->select('id_truck, plat_no_truck, merk_truck')
      ->from('truck')
      ->like('plat_no_truck', $key);

    $res = $this->db->get()->result();

    return $res;
  }

  public function getHistoryPart($id)
  {
    $this->db->select('*')
      ->from('truck')
      ->join('pakai_part', 'pakai_part.truck_id = truck.id_truck', 'left')
      ->join('detail_pakai', 'detail_pakai.kd_pakai = pakai_part.kd_pakai')
      ->join('stok_part', 'stok_part.id_part = detail_pakai.part_id')
      ->join('merk', 'merk.id_merk = detail_pakai.merk_id')
      ->where('id_truck', $id)
      ->limit(20)
      ->order_by('detail_pakai.kd_pakai');

    $query = $this->db->get()->result();

    return $query;
  }

  public function getHistoryBan($id)
  {
    $this->db->select('*')
      ->from('truck')
      ->join('pakai_ban', 'pakai_ban.truck_ban_id = truck.id_truck', 'left')
      ->join('detail_pakai_ban', 'detail_pakai_ban.kd_pakai_ban = pakai_ban.kd_pakai_ban')
      ->join('ban', 'ban.id_ban = detail_pakai_ban.ban_id')
      ->join('merk', 'merk.id_merk = detail_pakai_ban.merk_ban_id')
      ->where('id_truck', $id)
      ->limit(20)
      ->order_by('detail_pakai_ban.kd_pakai_ban');

    $query = $this->db->get()->result();

    return $query;
  }

  public function getSearchPart($id, $key)
  {
    $this->db->select('*')
      ->from('truck')
      ->join('pakai_part', 'pakai_part.truck_id = truck.id_truck', 'left')
      ->join('detail_pakai', 'detail_pakai.kd_pakai = pakai_part.kd_pakai')
      ->join('stok_part', 'stok_part.id_part = detail_pakai.part_id')
      ->join('merk', 'merk.id_merk = detail_pakai.merk_id')
      ->where('id_truck', $id)
      ->like('jenis_part', $key)
      ->limit(20)
      ->order_by('detail_pakai.kd_pakai');

    $query = $this->db->get()->result();

    return $query;
  }

  public function getSearchBan($id, $key)
  {
    $this->db->select('*')
      ->from('truck')
      ->join('pakai_ban', 'pakai_ban.truck_ban_id = truck.id_truck', 'left')
      ->join('detail_pakai_ban', 'detail_pakai_ban.kd_pakai_ban = pakai_ban.kd_pakai_ban')
      ->join('ban', 'ban.id_ban = detail_pakai_ban.ban_id')
      ->join('merk', 'merk.id_merk = detail_pakai_ban.merk_ban_id')
      ->where('id_truck', $id)
      ->like('no_seri', $key)
      ->limit(20)
      ->order_by('detail_pakai_ban.kd_pakai_ban');

    $query = $this->db->get()->result();

    return $query;
  }

  public function addTruck($data)
  {
    return $this->db->insert('truck', $data);
  }

  public function editTruck($data, $where)
  {
    return $this->db->update('truck', $data, $where);
  }

  public function deleteTruck($id)
  {
    return $this->db->delete('truck', ['id_truck' => $id]);
  }

  public function jenisTruck($id)
  {
    $this->db->select('*')
      ->where(['id_truck' => $id]);

    $query = $this->db->get('truck');

    return $query->row();
  }
}
