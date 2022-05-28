<?php
class M_data_nilai extends CI_Model{

	function get($user_id,$ujian_id,$jenis){
		$this->db->select('*');
		$this->db->from('tb_akumulasi');
		$this->db->join('tb_kategori_soal','tb_akumulasi.kategori_id=tb_kategori_soal.kategori_id');
		$this->db->join('tb_user','tb_akumulasi.user_id=tb_user.user_id');
		$this->db->where('tb_akumulasi.user_id',$user_id);
		$this->db->where('tb_akumulasi.ujian_id',$ujian_id);
		$this->db->where('tb_akumulasi.akumulasi_jenis',$jenis);
		$this->db->order_by('tb_akumulasi.user_id','ASC');
		$hasil = $this->db->get();
		return $hasil;
	}

	function get_jawaban($user_id,$ujian_id,$tabel,$tabel2,$id_field){
		$this->db->select('*');
		$this->db->from($tabel);
		$this->db->join('tb_ujian',''.$tabel.'.ujian_id=tb_ujian.ujian_id');
		$this->db->join('tb_user',''.$tabel.'.user_id=tb_user.user_id');
		$this->db->join($tabel2,''.$tabel.'.'.$id_field.'='.$tabel2.'.'.$id_field.'');
		$this->db->join('tb_kategori_soal',''.$tabel2.'.kategori_id=tb_kategori_soal.kategori_id');
		$this->db->where(''.$tabel.'.user_id',$user_id);
		$this->db->where(''.$tabel.'.ujian_id',$ujian_id);
		$this->db->order_by(''.$tabel.'.user_id','ASC');
		$hasil = $this->db->get();
		return $hasil;
	}

	function get_akumulasi($user_id,$ujian_id){
		$this->db->select('*,sum(akumulasi_skor) as skor');
		$this->db->from('tb_akumulasi');
		$this->db->join('tb_kategori_soal','tb_akumulasi.kategori_id=tb_kategori_soal.kategori_id');
		$this->db->join('tb_user','tb_akumulasi.user_id=tb_user.user_id');
		$this->db->join('tb_skor_max','tb_akumulasi.ujian_id=tb_skor_max.ujian_id AND tb_akumulasi.kategori_id=tb_skor_max.kategori_id');
		$this->db->where('tb_akumulasi.ujian_id',$ujian_id);
		$this->db->where('tb_akumulasi.user_id',$user_id);
		$this->db->group_by('tb_akumulasi.kategori_id');
		$this->db->order_by('tb_akumulasi.kategori_id','ASC');
		$hasil = $this->db->get();
		return $hasil;
	}

	function get_hasil_ujian(){
		$this->db->select('*');
		$this->db->from('tb_hasil_ujian');
		$this->db->join('tb_ujian','tb_hasil_ujian.ujian_id=tb_ujian.ujian_id');
		$this->db->join('tb_user','tb_hasil_ujian.user_id=tb_user.user_id');
		$hasil = $this->db->get();
		return $hasil;
	}

	function get_kategori(){
		$hasil = $this->db->get('tb_kategori_soal');
		return $hasil;
	}

	function get_user($user_id){
		$this->db->select('*');
		$this->db->from('tb_user');
		$this->db->where('user_id',$user_id);
		$hasil = $this->db->get();
		return $hasil;
	}

	function get_teknisi(){
		$this->db->select('*');
		$this->db->from('tb_user');
		$this->db->where('user_level','2');
		$hasil = $this->db->get();
		return $hasil;
	}

	function get_uprak(){
		$this->db->select('*');
		$this->db->from('tb_materi_uprak');
		$this->db->where('uprak_status','1');
		$hasil = $this->db->get();
		return $hasil;
	}

	function simpan($tabel,$data){
		$res = $this->db->insert($tabel, $data);
		return $res;
	}

	function update($id_field,$id,$tabel,$data){
		$res = $this->db->where($id_field, $id)
				 		->update($tabel, $data);
		return $res;
	}

	function update_akumulasi_essai($ujian_id,$user_id,$kategori_id,$data_essai){
		$res = $this->db->where('ujian_id', $ujian_id)
						->where('user_id', $user_id)
						->where('akumulasi_jenis', 'essai')
						->where('kategori_id', $kategori_id)
				 		->update('tb_akumulasi', $data_essai);
		return $res;
	}

