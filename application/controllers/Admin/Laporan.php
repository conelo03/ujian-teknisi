<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    if ($this->session->userdata('masuk') != TRUE)
    {
      $url=base_url();
      redirect($url);
    };
    $this->load->model('M_data_nilai');
    $this->load->model('M_data_ujian');
  }

  public function ujian()
  {
    if($this->session->userdata('akses')=='1')
    {
      $x['judul'] = "Laporan Hasil Ujian";
      $x['data'] = $this->M_data_ujian->get();
      $this->load->view('admin/laporan/v_laporan_ujian', $x); 
    }
    else
    {
      $this->load->view('blocked');
    }
  }

  public function laporan_ujian($ujian_id)
  {
    $x['judul'] = "Laporan Hasil Ujian";
    $x['ujian_id']= $ujian_id;
    $x['data'] = $this->db->get_where('tb_hasil_ujian', ['ujian_id' => $ujian_id]);
    $this->load->view('admin/laporan/v_laporan_hasil_ujian', $x);
  }

  public function laporan_ujian_pdf($ujian_id)
  {
    $this->load->library('pdf');
    $x['judul'] = "Laporan Hasil Ujian";
    $x['ujian_id']= $ujian_id;
    $ujian = $this->db->get_where('tb_ujian', ['ujian_id' => $ujian_id])->row_array();
    $hari = date('l', strtotime($ujian['ujian_tanggal']));
    $x['hari'] = $this->hari_indo($hari);
    $x['tgl'] = date('d', strtotime($ujian['ujian_tanggal']));
    $bln = date('m', strtotime($ujian['ujian_tanggal']));
    $x['bln'] = $this->bln_indo($bln); 
    $x['tahun'] = date('Y', strtotime($ujian['ujian_tanggal']));
    $x['data'] = $this->db->get_where('tb_hasil_ujian', ['ujian_id' => $ujian_id]);
    $html_content = $this->load->view('admin/laporan/v_print_laporan_ujian', $x, true);
    $filename = 'Laporan Hasil Ujian.pdf';

    $this->pdf->loadHtml($html_content);
    $this->pdf->render();
    $this->pdf->stream($filename, ['Attachment' => 1]);
  }

  public function laporan_klasterisasi_pdf($ujian_id)
  {
    $this->load->library('pdf');
    $x['judul'] = "Laporan Hasil Klasterisasi";
    $x['ujian_id']= $ujian_id;
    $ujian = $this->db->get_where('tb_ujian', ['ujian_id' => $ujian_id])->row_array();
    $hari = date('l', strtotime($ujian['ujian_tanggal']));
    $x['hari'] = $this->hari_indo($hari);
    $x['tgl'] = date('d', strtotime($ujian['ujian_tanggal']));
    $bln = date('m', strtotime($ujian['ujian_tanggal']));
    $x['bln'] = $this->bln_indo($bln); 
    $x['tahun'] = date('Y', strtotime($ujian['ujian_tanggal']));
    $x['data'] = $this->db->get_where('tb_hasil_ujian', ['ujian_id' => $ujian_id]);
    $html_content = $this->load->view('admin/laporan/v_print_laporan_klasterisasi', $x, true);
    $filename = 'Laporan Hasil Klasterisasi.pdf';

    $this->pdf->loadHtml($html_content);
    $this->pdf->render();
    $this->pdf->stream($filename, ['Attachment' => 1]);
  }

  public function klasterisasi()
  {
    if($this->session->userdata('akses')=='1')
    {
      $x['judul'] = "Laporan Hasil Klasterisasi";
      $x['data'] = $this->M_data_ujian->get();
      $this->load->view('admin/laporan/v_laporan_klasterisasi', $x); 
    }
    else
    {
      $this->load->view('blocked');
    }
  }

  public function laporan_klasterisasi($ujian_id)
  {
    $x['judul'] = "Laporan Hasil Klasterisasi";
    $x['ujian_id']= $ujian_id;
    $x['data'] = $this->db->get_where('tb_hasil_ujian', ['ujian_id' => $ujian_id]);
    $this->load->view('admin/laporan/v_laporan_hasil_klasterisasi', $x);
  }

  private function hari_indo($hari){
    switch ($hari) {
      case 'Monday': $hari= 'Senin'; break;
      case 'Tuesday': $hari= 'Selasa'; break;
      case 'Wednesday': $hari= 'Rabu'; break;
      case 'Thursday': $hari= 'Kamis'; break;
      case 'Friday': $hari= 'Jumat'; break;
      case 'Saturday': $hari= 'Sabtu'; break;
      case 'Sunday': $hari= 'Ahad'; break;
      default: $hari= 'Hari Tidak Terdefinisi'; break;
    }
    return $hari;
  }
   
   private function bln_indo($bln){
    switch ($bln) {
      case '01': $bln= 'Januari'; break;
      case '02': $bln= 'Februari'; break;
      case '03': $bln= 'Maret'; break;
      case '04': $bln= 'April'; break;
      case '05': $bln= 'Mei'; break;
      case '06': $bln= 'Juni'; break;
      case '07': $bln= 'Juli'; break;
      case '08': $bln= 'Agustus'; break;
      case '09': $bln= 'September'; break;
      case '10': $bln= 'Oktober'; break;
      case '11': $bln= 'November'; break;
      case '12': $bln= 'Desember'; break;
      default: $bln= 'Hari Tidak Terdefinisi'; break;
    }
    return $bln;
  } 
}
