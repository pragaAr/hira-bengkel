<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Auth_model', 'Auth');
  }

  public function index()
  {
    if ($this->session->userdata('id_user')) {

      redirect('home');
    }

    $data['title'] = "Login";

    $this->form_validation->set_rules('username', 'Username', 'required');
    $this->form_validation->set_rules('password', 'Password', 'required');

    if ($this->form_validation->run() == false) {
      $this->load->view('auth/header', $data);
      $this->load->view('auth/login');
      $this->load->view('auth/footer');
    } else {
      $uname        = $this->input->post('username');
      $inputpass    = $this->input->post('password');

      $cekpass      = $this->Auth->cekLogin($uname);
      $truepass     = password_verify($inputpass, $cekpass->password);

      if ($cekpass) {

        if ($truepass == true) {

          $this->session->set_userdata('id_user', $cekpass->id_user);
          $this->session->set_userdata('nama_user', $cekpass->nama_user);
          $this->session->set_userdata('username', $cekpass->username);
          $this->session->set_userdata('user_role', $cekpass->user_role);

          $this->session->set_flashdata('flashLogin', 'Selamat Datang');
          redirect('home');
        } else {
          $this->session->set_flashdata('wrongpassoruser', 'Data Tidak Valid!');
          redirect('auth');
        }
      } else {
        $this->session->set_flashdata('wrongpassoruser', 'Data Tidak Valid!');
        redirect('auth');
      }
    }
  }

  public function register()
  {
    $data['title'] = "Register";

    $this->form_validation->set_rules('nama', 'Nama User', 'required');
    $this->form_validation->set_rules('notelp', 'No Telpon', 'required|numeric');
    $this->form_validation->set_rules('username', 'Username', 'required');
    $this->form_validation->set_rules('password', 'Password', 'required');

    if ($this->form_validation->run() == false) {
      $this->load->view('auth/header', $data);
      $this->load->view('auth/register');
      $this->load->view('auth/footer');
    } else {
      $this->Auth->register();
      $this->session->set_flashdata('flashReg', 'Silahkan login');
      redirect('auth');
    }
  }

  public function logout()
  {
    $this->session->unset_userdata('id_user');
    $this->session->unset_userdata('nama_user');
    $this->session->unset_userdata('username');
    $this->session->unset_userdata('user_role');

    $this->session->set_flashdata('flashLogout', 'Sampai jumpa kembali');
    redirect('auth');
  }
}
