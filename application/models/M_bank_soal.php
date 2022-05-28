<?php
class M_bank_soal extends CI_Model{

	function get($id,$tabel){
		$this->db->select('*');
		$this->db->from($tabel);
		$this->db->join('tb_kategori_soal','tb_kategori_soal.kategori_id='.$tabel.'.kategori_id');
		$this->db->order_by('tb_kategori_soal.kategori_id','ASC');
		$hasil = $this->db->get();
		return $hasil;
	}

	function get_kategori(){
		$hasil = $this->db->get('tb_kategori_soal');
		return $hasil;
	}

	function get_komponen_uprak(){
		$hasil = $this->db->get('tb_komponen_uprak');
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

	function hapus($id_field, $id, $tabel){
		$res = $this->db->where($id_field, $id)
				 		->delete($tabel);
		return $res;
	}

	function import($tabel,$data){
        $this->db->insert_batch($tabel, $data);
    }

}