	function update_akumulasi_uprak($ujian_id,$user_id,$kategori_id,$data_uprak){
		$res = $this->db->where('ujian_id', $ujian_id)
						->where('user_id', $user_id)
						->where('akumulasi_jenis', 'uprak')
						->where('kategori_id', $kategori_id)
				 		->update('tb_akumulasi', $data_uprak);
		return $res;
	}

	function hapus($id_field, $id, $tabel){
		$res = $this->db->where($id_field, $id)
				 		->delete($tabel);
		return $res;
	}

	function get_pu_pg(){
		$this->db->select('sum(soal_pg_bobot) as skor');
		$this->db->from('tb_soal_pg');
		$this->db->where('soal_pg_status','A');
		$this->db->group_by('kategori_id');
		$this->db->having('kategori_id',1);
		$hasil = $this->db->get();
		return $hasil;
	}
	function get_s_pg(){
		$this->db->select('sum(soal_pg_bobot) as skor');
		$this->db->from('tb_soal_pg');
		$this->db->where('soal_pg_status','A');
		$this->db->group_by('kategori_id');
		$this->db->having('kategori_id',2);
		$hasil = $this->db->get();
		return $hasil;
	}
	function get_h_pg(){
		$this->db->select('sum(soal_pg_bobot) as skor');
		$this->db->from('tb_soal_pg');
		$this->db->where('soal_pg_status','A');
		$this->db->group_by('kategori_id');
		$this->db->having('kategori_id',3);
		$hasil = $this->db->get();
		return $hasil;
	}
	function get_l_pg(){
		$this->db->select('sum(soal_pg_bobot) as skor');
		$this->db->from('tb_soal_pg');
		$this->db->where('soal_pg_status','A');
		$this->db->group_by('kategori_id');
		$this->db->having('kategori_id',4);
		$hasil = $this->db->get();
		return $hasil;
	}

	
	function get_pu_essai(){
		$this->db->select('sum(soal_essai_bobot) as skor');
		$this->db->from('tb_soal_essai');
		$this->db->where('soal_essai_status','A');
		$this->db->group_by('kategori_id');
		$this->db->having('kategori_id',1);
		$hasil = $this->db->get();
		return $hasil;
	}
	function get_s_essai(){
		$this->db->select('sum(soal_essai_bobot) as skor');
		$this->db->from('tb_soal_essai');
		$this->db->where('soal_essai_status','A');
		$this->db->group_by('kategori_id');
		$this->db->having('kategori_id',2);
		$hasil = $this->db->get();
		return $hasil;
	}
	function get_h_essai(){
		$this->db->select('sum(soal_essai_bobot) as skor');
		$this->db->from('tb_soal_essai');
		$this->db->where('soal_essai_status','A');
		$this->db->group_by('kategori_id');
		$this->db->having('kategori_id',3);
		$hasil = $this->db->get();
		return $hasil;
	}
	function get_l_essai(){
		$this->db->select('sum(soal_essai_bobot) as skor');
		$this->db->from('tb_soal_essai');
		$this->db->where('soal_essai_status','A');
		$this->db->group_by('kategori_id');
		$this->db->having('kategori_id',4);
		$hasil = $this->db->get();
		return $hasil;
	}


	function get_pu_uprak(){
		$this->db->select('sum(uprak_bobot) as skor');
		$this->db->from('tb_materi_uprak');
		$this->db->where('uprak_status','1');
		$this->db->group_by('kategori_id');
		$this->db->having('kategori_id',1);
		$hasil = $this->db->get();
		return $hasil;
	}
	function get_s_uprak(){
		$this->db->select('sum(uprak_bobot) as skor');
		$this->db->from('tb_materi_uprak');
		$this->db->where('uprak_status','1');
		$this->db->group_by('kategori_id');
		$this->db->having('kategori_id',2);
		$hasil = $this->db->get();
		return $hasil;
	}
	function get_h_uprak(){
		$this->db->select('sum(uprak_bobot) as skor');
		$this->db->from('tb_materi_uprak');
		$this->db->where('uprak_status','1');
		$this->db->group_by('kategori_id');
		$this->db->having('kategori_id',3);
		$hasil = $this->db->get();
		return $hasil;
	}
	function get_l_uprak(){
		$this->db->select('sum(uprak_bobot) as skor');
		$this->db->from('tb_materi_uprak');
		$this->db->where('uprak_status','1');
		$this->db->group_by('kategori_id');
		$this->db->having('kategori_id',4);
		$hasil = $this->db->get();
		return $hasil;
	}

}
