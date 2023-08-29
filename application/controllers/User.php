<?php
defined('BASEPATH') or exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

class User extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('datatables');

    $this->load->model('User_model', 'User');

    if (empty($this->session->userdata('id_user'))) {
      $this->session->set_flashdata('flashceklogin', 'Silahkan Login terlebih dahulu!');
      redirect('auth');
    } elseif ($this->session->userdata('user_role') != 'admin') {
      redirect('oops');
    }
  }

  public function index()
  {
    $data['title']  = 'Data User';

    $this->load->view('template/header', $data);
    $this->load->view('template/sidebar');
    $this->load->view('template/navbar');
    $this->load->view('main/user', $data);
  }

  public function getUsers()
  {
    header('Content-Type: application/json');

    echo $this->User->getData();
  }

  public function getId()
  {
    $id   = $this->input->post('iduser');
    $data = $this->User->getId($id);

    echo json_encode($data);
  }

  public function cekusername()
  {
    $uname  = $this->input->post('username');
    $data   = $this->User->cekUserName($uname);

    echo json_encode($data);
  }

  public function create()
  {
    $nama       = htmlspecialchars(trim(preg_replace('/[^a-zA-Z0-9\s]/', '', $this->input->post('nama'))));
    $telp       = htmlspecialchars(trim(preg_replace('/[^0-9]/', '', $this->input->post('telpon'))));
    $username   = htmlspecialchars(trim(preg_replace('/[^a-zA-Z0-9\s]/', '', $this->input->post('username'))));
    $pass       = trim($this->input->post('pass'));
    $role       = htmlspecialchars(trim(preg_replace('/[^a-zA-Z0-9\s]/', '', $this->input->post('role'))));

    $data = array(
      'nama_user'     => strtolower($nama),
      'no_telp_user'  => strtolower($telp),
      'username'      => strtolower($username),
      'password'      => password_hash($pass, PASSWORD_DEFAULT),
      'user_role'     => $role,
      'user_in'       => date('Y-m-d H:i:s')
    );

    $data = $this->User->addUser($data);

    echo json_encode($data);
  }

  public function update()
  {
    $id         = $this->input->post('id');
    $nama       = htmlspecialchars(trim(preg_replace('/[^a-zA-Z0-9\s]/', '', $this->input->post('nama'))));
    $telp       = htmlspecialchars(trim(preg_replace('/[^0-9]/', '', $this->input->post('telp'))));
    $username   = htmlspecialchars(trim(preg_replace('/[^a-zA-Z0-9\s]/', '', $this->input->post('username'))));
    $pass       = trim($this->input->post('pass'));
    $role       = $this->input->post('role');

    $data = array(
      'nama_user'     => strtolower($nama),
      'no_telp_user'  => $telp,
      'username'      => strtolower($username),
      'password'      => password_hash($pass, PASSWORD_DEFAULT),
      'user_role'     => $role,
    );

    $where = array(
      'id_user'   => $id
    );

    $data = $this->User->editUser($data, $where);

    echo json_encode($data);
  }

  public function delete()
  {
    $id   = $this->input->post('iduser');
    $data = $this->User->deleteUser($id);

    echo json_encode($data);
  }
}
