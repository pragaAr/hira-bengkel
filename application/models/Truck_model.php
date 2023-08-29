<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Truck_model extends CI_Model
{
  public function getData()
  {
    $this->datatables->select('truck.id_truck, truck.plat_no_truck, truck.merk_truck, truck.jenis_truck');
    $this->datatables->from('truck');
    $this->datatables->add_column(
      'view',
      '<div class="btn-group" role="group">
          <a href="javascript:void(0);" class="btn btn-sm btn-warning text-white btn-edit-truck" data-id="$1" data-toggle="tooltip" title="Edit">
            <i class="fas fa-pencil-alt fa-sm"></i>
          </a>
          <a href="javascript:void(0);" class="btn btn-sm btn-danger text-white btn-delete-truck" data-id="$1" data-toggle="tooltip" title="Hapus">
            <i class="fas fa-trash fa-sm"></i>
          </a>
        </div>',
      'id_truck, plat_no_truck, merk_truck, jenis_truck'
    );

    return $this->datatables->generate();
  }

  public function getId($id)
  {
    $this->db->select('*');
    $this->db->from('truck');
    $this->db->where('id_truck', $id);

    return $this->db->get()->row();
  }

  public function getDataTruck() // for select2
  {
    $this->db->select('truck.id_truck, truck.plat_no_truck, truck.merk_truck');
    $this->db->from('truck');
    $this->db->order_by('plat_no_truck', 'asc');
    $res = $this->db->get()->result();

    return $res;
  }

  public function getSearchDataTruck($keyword) // for select2 search
  {
    $this->db->select('truck.id_truck, truck.plat_no_truck, truck.merk_truck');
    $this->db->from('truck');
    $this->db->like('plat_no_truck', $keyword);
    $res = $this->db->get()->result();

    return $res;
  }

  public function getHistoryPart($id)
  {
    $this->db->select('*');
    $this->db->from('truck');
    $this->db->join('pakai_part', 'pakai_part.truck_id = truck.id_truck', 'left');
    $this->db->join('detail_pakai', 'detail_pakai.kd_pakai = pakai_part.kd_pakai');
    $this->db->join('stok_part', 'stok_part.id_part = detail_pakai.part_id');
    $this->db->join('merk', 'merk.id_merk = detail_pakai.merk_id');
    $this->db->where('id_truck', $id);
    $this->db->limit(20);
    $this->db->order_by('detail_pakai.kd_pakai');
    $query = $this->db->get()->result();
    return $query;
  }

  public function getHistoryBan($id)
  {
    $this->db->select('*');
    $this->db->from('truck');
    $this->db->join('pakai_ban', 'pakai_ban.truck_ban_id = truck.id_truck', 'left');
    $this->db->join('detail_pakai_ban', 'detail_pakai_ban.kd_pakai_ban = pakai_ban.kd_pakai_ban');
    $this->db->join('ban', 'ban.id_ban = detail_pakai_ban.ban_id');
    $this->db->join('merk', 'merk.id_merk = detail_pakai_ban.merk_ban_id');
    $this->db->where('id_truck', $id);
    $this->db->limit(20);
    $this->db->order_by('detail_pakai_ban.kd_pakai_ban');
    $query = $this->db->get()->result();
    return $query;
  }

  public function getSearchPart($id, $keyword)
  {
    $this->db->select('*');
    $this->db->from('truck');
    $this->db->join('pakai_part', 'pakai_part.truck_id = truck.id_truck', 'left');
    $this->db->join('detail_pakai', 'detail_pakai.kd_pakai = pakai_part.kd_pakai');
    $this->db->join('stok_part', 'stok_part.id_part = detail_pakai.part_id');
    $this->db->join('merk', 'merk.id_merk = detail_pakai.merk_id');
    $this->db->where('id_truck', $id);
    $this->db->like('jenis_part', $keyword);
    $this->db->limit(20);
    $this->db->order_by('detail_pakai.kd_pakai');
    $query = $this->db->get()->result();
    return $query;
  }

  public function getSearchBan($id, $keyword)
  {
    $this->db->select('*');
    $this->db->from('truck');
    $this->db->join('pakai_ban', 'pakai_ban.truck_ban_id = truck.id_truck', 'left');
    $this->db->join('detail_pakai_ban', 'detail_pakai_ban.kd_pakai_ban = pakai_ban.kd_pakai_ban');
    $this->db->join('ban', 'ban.id_ban = detail_pakai_ban.ban_id');
    $this->db->join('merk', 'merk.id_merk = detail_pakai_ban.merk_ban_id');
    $this->db->where('id_truck', $id);
    $this->db->like('no_seri', $keyword);
    $this->db->limit(20);
    $this->db->order_by('detail_pakai_ban.kd_pakai_ban');
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
    $this->db->select('*');
    $this->db->where(['id_truck' => $id]);
    $query = $this->db->get('truck');
    return $query->row();
  }
}
