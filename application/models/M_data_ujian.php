<?php
class M_data_ujian extends CI_Model{

	function get(){
		$hasil = $this->db->get('tb_ujian');
		return $hasil;
	}

	function get_max_skor($id){
		$this->db->select('*');
		$this->db->from('tb_skor_max');
		$this->db->where('ujian_id',$id);
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

	function hapus($id_field, $id, $tabel){
		$res = $this->db->where($id_field, $id)
				 		->delete($tabel);
		return $res;
	}

	function get_soal_pg_pagi($limit, $offset,$ujian_id,$user_id){
        $id_user = $this->session->userdata('id');
        if (($id_user % 2) == 1){
            if($offset>0){
                return $this->db->query("SELECT *, tb_soal_pg.soal_pg_id as soal_pg_id FROM `tb_soal_pg` left join tb_nilai_pg on tb_soal_pg.soal_pg_id=tb_nilai_pg.soal_pg_id and tb_nilai_pg.user_id='$user_id' and tb_nilai_pg.ujian_id='$ujian_id' where tb_soal_pg.soal_pg_status='A' limit $limit offset $offset")->result();
            } else {
                return $this->db->query("SELECT *, tb_soal_pg.soal_pg_id as soal_pg_id FROM `tb_soal_pg` left join tb_nilai_pg on tb_soal_pg.soal_pg_id=tb_nilai_pg.soal_pg_id and tb_nilai_pg.user_id='$user_id' and tb_nilai_pg.ujian_id='$ujian_id' where tb_soal_pg.soal_pg_status='A' limit $limit")->result();
            }
        } elseif(($id_user % 2) == 0) {
            if($offset>0){
                return $this->db->query("SELECT *, tb_soal_pg.soal_pg_id as soal_pg_id FROM `tb_soal_pg` left join tb_nilai_pg on tb_soal_pg.soal_pg_id=tb_nilai_pg.soal_pg_id and tb_nilai_pg.user_id='$user_id' and tb_nilai_pg.ujian_id='$ujian_id' where tb_soal_pg.soal_pg_status='B' limit $limit offset $offset")->result();
            } else {
                return $this->db->query("SELECT *, tb_soal_pg.soal_pg_id as soal_pg_id FROM `tb_soal_pg` left join tb_nilai_pg on tb_soal_pg.soal_pg_id=tb_nilai_pg.soal_pg_id and tb_nilai_pg.user_id='$user_id' and tb_nilai_pg.ujian_id='$ujian_id' where tb_soal_pg.soal_pg_status='B' limit $limit")->result();
            }
        }
		
    }

    function get_soal_pg($ujian_id,$user_id){
        $id_user = $this->session->userdata('id');
        if (intval($id_user) % 2 == 1){
          return $this->db->query("SELECT *, tb_soal_pg.soal_pg_id as soal_pg_id FROM `tb_soal_pg` left join tb_nilai_pg on tb_soal_pg.soal_pg_id=tb_nilai_pg.soal_pg_id and tb_nilai_pg.user_id='$user_id' and tb_nilai_pg.ujian_id='$ujian_id' where tb_soal_pg.soal_pg_status='A'")->result();
        } else {
          return $this->db->query("SELECT *, tb_soal_pg.soal_pg_id as soal_pg_id FROM `tb_soal_pg` left join tb_nilai_pg on tb_soal_pg.soal_pg_id=tb_nilai_pg.soal_pg_id and tb_nilai_pg.user_id='$user_id' and tb_nilai_pg.ujian_id='$ujian_id' where tb_soal_pg.soal_pg_status='B'")->result();
        }
		
    }

    function get_jml_pg($ujian_id,$user_id){
        $id_user = $this->session->userdata('id');
        if (intval($id_user) % 2 == 1){
          return $this->db->query("SELECT *, tb_soal_pg.soal_pg_id as soal_pg_id FROM `tb_soal_pg` left join tb_nilai_pg on tb_soal_pg.soal_pg_id=tb_nilai_pg.soal_pg_id and tb_nilai_pg.user_id='$user_id' and tb_nilai_pg.ujian_id='$ujian_id' where tb_soal_pg.soal_pg_status='A'");
        } else {
          return $this->db->query("SELECT *, tb_soal_pg.soal_pg_id as soal_pg_id FROM `tb_soal_pg` left join tb_nilai_pg on tb_soal_pg.soal_pg_id=tb_nilai_pg.soal_pg_id and tb_nilai_pg.user_id='$user_id' and tb_nilai_pg.ujian_id='$ujian_id' where tb_soal_pg.soal_pg_status='B'");
        }
		
    }

    function get_soal_essai_pagi($limit, $offset,$ujian_id,$user_id){
        $id_user = $this->session->userdata('id');
        if (intval($id_user) % 2 == 1){
            if($offset>0){
                return $this->db->query("SELECT *, tb_soal_essai.soal_essai_id as soal_essai_id FROM `tb_soal_essai` left join tb_nilai_essai on tb_soal_essai.soal_essai_id=tb_nilai_essai.soal_essai_id and tb_nilai_essai.user_id='$user_id' and tb_nilai_essai.ujian_id='$ujian_id' where tb_soal_essai.soal_essai_status='A' limit $limit offset $offset")->result();
            } else {
                return $this->db->query("SELECT *, tb_soal_essai.soal_essai_id as soal_essai_id FROM `tb_soal_essai` left join tb_nilai_essai on tb_soal_essai.soal_essai_id=tb_nilai_essai.soal_essai_id and tb_nilai_essai.user_id='$user_id' and tb_nilai_essai.ujian_id='$ujian_id' where tb_soal_essai.soal_essai_status='A' limit $limit")->result();
            }
        } else {
            if($offset>0){
                return $this->db->query("SELECT *, tb_soal_essai.soal_essai_id as soal_essai_id FROM `tb_soal_essai` left join tb_nilai_essai on tb_soal_essai.soal_essai_id=tb_nilai_essai.soal_essai_id and tb_nilai_essai.user_id='$user_id' and tb_nilai_essai.ujian_id='$ujian_id' where tb_soal_essai.soal_essai_status='B' limit $limit offset $offset")->result();
            } else {
                return $this->db->query("SELECT *, tb_soal_essai.soal_essai_id as soal_essai_id FROM `tb_soal_essai` left join tb_nilai_essai on tb_soal_essai.soal_essai_id=tb_nilai_essai.soal_essai_id and tb_nilai_essai.user_id='$user_id' and tb_nilai_essai.ujian_id='$ujian_id' where tb_soal_essai.soal_essai_status='B' limit $limit")->result();
            }   
        }
		
    }

    function get_soal_essai($ujian_id,$user_id){
        $id_user = $this->session->userdata('id');
        if (($id_user % 2) == 1){
            return $this->db->query("SELECT *, tb_soal_essai.soal_essai_id as soal_essai_id FROM `tb_soal_essai` left join tb_nilai_essai on tb_soal_essai.soal_essai_id=tb_nilai_essai.soal_essai_id and tb_nilai_essai.user_id='$user_id' and tb_nilai_essai.ujian_id='$ujian_id'and tb_nilai_essai.user_id='$user_id' and tb_nilai_essai.ujian_id='$ujian_id' where tb_soal_essai.soal_essai_status='A'")->result();
        } elseif(($id_user % 2) == 0) {
            return $this->db->query("SELECT *, tb_soal_essai.soal_essai_id as soal_essai_id FROM `tb_soal_essai` left join tb_nilai_essai on tb_soal_essai.soal_essai_id=tb_nilai_essai.soal_essai_id and tb_nilai_essai.user_id='$user_id' and tb_nilai_essai.ujian_id='$ujian_id'and tb_nilai_essai.user_id='$user_id' and tb_nilai_essai.ujian_id='$ujian_id' where tb_soal_essai.soal_essai_status='B'")->result();
        }
		
    }

    function get_jml_essai($ujian_id,$user_id){
        $id_user = $this->session->userdata('id');
        if (($id_user % 2) == 1){
            return $this->db->query("SELECT *, tb_soal_essai.soal_essai_id as soal_essai_id FROM `tb_soal_essai` left join tb_nilai_essai on tb_soal_essai.soal_essai_id=tb_nilai_essai.soal_essai_id and tb_soal_essai.soal_essai_status='A' and tb_nilai_essai.user_id='$user_id' and tb_nilai_essai.ujian_id='$ujian_id'and tb_nilai_essai.user_id='$user_id' and tb_nilai_essai.ujian_id='$ujian_id' where tb_soal_essai.soal_essai_status='A'");
        } elseif(($id_user % 2) == 0) {
            return $this->db->query("SELECT *, tb_soal_essai.soal_essai_id as soal_essai_id FROM `tb_soal_essai` left join tb_nilai_essai on tb_soal_essai.soal_essai_id=tb_nilai_essai.soal_essai_id and tb_soal_essai.soal_essai_status='B' and tb_nilai_essai.user_id='$user_id' and tb_nilai_essai.ujian_id='$ujian_id'and tb_nilai_essai.user_id='$user_id' and tb_nilai_essai.ujian_id='$ujian_id' where tb_soal_essai.soal_essai_status='B'");
        }
		
    }

	function get_by_limit($id_user,$limit){
        if (($id_user % 2) == 1){
            $this->db->from('tb_nilai_pg')
                     ->join('tb_soal_pg', 'tb_soal_pg.soal_pg_id = tb_nilai_pg.soal_pg_id','right')
                     ->where('user_id="'.$id_user.'"')
                     ->where('tb_soal_pg.soal_pg_status','A')
                     ->order_by('nilai_pg_order', 'ASC')
                     ->limit($limit);
            return $this->db->get();
        } elseif(($id_user % 2) == 0) {
            $this->db->from('tb_nilai_pg')
                     ->join('tb_soal_pg', 'tb_soal_pg.soal_pg_id = tb_nilai_pg.soal_pg_id','right')
                     ->where('user_id="'.$id_user.'"')
                     ->where('tb_soal_pg.soal_pg_status','B')
                     ->order_by('nilai_pg_order', 'ASC')
                     ->limit($limit);
            return $this->db->get();
        }
		
	}

	function count_by_status_waktuuser($user_id, $waktuuser){
        $this->db->select('COUNT(tb_hasil_ujian.user_id) AS hasil')
                 ->where('(tb_hasil_ujian.user_id="'.$user_id.'" AND TIMESTAMPADD(MINUTE, ujian_waktu, ujian_created)>"'.$waktuuser.'")')
                 ->from('tb_ujian')
                 ->join('tb_hasil_ujian', 'tb_ujian.ujian_id = tb_hasil_ujian.ujian_id');
        return $this->db->get();
    }

    function get_by_tessoal_limit($nilai_pg_id, $limit){
        $id_user = $this->session->userdata('id');
        if (($id_user % 2) == 1){
            $this->db->select('nilai_pg_id,user_id,nilai_pg_skor,nilai_pg_ragu,tb_nilai_pg.soal_pg_id,nilai_pg_order,kategori_id,soal_pg_soal,soal_pg_jawaban')
                     ->where('nilai_pg_id="'.$nilai_pg_id.'"')
                     ->join('tb_soal_pg', 'tb_nilai_pg.soal_pg_id = tb_soal_pg.soal_pg_id','right')
                     ->where('tb_soal_pg.soal_pg_status','A')
                     ->from('tb_nilai_pg')
                     ->limit($limit);
            return $this->db->get();
        } elseif(($id_user % 2) == 0) {
            $this->db->select('nilai_pg_id,user_id,nilai_pg_skor,nilai_pg_ragu,tb_nilai_pg.soal_pg_id,nilai_pg_order,kategori_id,soal_pg_soal,soal_pg_jawaban')
                     ->where('nilai_pg_id="'.$nilai_pg_id.'"')
                     ->join('tb_soal_pg', 'tb_nilai_pg.soal_pg_id = tb_soal_pg.soal_pg_id','right')
                     ->where('tb_soal_pg.soal_pg_status','B')
                     ->from('tb_nilai_pg')
                     ->limit($limit);
            return $this->db->get();
        }
        
    }

    function get_by_tessoal($soal_pg_id){
        $id_user = $this->session->userdata('id');
        if (($id_user % 2) == 1){
            $this->db->where('tb_soal_pg.soal_pg_id="'.$soal_pg_id.'"')
                     ->from('tb_soal_pg')
                     ->join('tb_nilai_pg', 'tb_soal_pg.soal_pg_id = tb_nilai_pg.soal_pg_id','left')
                     ->where('tb_soal_pg.soal_pg_status','A');
            return $this->db->get();
        } elseif(($id_user % 2) == 0) {
            $this->db->where('tb_soal_pg.soal_pg_id="'.$soal_pg_id.'"')
                     ->from('tb_soal_pg')
                     ->join('tb_nilai_pg', 'tb_soal_pg.soal_pg_id = tb_nilai_pg.soal_pg_id','left')
                     ->where('tb_soal_pg.soal_pg_status','B');
            return $this->db->get();
        }
        
    }

    function get_by_user_tes_limit($user_id, $ujian_id){
        $this->db->where('user_id="'.$user_id.'" AND tb_hasil_ujian.ujian_id="'.$ujian_id.'"')
                 ->from('tb_hasil_ujian')
                 ->join('tb_ujian', 'tb_hasil_ujian.ujian_id = tb_ujian.ujian_id')
                 ->limit(1);
        return $this->db->get();
    }

    function get_by_testuser($user_id){
        $id_user = $this->session->userdata('id');
        if (($id_user % 2) == 1){
            return $this->db->query("SELECT * from tb_nilai_pg right join tb_soal_pg on tb_nilai_pg.soal_pg_id=tb_soal_pg.soal_pg_id and tb_nilai_pg.user_id='$user_id' where tb_soal_pg.soal_pg_status='A' order by tb_nilai_pg.nilai_pg_order ASC");
        } elseif(($id_user % 2) == 0) {
            return $this->db->query("SELECT * from tb_nilai_pg right join tb_soal_pg on tb_nilai_pg.soal_pg_id=tb_soal_pg.soal_pg_id and tb_nilai_pg.user_id='$user_id' where tb_soal_pg.soal_pg_status='B' order by tb_nilai_pg.nilai_pg_order ASC");
        }
    	
    }

}
