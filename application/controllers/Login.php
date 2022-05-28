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

  public function index() 
  {
    $this->load->view('v_home.php');
  }

  function login()
  {
    $this->load->view('v_login');
  }

  function cek()
  {
    $username = htmlspecialchars($this->input->post('username', TRUE) , ENT_QUOTES);
    $password = htmlspecialchars($this->input->post('password', TRUE) , ENT_QUOTES);
    $cek = $this->M_login->login($username);
    if ($cek->num_rows() > 0)
    {
      $data = $cek->row_array();
      if(password_verify($password, $data['user_password']))
      {
        $this->session->set_userdata('masuk',TRUE);
        if($data['user_level'] == '1')
        {
          $this->session->set_userdata('akses','1');
          $this->session->set_userdata('ses_id',$data['user_username']);
          $this->session->set_userdata('id',$data['user_id']);
          $this->session->set_userdata('ses_nama',$data['user_nama']);
          redirect('admin/dashboard.html');
        }
        elseif($data['user_level'] == '2')
        {
          $this->session->set_userdata('akses','2');
          $this->session->set_userdata('ses_id',$data['user_username']);
          $this->session->set_userdata('id',$data['user_id']);
          $this->session->set_userdata('ses_nama',$data['user_nama']);
          redirect('teknisi/dashboard.html');
        }
      }
      else
      {
        echo $this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert"><span class="fa fa-close"></span></button> Username Atau Password Salah</div>');
        redirect('login.html');
      } 
    }
    else
    {
      echo $this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert"><span class="fa fa-close"></span></button> Username Atau Password Salah</div>');
      redirect('login.html');
    }
  }

  function logout()
  {
    $this->session->unset_userdata('akses');
    $this->session->unset_userdata('ses_id');
    $this->session->unset_userdata('id');
    $this->session->unset_userdata('ses_nama');
    echo $this->session->set_flashdata('msg',
        '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert"><span class="fa fa-close"></span></button> Anda telah keluar.</div>');
    redirect('login.html');
  }
}
