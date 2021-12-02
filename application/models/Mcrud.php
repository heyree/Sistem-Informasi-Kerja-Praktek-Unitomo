<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mcrud extends CI_Model {

	var $tbl_users	 = 'tbl_user';
	var $tbl_pemb		 = 'tbl_pemb';
	var $tbl_siswa	 = 'tbl_siswa';


	public function get_users()
	{
			$this->db->from($this->tbl_users);
			$query = $this->db->get();

			return $query;
	}

	public function get_users_daftar()
	{
			$this->db->from($this->tbl_users);
			$this->db->where('status','terdaftar');
			$query = $this->db->get();

			return $query;
	}

	public function get_level_users()
	{
			$this->db->from($this->tbl_users);
			// $this->db->where('tbl_user.level', 'user');
			$query = $this->db->get();

			return $query;
	}

	public function get_users_by_un($id)
	{
				$this->db->from($this->tbl_users);
				$this->db->where('username',$id);
				$query = $this->db->get();

				return $query;
	}

	public function get_level_users_by_id($id)
	{
			$this->db->from($this->tbl_users);
			$this->db->where('tbl_user.level', 'user');
			$this->db->where('tbl_user.id_user', $id);
			$query = $this->db->get();

			return $query->row();
	}

	public function save_user($data)
	{
		$this->db->insert($this->tbl_users, $data);
		return $this->db->insert_id();
	}

	public function update_user($where, $data)
	{
		$this->db->update($this->tbl_users, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_user_by_id($id)
	{
		$this->db->where('id_user', $id);
		$this->db->delete($this->tbl_users);
	}


	function terbilang($x){
        $abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
        if ($x < 12)
        return "" . $abil[$x];
        elseif ($x < 20)
        return $this->terbilang($x - 10) . "belas";
        elseif ($x < 100)
        return $this->terbilang($x / 10) . "puluh" . $this->terbilang($x % 10);
        elseif ($x < 200)
        return " seratus" . $this->terbilang($x - 100);
        elseif ($x < 1000)
        return $this->terbilang($x / 100) . " ratus" . $this->terbilang($x % 100);
        elseif ($x < 2000)
        return " seribu" . $this->terbilang($x - 1000);
        elseif ($x < 1000000)
        return $this->terbilang($x / 1000) . "ribu " . $this->terbilang($x % 1000);
        elseif ($x < 1000000000)
        return $this->terbilang($x / 1000000) . " juta" . $this->terbilang($x % 1000000);
  }

	public static function format($date)
	{
			$str = explode('-', $date);
			$bulan = array(
				'01' => 'Januari',
				'02' => 'Februari',
				'03' => 'Maret',
				'04' => 'April',
				'05' => 'Mei',
				'06' => 'Juni',
				'07' => 'Juli',
				'08' => 'Agustus',
				'09' => 'September',
				'10' => 'Oktober',
				'11' => 'November',
				'12' => 'Desember',
			);
			return $str['2'] . " " . $bulan[$str[1]] . " " .$str[0];
	}

	public function get_pemb_by_un($id)
	{
				$this->db->from($this->tbl_pemb);
				$this->db->where('username',$id);
				$query = $this->db->get();

				return $query;
	}

	public function get_siswa_by_nis($id)
	{
				$this->db->from($this->tbl_siswa);
				$this->db->where('nis',$id);
				$query = $this->db->get();

				return $query;
	}

}
