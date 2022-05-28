<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bank_soal extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    if ($this->session->userdata('masuk') != TRUE)
    {
      $url=base_url();
      redirect($url);
    };
    $this->load->model('M_bank_soal');
    $this->load->library('upload');
  }

  private function upload_gambar()
  {
      $config['upload_path'] = './upload/media/';
      $config['allowed_types'] = 'jpg|png|jpeg';
      $config['max_size'] = 10100;
      $this->upload->initialize($config);
      $this->load->library('upload', $config);

      if(! $this->upload->do_upload('media'))
      {
        return 'default.jpg';
      }

      return $this->upload->data('file_name');
  }

  public function soal_pg()
  {
    if($this->session->userdata('akses')=='1')
    {
      $id = 'soal_pg_id';
      $tabel = 'tb_soal_pg';
      $x['judul'] = "Data Soal Pilihan Ganda";
      $x['data'] = $this->M_bank_soal->get($id,$tabel);
      $x['kategori'] = $this->M_bank_soal->get_kategori();
      $this->load->view('admin/bank_soal/v_soal_pg', $x); 
    }
    else
    {
      $this->load->view('blocked');
    }
  }

  function tambah_soal_pg()
  {
    $kategori = $this->input->post('kategori');
    $bobot = $this->input->post('bobot');
    $tahun = $this->input->post('tahun');
    $soal = $this->input->post('soal');
    $pil_a = $this->input->post('pil_a');
    $pil_b = $this->input->post('pil_b');
    $pil_c = $this->input->post('pil_c');
    $pil_d = $this->input->post('pil_d');
    $jawaban = $this->input->post('jawaban');
    $status = $this->input->post('status');
    $media = $this->upload_gambar();

    $tabel = 'tb_soal_pg';
    $data = array(
      'kategori_id' => $kategori,
      'soal_pg_bobot' => $bobot,
      'soal_pg_tahun' => $tahun,
      'soal_pg_soal' => $soal,
      'soal_pg_pil_a' => $pil_a,
      'soal_pg_pil_b' => $pil_b,
      'soal_pg_pil_c' => $pil_c,
      'soal_pg_pil_d' => $pil_d,
      'soal_pg_jawaban' => $jawaban,
      'soal_pg_status' => $status,
      'soal_pg_media' => $media
    );

    $input = $this->M_bank_soal->simpan($tabel,$data);
    if ($input > 0)
    {
      echo $this->session->set_flashdata('msg','success');
      redirect('admin/soal-pilihan-ganda.html');
    }
    else
    {
      echo $this->session->set_flashdata('msg','error');
      redirect('admin/soal-pilihan-ganda.html');
    }
  }

  function update_soal_pg()
  {
    $id = $this->input->post('id_soal');
    $kategori = $this->input->post('kategori');
    $bobot = $this->input->post('bobot');
    $tahun = $this->input->post('tahun');
    $soal = $this->input->post('soal');
    $pil_a = $this->input->post('pil_a');
    $pil_b = $this->input->post('pil_b');
    $pil_c = $this->input->post('pil_c');
    $pil_d = $this->input->post('pil_d');
    $jawaban = $this->input->post('jawaban');
    $status = $this->input->post('status');

    if(empty($_FILES['media']['name'])){
      $media = $this->input->post('nama_media');
    } else {
      $media = $this->upload_gambar();
    }
    
    
    
    $tabel = 'tb_soal_pg';
    $id_field = 'soal_pg_id';
      
      $data = array(
        'kategori_id' => $kategori,
        'soal_pg_bobot' => $bobot,
        'soal_pg_tahun' => $tahun,
        'soal_pg_soal' => $soal,
        'soal_pg_pil_a' => $pil_a,
        'soal_pg_pil_b' => $pil_b,
        'soal_pg_pil_c' => $pil_c,
        'soal_pg_pil_d' => $pil_d,
        'soal_pg_jawaban' => $jawaban,
        'soal_pg_status' => $status,
        'soal_pg_media' => $media
      );
    
    
  

    $update = $this->M_bank_soal->update($id_field,$id,$tabel,$data);
    if ($update > 0)
    {
      echo $this->session->set_flashdata('msg','info');
      redirect('admin/soal-pilihan-ganda.html');
    }
    else
    {
      echo $this->session->set_flashdata('msg','error');
      redirect('admin/soal-pilihan-ganda.html');
    }
  }

  function hapus_soal_pg(){
    $id = $this->input->post('id_soal');
    $id_field = 'soal_pg_id';
    $tabel = 'tb_soal_pg';
    $this->M_bank_soal->hapus($id_field, $id, $tabel);
    echo $this->session->set_flashdata('msg','success-hapus');
    redirect('admin/soal-pilihan-ganda.html');
  }

  public function import_soal_pg()
  {
      // Load plugin PHPExcel nya
      include APPPATH.'third_party/PHPExcel/PHPExcel.php';

      $config['upload_path'] = realpath('excel');
      $config['allowed_types'] = 'xlsx|xls|csv';
      $config['max_size'] = '10000';
      $config['encrypt_name'] = true;

      $this->load->library('upload', $config);

      if (!$this->upload->do_upload()) {

          //upload gagal
          echo $this->session->set_flashdata('msg','error-import');
          //redirect halaman
          redirect('Admin/Bank_soal/soal_pg');

      } else {

          $data_upload = $this->upload->data();

          $excelreader     = new PHPExcel_Reader_Excel2007();
          $loadexcel         = $excelreader->load('excel/'.$data_upload['file_name']); // Load file yang telah diupload kfolder excel
          $sheet             = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);

          $data = array();

          $numrow = 1;
          foreach($sheet as $row){
                      if($numrow > 1){
                          array_push($data, array(
                              'kategori_id' => $row['B'],
                              'soal_pg_bobot' => $row['C'],
                              'soal_pg_soal'  => $row['D'],
                              'soal_pg_pil_a' => $row['E'],
                              'soal_pg_pil_b' => $row['F'],
                              'soal_pg_pil_c' => $row['G'],
                              'soal_pg_pil_d' => $row['H'],
                              'soal_pg_jawaban' => $row['I'],
                              'soal_pg_tahun' => $row['J'],
                              'soal_pg_status' => $row['K'],
                          ));
                      }
            $numrow++;
          }
          $this->M_bank_soal->import('tb_soal_pg',$data);
          //delete file from server
          unlink(realpath('excel/'.$data_upload['file_name']));

          //upload success
          echo $this->session->set_flashdata('msg','success-import');
          //redirect halaman
          redirect('Admin/Bank_soal/soal_pg');

    }
  }

  public function soal_essai()
  {
    if($this->session->userdata('akses')=='1')
    {
      $id = 'soal_essai_id';
      $tabel = 'tb_soal_essai';
      $x['judul'] = "Data Soal Essai";
      $x['data'] = $this->M_bank_soal->get($id,$tabel);
      $x['kategori'] = $this->M_bank_soal->get_kategori();
      $this->load->view('admin/bank_soal/v_soal_essai', $x); 
    }
    else
    {
      $this->load->view('blocked');
    }
  }

  function tambah_soal_essai()
  {
    $kategori = $this->input->post('kategori');
    $bobot = $this->input->post('bobot');
    $tahun = $this->input->post('tahun');
    $soal = $this->input->post('soal');
    $jawaban = $this->input->post('jawaban');
    $status = $this->input->post('status');
    $media = $this->upload_gambar();

    $tabel = 'tb_soal_essai';
    $data = array(
      'kategori_id' => $kategori,
      'soal_essai_bobot' => $bobot,
      'soal_essai_tahun' => $tahun,
      'soal_essai_soal' => $soal,
      'soal_essai_jawaban' => $jawaban,
      'soal_essai_status' => $status,
      'soal_essai_media' => $media

    );

    $input = $this->M_bank_soal->simpan($tabel,$data);
    if ($input > 0)
    {
      echo $this->session->set_flashdata('msg','success');
      redirect('admin/soal-essai.html');
    }
    else
    {
      echo $this->session->set_flashdata('msg','error');
      redirect('admin/soal-essai.html');
    }
  }

  function update_soal_essai()
  {
    $id = $this->input->post('id_soal');
    $kategori = $this->input->post('kategori');
    $bobot = $this->input->post('bobot');
    $tahun = $this->input->post('tahun');
    $soal = $this->input->post('soal');
    $jawaban = $this->input->post('jawaban');
    $status = $this->input->post('status');
    if(empty($_FILES['media']['name'])){
      $media = $this->input->post('nama_media');
    } else {
      $media = $this->upload_gambar();
    }

    $tabel = 'tb_soal_essai';
    $id_field = 'soal_essai_id';
    $data = array(
      'kategori_id' => $kategori,
      'soal_essai_bobot' => $bobot,
      'soal_essai_tahun' => $tahun,
      'soal_essai_soal' => $soal,
      'soal_essai_jawaban' => $jawaban,
      'soal_essai_status' => $status,
      'soal_essai_media' => $media
    );

    $update = $this->M_bank_soal->update($id_field,$id,$tabel,$data);
    if ($update > 0)
    {
      echo $this->session->set_flashdata('msg','info');
      redirect('admin/soal-essai.html');
    }
    else
    {
      echo $this->session->set_flashdata('msg','error');
      redirect('admin/soal-essai.html');
    }
  }

  function hapus_soal_essai(){
    $id = $this->input->post('id_soal');
    $id_field = 'soal_essai_id';
    $tabel = 'tb_soal_essai';
    $this->M_bank_soal->hapus($id_field, $id, $tabel);
    $this->db->delete('tb_indikator_nilai_essai', ['soal_essai_id' => $id]);
    echo $this->session->set_flashdata('msg','success-hapus');
    redirect('admin/soal-essai.html');
  }

  public function import_soal_essai()
  {
      // Load plugin PHPExcel nya
      include APPPATH.'third_party/PHPExcel/PHPExcel.php';

      $config['upload_path'] = realpath('excel');
      $config['allowed_types'] = 'xlsx|xls|csv';
      $config['max_size'] = '10000';
      $config['encrypt_name'] = true;

      $this->load->library('upload', $config);

      if (!$this->upload->do_upload()) {

          //upload gagal
          echo $this->session->set_flashdata('msg','error-import');
          //redirect halaman
          redirect('Admin/Bank_soal/soal_essai');

      } else {

          $data_upload = $this->upload->data();

          $excelreader     = new PHPExcel_Reader_Excel2007();
          $loadexcel         = $excelreader->load('excel/'.$data_upload['file_name']); // Load file yang telah diupload kfolder excel
          $sheet             = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);

          $data = array();

          $numrow = 1;
          foreach($sheet as $row){
                      if($numrow > 1){
                          array_push($data, array(
                              'kategori_id' => $row['B'],
                              'soal_essai_soal'  => $row['C'],
                              'soal_essai_jawaban' => $row['D'],
                              'soal_essai_bobot' => $row['E'],
                              'soal_essai_tahun' => $row['F'],
                              'soal_essai_status' => $row['G'],
                          ));
                      }
            $numrow++;
          }
          $this->M_bank_soal->import('tb_soal_essai',$data);
          //delete file from server
          unlink(realpath('excel/'.$data_upload['file_name']));

          //upload success
          echo $this->session->set_flashdata('msg','success-import');
          //redirect halaman
          redirect('Admin/Bank_soal/soal_essai');

    }
  }

  public function indikator_soal_essai($soal_essai_id)
  {
    $x['soal'] = $this->db->get_where('tb_soal_essai',['soal_essai_id' => $soal_essai_id])->row_array();
    $x['judul'] = "Data Indikator Penilaian Soal Essai";
    $x['data'] = $this->db->get_where('tb_indikator_nilai_essai',['soal_essai_id' => $soal_essai_id]);
    $this->load->view('admin/bank_soal/v_indikator_essai', $x); 
  }

  function tambah_indikator_soal_essai()
  {
    $soal_essai_id = $this->input->post('soal_essai_id');
    $skor = $this->input->post('skor');
    $indikator = $this->input->post('indikator');

    $tabel = 'tb_indikator_nilai_essai';
    $data = array(
      'soal_essai_id' => $soal_essai_id,
      'skor' => $skor,
      'indikator' => $indikator
    );

    $input = $this->M_bank_soal->simpan($tabel,$data);
    if ($input > 0)
    {
      echo $this->session->set_flashdata('msg','success');
      redirect('Admin/Bank_soal/indikator_soal_essai/'.$soal_essai_id);
    }
    else
    {
      echo $this->session->set_flashdata('msg','error');
      redirect('Admin/Bank_soal/indikator_soal_essai/'.$soal_essai_id);
    }
  }

  function update_indikator_soal_essai()
  {
    $soal_essai_id = $this->input->post('soal_essai_id');
    $indikator_nilai_essai_id = $this->input->post('indikator_nilai_essai_id');
    $skor = $this->input->post('skor');
    $indikator = $this->input->post('indikator');

    $tabel = 'tb_indikator_nilai_essai';
    $id_field = 'indikator_nilai_essai_id';
    $data = array(
      'soal_essai_id' => $soal_essai_id,
      'skor' => $skor,
      'indikator' => $indikator
    );

    $update = $this->M_bank_soal->update($id_field,$indikator_nilai_essai_id,$tabel,$data);
    if ($update > 0)
    {
      echo $this->session->set_flashdata('msg','info');
      redirect('Admin/Bank_soal/indikator_soal_essai/'.$soal_essai_id);
    }
    else
    {
      echo $this->session->set_flashdata('msg','error');
      redirect('Admin/Bank_soal/indikator_soal_essai/'.$soal_essai_id);
    }
  }

  function hapus_indikator_soal_essai(){
    $soal_essai_id = $this->input->post('soal_essai_id');
    $indikator_nilai_essai_id = $this->input->post('indikator_nilai_essai_id');
    $id_field = 'indikator_nilai_essai_id';
    $tabel = 'tb_indikator_nilai_essai';
    $this->M_bank_soal->hapus($id_field, $indikator_nilai_essai_id, $tabel);
    echo $this->session->set_flashdata('msg','success-hapus');
    redirect('Admin/Bank_soal/indikator_soal_essai/'.$soal_essai_id);
  }

  public function materi_uprak()
  {
    if($this->session->userdata('akses')=='1')
    {
      $tabel = 'tb_materi_uprak';
      $id = 'uprak_id';
      $x['judul'] = "Materi Ujian Praktek";
      $x['data'] = $this->M_bank_soal->get($id,$tabel);
      $x['kategori'] = $this->M_bank_soal->get_kategori();
      $this->load->view('admin/bank_soal/v_materi_uprak', $x); 
    }
    else
    {
      $this->load->view('blocked');
    }
  }

  function tambah_materi_uprak()
  {
    $kategori = $this->input->post('kategori');
    $bobot = $this->input->post('bobot');
    $tahun = $this->input->post('tahun');
    $materi = $this->input->post('materi');
    $status = $this->input->post('status');

    $tabel = 'tb_materi_uprak';
    $data = array(
      'kategori_id' => $kategori,
      'uprak_bobot' => $bobot,
      'uprak_tahun' => $tahun,
      'uprak_materi' => $materi,
      'uprak_status' => $status
    );

    $input = $this->M_bank_soal->simpan($tabel,$data);
    if ($input > 0)
    {
      echo $this->session->set_flashdata('msg','success');
      redirect('admin/materi-ujian-praktek.html');
    }
    else
    {
      echo $this->session->set_flashdata('msg','error');
      redirect('admin/materi-ujian-praktek.html');
    }
  }

  function update_materi_uprak()
  {
    $id = $this->input->post('id_soal');
    $kategori = $this->input->post('kategori');
    $bobot = $this->input->post('bobot');
    $tahun = $this->input->post('tahun');
    $materi = $this->input->post('materi');
    $status = $this->input->post('status');

    $tabel = 'tb_materi_uprak';
    $id_field = 'uprak_id';
    $data = array(
      'kategori_id' => $kategori,
      'uprak_bobot' => $bobot,
      'uprak_tahun' => $tahun,
      'uprak_materi' => $materi,
      'uprak_status' => $status
    );

    $update = $this->M_bank_soal->update($id_field,$id,$tabel,$data);
    if ($update > 0)
    {
      echo $this->session->set_flashdata('msg','info');
      redirect('admin/materi-ujian-praktek.html');
    }
    else
    {
      echo $this->session->set_flashdata('msg','error');
      redirect('admin/materi-ujian-praktek.html');
    }
  }

  function hapus_materi_uprak(){
    $id = $this->input->post('id_soal');
    $id_field = 'uprak_id';
    $tabel = 'tb_materi_uprak';
    $this->M_bank_soal->hapus($id_field, $id, $tabel);
    echo $this->session->set_flashdata('msg','success-hapus');
    redirect('admin/materi-ujian-praktek.html');
  }

  public function import_materi_uprak()
  {
      // Load plugin PHPExcel nya
      include APPPATH.'third_party/PHPExcel/PHPExcel.php';

      $config['upload_path'] = realpath('excel');
      $config['allowed_types'] = 'xlsx|xls|csv';
      $config['max_size'] = '10000';
      $config['encrypt_name'] = true;

      $this->load->library('upload', $config);

      if (!$this->upload->do_upload()) {

          //upload gagal
          echo $this->session->set_flashdata('msg','error-import');
          //redirect halaman
          redirect('Admin/Bank_soal/materi_uprak');

      } else {

          $data_upload = $this->upload->data();

          $excelreader     = new PHPExcel_Reader_Excel2007();
          $loadexcel         = $excelreader->load('excel/'.$data_upload['file_name']); // Load file yang telah diupload kfolder excel
          $sheet             = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);

          $data = array();

          $numrow = 1;
          foreach($sheet as $row){
                      if($numrow > 1){
                          array_push($data, array(
                              'kategori_id' => $row['B'],
                              'uprak_materi'  => $row['C'],
                              'uprak_bobot' => $row['D'],
                              'uprak_tahun' => $row['E'],
                              'uprak_status' => $row['F'],
                          ));
                      }
            $numrow++;
          }
          $this->M_bank_soal->import('tb_materi_uprak',$data);
          //delete file from server
          unlink(realpath('excel/'.$data_upload['file_name']));

          //upload success
          echo $this->session->set_flashdata('msg','success-import');
          //redirect halaman
          redirect('Admin/Bank_soal/materi_uprak');

    }
  }

  public function kategori_soal()
  {
    if($this->session->userdata('akses')=='1')
    {
      $x['judul'] = "Kategori Soal";
      $x['data'] = $this->M_bank_soal->get_kategori();
      $this->load->view('admin/bank_soal/v_kategori_soal', $x); 
    }
    else
    {
      $this->load->view('blocked');
    }
  }

  function tambah_kategori()
  {
    $kategori = $this->input->post('kategori');

    $tabel = 'tb_kategori_soal';
    $data = array(
      'kategori_soal' => $kategori,
    );

    $input = $this->M_bank_soal->simpan($tabel,$data);
    if ($input > 0)
    {
      echo $this->session->set_flashdata('msg','success');
      redirect('admin/kategori-soal.html');
    }
    else
    {
      echo $this->session->set_flashdata('msg','error');
      redirect('admin/kategori-soal.html');
    }
  }

  function update_kategori()
  {
    $id = $this->input->post('id_kategori');
    $kategori = $this->input->post('kategori');

    $tabel = 'tb_kategori_soal';
    $id_field = 'kategori_id';
    $data = array(
      'kategori_soal' => $kategori,
    );

    $update = $this->M_bank_soal->update($id_field,$id,$tabel,$data);
    if ($update > 0)
    {
      echo $this->session->set_flashdata('msg','info');
      redirect('admin/kategori-soal.html');
    }
    else
    {
      echo $this->session->set_flashdata('msg','error');
      redirect('admin/kategori-soal.html');
    }
  }

  function hapus_kategori(){
    $id = $this->input->post('id_kategori');
    $id_field = 'kategori_id';
    $tabel = 'tb_kategori_soal';
    $this->M_bank_soal->hapus($id_field, $id, $tabel);
    echo $this->session->set_flashdata('msg','success-hapus');
    redirect('admin/kategori-soal.html');
  }

  public function komponen_uprak()
  {
    if($this->session->userdata('akses')=='1')
    {
      $x['judul'] = "Komponen Ujian Praktek";
      $x['data'] = $this->M_bank_soal->get_komponen_uprak();
      $this->load->view('admin/bank_soal/v_komponen_uprak', $x); 
    }
    else
    {
      $this->load->view('blocked');
    }
  }

  function tambah_komponen_uprak()
  {
    $komponen = $this->input->post('komponen');
    $bobot = $this->input->post('bobot');

    $tabel = 'tb_komponen_uprak';
    $data = array(
      'komponen_uprak_komponen' => $komponen,
      'komponen_uprak_bobot' => $bobot,
    );

    $input = $this->M_bank_soal->simpan($tabel,$data);
    if ($input > 0)
    {
      echo $this->session->set_flashdata('msg','success');
      redirect('Admin/Bank_soal/komponen_uprak');
    }
    else
    {
      echo $this->session->set_flashdata('msg','error');
      redirect('Admin/Bank_soal/komponen_uprak');
    }
  }

  function update_komponen_uprak()
  {
    $id = $this->input->post('id_komponen');
    $komponen = $this->input->post('komponen');
    $bobot = $this->input->post('bobot');

    $tabel = 'tb_komponen_uprak';
    $id_field = 'komponen_uprak_id';
    $data = array(
      'komponen_uprak_komponen' => $komponen,
      'komponen_uprak_bobot' => $bobot,
    );

    $update = $this->M_bank_soal->update($id_field,$id,$tabel,$data);
    if ($update > 0)
    {
      echo $this->session->set_flashdata('msg','info');
      redirect('Admin/Bank_soal/komponen_uprak');
    }
    else
    {
      echo $this->session->set_flashdata('msg','error');
      redirect('Admin/Bank_soal/komponen_uprak');
    }
  }

  function hapus_komponen_uprak(){
    $id = $this->input->post('id_komponen');
    $id_field = 'komponen_uprak_id';
    $tabel = 'tb_komponen_uprak';
    $this->M_bank_soal->hapus($id_field, $id, $tabel);
    echo $this->session->set_flashdata('msg','success-hapus');
    redirect('Admin/Bank_soal/komponen_uprak');
  }

  public function subkomponen_uprak($uprak_id)
  {
    if($this->session->userdata('akses')=='1')
    {
      $x['judul'] = "Sub Komponen Ujian Praktek";
      $x['uprak_id'] = $uprak_id;
      $x['komponen'] = $this->M_bank_soal->get_komponen_uprak();
      $x['data'] = $this->db->select('*')
                            ->from('tb_subkomponen_uprak')
                            ->join('tb_komponen_uprak','tb_komponen_uprak.komponen_uprak_id=tb_subkomponen_uprak.komponen_uprak_id')
                            ->where('tb_subkomponen_uprak.uprak_id', $uprak_id)
                            ->get();
      $this->load->view('admin/bank_soal/v_subkomponen_uprak', $x); 
    }
    else
    {
      $this->load->view('blocked');
    }
  }

  function tambah_subkomponen_uprak()
  {
    $uprak_id = $this->input->post('uprak_id');
    $id_komponen = $this->input->post('id_komponen');
    $sub_komponen = $this->input->post('sub_komponen');

    $tabel = 'tb_subkomponen_uprak';
    $data = array(
      'uprak_id' => $uprak_id,
      'komponen_uprak_id' => $id_komponen,
      'sk_subkomponen' => $sub_komponen,
    );

    $input = $this->M_bank_soal->simpan($tabel,$data);
    if ($input > 0)
    {
      echo $this->session->set_flashdata('msg','success');
      redirect('Admin/Bank_soal/subkomponen_uprak/'.$uprak_id);
    }
    else
    {
      echo $this->session->set_flashdata('msg','error');
      redirect('Admin/Bank_soal/subkomponen_uprak/'.$uprak_id);
    }
  }

  function update_subkomponen_uprak()
  {
    $id = $this->input->post('id_subkomponen');
    $uprak_id = $this->input->post('uprak_id');
    $id_komponen = $this->input->post('id_komponen');
    $sub_komponen = $this->input->post('sub_komponen');

    $tabel = 'tb_subkomponen_uprak';
    $id_field = 'sk_uprak_id';
    $data = array(
      'uprak_id' => $uprak_id,
      'komponen_uprak_id' => $id_komponen,
      'sk_subkomponen' => $sub_komponen,
    );

    $update = $this->M_bank_soal->update($id_field,$id,$tabel,$data);
    if ($update > 0)
    {
      echo $this->session->set_flashdata('msg','info');
      redirect('Admin/Bank_soal/subkomponen_uprak/'.$uprak_id);
    }
    else
    {
      echo $this->session->set_flashdata('msg','error');
      redirect('Admin/Bank_soal/subkomponen_uprak/'.$uprak_id);
    }
  }

  function hapus_subkomponen_uprak(){
    $uprak_id = $this->input->post('uprak_id');
    $id = $this->input->post('id_subkomponen');
    $id_field = 'sk_uprak_id';
    $tabel = 'tb_subkomponen_uprak';
    $this->M_bank_soal->hapus($id_field, $id, $tabel);
    echo $this->session->set_flashdata('msg','success-hapus');
    redirect('Admin/Bank_soal/subkomponen_uprak/'.$uprak_id);
  }
}
