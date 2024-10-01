<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Oops extends CI_Controller
{
  public function index()
  {
    $this->load->view('errors/oops-404');
  }
}
