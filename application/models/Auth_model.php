<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_MODEL
{
  public function cekLogin($uname)
  {
    return $this->db->get_where('user', ['username' => $uname])->row();
  }

  public function register()
  {
    $nama_user       = $this->input->post('nama');
    $no_telp_user    = $this->input->post('notelp');
    $username        = $this->input->post('username');
    $password        = $this->input->post('password');
    $user_role       = 'admin';

    $data = array(
      'nama_user'      => $nama_user,
      'no_telp_user'   => $no_telp_user,
      'username'       => $username,
      'password'       => password_hash($password, PASSWORD_DEFAULT),
      'user_role'      => $user_role
    );

    $this->db->insert('user', $data);
  }
}
