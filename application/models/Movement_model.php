<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Movement_model extends CI_Model
{
  public function addMove($datamove, $noseri)
  {
    $this->db->insert('movement_ban', $datamove);

    $this->db->delete('ban', $noseri);
  }

  public function getData()
  {
    $this->datatables->select('id_move, no_seri, ukuran, merk, movement, tgl_move')
      ->from('movement_ban')
      ->add_column(
        'view',
        '<div class="btn-group" role="group">
         
        </div>',
        'id_move, no_seri, movement, tgl_move'
      );

    return $this->datatables->generate();
  }
}
