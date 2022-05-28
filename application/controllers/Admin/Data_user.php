<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_user extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    if ($this->session->userdata('masuk') != TRUE)
    {
      $url=base_url();
      redirect($url);
    };
    $this->load->model('M_data_user');
  }

  public function index()
  {
    if($this->session->userdata('akses')=='1')
    {

      $x['judul'] = "Data user";
  		$x['data']=$this->M_data_user->get();
  		$this->load->view('admin/v_data_user',$x);
    }
    else
    {
      $this->load->view('blocked');
    }
  }

	function tambah_user()
  {
    $nama=$this->input->post('user_nama');
    $username=$this->input->post('user_username');
	  $password=$this->input->post('user_password');
    $konfirm_password=$this->input->post('user_password2');
    $jk=$this->input->post('user_jk');
    $email=$this->input->post('user_email');
    $nohp=$this->input->post('user_nohp');
    $alamat=$this->input->post('user_alamat');
    $level=$this->input->post('user_level');

    $query = $this->db->query("SELECT * FROM tb_user WHERE user_username='$username'");
    $cek_username = $query->num_rows();
    if ($cek_username > 0 )
    {
      echo $this->session->set_flashdata('msg','username-ganda');
      redirect('admin/data-pengguna.html');
    }
    else
    {
      if ($password <> $konfirm_password)
      {
        echo $this->session->set_flashdata('msg','error');
        redirect('admin/data-pengguna.html');
      }
      else
      {
        $data_user = array(
          'user_nama'     => $nama,
          'user_username' => $username,
          'user_password' => password_hash($password, PASSWORD_DEFAULT),
          'user_jk'       => $jk,
          'user_email'    => $email,
          'user_nohp'     => $nohp,
          'user_alamat'   => $alamat,
          'user_level'    => $level
        );
        $this->M_data_user->simpan($data_user);
        echo $this->session->set_flashdata('msg','success');
        redirect('admin/data-pengguna.html');
      }
    } 
	}

	function update_user()
  {
	  $id=$this->input->post('user_id');
    $nama=$this->input->post('user_nama');
    $username=$this->input->post('user_username');
    $password=$this->input->post('user_password');
    $konfirm_password=$this->input->post('user_password2');
    $jk=$this->input->post('user_jk');
    $email=$this->input->post('user_email');
    $nohp=$this->input->post('user_nohp');
    $alamat=$this->input->post('user_alamat');
    $level=$this->input->post('user_level');

    $query1 = $this->db->query("SELECT * FROM tb_user WHERE user_id='$id'");
    $get_user = $query1->row_array();

    $query = $this->db->query("SELECT * FROM tb_user WHERE user_username='$username'");
    $cek_username = $query->num_rows();

    if ($username == $get_user['user_username'] )
    {
      if (empty($password) && empty($konfirm_password))
      {
        $data_user = array(
          'user_nama'     => $nama,
          'user_username' => $username,
          'user_jk'       => $jk,
          'user_email'    => $email,
          'user_nohp'     => $nohp,
          'user_alamat'   => $alamat,
          'user_level'    => $level
        );
        $this->M_data_user->update($id,$data_user);
        echo $this->session->set_flashdata('msg','info');
        redirect('admin/data-pengguna.html');
      }
      elseif ($password <> $konfirm_password)
      {
        echo $this->session->set_flashdata('msg','error');
        redirect('admin/data-pengguna.html');
      }
      elseif ($password == $konfirm_password)
      {
        $data_user = array(
          'user_nama'     => $nama,
          'user_username' => $username,
          'user_password' => password_hash($password, PASSWORD_DEFAULT),
          'user_jk'       => $jk,
          'user_email'    => $email,
          'user_nohp'     => $nohp,
          'user_alamat'   => $alamat,
          'user_level'    => $level
        );
        $this->M_data_user->update($id,$data_user);
        echo $this->session->set_flashdata('msg','info');
        redirect('admin/data-pengguna.html');
      }
      else
      {
        echo $this->session->set_flashdata('msg','warning');
        redirect('admin/data-pengguna.html');
      }
    }
    elseif ($cek_username > 0 )
    {
      echo $this->session->set_flashdata('msg','username-ganda');
      redirect('admin/data-pengguna.html');
    }
    else
    {
      if (empty($password) && empty($konfirm_password))
      {
        $data_user = array(
          'user_nama'     => $nama,
          'user_username' => $username,
          'user_jk'       => $jk,
          'user_email'    => $email,
          'user_nohp'     => $nohp,
          'user_alamat'   => $alamat,
          'user_level'    => $level
        );
        $this->M_data_user->update($id,$data_user);
        echo $this->session->set_flashdata('msg','info');
        redirect('admin/data-pengguna.html');
      }
      elseif ($password <> $konfirm_password)
      {
        echo $this->session->set_flashdata('msg','error');
        redirect('admin/data-pengguna.html');
      }
      elseif ($password == $konfirm_password)
      {
        $data_user = array(
          'user_nama'     => $nama,
          'user_username' => $username,
          'user_password' => password_hash($password, PASSWORD_DEFAULT),
          'user_jk'       => $jk,
          'user_email'    => $email,
          'user_nohp'     => $nohp,
          'user_alamat'   => $alamat,
          'user_level'    => $level
        );
        $this->M_data_user->update($id,$data_user);
        echo $this->session->set_flashdata('msg','info');
        redirect('admin/data-pengguna.html');
      }
      else
      {
        echo $this->session->set_flashdata('msg','warning');
        redirect('admin/data-pengguna.html');
      }
    }
	}

	function hapus_user(){
		$id=$this->input->post('user_id');
		$this->M_data_user->hapus($id);
    echo $this->session->set_flashdata('msg','success-hapus');
    redirect('admin/data-pengguna.html');
	}
}
