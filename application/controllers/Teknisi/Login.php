<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->library('session');
    $this->load->model('M_login');
  }

  function index()
  {
    $this->load->view('teknisi/v_login');
  }

  function cek()
  {
    $username = htmlspecialchars($this->input->post('username', TRUE) , ENT_QUOTES);
    $password = htmlspecialchars($this->input->post('password', TRUE) , ENT_QUOTES);
    $cek = $this->M_login->login_teknisi($username, $password);
    if ($cek->num_rows() > 0)
    {
      $data = $cek->row_array();
      $this->session->set_userdata('masuk',TRUE);
      if($data['karyawan_level'] == '2')
      {
        $this->session->set_userdata('akses','2');
        $this->session->set_userdata('ses_id',$data['karyawan_username']);
        $this->session->set_userdata('id',$data['karyawan_id']);
        $this->session->set_userdata('ses_nama',$data['karyawan_nama']);
        redirect('teknisi/dashboard');
      }
    }
    else
    {
      echo $this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert"><span class="fa fa-close"></span></button> Username Atau Password Salah</div>');
      redirect('teknisi/login');
    }
  }

  function logout()
  {
    $this->session->unset_userdata('akses');
    $this->session->unset_userdata('ses_id');
    $this->session->unset_userdata('id');
    $this->session->unset_userdata('ses_nama');
    session_destroy();
    $this->session->set_flashdata('msg',
        '<div class="alert alert-dismissible alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>You have been logged out!</strong>  Please Come Back Again Later..
        </div>');
    redirect('teknisi/login');
  }
}
