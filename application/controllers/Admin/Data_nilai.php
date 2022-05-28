<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_nilai extends CI_Controller
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
    $this->load->model('M_bank_soal');
  }

  public function hasil_ujian_pg()
  {
    if($this->session->userdata('akses')=='1')
    {
      $x['judul'] = "Data Akumulasi Nilai";
      $x['data'] = $this->M_data_nilai->get_hasil_ujian();
      $this->load->view('admin/data_nilai/v_hasil_ujian_pg', $x); 
    }
    else
    {
      $this->load->view('blocked');
    }
  }

  public function nilai_pg($user_id,$ujian_id)
  {
    if($this->session->userdata('akses')=='1')
    {
      $jenis = 'pg';
      $tabel = 'tb_nilai_pg';
      $tabel2 = 'tb_soal_pg';
      $id_field = 'soal_pg_id';
      $x['judul'] = "Data Akumulasi Pilihan Ganda";
      $x['data'] = $this->M_data_nilai->get($user_id,$ujian_id,$jenis);
      $x['kategori'] = $this->M_data_nilai->get_kategori();
      $x['jawaban'] = $this->M_data_nilai->get_jawaban($user_id,$ujian_id,$tabel,$tabel2,$id_field);
      $this->load->view('admin/data_nilai/v_nilai_pg', $x); 
    }
    else
    {
      $this->load->view('blocked');
    }
  }  

  public function hasil_ujian_essai()
  {
    if($this->session->userdata('akses')=='1')
    {
      $x['judul'] = "Data Akumulasi Nilai";
      $x['data'] = $this->M_data_nilai->get_hasil_ujian();
      $this->load->view('admin/data_nilai/v_hasil_ujian_essai', $x); 
    }
    else
    {
      $this->load->view('blocked');
    }
  }  

  public function nilai_essai($user_id,$ujian_id)
  {
    if($this->session->userdata('akses')=='1')
    {
      $jenis = 'essai';
      $tabel = 'tb_nilai_essai';
      $tabel2 = 'tb_soal_essai';
      $id_field = 'soal_essai_id';
      $x['judul'] = "Data Akumulasi Essai";
      $x['data'] = $this->M_data_nilai->get($user_id,$ujian_id,$jenis);
      $x['kategori'] = $this->M_data_nilai->get_kategori();
      $x['jawaban'] = $this->M_data_nilai->get_jawaban($user_id,$ujian_id,$tabel,$tabel2,$id_field);
      $this->load->view('admin/data_nilai/v_nilai_essai', $x); 
    }
    else
    {
      $this->load->view('blocked');
    }
  }

  function input_skor_essai()
  {
    $id = $this->input->post('id_nilai');
    $ujian_id = $this->input->post('id_ujian');
    $user_id = $this->input->post('id_user');
    $kategori_id = $this->input->post('id_kategori');
    $skor = $this->input->post('skor');

    $tabel = 'tb_nilai_essai';
    $id_field = 'nilai_essai_id';
    $data = array(
      'nilai_essai_skor' => $skor,

    );

    $update = $this->M_data_nilai->update($id_field,$id,$tabel,$data);
    if ($update > 0)
    {
      $query = $this->db->select_sum('nilai_essai_skor','akumulasi_essai')
                        ->from('tb_nilai_essai')
                        ->join('tb_soal_essai','tb_nilai_essai.soal_essai_id=tb_soal_essai.soal_essai_id')
                        ->join('tb_kategori_soal','tb_kategori_soal.kategori_id=tb_soal_essai.kategori_id')
                        ->where('tb_kategori_soal.kategori_id',$kategori_id)
                        ->where('tb_nilai_essai.ujian_id',$ujian_id)
                        ->where('tb_nilai_essai.user_id',$user_id)
                        ->get()->row_array();
      $get = $query['akumulasi_essai'];
      $data_essai = array(
        'akumulasi_skor' => $get
      );
      $this->M_data_nilai->update_akumulasi_essai($ujian_id,$user_id,$kategori_id,$data_essai);

      echo $this->session->set_flashdata('msg','info');
      redirect('admin/'.$user_id.'/'.$ujian_id.'/data-akumulasi-ujian-essai.html');
    }
    else
    {
      echo $this->session->set_flashdata('msg','error');
      redirect('admin/'.$user_id.'/'.$ujian_id.'/data-akumulasi-ujian-essai.html');
    }
  }

  public function hasil_ujian_praktek()
  {
    if($this->session->userdata('akses')=='1')
    {
      $x['judul'] = "Data Akumulasi Nilai";
      $x['data'] = $this->M_data_nilai->get_hasil_ujian();
      $this->load->view('admin/data_nilai/v_hasil_ujian_praktek', $x); 
    }
    else
    {
      $this->load->view('blocked');
    }
  }

  public function nilai_uprak($user_id,$ujian_id)
  {
    if($this->session->userdata('akses')=='1')
    {
      $jenis = 'uprak';
      $tabel = 'tb_nilai_uprak';
      $tabel2 = 'tb_materi_uprak';
      $id_field = 'uprak_id';
      $get_user = $this->M_data_nilai->get_user($user_id);
      $u = $get_user->row_array();
      $x['judul'] = "Data Akumulasi Ujian Praktek";
      $x['data'] = $this->M_data_nilai->get($user_id,$ujian_id,$jenis);
      $x['kategori'] = $this->M_data_nilai->get_kategori();
      $x['jawaban'] = $this->M_data_nilai->get_jawaban($user_id,$ujian_id,$tabel,$tabel2,$id_field);
      $x['uprak'] = $this->M_data_nilai->get_uprak();
      $x['user_id'] = $user_id;
      $x['ujian_id'] = $ujian_id;
      $x['user_nama'] = $u['user_nama'];
      $this->load->view('admin/data_nilai/v_nilai_uprak', $x); 
    }
    else
    {
      $this->load->view('blocked');
    }
  }
  
  function input_skor_uprak()
  {
    $ujian_id = $this->input->post('id_ujian');
    $user_id = $this->input->post('id_user');
    $uprak = $this->input->post('uprak');
    $skor = $this->input->post('skor');

    $pch_uprak = explode('.', $uprak);
    $uprak_id = $pch_uprak[0];
    $kategori_id = $pch_uprak[1];

    $tabel = 'tb_nilai_uprak';
    $data = array(
      'uprak_id' => $uprak_id,
      'user_id' => $user_id,
      'ujian_id' => $ujian_id,
      'nilai_uprak_skor' => $skor

    );

    $simpan = $this->M_data_nilai->simpan($tabel,$data);
    if ($simpan > 0)
    {
      $query = $this->db->select_sum('nilai_uprak_skor','akumulasi_uprak')
                        ->from('tb_nilai_uprak')
                        ->join('tb_materi_uprak','tb_nilai_uprak.uprak_id=tb_materi_uprak.uprak_id')
                        ->join('tb_kategori_soal','tb_kategori_soal.kategori_id=tb_materi_uprak.kategori_id')
                        ->where('tb_kategori_soal.kategori_id',$kategori_id)
                        ->where('tb_nilai_uprak.ujian_id',$ujian_id)
                        ->get()->row_array();
      $get = $query['akumulasi_uprak'];
      $data_uprak = array(
        'akumulasi_skor' => $get
      );
      $this->M_data_nilai->update_akumulasi_uprak($ujian_id,$user_id,$kategori_id,$data_uprak); 
      echo $this->session->set_flashdata('msg','success');
      redirect('admin/'.$user_id.'/'.$ujian_id.'/data-akumulasi-ujian-praktek.html');
    }
    else
    {
      echo $this->session->set_flashdata('msg','error');
      redirect('admin/'.$user_id.'/'.$ujian_id.'/data-akumulasi-ujian-praktek.html');
    }
  }

  function edit_skor_uprak()
  {
    $id = $this->input->post('id_nilai');
    $ujian_id = $this->input->post('id_ujian');
    $user_id = $this->input->post('id_user');
    $uprak_id = $this->input->post('materi');
    $kategori_id = $this->input->post('id_kategori');
    $skor = $this->input->post('skor');

    $tabel = 'tb_nilai_uprak';
    $id_field = 'nilai_uprak_id';
    $data = array(
      'uprak_id' => $uprak_id,
      'user_id' => $user_id,
      'ujian_id' => $ujian_id,
      'nilai_uprak_skor' => $skor

    );

    $update = $this->M_bank_soal->update($id_field,$id,$tabel,$data);
    if ($update > 0)
    {
      $query = $this->db->select_sum('nilai_uprak_skor','akumulasi_uprak')
                        ->from('tb_nilai_uprak')
                        ->join('tb_materi_uprak','tb_nilai_uprak.uprak_id=tb_materi_uprak.uprak_id')
                        ->join('tb_kategori_soal','tb_kategori_soal.kategori_id=tb_materi_uprak.kategori_id')
                        ->where('tb_kategori_soal.kategori_id',$kategori_id)
                        ->where('tb_nilai_uprak.ujian_id',$ujian_id)
                        ->get()->row_array();
      $get = $query['akumulasi_uprak'];
      $data_uprak = array(
        'akumulasi_skor' => $get
      );
      $this->M_data_nilai->update_akumulasi_uprak($ujian_id,$user_id,$kategori_id,$data_uprak); 
      echo $this->session->set_flashdata('msg','info');
      redirect('admin/'.$user_id.'/'.$ujian_id.'/data-akumulasi-ujian-praktek.html');
    }
    else
    {
      echo $this->session->set_flashdata('msg','error');
      redirect('admin/'.$user_id.'/'.$ujian_id.'/data-akumulasi-ujian-praktek.html');
    }
  }

  function hapus_skor_uprak(){
    $id = $this->input->post('id_nilai');
    $ujian_id = $this->input->post('id_ujian');
    $user_id = $this->input->post('id_user');
    $kategori_id = $this->input->post('id_kategori');
    $skor = $this->input->post('skor');
    $id_field = 'nilai_uprak_id';
    $tabel = 'tb_nilai_uprak';
    $this->M_data_nilai->hapus($id_field, $id, $tabel);
    $query = $this->db->select('*')
                      ->from('tb_akumulasi')
                      ->where('akumulasi_jenis','uprak')
                      ->where('ujian_id',$ujian_id)
                      ->where('user_id',$user_id)
                      ->where('kategori_id',$kategori_id)
                      ->get()->row_array();
    $get_skor = $query['akumulasi_skor'];

    $data = array (
      'akumulasi_skor' => $get_skor - $skor
    );
    $res = $this->db->where('ujian_id', $ujian_id)
                    ->where('user_id', $user_id)
                    ->where('akumulasi_jenis', 'uprak')
                    ->where('kategori_id', $kategori_id)
                    ->update('tb_akumulasi', $data);
    echo $this->session->set_flashdata('msg','success-hapus');
    redirect('admin/'.$user_id.'/'.$ujian_id.'/data-akumulasi-ujian-praktek.html');
  }

  public function nilai_akumulasi()
  {
    if($this->session->userdata('akses')=='1')
    {
      $x['judul'] = "Data Akumulasi Nilai";
      $x['data'] = $this->M_data_nilai->get_hasil_ujian();
      $this->load->view('admin/data_nilai/v_hasil_akumulasi_ujian', $x); 
    }
    else
    {
      $this->load->view('blocked');
    }
  }

  public function nilai_akumulasi_ujian($user_id,$ujian_id)
  {
    if($this->session->userdata('akses')=='1')
    {
      $x['judul'] = "Data Akumulasi Ujian";
      $x['data'] = $this->M_data_nilai->get_akumulasi($user_id,$ujian_id);
      $this->load->view('admin/data_nilai/v_nilai_akumulasi', $x);
    }
    else
    {
      $this->load->view('blocked');
    }
  } 

  public function input_nilai_uprak_per_sk($user_id,$ujian_id,$uprak_id)
  {
    if($this->session->userdata('akses')=='1')
    {
      $get_user = $this->M_data_nilai->get_user($user_id);
      $u = $get_user->row_array();
      $x['judul'] = "Data Subkomponen Uprak";
      $x['data'] = $this->db->select('*')
                            ->join('tb_subkomponen_uprak','tb_subkomponen_uprak.sk_uprak_id=tb_nilai_subkomponen_uprak.sk_uprak_id')
                            ->join('tb_komponen_uprak', 'tb_komponen_uprak.komponen_uprak_id=tb_nilai_subkomponen_uprak.komponen_uprak_id')
                            ->where('tb_nilai_subkomponen_uprak.user_id', $user_id)
                            ->where('tb_nilai_subkomponen_uprak.ujian_id', $ujian_id)
                            ->where('tb_nilai_subkomponen_uprak.uprak_id', $uprak_id)->get('tb_nilai_subkomponen_uprak');
      
      $x['subkomponen'] = $this->db->query("SELECT * from tb_subkomponen_uprak where uprak_id = '$uprak_id'");
      $x['user_id'] = $user_id;
      $x['ujian_id'] = $ujian_id;
      $x['uprak_id'] = $uprak_id;
      $this->load->view('admin/data_nilai/v_nilai_uprak_per_sk', $x); 
    }
    else
    {
      $this->load->view('blocked');
    }
  }

  function tambah_nilai_sk_uprak()
  {
    $detail = $this->input->post('detail');
    $pch_id = explode('-', $detail);
    $sk_uprak_id = $pch_id[0];
    $komponen_uprak_id = $pch_id[1];
    $user_id = $this->input->post('user_id');
    $ujian_id = $this->input->post('ujian_id');    
    $uprak_id = $this->input->post('uprak_id');
    $skor = $this->input->post('skor');

    $data = array(
      'sk_uprak_id' => $sk_uprak_id,
      'komponen_uprak_id' => $komponen_uprak_id,
      'user_id' => $user_id,
      'ujian_id' => $ujian_id,
      'uprak_id' => $uprak_id,
      'sk_uprak_nilai' => $skor

    );

    $insert = $this->db->insert('tb_nilai_subkomponen_uprak', $data);
    $update = $this->update_skor_uprak($user_id,$ujian_id,$uprak_id);
    if ($update == true)
    {
      echo $this->session->set_flashdata('msg','info');
      redirect('Admin/Data_nilai/input_nilai_uprak_per_sk/'.$user_id.'/'.$ujian_id.'/'.$uprak_id);
    }
    else
    {
      echo $this->session->set_flashdata('msg','error');
      redirect('Admin/Data_nilai/input_nilai_uprak_per_sk/'.$user_id.'/'.$ujian_id.'/'.$uprak_id);
    }
  }

  function update_skor_uprak($user_id,$ujian_id,$uprak_id)
  {
    $komponen = $this->db->get('tb_komponen_uprak');
    $nilai_uprak = 0;
    foreach ($komponen->result_array() as $k) {
      $id_komponen = $k['komponen_uprak_id'];
      $bobot_komponen = $k['komponen_uprak_bobot'];

      $get_skor = $this->db->select_avg('sk_uprak_nilai','skor')
                          ->where('komponen_uprak_id', $id_komponen)
                          ->where('uprak_id', $uprak_id)
                          ->where('user_id', $user_id)
                          ->where('ujian_id', $ujian_id)
                          ->get('tb_nilai_subkomponen_uprak')->row_array();
      $skor_per_sk = $get_skor['skor'];
      $skor_per_k = $skor_per_sk*$bobot_komponen/100;

      $nilai_uprak +=$skor_per_k;
    }

    $get_uprak = $this->db->get_where('tb_materi_uprak', ['uprak_id' => $uprak_id])->row_array();

    $nilai_uprak_akhir = $nilai_uprak*$get_uprak['uprak_bobot']/100;

    $where = array(
      'uprak_id'=>$uprak_id,
      'ujian_id'=>$ujian_id,
      'user_id'=>$user_id
    );

    $this->db->update('tb_nilai_uprak', ['nilai_uprak_skor' => $nilai_uprak_akhir], $where);

    $get_kategori = $this->db->get_where('tb_materi_uprak', ['uprak_id' => $uprak_id])->row_array();
    $kategori_id = $get_uprak['kategori_id'];
    $query = $this->db->select_sum('nilai_uprak_skor','akumulasi_uprak')
                        ->from('tb_nilai_uprak')
                        ->join('tb_materi_uprak','tb_nilai_uprak.uprak_id=tb_materi_uprak.uprak_id')
                        ->join('tb_kategori_soal','tb_kategori_soal.kategori_id=tb_materi_uprak.kategori_id')
                        ->where('tb_kategori_soal.kategori_id',$kategori_id)
                        ->where('tb_nilai_uprak.ujian_id',$ujian_id)
                        ->get()->row_array();
    $get = $query['akumulasi_uprak'];
    $data_uprak = array(
      'akumulasi_skor' => $get
    );
    $this->M_data_nilai->update_akumulasi_uprak($ujian_id,$user_id,$kategori_id,$data_uprak); 

    return true;
  }
}
