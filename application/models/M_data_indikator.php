<?php
class M_data_indikator extends CI_Model{

	function get($tabel){
		$hasil = $this->db->get($tabel);
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

}
