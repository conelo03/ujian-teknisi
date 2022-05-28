<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    if ($this->session->userdata('masuk') != TRUE)
    {
      $url=base_url();
      redirect($url);
    }
  }

  public function index()
  {
    if($this->session->userdata('akses')=='1')
    {
      $data['judul'] = "Dashboard";
      $this->load->view('admin/v_dashboard', $data);
    }
    else
    {
      $this->load->view('blocked');
    }
  }
}
