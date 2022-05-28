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
    $this->load->model('M_data_ujian');
    $this->load->model('M_data_nilai');
  }

  public function index()
  {
    if($this->session->userdata('akses')=='2')
    {
      $x['judul'] = "Dashboard";
      $x['nama_peserta'] = $this->session->userdata('ses_nama');
      $x['user_id'] = $this->session->userdata('id');
      $x['timestamp'] = strtotime(date('Y-m-d H:i:s'));
      $x['data'] = $this->db->get_where('tb_ujian',['ujian_status' => '1']);
      $this->load->view('teknisi/v_dashboard', $x);
    }
    else
    {
      $this->load->view('blocked');
    }
  }

  public function konfirmasi($id)
  {
    $x['judul'] = "Konfirmasi";
    $x['nama_peserta'] = $this->session->userdata('ses_nama');
    $x['uprak'] = $this->M_data_nilai->get_uprak();
    $x['timestamp'] = strtotime(date('Y-m-d H:i:s'));
    $x['data'] = $this->db->get_where('tb_ujian',['ujian_id' => $id])->row_array();
    $this->load->view('teknisi/v_konfirmasi', $x);
  }

  public function data_nilai($user_id, $ujian_id)
  {
    if($this->session->userdata('akses')=='2')
    {
      $x['judul'] = "Data Nilai";
      $jenis = 'pg';
      $tabel = 'tb_nilai_pg';
      $tabel2 = 'tb_soal_pg';
      $id_field = 'soal_pg_id';
      $x['judul'] = "Data Akumulasi Pilihan Ganda";
      $x['data'] = $this->M_data_nilai->get($user_id,$ujian_id,$jenis);
      $x['kategori'] = $this->M_data_nilai->get_kategori();
      $x['jawaban'] = $this->M_data_nilai->get_jawaban($user_id,$ujian_id,$tabel,$tabel2,$id_field);
      
      $x['nama_peserta'] = $this->session->userdata('ses_nama');
      $x['timestamp'] = strtotime(date('Y-m-d H:i:s'));
      $x['data'] = $this->db->get_where('tb_ujian',['ujian_status' => '1']);
      $this->load->view('teknisi/v_nilai', $x);
    }
    else
    {
      $this->load->view('blocked');
    }
  }
}
