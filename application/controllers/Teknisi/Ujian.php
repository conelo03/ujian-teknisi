<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ujian extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    if ($this->session->userdata('masuk') != TRUE)
    {
      $url=base_url();
      redirect($url);
    }
    $this->load->library('pagination');
    $this->load->model('M_data_ujian');
    date_default_timezone_set("Asia/Jakarta"); 
  }

  public function index($id_ujian)
  {
    $x['judul'] = "CAT MatahariLed";
    $x['nama_peserta'] = $this->session->userdata('ses_nama');
    $x['timestamp'] = strtotime(date('Y-m-d H:i:s'));
    $id_user = $this->session->userdata('id');

  

    $x['ujian'] = $this->db->get_where('tb_ujian',['ujian_id' => $id_ujian])->row();

    if (intval($id_user) % 2 == 1){
      $x['soal'] = $this->db->get_where('tb_soal_pg',['soal_pg_status' => 'A'])->row();
    } else {
      $x['soal'] = $this->db->get_where('tb_soal_pg',['soal_pg_status' => 'B'])->row();
    }
    
    $x['user_id'] = $id_user;
    $x['ujian_id'] = $id_ujian;

    $cek_ujian = $this->db->get_where('tb_hasil_ujian',['ujian_id' => $id_ujian, 'user_id' => $id_user]);

    if ($cek_ujian->num_rows() == 0){
      $data['user_id'] = $id_user;
      $data['ujian_id'] = $id_ujian;
      $data['h_ujian_status'] = '1';
      $data['ujian_created'] = date('Y-m-d H:i:s');
      $simpan = $this->M_data_ujian->simpan('tb_hasil_ujian',$data);
      $hasil_ujian = $this->db->get_where('tb_hasil_ujian',['ujian_id' => $id_ujian, 'user_id' => $id_user])->row();
    } else {
      $hasil_ujian = $this->db->get_where('tb_hasil_ujian',['ujian_id' => $id_ujian, 'user_id' => $id_user])->row();
    }

    if(($hasil_ujian->h_ujian_status == '2') || ($hasil_ujian->h_ujian_status == '3') || ($hasil_ujian->h_ujian_status == '4')){
      echo $this->session->set_flashdata('msg','sudah_ujian');
      redirect('Teknisi/Dashboard/konfirmasi/'.$id_ujian);
    }

    $tanggal = new DateTime();
    // Cek apakah tes sudah melebihi batas waktu
    $tanggal_tes = new DateTime($hasil_ujian->ujian_created);
    $tanggal_tes->modify('+'.$x['ujian']->ujian_waktu.' minutes');
    if($tanggal>=$tanggal_tes){
        // jika waktu sudah melebihi waktu ketentuan, maka diarahkan ke dashboard
      $this->db->update('tb_hasil_ujian',['h_ujian_status' =>'2'],['user_id' => $id_user, 'ujian_id' => $id_ujian]);
        echo $this->session->set_flashdata('msg','error');
        redirect('Teknisi/Dashboard/konfirmasi/'.$id_ujian);
    }else{
        // mengambil soal sesuai dengan tes yang dikerjakan
        $x['tes_waktu'] = $x['ujian']->ujian_waktu;
        $x['tes_dibuat'] = $hasil_ujian->ujian_created;
        $x['tanggal'] = $tanggal->format('Y-m-d H:i:s');
        // Mengambil selisih jam
        $tanggal_tes = new DateTime($hasil_ujian->ujian_created);
        $tanggal_diff = $tanggal_tes->diff($tanggal);

        $detik_berjalan = ($tanggal_diff->h*60*60)+($tanggal_diff->i*60)+$tanggal_diff->s;
        $detik_total = $x['ujian']->ujian_waktu*60;

                    // untuk menangani Jika tes setelah ditambah waktunya melebihi jam saat itu
                    // jika time saat ini lebih besar dari time creation
        if($tanggal>=$tanggal_tes){
            $detik_sisa = $detik_total-$detik_berjalan;
                    
                    // jika time creation lebih besar dari tanggal saat ini
        }else{
            $detik_sisa = $detik_total+$detik_berjalan;
        }
    }

    $x['detik_berjalan'] = $detik_berjalan;
    $x['detik_total'] = $detik_total;
    $x['detik_sisa'] = $detik_sisa;

    $config['base_url'] = base_url().'Tenisi/Ujian/index/'.$id_ujian.'/';
    if (intval($id_user) % 2 == 1){
      $config['total_rows'] = $this->db->get_where('tb_soal_pg',['soal_pg_status' => 'A'])->num_rows(); //total row
    } else {
      $config['total_rows'] = $this->db->get_where('tb_soal_pg',['soal_pg_status' => 'B'])->num_rows(); //total row
    }
    
    $config['per_page'] = 1;  //show record per halaman
    $config["uri_segment"] = 5;  // uri parameter
    $config["num_links"] = 0;
    $from = $this->uri->segment(5);
 
    // Membuat Style pagination untuk BootStrap v4
    $config['full_tag_open']    = '<div class="pagging text-center"><nav<ul class="pagination justify-content-center">';
    $config['full_tag_close']   = '</ul></nav></div>';
        
    $config['next_link']        = 'Next';
    $config['next_tag_open']   = '<li class="page-item"><span class="page-link">';
    $config['next_tag_close']  = '</span></li>';

    $config['prev_link']        = 'Prev';
    $config['prev_tag_open']   = '<li class="page-item"><span class="page-link">';
    $config['prev_tag_close']  = '</span></li>';

    $config['first_link']      = 'First'; 
    $config['first_tag_open']  = '<li class="page-item"><span class="page-link">';
    $config['first_tag_close'] = '</span></li>';
        
    $config['last_link']       = 'Last'; 
    $config['last_tag_open']   = '<li class="page-item"><span class="page-link">';
    $config['last_tag_close']  = '</span></li>';
        
    $config['cur_tag_open']    = '<li class="page-item active"><span class="page-link">';
    $config['cur_tag_close']   = '<span class="sr-only"><a class="active" href="#"></a></span></span></li>';
         
    $config['num_tag_open']    = '<li class="page-item"><span class="page-link">';
    $config['num_tag_close']   = '</span></li>';

        
 
    $this->pagination->initialize($config);
    //panggil function get_mahasiswa_list yang ada pada mmodel mahasiswa_model. 
    $x['soal_pg'] = $this->M_data_ujian->get_soal_pg_pagi($config["per_page"], $from, $id_ujian, $id_user);
    $x['jml_soal'] = $this->M_data_ujian->get_jml_pg($id_ujian,$id_user)->num_rows()-1;
    $x['daftar_soal'] = $this->M_data_ujian->get_soal_pg($id_ujian,$id_user);
 
    $x['paginat'] = $this->pagination->create_links();

    $this->load->view('teknisi/v_isi_jawaban', $x);
  }

  public function simpan_jawaban(){
    $user_id = $this->input->post('user_id');
    $ujian_id = $this->input->post('ujian_id');
    $soal_pg_id = $this->input->post('soal_pg_id');
    $soal_pg_jawaban =$this->input->post('soal_pg_jawaban');
    $soal_pg_bobot = $this->input->post('soal_pg_bobot');
    $ragu = $this->input->post('ragu');
    $jml_soal = $this->input->post('jml_soal');

    $jawaban = $this->input->post('jawaban');
    if($ragu == NULL){
      $ragu = '0';
    }

    if($this->input->post('uri') == $jml_soal){
      $uri = $this->input->post('uri');
    } else {
      $uri = (int)$this->input->post('uri')+1;
    }

    $cek_nilai = $this->db->get_where('tb_nilai_pg',['user_id' => $user_id, 'ujian_id' => $ujian_id, 'soal_pg_id' => $soal_pg_id])->num_rows();
    if(!empty($jawaban)){
      if($cek_nilai == 0){
        if($soal_pg_jawaban == $jawaban){
          $skor = $soal_pg_bobot;
          $koreksi = '1';
        } else {
          $skor = '0';
          $koreksi = '0';
        }
        $input = array(
          'user_id' => $user_id,
          'ujian_id' => $ujian_id,
          'soal_pg_id' => $soal_pg_id,
          'nilai_pg_jawaban' => $jawaban,
          'nilai_pg_skor' => $skor,
          'nilai_pg_koreksi' => $koreksi,
          'nilai_pg_ragu' => $ragu
        );
        $this->db->insert('tb_nilai_pg', $input);
      }
      elseif($cek_nilai>0){
        if($soal_pg_jawaban == $jawaban){
          $skor = $soal_pg_bobot;
          $koreksi = '1';
        } else {
          $skor = '0';
          $koreksi = '0';
        }
        $input = array(
          'user_id' => $user_id,
          'ujian_id' => $ujian_id,
          'soal_pg_id' => $soal_pg_id,
          'nilai_pg_jawaban' => $jawaban,
          'nilai_pg_skor' => $skor,
          'nilai_pg_koreksi' => $koreksi,
          'nilai_pg_ragu' => $ragu
        );
        $this->db->update('tb_nilai_pg', $input,['user_id' => $user_id, 'ujian_id' => $ujian_id, 'soal_pg_id' => $soal_pg_id]);
      }
      redirect('Teknisi/Ujian/index/'.$ujian_id.'/'.$uri);
    } else {
      redirect('Teknisi/Ujian/index/'.$ujian_id.'/'.$uri);
    }
    
  }

  public function hentikan_tes(){
    $user_id = $this->input->post('user_id');
    $ujian_id = $this->input->post('ujian_id');

    $update = array(
      'h_ujian_status' => '2'
    );
    $this->db->update('tb_hasil_ujian', $update,['user_id' => $user_id, 'ujian_id' => $ujian_id]);
    $get_kategori = $this->db->get('tb_kategori_soal')->result();
    foreach ($get_kategori as $k) {
      $get_aka = $this->db->query("SELECT sum(nilai_pg_skor) as skor from tb_nilai_pg join tb_soal_pg on tb_nilai_pg.soal_pg_id=tb_soal_pg.soal_pg_id and tb_nilai_pg.ujian_id='$ujian_id' and tb_nilai_pg.user_id='$user_id' and tb_soal_pg.kategori_id='$k->kategori_id'")->row();
      if($get_aka->skor == NULL){
        $skor = '0';
      } else {
        $skor = $get_aka->skor;
      }
      $data = array(
        'ujian_id' => $ujian_id,
        'user_id' =>$user_id,
        'akumulasi_jenis' => 'pg',
        'kategori_id' => $k->kategori_id,
        'akumulasi_skor' => $skor
      );

      $this->db->insert('tb_akumulasi', $data);
    }
    echo $this->session->set_flashdata('msg','henti_pg');
    redirect('Teknisi/Dashboard/konfirmasi/'.$ujian_id);
  }

  public function essai($id_ujian)
  {
    $x['judul'] = "CAT MatahariLed";
    $x['nama_peserta'] = $this->session->userdata('ses_nama');
    $x['timestamp'] = strtotime(date('Y-m-d H:i:s'));
    $id_user = $this->session->userdata('id');

    $h_ujian = $this->db->get_where('tb_hasil_ujian',['ujian_id' => $id_ujian, 'user_id' => $id_user])->row();

    if($h_ujian->h_ujian_status == '1'){
      echo $this->session->set_flashdata('msg','belum_ujian');
      redirect('Teknisi/Dashboard/konfirmasi/'.$id_ujian);
    }elseif(($h_ujian->h_ujian_status == '2') || ($h_ujian->h_ujian_status == '3')){
      $x['ujian'] = $this->db->get_where('tb_ujian',['ujian_id' => $id_ujian])->row();
      if (($id_user % 2) == 1){
            $x['soal'] = $this->db->get_where('tb_soal_essai',['soal_essai_status' => 'A'])->row();
        } elseif(($id_user % 2) == 0) {
            $x['soal'] = $this->db->get_where('tb_soal_essai',['soal_essai_status' => 'B'])->row();
        }
      

      $x['user_id'] = $id_user;
      $x['ujian_id'] = $id_ujian;

      if ($h_ujian->h_ujian_status == '3'){
        $hasil_ujian = $this->db->get_where('tb_hasil_ujian',['ujian_id' => $id_ujian, 'user_id' => $id_user])->row();
      } else {
        $data = array(
          'user_id' => $id_user,
          'ujian_id' => $id_ujian,
          'h_ujian_status' => '3',
          'ujian_created' => date('Y-m-d H:i:s')
        );
        $this->db->update('tb_hasil_ujian',$data,['user_id' => $id_user, 'ujian_id' => $id_ujian]);
        $hasil_ujian = $this->db->get_where('tb_hasil_ujian',['ujian_id' => $id_ujian, 'user_id' => $id_user])->row();
      }

      $tanggal = new DateTime();
      // Cek apakah tes sudah melebihi batas waktu
      $tanggal_tes = new DateTime($hasil_ujian->ujian_created);
      $tanggal_tes->modify('+'.$x['ujian']->ujian_essai_waktu.' minutes');
      if($tanggal>=$tanggal_tes){
          // jika waktu sudah melebihi waktu ketentuan, maka diarahkan ke dashboard
          $this->db->update('tb_hasil_ujian',['h_ujian_status' =>'4'],['user_id' => $id_user, 'ujian_id' => $id_ujian]);
          echo $this->session->set_flashdata('msg','error');
          redirect('Teknisi/Dashboard/konfirmasi/'.$id_ujian);
      }else{
          // mengambil soal sesuai dengan tes yang dikerjakan
          $x['tes_waktu'] = $x['ujian']->ujian_essai_waktu;
          $x['tes_dibuat'] = $hasil_ujian->ujian_created;
          $x['tanggal'] = $tanggal->format('Y-m-d H:i:s');
          // Mengambil selisih jam
          $tanggal_tes = new DateTime($hasil_ujian->ujian_created);
          $tanggal_diff = $tanggal_tes->diff($tanggal);

          $detik_berjalan = ($tanggal_diff->h*60*60)+($tanggal_diff->i*60)+$tanggal_diff->s;
          $detik_total = $x['ujian']->ujian_essai_waktu*60;

                      // untuk menangani Jika tes setelah ditambah waktunya melebihi jam saat itu
                      // jika time saat ini lebih besar dari time creation
          if($tanggal>=$tanggal_tes){
              $detik_sisa = $detik_total-$detik_berjalan;
                      
                      // jika time creation lebih besar dari tanggal saat ini
          }else{
              $detik_sisa = $detik_total+$detik_berjalan;
          }
      }

      $x['detik_berjalan'] = $detik_berjalan;
      $x['detik_total'] = $detik_total;
      $x['detik_sisa'] = $detik_sisa;

      $config['base_url'] = base_url().'Tenisi/Ujian/essai/'.$id_ujian.'/';
      if (($id_user % 2) == 1){
            $config['total_rows'] = $this->db->get_where('tb_soal_essai',['soal_essai_status' => 'A'])->num_rows(); //total row
        } elseif(($id_user % 2) == 0) {
            $config['total_rows'] = $this->db->get_where('tb_soal_essai',['soal_essai_status' => 'B'])->num_rows(); //total row
        }
      
      $config['per_page'] = 1;  //show record per halaman
      $config["uri_segment"] = 5;  // uri parameter
      $config["num_links"] = 0;
      $from = $this->uri->segment(5);
   
      // Membuat Style pagination untuk BootStrap v4
      $config['full_tag_open']    = '<div class="pagging text-center"><nav<ul class="pagination justify-content-center">';
      $config['full_tag_close']   = '</ul></nav></div>';
          
      $config['next_link']        = 'Next';
      $config['next_tag_open']   = '<li class="page-item"><span class="page-link">';
      $config['next_tag_close']  = '</span></li>';

      $config['prev_link']        = 'Prev';
      $config['prev_tag_open']   = '<li class="page-item"><span class="page-link">';
      $config['prev_tag_close']  = '</span></li>';

      $config['first_link']      = 'First'; 
      $config['first_tag_open']  = '<li class="page-item"><span class="page-link">';
      $config['first_tag_close'] = '</span></li>';
          
      $config['last_link']       = 'Last'; 
      $config['last_tag_open']   = '<li class="page-item"><span class="page-link">';
      $config['last_tag_close']  = '</span></li>';
          
      $config['cur_tag_open']    = '<li class="page-item active"><span class="page-link">';
      $config['cur_tag_close']   = '<span class="sr-only"><a class="active" href="#"></a></span></span></li>';
           
      $config['num_tag_open']    = '<li class="page-item"><span class="page-link">';
      $config['num_tag_close']   = '</span></li>';

          
   
      $this->pagination->initialize($config);
      //panggil function get_mahasiswa_list yang ada pada mmodel mahasiswa_model. 
      $x['soal_essai'] = $this->M_data_ujian->get_soal_essai_pagi($config["per_page"], $from, $id_ujian, $id_user);
      $x['jml_soal'] = $this->M_data_ujian->get_jml_essai($id_ujian,$id_user)->num_rows()-1;
      $x['daftar_soal'] = $this->M_data_ujian->get_soal_essai($id_ujian,$id_user);
   
      $x['paginat'] = $this->pagination->create_links();

      $this->load->view('teknisi/v_isi_jawaban_essai', $x);
    } else {
      echo $this->session->set_flashdata('msg','selesai');
      redirect('Teknisi/Dashboard/konfirmasi/'.$id_ujian);
    }
  }

  public function simpan_jawaban_essai(){
    $user_id = $this->input->post('user_id');
    $ujian_id = $this->input->post('ujian_id');
    $soal_essai_id = $this->input->post('soal_essai_id');
    $ragu = $this->input->post('ragu');
    $jml_soal = $this->input->post('jml_soal');
    $jawaban = $this->input->post('jawaban');
    if($ragu == NULL){
      $ragu = '0';
    }

    if($this->input->post('uri') == $jml_soal){
      $uri = $this->input->post('uri');
    } else {
      $uri = (int)$this->input->post('uri')+1;
    }

    $cek_nilai = $this->db->get_where('tb_nilai_essai',['user_id' => $user_id, 'ujian_id' => $ujian_id, 'soal_essai_id' => $soal_essai_id])->num_rows();
    if(!empty($jawaban)){
      if($cek_nilai == 0){
        $input = array(
          'user_id' => $user_id,
          'ujian_id' => $ujian_id,
          'soal_essai_id' => $soal_essai_id,
          'nilai_essai_jawaban' => $jawaban,
          'nilai_essai_ragu' => $ragu
        );
        $this->db->insert('tb_nilai_essai', $input);
      }
      elseif($cek_nilai>0){
        $input = array(
          'user_id' => $user_id,
          'ujian_id' => $ujian_id,
          'soal_essai_id' => $soal_essai_id,
          'nilai_essai_jawaban' => $jawaban,
          'nilai_essai_ragu' => $ragu
        );
        $this->db->update('tb_nilai_essai', $input,['user_id' => $user_id, 'ujian_id' => $ujian_id, 'soal_essai_id' => $soal_essai_id]);
      }
      redirect('Teknisi/Ujian/essai/'.$ujian_id.'/'.$uri);
    } else {
      redirect('Teknisi/Ujian/essai/'.$ujian_id.'/'.$uri);
    }
    
  }

  public function hentikan_tes_essai(){
    $user_id = $this->input->post('user_id');
    $ujian_id = $this->input->post('ujian_id');

    $update = array(
      'h_ujian_status' => '4'
    );

    $this->db->update('tb_hasil_ujian', $update,['user_id' => $user_id, 'ujian_id' => $ujian_id]);

    $get_kategori = $this->db->get('tb_kategori_soal')->result();
    foreach ($get_kategori as $k) {
      $data = array(
        'ujian_id' => $ujian_id,
        'user_id' =>$user_id,
        'akumulasi_jenis' => 'essai',
        'kategori_id' => $k->kategori_id,
        'akumulasi_skor' => NULL
      );

      $this->db->insert('tb_akumulasi', $data);
    }

    foreach ($get_kategori as $k) {
      $data = array(
        'ujian_id' => $ujian_id,
        'user_id' =>$user_id,
        'akumulasi_jenis' => 'uprak',
        'kategori_id' => $k->kategori_id,
        'akumulasi_skor' => NULL
      );

      $this->db->insert('tb_akumulasi', $data);
    }
    echo $this->session->set_flashdata('msg','henti_essai');
    redirect('Teknisi/Dashboard/konfirmasi/'.$ujian_id);
  }

}