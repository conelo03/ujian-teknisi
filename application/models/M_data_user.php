<?php
class M_data_user extends CI_Model{

	function get(){
		$hasil = $this->db->get('tb_user');
		if($hasil->num_rows() > 0){
			return $hasil;
		} else {
			return $hasil;
		}
	}

	function simpan($data_user){
		$this->db->insert('tb_user', $data_user);
	}

	function update($id,$data_user){
		$this->db->where('user_id', $id)
				 ->update('tb_user', $data_user);
	}

	function hapus($id){
		$this->db->where('user_id', $id)
				 ->delete('tb_user');
	}

}
