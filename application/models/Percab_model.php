<?php
defined('BASEPATH') or exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

class Percab_model extends CI_Model
{
  public function getData()
  {
    $this->datatables->select('id_percab, nosurat, tglsurat, cabang, totalpercab, totalbyr, percab_add')
      ->from('percab')
      ->add_column(
        'view',
        '<div class="btn-group" role="group">
          <a href="http://localhost/he-bengkel/percab/detail/$2" class="btn btn-sm btn-success text-white" data-toggle="tooltip" title="Detail">
            <i class="fas fa-eye fa-sm"></i>
          </a>
          <a href="javascript:void(0);" class="btn btn-sm btn-danger text-white btn-delete" data-no="$2" data-toggle="tooltip" title="Hapus">
            <i class="fas fa-trash fa-sm"></i>
          </a>
        </div>',
        'id_percab, nosurat, tglsurat, cabang, totalpercab, totalbyr, percab_add'
      );

    return $this->datatables->generate();
  }

  public function getDataId($id)
  {
    $this->db->select('nosurat, tglsurat, cabang, totalbyr')
      ->from('percab')
      ->where('id_percab', $id);

    $query = $this->db->get()->row();

    return $query;
  }

  public function getDataNo($no)
  {
    $this->db->select('nosurat, tglsurat, cabang, totalbyr')
      ->from('percab')
      ->where('nosurat', $no);

    $query = $this->db->get()->row();

    return $query;
  }

  public function detailData($no)
  {
    $this->db->select('a.bengkel, a.tglnota, a.sopir, a.part, a.ongkos, a.ketpercab, b.plat_no_truck')
      ->from('detail_percab a')
      ->join('truck b', 'b.id_truck = a.truckid')
      ->where('nosurat', $no);

    $query = $this->db->get()->result();

    return $query;
  }

  public function getAllDetailData()
  {
    $this->datatables->select('a.id_detailpercab, a.nosurat, c.cabang, a.bengkel, a.tglnota, a.part, b.plat_no_truck, a.sopir, a.ongkos, a.ketpercab')
      ->from('detail_percab a')
      ->join('truck b', 'b.id_truck = a.truckid', 'left')
      ->join('percab c', 'c.nosurat = a.nosurat')

      // --for searching needed
      ->add_column(
        'view',
        'id_detailpercab, nosurat, cabang, bengkel, tglnota, part, plat_no_truck, sopir, ongkos, ketpercab'
      );
    // --for searching needed

    return $this->datatables->generate();
  }

  public function sumTotal($input)
  {
    $year   = date('Y', strtotime($input));
    $month  = date('m', strtotime($input));

    $this->db->select('SUM(totalbyr) as total')
      ->from('percab')
      ->where('MONTH(tglsurat)', $month)
      ->where('YEAR(tglsurat)', $year);

    $query = $this->db->get()->row();

    return $query;
  }

  public function chartThisMonth()
  {
    $this->db->select('*');
    $this->db->from('percab');
    $this->db->where('MONTH(percab.tglsurat)', date('m'));
    $this->db->where('YEAR(percab.tglsurat)', date('Y'));
    $this->db->group_by('percab.nosurat');
    $query = $this->db->get()->result_array();

    return $query;
  }

  public function chartFilterMonth($year, $month)
  {
    $this->db->select('*');
    $this->db->from('percab');
    $this->db->where('YEAR(percab.tglsurat)', $year);
    $this->db->where('MONTH(percab.tglsurat)', $month);
    $this->db->group_by('percab.nosurat');

    $query = $this->db->get()->result_array();

    return $query;
  }

  public function addData($data, $detail)
  {
    $this->db->insert('percab', $data);
    $this->db->insert_batch('detail_percab', $detail);
  }

  public function deleteData($no)
  {
    $this->db->delete('percab', ['nosurat' => $no]);
    $this->db->delete('detail_percab', ['nosurat' => $no]);
  }
}
