<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_ujian extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    if ($this->session->userdata('masuk') != TRUE)
    {
      $url=base_url();
      redirect($url);
    };
    $this->load->model('M_data_ujian');
    $this->load->model('M_data_nilai');
  }

  public function ujian()
  {
    if($this->session->userdata('akses')=='1')
    {
      $x['judul'] = "Data Ujian";
      $x['data'] = $this->M_data_ujian->get();
      $this->load->view('admin/v_data_ujian', $x); 
    }
    else
    {
      $this->load->view('blocked');
    }
  }

  function tambah_ujian()
  {
    $nama = $this->input->post('nama');
    $tgl = $this->input->post('tanggal');
    $waktu = $this->input->post('waktu');
    $waktu_essai = $this->input->post('waktu_essai');
    $status = $this->input->post('status');

    $pch_tgl = explode('-', $tgl);
    $tanggal = $pch_tgl[2].'-'.$pch_tgl[1].'-'.$pch_tgl[0];

    $tabel = 'tb_ujian';
    $data = array(
      'ujian_nama' => $nama,
      'ujian_tanggal' => $tanggal,
      'ujian_waktu' => $waktu,
      'ujian_essai_waktu' => $waktu_essai,
      'ujian_status' => $status
    );

    $input = $this->M_data_ujian->simpan($tabel,$data);
    if ($input > 0)
    {
      echo $this->session->set_flashdata('msg','success');
      redirect('admin/data-ujian.html');
    }
    else
    {
      echo $this->session->set_flashdata('msg','error');
      redirect('admin/data-ujian.html');
    }
  }

  function update_ujian()
  {
    $id = $this->input->post('id_ujian');
    $nama = $this->input->post('nama');
    $tgl = $this->input->post('tanggal');
    $waktu = $this->input->post('waktu');
    $waktu_essai = $this->input->post('waktu_essai');
    $status = $this->input->post('status');

    $pch_tgl = explode('-', $tgl);
    $tanggal = $pch_tgl[2].'-'.$pch_tgl[1].'-'.$pch_tgl[0];

    $tabel = 'tb_ujian';
    $id_field = 'ujian_id';
    $data = array(
      'ujian_nama' => $nama,
      'ujian_tanggal' => $tanggal,
      'ujian_waktu' => $waktu,
      'ujian_essai_waktu' => $waktu_essai,
      'ujian_status' => $status
    );

    $update = $this->M_data_ujian->update($id_field,$id,$tabel,$data);

    if($status == '1'){
      $query = $this->M_data_ujian->get_max_skor($id);
      $get_count = $query->num_rows();

      if($get_count == '0'){
        $pu_pg = $this->M_data_nilai->get_pu_pg()->row_array();
        $s_pg = $this->M_data_nilai->get_s_pg()->row_array();
        $h_pg = $this->M_data_nilai->get_h_pg()->row_array();
        $l_pg = $this->M_data_nilai->get_l_pg()->row_array();
        $pu_essai = $this->M_data_nilai->get_pu_essai()->row_array();
        $s_essai = $this->M_data_nilai->get_s_essai()->row_array();
        $h_essai = $this->M_data_nilai->get_h_essai()->row_array();
        $l_essai = $this->M_data_nilai->get_l_essai()->row_array();
        $pu_uprak = $this->M_data_nilai->get_pu_uprak()->row_array();
        $s_uprak = $this->M_data_nilai->get_s_uprak()->row_array();
        $h_uprak = $this->M_data_nilai->get_h_uprak()->row_array();
        $l_uprak = $this->M_data_nilai->get_l_uprak()->row_array();

        $max_pu = $pu_pg['skor'] + $pu_essai['skor'] + $pu_uprak['skor'];
        $max_s = $s_pg['skor'] + $s_essai['skor'] + $s_uprak['skor'];
        $max_h = $h_pg['skor'] + $h_essai['skor'] + $h_uprak['skor'];
        $max_l = $l_pg['skor'] + $l_essai['skor'] + $l_uprak['skor'];

        $tabel = 'tb_skor_max';
        $data = array(
          'ujian_id' => $id,
          'kategori_id' => '1',
          'skor_max_skor' => $max_pu
        );
        $input = $this->M_data_ujian->simpan($tabel,$data);

        $data = array(
          'ujian_id' => $id,
          'kategori_id' => '2',
          'skor_max_skor' => $max_s
        );
        $input = $this->M_data_ujian->simpan($tabel,$data);

        $data = array(
          'ujian_id' => $id,
          'kategori_id' => '3',
          'skor_max_skor' => $max_h
        );
        $input = $this->M_data_ujian->simpan($tabel,$data);

        $data = array(
          'ujian_id' => $id,
          'kategori_id' => '4',
          'skor_max_skor' => $max_l
        );
        $input = $this->M_data_ujian->simpan($tabel,$data);
        
        echo $this->session->set_flashdata('msg','success');
        redirect('admin/data-ujian.html');

      } else {
        if ($update > 0)
        {
          echo $this->session->set_flashdata('msg','success');
          redirect('admin/data-ujian.html');
        }
        else
        {
          echo $this->session->set_flashdata('msg','error');
          redirect('admin/data-ujian.html');
        }
      }
    } else {
      if ($update > 0)
      {
        echo $this->session->set_flashdata('msg','success');
        redirect('admin/data-ujian.html');
      }
      else
      {
        echo $this->session->set_flashdata('msg','error');
        redirect('admin/data-ujian.html');
      }
    } 
  }

  function hapus_ujian(){
    $id = $this->input->post('id_ujian');
    $id_field = 'ujian_id';
    $tabel = 'tb_ujian';
    $this->M_data_ujian->hapus($id_field, $id, $tabel);
    echo $this->session->set_flashdata('msg','success-hapus');
    redirect('admin/data-ujian.html');
  }
}
