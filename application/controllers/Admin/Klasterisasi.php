<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Klasterisasi extends CI_Controller
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

  public function index()
  {
    if($this->session->userdata('akses')=='1')
    {
      $x['judul'] = "Data Klasterisasi";
      $x['data'] = $this->M_data_ujian->get();
      $this->load->view('admin/klasterisasi/v_all_ujian', $x); 
    }
    else
    {
      $this->load->view('blocked');
    }
  }

  public function peringkat()
  {
    if($this->session->userdata('akses')=='1')
    {
      $x['judul'] = "Data Peringkat";
      $x['data'] = $this->M_data_ujian->get();
      $this->load->view('admin/klasterisasi/v_all_ujian_rank', $x); 
    }
    else
    {
      $this->load->view('blocked');
    }
  }

  public function data_peringkat($ujian_id)
  {
    if($this->session->userdata('akses')=='1')
    {
      $x['judul'] = "Data Peringkat";
      $x['id_ujian'] = $ujian_id;
      $x['data'] = $this->db->query("SELECT * from tb_ujian join tb_hasil_ujian join tb_user on tb_ujian.ujian_id = tb_hasil_ujian.ujian_id and tb_hasil_ujian.user_id = tb_user.user_id and tb_ujian.ujian_id = '$ujian_id'");
      $this->db->query('TRUNCATE table tb_akumulasi_temp');
      
      foreach ($x['data']->result_array() as $i) {
        $user_id = $i['user_id'];
        $get_akumulasi = $this->db->select('*, sum(akumulasi_skor) as skor')
                                  ->where('user_id' , $user_id)
                                  ->where('ujian_id' , $ujian_id)
                                  ->order_by('kategori_id','ASC')
                                  ->group_by('kategori_id')
                                  ->get('tb_akumulasi')->result_array();
        $kategori = array();
        foreach ($get_akumulasi as $a) {
          if(is_null($a['skor'])){
            $kategori[] = 0;
          }else{
            $kategori[] = $a['skor'];
          }
          

        }
       
          $ak_temp['nama_teknisi'] = $i['user_nama'];
          $ak_temp['pu'] = $kategori[0];
          $ak_temp['software'] = $kategori[1];
          $ak_temp['hardware'] = $kategori[2];
          $ak_temp['kelistrikan'] = $kategori[3];
          $ak_temp['akumulasi'] = $kategori[0]+$kategori[1]+$kategori[2]+$kategori[3];
          $this->db->insert('tb_akumulasi_temp', $ak_temp);
      }
      $x['akumulasi'] = $this->db->order_by('akumulasi', 'desc')->get('tb_akumulasi_temp');
      $this->load->view('admin/klasterisasi/v_peringkat', $x); 
    }
    else
    {
      $this->load->view('blocked');
    }
  }

  public function data_klasterisasi($ujian_id)
  {
    if($this->session->userdata('akses')=='1')
    {
      $x['judul'] = "Data Klasterisasi per Ujian";
      $x['id_ujian'] = $ujian_id;
      $x['data'] = $this->db->query("SELECT * from tb_ujian join tb_hasil_ujian join tb_user on tb_ujian.ujian_id = tb_hasil_ujian.ujian_id and tb_hasil_ujian.user_id = tb_user.user_id and tb_ujian.ujian_id = '$ujian_id'");
      $this->db->query('TRUNCATE table tb_akumulasi_temp');
      
      foreach ($x['data']->result_array() as $i) {
        $user_id = $i['user_id'];
        $get_akumulasi = $this->db->select('*, sum(akumulasi_skor) as skor')
                                  ->where('user_id' , $user_id)
                                  ->where('ujian_id' , $ujian_id)
                                  ->order_by('kategori_id','ASC')
                                  ->group_by('kategori_id')
                                  ->get('tb_akumulasi')->result_array();
        $kategori = array();
        foreach ($get_akumulasi as $a) {
          if(is_null($a['skor'])){
            $kategori[] = 0;
          }else{
            $kategori[] = $a['skor'];
          }
          

        }
          $ak_temp['user_id'] = $i['user_id'];
          $ak_temp['nama_teknisi'] = $i['user_nama'];
          $ak_temp['pu'] = $kategori[0];
          $ak_temp['software'] = $kategori[1];
          $ak_temp['hardware'] = $kategori[2];
          $ak_temp['kelistrikan'] = $kategori[3];
          $this->db->insert('tb_akumulasi_temp', $ak_temp);
      }
      $x['akumulasi'] = $this->db->get('tb_akumulasi_temp');
      $this->load->view('admin/klasterisasi/v_data_klasterisasi', $x); 
    }
    else
    {
      $this->load->view('blocked');
    }
  }

  public function klasterisasi_next($ujian_id){
      
    $x['judul'] = "Data Klasterisasi per Ujian";
    $x['id_ujian'] = $ujian_id;
    $x['data'] = $this->db->query("SELECT * from tb_ujian join tb_hasil_ujian join tb_user on tb_ujian.ujian_id = tb_hasil_ujian.ujian_id and tb_hasil_ujian.user_id = tb_user.user_id and tb_ujian.ujian_id = '$ujian_id'");
    $x['akumulasi'] = $this->db->get('tb_akumulasi_temp');

    $id = "";
    $id = $this->db->query('select max(nomor) as m from hasil_centroid');
    foreach($id->result() as $i)
    {
      $id = $i->m;
    }
    $this->db->where('nomor', $id);
    $x['centroid'] = $this->db->get('hasil_centroid');
    $x['id'] = $id+1;
    
    $it = "";
    $it = $this->db->query('select max(iterasi) as it from centroid_temp');
    foreach($it->result() as $i)
    {
      $it = $i->it;
    }
    
    $it_temp = $it-1;
    $this->db->where('iterasi', $it_temp);
    $it_sebelum = $this->db->get('centroid_temp');
    $c1_sebelum = array();
    $c2_sebelum = array();
    $c3_sebelum = array();
    $c4_sebelum = array();
    $c5_sebelum = array();
    $c6_sebelum = array();
    $c7_sebelum = array();
    $no=0;
    foreach($it_sebelum->result() as $it_prev)
    {
      $c1_sebelum[$no] = $it_prev->c1;
      $c2_sebelum[$no] = $it_prev->c2;
      $c3_sebelum[$no] = $it_prev->c3;
      $c4_sebelum[$no] = $it_prev->c4;
      $c5_sebelum[$no] = $it_prev->c5;
      $c6_sebelum[$no] = $it_prev->c6;
      $c7_sebelum[$no] = $it_prev->c7;
      $no++;
    }
    
    $this->db->where('iterasi', $it);
    $it_sesesudah = $this->db->get('centroid_temp');
    $c1_sesesudah = array();
    $c2_sesesudah = array();
    $c3_sesesudah = array();
    $c4_sesesudah = array();
    $c5_sesesudah = array();
    $c6_sesesudah = array();
    $c7_sesesudah = array();
    $no=0;
    foreach($it_sesesudah->result() as $it_next)
    {
      $c1_sesesudah[$no] = $it_next->c1;
      $c2_sesesudah[$no] = $it_next->c2;
      $c3_sesesudah[$no] = $it_next->c3;
      $c4_sesesudah[$no] = $it_next->c4;
      $c5_sesesudah[$no] = $it_next->c5;
      $c6_sesesudah[$no] = $it_next->c6;
      $c7_sesesudah[$no] = $it_next->c7;
      $no++;
    }
    
    if($c1_sebelum==$c1_sesesudah && 
      $c2_sebelum==$c2_sesesudah && 
      $c3_sebelum==$c3_sesesudah && 
      $c4_sebelum==$c4_sesesudah && 
      $c5_sebelum==$c5_sesesudah && 
      $c6_sebelum==$c6_sesesudah && 
      $c7_sebelum==$c7_sesesudah )
    {
      echo $this->session->set_flashdata('msg','iterasi-selesai');
      redirect('Admin/Klasterisasi/klasterisasi_end/'.$ujian_id);
    }
    else
    {
      $this->load->view('admin/klasterisasi/v_data_klasterisasi_next', $x); 
    }
    
  }   

  function klasterisasi_end($ujian_id)
  {
    $x['judul'] = "Data Klasterisasi per Ujian";
    $x['ujian_id'] = $ujian_id;
    $x['data'] = $this->db->query("SELECT * from tb_ujian join tb_hasil_ujian join tb_user on tb_ujian.ujian_id = tb_hasil_ujian.ujian_id and tb_hasil_ujian.user_id = tb_user.user_id and tb_ujian.ujian_id = '$ujian_id'");

    $x['q'] = $this->db->query('SELECT * from centroid_temp group by iterasi');
    $get_max = $this->db->query("SELECT max(iterasi) as iterasi from centroid_temp")->row();
    $max = $get_max->iterasi;
    $iterasi = $this->db->query("SELECT * from centroid_temp where iterasi='$max' ")->result_array();
    $akumulasi = $this->db->get('tb_akumulasi_temp')->result_array();
    $id_user = array();
    $nama_user = array();
    foreach ($akumulasi as $a) {
      $id_user[]=$a['user_id'];
      $nama_user[]=$a['nama_teknisi'];
    }

    $no = 0;
    foreach ($iterasi as $i) {
      $user_id = $id_user[$no];
      $nama = $nama_user[$no];

      if($i['c1'] == 1){
        $jabatan = 'Teknisi Produksi';
      } elseif($i['c2'] == 1){
        $jabatan = 'Teknisi Inventory';
      } elseif($i['c3'] == 1){
        $jabatan = 'Teknisi Instalasi Listrik';
      } elseif($i['c4'] == 1){
        $jabatan = 'Teknisi Instalasi Umum';
      } elseif($i['c5'] == 1){
        $jabatan = 'Teknisi Konfigurasi';
      } elseif($i['c6'] == 1){
        $jabatan = 'Teknisi Software';
      } elseif($i['c7'] == 1){
        $jabatan = 'Teknisi RnD';
      } 

      $hasil['user_id'] = $user_id;
      $hasil['nama_teknisi'] = $nama;
      $hasil['ujian_id'] = $ujian_id;
      $hasil['jabatan'] = $jabatan;

      $this->db->insert('hasil_klasterisasi', $hasil);
      $no++;
    }
    $x['hasil_klasterisasi'] = $this->db->get_where('hasil_klasterisasi', ['ujian_id' =>$ujian_id]);

    $this->load->view('admin/klasterisasi/v_data_klasterisasi_end', $x); 
  }
}
