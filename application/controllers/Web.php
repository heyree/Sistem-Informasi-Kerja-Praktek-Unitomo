<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// error_reporting(0);
class Web extends CI_Controller {

	public function index()
	{
		$ceks = $this->session->userdata('prakrin_smk@Proyek-2017');
		// if(!isset($ceks)) {
		// 	redirect('web/login');
		// }else{
		// 			redirect('users');
		// }

		$data['judul_web'] = "Selamat datang di Sistem Kerja Praktek";

		$this->load->view('web/header', $data);
		$this->load->view('web/beranda');
		$this->load->view('web/footer');

	}


	public function info($id='')
	{

		$this->db->join('tbl_label','tbl_label.kdlabel=tbl_info.kdlabel');
		if ($id != '') {
			$this->db->where('kdinfo', $id);
		}
		if (isset($_POST['btncari'])) {
			$this->db->like('judul', $_POST['cari']);
		}
		$this->db->order_by('kdinfo','DESC');
		$this->db->limit(5);
		$data['v_info']		 = $this->db->get('tbl_info');

		$this->db->order_by('nama_label','ASC');
		$data['v_label']		 = $this->db->get('tbl_label');

		if ($id == '') {
			if (isset($_POST['btncari'])) {
				$judul = $_POST['cari'];
			}else{
				$judul = 'Informasi';
			}
			$data['judul_web'] = $judul;

			$p = 'informasi';
		}else {
			$data['judul_web'] = $data['v_info']->row()->judul;

			$p = 'informasi_detail';

			if ($data['v_info']->num_rows() == 0) {
				redirect('web/error_not_found');
			}
		}

		$this->load->view('web/header', $data);
		$this->load->view('web/'.$p, $data);
		$this->load->view('web/footer');

	}

	public function industri($id='')
	{
		if ($id != '') {
			$this->db->where('kdind', $id);
		}
		$this->db->order_by('kdind','DESC');
		$data['v_industri']		 = $this->db->get('tbl_industri');

		if ($id == '') {
			$data['judul_web'] = 'Industri';

			$p = 'industri';
		}else {
			$data['judul_web'] = $data['v_industri']->row()->nama_industri;

			$p = 'industri_detail';

			if ($data['v_industri']->num_rows() == 0) {
				redirect('web/error_not_found');
			}
		}

		$this->load->view('web/header', $data);
		$this->load->view('web/'.$p, $data);
		$this->load->view('web/footer');

	}
	

	public function login()
	{
		$ceks = $this->session->userdata('prakrin_smk@Proyek-2017');
		if(isset($ceks)) {
			redirect('users');
		}else{
			$data['judul_web'] = "Selamat datang";

			$this->load->view('web/header', $data);
			$this->load->view('web/login', $data);
			$this->load->view('web/footer');

				if (isset($_POST['btnlogin'])){
						 $username = htmlentities(strip_tags($_POST['username']));
						 $pass	   = htmlentities(strip_tags(md5($_POST['password'])));

						 $cek_un    = $this->Mcrud->get_users_by_un($username);
						 $cek_pemb  = $this->db->get_where("tbl_pemb", array('username' => "$username"));
						 $cek_siswa = $this->db->get_where("tbl_siswa", array('nis' => "$username"));
						 if ($cek_un->num_rows() != 0) {
						 		$query  = $cek_un;
						 }elseif ($cek_pemb->num_rows() != 0) {
						 		$query  = $cek_pemb;
						 }else{
							 	$query  = $cek_siswa;
						 }
						 $cek    = $query->result();
						 $cekun  = $username;
						 $jumlah = $query->num_rows();

						 if($jumlah == 0) {
								 $this->session->set_flashdata('msg',
									 '
									 <div class="alert alert-danger alert-dismissible" role="alert">
									 		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;&nbsp;</span>
											</button>
											<strong>NIS/Username "'.$username.'"</strong> belum terdaftar.
									 </div>'
								 );
								 redirect('web/login');
						 } else {
										 $row = $query->row();
										 $cekpass = $row->password;
										 if($cekpass <> $pass) {
												$this->session->set_flashdata('msg',
													 '<div class="alert alert-warning alert-dismissible" role="alert">
													 		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
																<span aria-hidden="true">&times;&nbsp;</span>
															</button>
															<strong>NIS/Username atau Password Salah!</strong>.
													 </div>'
												);
												redirect('web/login');
										 } else {

											//  date_default_timezone_set('Asia/Jakarta');
											//  $tgl = date('Y-m-d H:i:s');
											//  $data = array(
											// 	 'terakhir_login'		=> $tgl,
											// 	);

											 if ($cek_un->num_rows() != 0) {
												//  $this->Mcrud->update_user(array('username' => $username), $data);

												 $id_user  = $row->id_user;
												 $level    = 'admin';
											 }elseif ($cek_pemb->num_rows() != 0) {
												//  $this->db->update('tbl_pemb', $data, array('username' => $username));

												 $id_user  = $row->nip;
												 $level    = 'pembimbing';
											 }else{
												//  $this->db->update('tbl_siswa', $data, array('nis' => $username));

												 $id_user  = $row->nis;
												 $level    = "siswa";
											 }

																$this->session->set_userdata('prakrin_smk@Proyek-2017', "$cekun");
																$this->session->set_userdata('id_user@Proyek-2017', "$id_user");
																$this->session->set_userdata('level@Proyek-2017', "$level");

																redirect('users');
										 }
						 }
				}
		}
	}


	public function logout() {
     if ($this->session->has_userdata('prakrin_smk@Proyek-2017') and $this->session->has_userdata('id_user@Proyek-2017') and $this->session->has_userdata('level@Proyek-2017')) {
         $this->session->sess_destroy();
         redirect('');
     }
		 redirect('');
  }

	function error_not_found(){
		$this->load->view('404_content');
	}

}
