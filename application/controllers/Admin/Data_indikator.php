<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_indikator extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    if ($this->session->userdata('masuk') != TRUE)
    {
      $url=base_url();
      redirect($url);
    };
    $this->load->model('M_data_indikator');
  }


  public function indikator()
  {
    if($this->session->userdata('akses')=='1')
    {
      $tabel = 'tb_indikator_jabatan';
      $x['judul'] = "Data Indikator Jabatan";
      $x['data'] = $this->M_data_indikator->get($tabel);
      $this->load->view('admin/v_indikator_jabatan', $x); 
    }
    else
    {
      $this->load->view('blocked');
    }
  }

  function tambah_indikator()
  {
    $jabatan = $this->input->post('jabatan');
    $pu = $this->input->post('pu');
    $software = $this->input->post('software');
    $hardware = $this->input->post('hardware');
    $listrik = $this->input->post('listrik');

    $tabel = 'tb_indikator_jabatan';
    $data = array(
      'i_jabatan_teknisi' => $jabatan,
      'i_jabatan_pu' => $pu / 100,
      'i_jabatan_software' => $software / 100,
      'i_jabatan_hardware' => $hardware / 100,
      'i_jabatan_listrik' => $listrik / 100
    );

    $input = $this->M_data_indikator->simpan($tabel,$data);
    if ($input > 0)
    {
      echo $this->session->set_flashdata('msg','success');
      redirect('admin/indikator-jabatan.html');
    }
    else
    {
      echo $this->session->set_flashdata('msg','error');
      redirect('admin/indikator-jabatan.html');
    }
  }

  function update_indikator()
  {
    $id = $this->input->post('id_indikator');
    $jabatan = $this->input->post('jabatan');
    $pu = $this->input->post('pu');
    $software = $this->input->post('software');
    $hardware = $this->input->post('hardware');
    $listrik = $this->input->post('listrik');

    $tabel = 'tb_indikator_jabatan';
    $id_field = 'i_jabatan_id';
    $data = array(
      'i_jabatan_teknisi' => $jabatan,
      'i_jabatan_pu' => $pu / 100,
      'i_jabatan_software' => $software / 100,
      'i_jabatan_hardware' => $hardware / 100,
      'i_jabatan_listrik' => $listrik / 100
    );

    $update = $this->M_data_indikator->update($id_field,$id,$tabel,$data);
    if ($update > 0)
    {
      echo $this->session->set_flashdata('msg','info');
      redirect('admin/indikator-jabatan.html');
    }
    else
    {
      echo $this->session->set_flashdata('msg','error');
      redirect('admin/indikator-jabatan.html');
    }
  }

  function hapus_indikator(){
    $id = $this->input->post('id_indikator');
    $id_field = 'i_jabatan_id';
    $tabel = 'tb_indikator_jabatan';
    $this->M_data_indikator->hapus($id_field, $id, $tabel);
    echo $this->session->set_flashdata('msg','success-hapus');
    redirect('admin/indikator-jabatan.html');
  }
}
