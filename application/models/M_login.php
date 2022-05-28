<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_login extends CI_Model
{

	public function login($username)
	{
    	$res = $this->db->query("SELECT * from tb_user where user_username='$username'");
    	return $res;
	}
}
