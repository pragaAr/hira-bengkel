<?php
defined('BASEPATH') or exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

class Percab_model extends CI_Model
{
  public function getData()
  {
    $role = $this->session->userdata('user_role');

    $this->datatables->select('id_percab, nosurat, tglsurat, cabang, totalpercab, totalbyr, percab_add')
      ->from('percab');

    if ($role == 'admin') {
      $this->datatables->add_column(
        'view',
        '<div class="btn-group" role="group">
          <a href="http://localhost/he-bengkel/percab/detail/$2" class="btn btn-sm border border-light btn-success text-white" title="Detail">
            <i class="fas fa-eye fa-sm"></i>
          </a>
          <a href="javascript:void(0);" class="btn btn-sm border border-light btn-danger text-white btn-delete" data-no="$2" title="Hapus">
            <i class="fas fa-trash fa-sm"></i>
          </a>
        </div>',
        'id_percab, nosurat, tglsurat, cabang, totalpercab, totalbyr, percab_add'
      );
    } elseif ($role == 'user') {
      $this->datatables->add_column(
        'view',
        '<div class="btn-group" role="group">
          <a href="http://localhost/he-bengkel/percab/detail/$2" class="btn btn-sm border border-light btn-success text-white" title="Detail">
            <i class="fas fa-eye fa-sm"></i>
          </a>
        </div>',
        'id_percab, nosurat, tglsurat, cabang, totalpercab, totalbyr, percab_add'
      );
    }

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
    $this->db->select('
                      a.bengkel, a.tglnota, 
                      a.sopir, a.part, a.ongkos, 
                      a.ketpercab, b.plat_no_truck
                      ')
      ->from('detail_percab a')
      ->join('truck b', 'b.id_truck = a.truckid')
      ->where('a.nosurat', $no);

    $query = $this->db->get()->result();

    return $query;
  }

  public function getAllDetailData()
  {
    $this->datatables->select('
                              a.id_detailpercab, a.nosurat, 
                              c.cabang, a.bengkel, a.tglnota, 
                              a.part, b.plat_no_truck, 
                              a.sopir, a.ongkos, a.ketpercab
                              ')
      ->from('detail_percab a')
      ->join('truck b', 'b.id_truck = a.truckid', 'left')
      ->join('percab c', 'c.nosurat = a.nosurat')

      ->add_column(
        'view',
        'id_detailpercab, nosurat, cabang, bengkel, tglnota, part, plat_no_truck, sopir, ongkos, ketpercab'
      );

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
    $this->db->select('*')
      ->from('percab')
      ->where('MONTH(percab.tglsurat)', date('m'))
      ->where('YEAR(percab.tglsurat)', date('Y'))
      ->group_by('percab.nosurat');

    $query = $this->db->get()->result_array();

    return $query;
  }

  public function chartFilterMonth($year, $month)
  {
    $this->db->select('*')
      ->from('percab')
      ->where('YEAR(percab.tglsurat)', $year)
      ->where('MONTH(percab.tglsurat)', $month)
      ->group_by('percab.nosurat');

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
