<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Users extends CI_Controller {

	function __construct(){
        parent::__construct();
				// load library Excell_Reader
				$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
  }

	public function index()
	{
		$ceks = $this->session->userdata('prakrin_smk@Proyek-2017');
		$id_user = $this->session->userdata('id_user@Proyek-2017');
		$level = $this->session->userdata('level@Proyek-2017');
		if(!isset($ceks)) {
			redirect('web/login');
		}else{
			if ($level == 'admin') {
				redirect('users/info');
			}elseif ($level == 'pembimbing') {
				redirect('users/profile');
			}else{
				redirect('users/status_prakerin');
			}

		}
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

	public function profile()
	{
		$ceks    = $this->session->userdata('prakrin_smk@Proyek-2017');
		$level   = $this->session->userdata('level@Proyek-2017');
		$id_user = $this->session->userdata('id_user@Proyek-2017');
		if(!isset($ceks)) {
			redirect('web/login');
		}else{

			$this->db->order_by('nama', 'ASC');
			$data['v_kelas'] 		= $this->db->get('tbl_kelas');
			$this->db->order_by('nama', 'ASC');
			$data['v_jurusan']  = $this->db->get('tbl_jurusan');
			if ($level == 'admin') {
				$data['user']   	 = $this->Mcrud->get_users_by_un($ceks);
				$data['email']		 = '';
				$data['level']		 = 'Admin';
			}elseif ($level == 'pembimbing') {
				$data['user']   	 = $this->Mcrud->get_pemb_by_un($ceks);
				$data['email']		 = '';
				$data['level']		 = 'Pembimbing';
			}else{
				$data['user']   	 = $this->db->get_where('tbl_siswa', "nis='$ceks'");
				$data['email']		 = '';
				$data['level']		 = 'Siswa';
			}
			// $data['level_users']  = $this->Mcrud->get_level_users();
			$data['judul_web'] 		= "Profil | Aplikasi SIPKISMK";

					$this->load->view('users/header', $data);
					$this->load->view('users/profile', $data);
					$this->load->view('users/footer');

					if (isset($_POST['btnupdate'])) {

						if ($level != 'pembimbing') {

								if ($level == 'siswa') {
										$lokasi = 'foto/siswa';
								}else{
										$lokasi = 'foto';
								}

								$file_size = 1024 * 3; // 3 MB
								$this->upload->initialize(array(
									"file_type"     => "image/jpeg",
									"upload_path"   => "./$lokasi",
									"allowed_types" => "jpg|jpeg|png|gif|bmp",
									"max_size" => "$file_size"
								));

								if ( ! $this->upload->do_upload('avatar-1'))
								{
											$foto = $data['user']->row()->foto;
								}
								 else
								{
									if ($data['user']->row()->foto != 'default.png') {
											unlink("$lokasi/".$data['user']->row()->foto);
									}
											$gbr = $this->upload->data();

											$filename = $gbr['file_name'];
											$foto = preg_replace('/ /', '_', $filename);
								}
					  }

						if ($level != 'siswa') {
							$username	    	= htmlentities(strip_tags($this->input->post('username')));
						}else{
							$username				= $ceks;
						}
						$nama_lengkap	 	= htmlentities(strip_tags($this->input->post('nama_lengkap')));
						if ($level == 'admin') {
							$identitas		= htmlentities(strip_tags($this->input->post('identitas')));
							$status	 		  = htmlentities(strip_tags($this->input->post('status')));
						}elseif ($level == 'pembimbing') {
							$kdjurusan		= htmlentities(strip_tags($this->input->post('jurusan')));
							$nip	 		  	= htmlentities(strip_tags($this->input->post('nip')));
							$wilayah	 		= htmlentities(strip_tags($this->input->post('wilayah')));

							if ($id_user != $nip) {
								$cek_nip   = $this->db->get_where("tbl_pemb", array('nip' => "$nip"));
								if ($cek_nip->num_rows() != 0) {
									 $query  = 'gagal';
									 $pesan  = "NIP '$nip'";
								}
							}
						}else{
							$kdkelas		  = htmlentities(strip_tags($this->input->post('kelas')));
							$telp	 		    = htmlentities(strip_tags($this->input->post('telp')));
						}

					if ($ceks != $username) {
							$cek_un    = $this->Mcrud->get_users_by_un($username);
							$cek_pemb  = $this->db->get_where("tbl_pemb", array('username' => "$username"));
							$cek_siswa = $this->db->get_where("tbl_siswa", array('nis' => "$username"));
							if ($cek_un->num_rows() != 0) {
								 $query  = 'gagal';
								 $pesan  = "Username '$username'";
							}elseif ($cek_pemb->num_rows() != 0) {
								 $query  = 'gagal';
								 $pesan  = "Username '$username'";
							}elseif ($cek_siswa->num_rows() != 0) {
								 $query  = 'gagal';
								 if ($level == 'siswa') {
								 		$pesan  = "NIS '$username'";
								 }else{
									 	$pesan  = "Username '$username'";
								 }
							}

							if ($query == 'gagal') {
								$this->session->set_flashdata('msg',
									'
									<div class="alert alert-warning alert-dismissible" role="alert">
										 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
											 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
										 </button>
										 <strong>Gagal!</strong> '.$pesan.' sudah ada.
									</div>'
								);
								redirect('users/profile');
							}
					}

						if ($level == 'admin') {
									$data = array(
										'username'	    => $username,
										'nama_lengkap'	=> $nama_lengkap,
										'identitas'			=> $identitas,
										'status'				=> $status,
										'foto'				  => $foto
									);
									$this->Mcrud->update_user(array('username' => $ceks), $data);
						}elseif ($level == 'pembimbing') {
									$data = array(
										'username'	    => $username,
										'nama_lengkap'	=> $nama_lengkap,
										'kdjurusan'			=> $kdjurusan,
										'nip'						=> $nip,
										'wilayah'				=> $wilayah
									);
									$this->db->update('tbl_pemb', $data, array('username' => $ceks));
						}else{
									$data = array(
										'nama_lengkap'	=> $nama_lengkap,
										'kdkelas'				=> $kdkelas,
										'telp'				  => $telp,
										'foto'				  => $foto
									);
									$this->db->update('tbl_siswa', $data, array('nis' => $ceks));
						}


							$this->session->has_userdata('prakrin_smk@Proyek-2017');
							$this->session->set_userdata('prakrin_smk@Proyek-2017', "$username");

							if ($level == 'pembimbing') {
									$id_user = $nip;
							}elseif ($level == 'siswa') {
									$id_user = $username;
							}
							$this->session->has_userdata('id_user@Proyek-2017');
							$this->session->set_userdata('id_user@Proyek-2017', "$id_user");

							$this->session->has_userdata('level@Proyek-2017');
							$this->session->set_userdata('level@Proyek-2017', "$level");

									$this->session->set_flashdata('msg',
										'
										<div class="alert alert-success alert-dismissible" role="alert">
											 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
												 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
											 </button>
											 <strong>Sukses!</strong> Profile berhasil diperbarui.
										</div>'
									);
									redirect('users/profile');
					}


					if (isset($_POST['btnupdate2'])) {
						$password 	= htmlentities(strip_tags($this->input->post('password')));
						$password2 	= htmlentities(strip_tags($this->input->post('password2')));

						if ($password != $password2) {
								$this->session->set_flashdata('msg2',
									'
									<div class="alert alert-warning alert-dismissible" role="alert">
										 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
											 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
										 </button>
										 <strong>Gagal!</strong> Password tidak cocok.
									</div>'
								);
						}else{
									$data = array(
										'password'	=> md5($password)
									);
									if ($level == 'admin') {
										$this->Mcrud->update_user(array('username' => $ceks), $data);
									}elseif ($level == 'pembimbing') {
										$this->db->update('tbl_pemb', $data, array('username' => $ceks));
									}else {
										$this->db->update('tbl_siswa', $data, array('nis' => $ceks));
									}

									$this->session->set_flashdata('msg2',
										'
										<div class="alert alert-success alert-dismissible" role="alert">
											 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
												 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
											 </button>
											 <strong>Sukses!</strong> Password berhasil diperbarui.
										</div>'
									);
						}
									redirect('users/profile');
					}


		}
	}


	public function data_info($id_label='')
	{
		$this->db->join('tbl_label','tbl_label.kdlabel=tbl_info.kdlabel');
		if ($id_label != 0) {
			$this->db->where('tbl_info.kdlabel', $id_label);
		}
		$this->db->order_by('kdinfo','DESC');
		$data = $this->db->get('tbl_info');
		?>
		<!-- <script type="text/javascript" src="assets/js/plugins/tables/datatables/datatables.min.js"></script> -->

		<!-- <script type="text/javascript" src="assets/js/core/app.js"></script> -->
		<script type="text/javascript" src="assets/js/pages/datatables_basic.js"></script>

		<table class="table datatable-basic" width="100%">
			<thead>
				<tr>
					<th width="30px;">No.</th>
					<th>Judul</th>
					<th>Tanggal</th>
					<th>Label</th>
					<th class="text-center" width="180">Aksi</th>
				</tr>
			</thead>
			<tbody>
					<?php
					$no=1;
					foreach ($data->result() as $row){?>
						<tr>
							<td><?php echo $no; ?></td>
							<td><?php echo $row->judul; ?></td>
							<td><?php echo $this->format($row->tanggal); ?></td>
							<td><?php echo $row->nama_label; ?></td>
							<td>
								<a href="web/info/<?php echo $row->kdinfo; ?>" class="btn btn-info" target="_blank"><i class="icon-eye"></i></a>
								<a href="users/info/e/<?php echo $row->kdinfo; ?>" class="btn btn-success"><i class="icon-pencil5"></i></a>
								<a href="users/info/h/<?php echo $row->kdinfo; ?>" class="btn btn-danger" onclick="return confirm('Anda Yakin??')"><i class="icon-trash"></i></a>
							</td>
						</tr>
					<?php
					$no++;
				}?>

			</tbody>
			</table>
			<?php
	}

	public function data_file()
	{
		$this->db->order_by('kdfile', 'DESC');
		$v_file = $this->db->get('tbl_file');
		?>

		<script type="text/javascript" src="assets/js/pages/datatables_basic.js"></script>
		<table class="table datatable-basic" width="100%">
			<thead>
				<tr>
					<th width="30px;">No.</th>
					<th>Judul</th>
					<th>Tanggal</th>
					<th>Nama File</th>
					<th class="text-center" width="180">Aksi</th>
				</tr>
			</thead>
			<tbody>
					<?php
					$no=1;
					foreach ($v_file->result() as $row){?>
						<tr>
							<td><?php echo $no; ?></td>
							<td><?php echo $row->judul; ?></td>
							<td><?php echo $this->format($row->tanggal); ?></td>
							<td><?php echo $row->nama; ?></td>
							<td>
								<!-- <a href="#" class="btn btn-info"><i class="icon-eye"></i></a> -->
								<a href="users/info/h_file/<?php echo $row->kdfile; ?>" class="btn btn-danger" onclick="return confirm('Anda Yakin??')"><i class="icon-trash"></i></a>
							</td>
						</tr>
					<?php
					$no++;
				}?>

			</tbody>
			</table>
		<?php
	}

	public function info($aksi='',$id='')
	{
		$ceks = $this->session->userdata('prakrin_smk@Proyek-2017');
		$id_user = $this->session->userdata('id_user@Proyek-2017');
		$level = $this->session->userdata('level@Proyek-2017');
		if(!isset($ceks)) {
			redirect('web/login');
		}else{

			if ($level != 'admin') {
				 redirect('web/error_not_found');
			}

			$data['user']   	 = $this->Mcrud->get_users_by_un($ceks);
			$this->db->order_by('kdlabel', 'ASC');
			$data['v_label'] 	 = $this->db->get('tbl_label');
			$data['email']		 = '';
			$data['level']		 = 'Admin';

			if ($aksi == 't') {

				$p = 'info/info_tambah';
				$data['judul_web'] = "Tambah Informasi | Aplikasi SIPKISMK";

			}elseif ($aksi == 'e') {

				$p = 'info/info_edit';
				$data['judul_web'] = "Edit Informasi | Aplikasi SIPKISMK";
				$data['v_info']		 = $this->db->get_where('tbl_info', "kdinfo='$id'")->row();

				if ($data['v_info']->kdinfo == '') {
					redirect('web/error_not_found');
				}

			}elseif ($aksi == 'h') {

				$cek_data = $this->db->get_where('tbl_info', "kdinfo='$id'")->row();
				if ($cek_data->kdinfo == '') {
					redirect('web/error_not_found');
				}

				unlink("$cek_data->gambar");
				$this->db->delete('tbl_info', "kdinfo='$id'");

				$this->session->set_flashdata('msg',
					 '
					 <div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times; &nbsp;</span>
							</button>
							<strong>Sukses!</strong> Informasi berhasil dihapus.
					 </div>'
				 );
				 redirect('users/info');

			}elseif ($aksi == 'h_file') {

				$cek_data = $this->db->get_where('tbl_file', "kdfile='$id'")->row();
				if ($cek_data->kdfile == '') {
					redirect('web/error_not_found');
				}

				unlink("lampiran/file/$cek_data->nama");
				$this->db->delete('tbl_file', "kdfile='$id'");

				$this->session->set_flashdata('msg_file',
					 '
					 <div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times; &nbsp;</span>
							</button>
							<strong>Sukses!</strong> File berhasil dihapus.
					 </div>'
				 );
				 redirect('users/info/u_f');

			}else{

				$p = 'info/info';
				$data['judul_web'] = "Kelola Informasi | Aplikasi SIPKISMK";

			}

			$this->load->view('users/header', $data);
			$this->load->view('users/admin/'.$p, $data);
			$this->load->view('users/footer');

			if (isset($_POST['btnsimpan'])) {
					$label 			= htmlentities(strip_tags($this->input->post('label')));
					$tanggal 		= htmlentities(strip_tags($this->input->post('tanggal')));
					$judul 			= htmlentities(strip_tags($this->input->post('judul')));
					$deskripsi 	= $this->input->post('deskripsi');

					$file_size = 5500; //5 MB
					$this->upload->initialize(array(
						"upload_path"   => "./foto/info/",
						"allowed_types" => "jpg|jpeg|png|gif|bmp",
						"max_size" => "$file_size"
					));

						if ($aksi == 't') {
							if ( ! $this->upload->do_upload('gambar'))
							{
									$error = $this->upload->display_errors('<p>', '</p>');
									$this->session->set_flashdata('msg',
										 '
										 <div class="alert alert-warning alert-dismissible" role="alert">
												<button type="button" class="close" data-dismiss="alert" aria-label="Close">
													<span aria-hidden="true">&times; &nbsp;</span>
												</button>
												<strong>Gagal!</strong> '.$error.'.
										 </div>'
									 );

									 redirect('users/info/t');
							}
							 else
							{
									$gbr = $this->upload->data();
									$filename = $gbr['file_name'];
									$filename = "foto/info/".$filename;
									$foto 		= preg_replace('/ /', '_', $filename);

									$data = array(
										'kdlabel'		  => $label,
										'tanggal'			=> date('Y-m-d', strtotime($tanggal)),
										'judul'				=> $judul,
										'deskripsi'	  => $deskripsi,
										'gambar'			=> $foto,
										'penulis'			=> $data['user']->row()->nama_lengkap
									);
									$this->db->insert('tbl_info', $data);

									$this->session->set_flashdata('msg_t',
										 '
										 <div class="alert alert-success alert-dismissible" role="alert">
												<button type="button" class="close" data-dismiss="alert" aria-label="Close">
													<span aria-hidden="true">&times; &nbsp;</span>
												</button>
												<strong>Sukses!</strong> Informasi berhasil ditambahkan.
										 </div>'
									 );
								}
							}elseif ($aksi == 'e') {
										if ($_FILES['gambar']['error'] <> 4) {
								        if ( ! $this->upload->do_upload('gambar'))
								        {
														$error = $this->upload->display_errors('<p>', '</p>');
														$update = "";
												}
								         else
								        {
															$cek_foto = $data['v_info']->gambar;
															unlink("$cek_foto");
								              $gbr = $this->upload->data();
								              $filename = $gbr['file_name'];
								              $filename = "foto/info/".$filename;
															$foto 		= preg_replace('/ /', '_', $filename);

															$update = "yes";
								        }
										}else{
											$foto   = $cek_foto;
											$update = "yes";
										}

										if ($update = "yes") {
												$data = array(
													'kdlabel'		  => $label,
													'tanggal'			=> date('Y-m-d', strtotime($tanggal)),
													'judul'				=> $judul,
													'deskripsi'	  => $deskripsi,
													'gambar'			=> $foto
												);
												$this->db->update('tbl_info', $data, array('kdinfo' => $id));

												$this->session->set_flashdata('msg_t',
													 '
													 <div class="alert alert-success alert-dismissible" role="alert">
															<button type="button" class="close" data-dismiss="alert" aria-label="Close">
																<span aria-hidden="true">&times; &nbsp;</span>
															</button>
															<strong>Sukses!</strong> Informasi berhasil diperbarui.
													 </div>'
												 );
										}else{
												$this->session->set_flashdata('msg',
													 '
													 <div class="alert alert-warning alert-dismissible" role="alert">
															<button type="button" class="close" data-dismiss="alert" aria-label="Close">
																<span aria-hidden="true">&times; &nbsp;</span>
															</button>
															<strong>Gagal!</strong> '.$error.'.
													 </div>'
												 );
												 redirect('users/info/e');
										}
							}
								 redirect('users/info');


			}



			if (isset($_POST['btnupfile'])) {
					$tanggal 		= htmlentities(strip_tags($this->input->post('tanggal')));
					$judul 			= htmlentities(strip_tags($this->input->post('judul')));
					$keterangan = htmlentities(strip_tags($this->input->post('keterangan')));

					$file_size = 1024 * 5; //5 MB
					$this->upload->initialize(array(
						"upload_path"   => "./lampiran/file/",
						"allowed_types" => "*",
						"max_size" => "$file_size"
					));

							if ( ! $this->upload->do_upload('file'))
							{
									$error = $this->upload->display_errors('<p>', '</p>');
									$this->session->set_flashdata('msg_file',
										 '
										 <div class="alert alert-warning alert-dismissible" role="alert">
												<button type="button" class="close" data-dismiss="alert" aria-label="Close">
													<span aria-hidden="true">&times; &nbsp;</span>
												</button>
												<strong>Gagal!</strong> '.$error.'.
										 </div>'
									 );

							}
							 else
							{
									$file = $this->upload->data();
									$filename = $file['file_name'];
									$file 		= preg_replace('/ /', '_', $filename);

									$data = array(
										'tanggal'		 => date('Y-m-d', strtotime($tanggal)),
										'judul'			 => $judul,
										'keterangan' => $keterangan,
										'nama'			 => $file,
										'share'			 => ''
									);
									$this->db->insert('tbl_file', $data);

									$this->session->set_flashdata('msg_file',
										 '
										 <div class="alert alert-success alert-dismissible" role="alert">
												<button type="button" class="close" data-dismiss="alert" aria-label="Close">
													<span aria-hidden="true">&times; &nbsp;</span>
												</button>
												<strong>Sukses!</strong> File berhasil ditambahkan.
										 </div>'
									 );
								}

								 redirect('users/info/u_f');

			}


		}
	}


	public function j_k($aksi='', $id='')
	{
		$ceks = $this->session->userdata('prakrin_smk@Proyek-2017');
		$id_user = $this->session->userdata('id_user@Proyek-2017');
		$level = $this->session->userdata('level@Proyek-2017');
		if(!isset($ceks)) {
			redirect('web/login');
		}else{

			if ($level != 'admin') {
				 redirect('web/error_not_found');
			}

			$data['user']   	 = $this->Mcrud->get_users_by_un($ceks);
			$this->db->order_by('nama', 'ASC');
			$data['v_jurusan'] 	 = $this->db->get('tbl_jurusan');
			$this->db->order_by('nama', 'ASC');
			$data['v_kelas'] 	 = $this->db->get('tbl_kelas');
			$data['email']		 = '';
			$data['level']		 = 'Admin';

				if ($aksi == 'e_kelas') {
					$p = "j_k/j_k_edit";

					$data['query'] = $this->db->get_where("tbl_kelas", "kdkelas = '$id'")->row();
					$data['judul_web'] 	  = "Edit Kelas | Aplikasi SIPKISMK";
				}elseif ($aksi == 'e_jurusan') {
					$p = "j_k/j_k_edit";

					$data['query'] = $this->db->get_where("tbl_jurusan", "kdjurusan = '$id'")->row();
					$data['judul_web'] 	  = "Edit Jurusan | Aplikasi SIPKISMK";
				}elseif ($aksi == 'h') {

					$data['query'] = $this->db->get_where("tbl_user", "id_user = '$id'")->row();

					if ($ceks == $data['query']->username) {
						$this->session->set_flashdata('msg',
							'
							<div class="alert alert-warning alert-dismissible" role="alert">
								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
								 </button>
								 <strong>Gagal!</strong> Maaf, Anda tidak bisa menghapus Nama Pengguna "'.$ceks.'" ini.
							</div>'
						);
					}else{
						$this->Mcrud->delete_user_by_id($id);
						$this->session->set_flashdata('msg',
							'
							<div class="alert alert-success alert-dismissible" role="alert">
								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
								 </button>
								 <strong>Sukses!</strong> Pengguna berhasil dihapus.
							</div>'
						);
					}
					redirect('users/pengguna');
				}else{
					$p = "j_k/j_k";

					$data['judul_web'] 	  = "Jurusan & Kelas | Aplikasi SIPKISMK";
				}

					$this->load->view('users/header', $data);
					$this->load->view("users/admin/$p", $data);
					$this->load->view('users/footer');

					date_default_timezone_set('Asia/Jakarta');
					$tgl = date('d-m-Y H:i:s');

					if (isset($_POST['btnsimpan'])) {

						$jurusan   	 	= htmlentities(strip_tags($this->input->post('jurusan')));
						if (!empty($_POST['kelas'])) {
							$kelas   	 	= htmlentities(strip_tags($this->input->post('kelas')));
							$cek_data = $this->db->get_where("tbl_kelas", "nama = '$kelas'")->num_rows();
							if ($cek_data != 0) {
									$this->session->set_flashdata('msg_kelas',
										'
										<div class="alert alert-warning alert-dismissible" role="alert">
											 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
												 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
											 </button>
											 <strong>Gagal!</strong> Nama Kelas "'.$kelas.'" Sudah ada.
										</div>'
									);
							}else{
											$data = array(
												'nama'	 	  => $kelas,
												'kdjurusan' => $jurusan
											);
											$this->db->insert('tbl_kelas', $data);

											$this->session->set_flashdata('msg_kelas',
												'
												<div class="alert alert-success alert-dismissible" role="alert">
													 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
														 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
													 </button>
													 <strong>Sukses!</strong> Kelas berhasil ditambah.
												</div>'
											);
							}
							redirect('users/j_k');
						}else{
							$cek_data = $this->db->get_where("tbl_jurusan", "nama = '$jurusan'")->num_rows();
							if ($cek_data != 0) {
									$this->session->set_flashdata('msg_jurusan',
										'
										<div class="alert alert-warning alert-dismissible" role="alert">
											 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
												 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
											 </button>
											 <strong>Gagal!</strong> Nama Jurusan "'.$jurusan.'" Sudah ada.
										</div>'
									);
							}else{
											$data = array(
												'nama'	 	 => $jurusan
											);
											$this->db->insert('tbl_jurusan', $data);

											$this->session->set_flashdata('msg_jurusan',
												'
												<div class="alert alert-success alert-dismissible" role="alert">
													 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
														 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
													 </button>
													 <strong>Sukses!</strong> Jurusan berhasil ditambah.
												</div>'
											);
							}
							redirect('users/j_k/tbl_jurusan');
						}

					}

					if (isset($_POST['btnupdate'])) {
							$jurusan   	 	= htmlentities(strip_tags($this->input->post('jurusan')));
							if (!empty($_POST['kelas'])) {
								$kelas   	 	= htmlentities(strip_tags($this->input->post('kelas')));
								$data = array(
									'nama'	 	  => $kelas,
									'kdjurusan' => $jurusan
								);
								$this->db->update('tbl_kelas', $data, "kdkelas='$id'");
								$this->session->set_flashdata('msg_kelas',
									'
									<div class="alert alert-success alert-dismissible" role="alert">
										 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
											 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
										 </button>
										 <strong>Sukses!</strong> Kelas berhasil ditambah.
									</div>'
								);

								redirect('users/j_k');
							}else{
								$data = array(
									'nama'	 	 => $jurusan
								);
								$this->db->update('tbl_jurusan', $data, "kdjurusan='$id'");
								$this->session->set_flashdata('msg_jurusan',
									'
									<div class="alert alert-success alert-dismissible" role="alert">
										 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
											 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
										 </button>
										 <strong>Sukses!</strong> Jurusan berhasil ditambah.
									</div>'
								);

								redirect('users/j_k/tbl_jurusan');
							}

					}

		}
	}



	public function pengguna($aksi='', $id='')
	{
		$ceks = $this->session->userdata('prakrin_smk@Proyek-2017');
		$id_user = $this->session->userdata('id_user@Proyek-2017');
		$level = $this->session->userdata('level@Proyek-2017');
		if(!isset($ceks)) {
			redirect('web/login');
		}else{

			if ($level != 'admin') {
				 redirect('web/error_not_found');
			}

			$data['user']   	 = $this->Mcrud->get_users_by_un($ceks);
			$this->db->order_by('nama', 'ASC');
			$data['v_jurusan'] 	 = $this->db->get('tbl_jurusan');
			$this->db->order_by('nama', 'ASC');
			$data['v_kelas'] 	 = $this->db->get('tbl_kelas');
			$this->db->order_by('nama_lengkap', 'ASC');
			$data['v_pemb'] 	 = $this->db->get('tbl_pemb');
			$data['email']		 = '';
			$data['level']		 = 'Admin';

				if ($aksi == 't_pemb') {
					$p = "pengguna/pengguna_tambah";

					$data['judul_web'] 	  = "Tambah Pembimbing | Aplikasi SIPKISMK";
				}elseif ($aksi == 't_siswa') {
					$p = "pengguna/pengguna_tambah";

					$data['judul_web'] 	  = "Tambah Siswa | Aplikasi SIPKISMK";
				}elseif ($aksi == 'd_pemb') {
					$p = "pengguna/pengguna_detail";

					$data['query'] = $this->db->get_where("tbl_pemb", "kdpemb = '$id'")->row();
					$data['judul_web'] 	  = "Detail Pembimbing | Aplikasi SIPKISMK";
				}elseif ($aksi == 'd_siswa') {
					$p = "pengguna/pengguna_detail";

					$data['query'] = $this->db->get_where("tbl_siswa", "nis = '$id'")->row();
					$data['judul_web'] 	  = "Detail Siswa | Aplikasi SIPKISMK";
				}elseif ($aksi == 'h_pemb') {

					$data['query'] = $this->db->get_where("tbl_pemb", "kdpemb = '$id'")->row();

					if ($data['query']->username != ''){
						$this->db->delete('tbl_pemb', "kdpemb='$id'");
						$this->session->set_flashdata('msg_pemb',
							'
							<div class="alert alert-success alert-dismissible" role="alert">
								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
								 </button>
								 <strong>Sukses!</strong> Pengguna Pembimbing berhasil dihapus.
							</div>'
						);
					}
					redirect('users/pengguna');

				}elseif ($aksi == 'h_siswa') {

					$data['query'] = $this->db->get_where("tbl_siswa", "nis = '$id'")->row();

					if ($data['query']->nis != ''){
						unlink("foto/siswa/".$data['query']->foto);
						$this->db->delete('tbl_siswa', "nis='$id'");
						$this->session->set_flashdata('msg_siswa',
							'
							<div class="alert alert-success alert-dismissible" role="alert">
								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
								 </button>
								 <strong>Sukses!</strong> Pengguna Siswa berhasil dihapus.
							</div>'
						);
					}
					redirect('users/pengguna/tbl_siswa');

				}else{
					$p = "pengguna/pengguna";

					$data['judul_web'] 	  = "Pengguna | Aplikasi SIPKISMK";

					$this->db->order_by('kdpemb', 'DESC');
					$data['v_pemb']  = $this->db->get("tbl_pemb");

					$this->db->order_by('nis', 'DESC');
					$data['v_siswa']  = $this->db->get("tbl_siswa");
				}

					$this->load->view('users/header', $data);
					$this->load->view("users/admin/$p", $data);
					$this->load->view('users/footer');

					date_default_timezone_set('Asia/Jakarta');
					$tgl = date('d-m-Y H:i:s');

					if (isset($_POST['btnsimpan'])) {
						$jurusan   		 	= htmlentities(strip_tags($this->input->post('jurusan')));
						$username	 		  = htmlentities(strip_tags($this->input->post('username')));
						$nip	 					= htmlentities(strip_tags($this->input->post('nip')));
						$nama_lengkap	 	= htmlentities(strip_tags($this->input->post('nama_lengkap')));
						$wilayah	 			= htmlentities(strip_tags($this->input->post('wilayah')));

						$cek_user  = $this->db->get_where("tbl_user", "username = '$username'")->num_rows();
						$cek_pemb  = $this->db->get_where("tbl_pemb", "username = '$username'")->num_rows();
						$cek_nip   = $this->db->get_where("tbl_pemb", "nip = '$nip'")->num_rows();
						$cek_siswa = $this->db->get_where("tbl_siswa", "nis = '$username'")->num_rows();
						if ($cek_user != 0) {
								$this->session->set_flashdata('msg',
									'
									<div class="alert alert-warning alert-dismissible" role="alert">
										 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
											 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
										 </button>
										 <strong>Gagal!</strong> Username "'.$username.'" Sudah ada.
									</div>'
								);
						}else{
								if ($cek_pemb != 0) {
										$this->session->set_flashdata('msg',
											'
											<div class="alert alert-warning alert-dismissible" role="alert">
												 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
													 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
												 </button>
												 <strong>Gagal!</strong> Username "'.$username.'" Sudah ada.
											</div>'
										);
								}else{
									if ($cek_nip != 0) {
											$this->session->set_flashdata('msg',
												'
												<div class="alert alert-warning alert-dismissible" role="alert">
													 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
														 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
													 </button>
													 <strong>Gagal!</strong> NIP "'.$nip.'" Sudah ada.
												</div>'
											);
											redirect('users/pengguna/t_pemb');
									}

										$data = array(
											'username'	 	 => $username,
											'kdjurusan'    => $jurusan,
											'password'	 	 => md5($username),
											'nip'		 			 => $nip,
											'nama_lengkap' => $nama_lengkap,
											'wilayah' 		 => $wilayah
										);
										$this->db->insert('tbl_pemb', $data);

										$this->session->set_flashdata('msg_pemb',
											'
											<div class="alert alert-success alert-dismissible" role="alert">
												 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
													 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
												 </button>
												 <strong>Sukses!</strong> Pengguna Pembimbing berhasil ditambahkan.
											</div>'
										);
										redirect('users/pengguna');
								}
						}
						redirect('users/pengguna/t_pemb');
					}


					if (isset($_POST['btnsimpan2'])) {
						$kelas   		 		= htmlentities(strip_tags($this->input->post('kelas')));
						$nis	 				  = htmlentities(strip_tags($this->input->post('nis')));
						$telp	 					= htmlentities(strip_tags($this->input->post('telp')));
						$nama_lengkap	 	= htmlentities(strip_tags($this->input->post('nama_lengkap')));
						$kdpemb	 				= htmlentities(strip_tags($this->input->post('kdpemb')));

						$cek_user  = $this->db->get_where("tbl_user", "username = '$nis'")->num_rows();
						$cek_pemb  = $this->db->get_where("tbl_pemb", "username = '$nis'")->num_rows();
						$cek_siswa = $this->db->get_where("tbl_siswa", "nis = '$nis'")->num_rows();
						if ($cek_user != 0) {
								$this->session->set_flashdata('msg',
									'
									<div class="alert alert-warning alert-dismissible" role="alert">
										 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
											 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
										 </button>
										 <strong>Gagal!</strong> Username "'.$nis.'" Sudah ada.
									</div>'
								);
						}else{
								if ($cek_pemb != 0) {
										$this->session->set_flashdata('msg',
											'
											<div class="alert alert-warning alert-dismissible" role="alert">
												 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
													 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
												 </button>
												 <strong>Gagal!</strong> Username "'.$nis.'" Sudah ada.
											</div>'
										);
								}else{

									$file_size = 1024 * 5; //5 MB
									$this->upload->initialize(array(
										"upload_path"   => "./foto/siswa/",
										"allowed_types" => "*",
										"max_size" => "$file_size"
									));

											if ( ! $this->upload->do_upload('file'))
											{
													$error = $this->upload->display_errors('<p>', '</p>');
													$this->session->set_flashdata('msg',
														 '
														 <div class="alert alert-warning alert-dismissible" role="alert">
																<button type="button" class="close" data-dismiss="alert" aria-label="Close">
																	<span aria-hidden="true">&times; &nbsp;</span>
																</button>
																<strong>Gagal!</strong> '.$error.'.
														 </div>'
													 );
													 redirect('users/pengguna/t_siswa');
											}
											 else
											{
													$file = $this->upload->data();
													$filename = $file['file_name'];
													$file 		= preg_replace('/ /', '_', $filename);
											}

										$data = array(
											'nis'	 			 	 => $nis,
											'kdkelas'    	 => $kelas,
											'password'	 	 => md5($nis),
											'nama_lengkap' => $nama_lengkap,
											'telp'				 => $telp,
											'foto'		 		 => $file,
											'kdpemb'		 	 => $kdpemb
										);
										$this->db->insert('tbl_siswa', $data);

										$this->session->set_flashdata('msg_siswa',
											'
											<div class="alert alert-success alert-dismissible" role="alert">
												 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
													 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
												 </button>
												 <strong>Sukses!</strong> Pengguna Siswa berhasil ditambahkan.
											</div>'
										);
										redirect('users/pengguna/tbl_siswa');
								}
						}
						redirect('users/pengguna/t_siswa');
					}
		}
	}



	public function industri($aksi='', $id='')
	{
		$ceks = $this->session->userdata('prakrin_smk@Proyek-2017');
		$id_user = $this->session->userdata('id_user@Proyek-2017');
		$level = $this->session->userdata('level@Proyek-2017');
		if(!isset($ceks)) {
			redirect('web/login');
		}else{

			if ($level != 'admin') {
				 redirect('web/error_not_found');
			}

			$data['user']   	 = $this->Mcrud->get_users_by_un($ceks);
			$this->db->order_by('Judul', 'ASC');
			$data['v_industri'] 	 = $this->db->get('tbl_industri');
			$data['email']		 = '';
			$data['level']		 = 'Admin';

				if ($aksi == 't') {
					$p = "industri/industri_tambah";

					$data['judul_web'] 	  = "Tambah Industri | Aplikasi SIPKISMK";
				}elseif ($aksi == 'd') {
					$p = "industri/industri_detail";

					$data['query'] = $this->db->get_where("tbl_industri", "kdind = '$id'")->row();
					$data['judul_web'] 	  = "Detail Industri | Aplikasi SIPKISMK";
				}elseif ($aksi == 'e') {
					$p = "industri/industri_edit";

					$data['query'] = $this->db->get_where("tbl_industri", "kdind = '$id'")->row();
					$data['judul_web'] 	  = "Edit Industri | Aplikasi SIPKISMK";
				}elseif ($aksi == 'h') {

					$data['query'] = $this->db->get_where("tbl_industri", "kdind = '$id'")->row();

					if ($data['query']->kdind != ''){
						unlink("foto/industri/".$data['query']->foto);
						$this->db->delete('tbl_industri', "kdind='$id'");
						$this->session->set_flashdata('msg',
							'
							<div class="alert alert-success alert-dismissible" role="alert">
								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
								 </button>
								 <strong>Sukses!</strong> Industri berhasil dihapus.
							</div>'
						);
					}
					redirect('users/industri');

				}else{
					$p = "industri/industri";

					$data['judul_web'] 	  = "Industri | Aplikasi SIPKISMK";
				}

					$this->load->view('users/header', $data);
					$this->load->view("users/admin/$p", $data);
					$this->load->view('users/footer');

					date_default_timezone_set('Asia/Jakarta');
					$tgl = date('d-m-Y H:i:s');

					if (isset($_POST['btnsimpan'])) {
						$Judul  	= htmlentities(strip_tags($this->input->post('Judul')));
						$Status	 		= htmlentities(strip_tags($this->input->post('Status')));
						$deskripsi	 			= htmlentities(strip_tags($this->input->post('deskripsi')));


									$file_size = 1024 * 5; //5 MB
									$this->upload->initialize(array(
										"upload_path"   => "./foto/industri/",
										"allowed_types" => "*",
										"max_size" => "$file_size"
									));

											if ( ! $this->upload->do_upload('file'))
											{
													$error = $this->upload->display_errors('<p>', '</p>');
													$this->session->set_flashdata('msg',
														 '
														 <div class="alert alert-warning alert-dismissible" role="alert">
																<button type="button" class="close" data-dismiss="alert" aria-label="Close">
																	<span aria-hidden="true">&times; &nbsp;</span>
																</button>
																<strong>Gagal!</strong> '.$error.'.
														 </div>'
													 );
													 redirect('users/industri/t');
											}
											 else
											{
													$file = $this->upload->data();
													$filename = $file['file_name'];
													$file 		= preg_replace('/ /', '_', $filename);
											}

										$data = array(
											'Judul'	 	=> $Judul,
											'Status'    => $Status,
											'deskripsi'				=> $deskripsi
										);
										$this->db->insert('tbl_industri', $data);

										$this->session->set_flashdata('msg',
											'
											<div class="alert alert-success alert-dismissible" role="alert">
												 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
													 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
												 </button>
												 <strong>Sukses!</strong> Industri berhasil ditambahkan.
											</div>'
										);
										redirect('users/industri');
					}



					if (isset($_POST['btnupdate'])) {
					$Judul  	= htmlentities(strip_tags($this->input->post('Judul')));
						$Status	 		= htmlentities(strip_tags($this->input->post('Status')));
						$deskripsi	 			= htmlentities(strip_tags($this->input->post('deskripsi')));

									$file_size = 1024 * 5; //5 MB
									$this->upload->initialize(array(
										"upload_path"   => "./foto/industri/",
										"allowed_types" => "*",
										"max_size" => "$file_size"
									));

									$cek_foto = $data['query']->foto;
									if ($_FILES['file']['error'] <> 4) {
											if ( ! $this->upload->do_upload('file'))
											{
													$error = $this->upload->display_errors('<p>', '</p>');
													$update = "";
											}
											 else
											{
														unlink("foto/industri/$cek_foto");
														$gbr = $this->upload->data();
														$filename = $gbr['file_name'];
														$file 		= preg_replace('/ /', '_', $filename);

														$update = "yes";
											}
									}else{
										$file   = $cek_foto;
										$update = "yes";
									}

									if ($update == 'yes') {

										$data = array(
											'Judul'	 	=> $Judul,
											'Status'    => $Status,
											'deskripsi'				=> $deskripsi
										);
										$this->db->update('tbl_industri', $data, "kdind='$id'");

										$this->session->set_flashdata('msg',
											'
											<div class="alert alert-success alert-dismissible" role="alert">
												 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
													 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
												 </button>
												 <strong>Sukses!</strong> Industri berhasil diperbarui.
											</div>'
										);
										redirect('users/industri');

									}else{
										$this->session->set_flashdata('msg',
											 '
											 <div class="alert alert-warning alert-dismissible" role="alert">
													<button type="button" class="close" data-dismiss="alert" aria-label="Close">
														<span aria-hidden="true">&times; &nbsp;</span>
													</button>
													<strong>Gagal!</strong> '.$error.'.
											 </div>'
										 );
										 redirect('users/industri/e/'.$id);
									}
					}

		}
	}


	public function penempatan($aksi='', $id='')
	{
		$ceks = $this->session->userdata('prakrin_smk@Proyek-2017');
		$id_user = $this->session->userdata('id_user@Proyek-2017');
		$level = $this->session->userdata('level@Proyek-2017');
		if(!isset($ceks)) {
			redirect('web/login');
		}else{

			if ($level != 'admin') {
				 redirect('web/error_not_found');
			}

			$data['user']   	 = $this->Mcrud->get_users_by_un($ceks);
			$this->db->order_by('kdpenempatan', 'DESC');
			$this->db->order_by('tahun', 'DESC');
			$data['v_penempatan'] 	 = $this->db->get('tbl_penempatan');
			$data['email']		 = '';
			$data['level']		 = 'Admin';

				if ($aksi == 'd') {
					$p = "penempatan/penempatan_detail";

					$data['query'] = $this->db->get_where("tbl_penempatan", "kdpenempatan = '$id'")->row();
					$data['judul_web'] 	  = "Detail Penempatan | Aplikasi SIPKISMK";
				}elseif ($aksi == 'h') {
					$cek_data_tolak = $this->db->get_where('tbl_tolak_penempatan', "kdpenempatan='$id'")->num_rows();
					if ($cek_data_tolak != 0) {
							$this->db->delete('tbl_tolak_penempatan', "kdpenempatan='$id'");
					}
					$cek_data = $this->db->get_where('tbl_penempatan', "kdpenempatan='$id'")->row();
					unlink("lampiran/surat/$cek_data->surat");
					$this->db->delete('tbl_penempatan', "kdpenempatan='$id'");

					$this->session->set_flashdata('msg',
						 '
						 <div class="alert alert-success alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times; &nbsp;</span>
								</button>
								<strong>Sukses!</strong> Penempatan berhasil dihapus.
						 </div>'
					 );
					 redirect('users/penempatan');

				}elseif ($aksi == 'tolak') {
					$cek_status = $this->db->get_where('tbl_penempatan', "kdpenempatan='$id'")->row()->status;
					if ($cek_status == 'ditolak') {
							$status = 'proses';
					}else{
							$status = 'ditolak';
					}
					$data = array(
						'status'	 	=> $status
					);
					$this->db->update('tbl_penempatan', $data, "kdpenempatan='$id'");

					$this->session->set_flashdata('msg',
						'
						<div class="alert alert-success alert-dismissible" role="alert">
							 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
							 </button>
							 <strong>Sukses!</strong> Penempatan berhasil diperbarui.
						</div>'
					);
					redirect('users/penempatan');
				}elseif ($aksi == 'setujui') {
					$cek_status = $this->db->get_where('tbl_penempatan', "kdpenempatan='$id'")->row()->status;
					if ($cek_status == 'diterima') {
							$status = 'proses';
					}else{
							$status = 'diterima';
					}
					$data = array(
						'status'	 	=> $status
					);
					$this->db->update('tbl_penempatan', $data, "kdpenempatan='$id'");

					$this->session->set_flashdata('msg',
						'
						<div class="alert alert-success alert-dismissible" role="alert">
							 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
							 </button>
							 <strong>Sukses!</strong> Penempatan berhasil diperbarui.
						</div>'
					);
					redirect('users/penempatan');
				}else{
					$p = "penempatan/penempatan";

					$data['judul_web'] 	  = "Penempatan | Aplikasi SIPKISMK";
				}

					$this->load->view('users/header', $data);
					$this->load->view("users/admin/$p", $data);
					$this->load->view('users/footer');

					date_default_timezone_set('Asia/Jakarta');
					$tgl = date('Y-m-d');

					for ($i=1; $i <=$data['v_penempatan']->num_rows() ; $i++) {
						if (isset($_POST['btntolak_'.$i])) {
							$kdpenempatan = $_POST['kdpenempatan_'.$i];
							$data = array(
								'kdpenempatan'	 	=> $kdpenempatan,
								'tanggal'	 				=> $tgl,
								'alasan'	 				=> $_POST['pesan_'.$i],
							);
							$this->db->insert('tbl_tolak_penempatan', $data);

							$data = array(
								'status'	 	=> 'ditolak'
							);
							$this->db->update('tbl_penempatan', $data, "kdpenempatan='$kdpenempatan'");

							$this->session->set_flashdata('msg',
								'
								<div class="alert alert-success alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
									 </button>
									 <strong>Sukses!</strong> Penolakan tempat berhasil dikirim.
								</div>'
							);
							redirect('users/penempatan');

						}
					}

		}
  }


	public function nilai_praktik($aksi='', $id='')
	{
		$ceks = $this->session->userdata('prakrin_smk@Proyek-2017');
		$id_user = $this->session->userdata('id_user@Proyek-2017');
		$level = $this->session->userdata('level@Proyek-2017');
		if(!isset($ceks)) {
			redirect('web/login');
		}else{

			if ($level != 'admin') {
				 redirect('web/error_not_found');
			}

			$data['user']   	 = $this->Mcrud->get_users_by_un($ceks);
			$this->db->join('tbl_penempatan','tbl_penempatan.nis=tbl_siswa.nis');
			$this->db->join('tbl_nilai','tbl_nilai.kdpenempatan=tbl_penempatan.kdpenempatan');
			if ($aksi == 'd') {
					$this->db->where('tbl_nilai.kdnilai', $id);
			}
			$this->db->order_by('tbl_siswa.nama_lengkap', 'ASC');
			$this->db->order_by('tbl_penempatan.tahun', 'DESC');
			$data['v_nilai'] 	 = $this->db->get('tbl_siswa');
			$data['email']		 = '';
			$data['level']		 = 'Admin';

				if ($aksi == 'd') {
					$p = "nilai/nilai_detail";

					$data['judul_web'] 	  = "Detail Nilai | Aplikasi SIPKISMK";
				}else{
					$p = "nilai/nilai";

					$data['judul_web'] 	  = "Nilai | Aplikasi SIPKISMK";
				}

					$this->load->view('users/header', $data);
					$this->load->view("users/admin/$p", $data);
					$this->load->view('users/footer');

		}
  }

//------------------- Pembimbing --------------------//
	public function d_siswa($aksi='', $id='')
	{
		$ceks = $this->session->userdata('prakrin_smk@Proyek-2017');
		$id_user = $this->session->userdata('id_user@Proyek-2017');
		$level = $this->session->userdata('level@Proyek-2017');
		if(!isset($ceks)) {
			redirect('web/login');
		}else{

			if ($level != 'pembimbing') {
				 redirect('web/error_not_found');
			}

			$data['user']   	 = $this->Mcrud->get_pemb_by_un($ceks);
			if ($aksi == 'd') {
				$this->db->where('nis', $id);
			}
			$this->db->order_by('nis', 'DESC');
			$data['v_siswa'] 	 = $this->db->get('tbl_siswa');
			$data['email']		 = '';
			$data['level']		 = 'Pembimbing';

				if ($aksi == 'd') {
					$p = "daftar_siswa/siswa_detail";

					$data['judul_web'] 	  = "Detail Siswa | Aplikasi SIPKISMK";
				}else{
					$p = "daftar_siswa/siswa";

					$data['judul_web'] 	  = "Data Siswa | Aplikasi SIPKISMK";
				}

					$this->load->view('users/header', $data);
					$this->load->view("users/pembimbing/$p", $data);
					$this->load->view('users/footer');

		}
  }


	public function bimbingan($aksi='', $id='')
	{
		$ceks = $this->session->userdata('prakrin_smk@Proyek-2017');
		$id_user = $this->session->userdata('id_user@Proyek-2017');
		$level = $this->session->userdata('level@Proyek-2017');
		if(!isset($ceks)) {
			redirect('web/login');
		}else{

			if ($level != 'pembimbing') {
				 redirect('web/error_not_found');
			}

			$data['user']   	 = $this->Mcrud->get_pemb_by_un($ceks);
			$this->db->join('tbl_siswa', 'tbl_siswa.nis=tbl_bimbingan.nis');
			$this->db->where('nip', $id_user);
			if ($aksi == 'd') {
				$this->db->where('kdbimbingan', $id);
			}
			$this->db->order_by('kdbimbingan', 'DESC');
			$data['v_bimbingan'] 	 = $this->db->get('tbl_bimbingan');
			$data['email']		 = '';
			$data['level']		 = 'Pembimbing';

				if ($aksi == 't') {
					$p = "bimbingan/bimbingan_tambah";

					$data['judul_web'] 	  = "Tambah Bimbingan | Aplikasi SIPKISMK";
					$this->db->order_by('nis', 'DESC');
					$this->db->order_by('nama_lengkap', 'ASC');
					$data['v_siswa']		 	 = $this->db->get('tbl_siswa');
				}elseif ($aksi == 'd') {
					$p = "bimbingan/bimbingan_detail";

					$data['judul_web'] 	  = "Detail Bimbingan | Aplikasi SIPKISMK";
				}elseif ($aksi == 'h') {

					$cek_data = $this->db->get_where('tbl_bimbingan', "kdbimbingan='$id'")->row();
					unlink("$cek_data->file");
					$this->db->delete('tbl_bimbingan', "kdbimbingan='$id'");

					$this->session->set_flashdata('msg',
						 '
						 <div class="alert alert-success alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times; &nbsp;</span>
								</button>
								<strong>Sukses!</strong> Bimbingan berhasil dihapus.
						 </div>'
					 );
					 redirect('users/bimbingan');

				}else{
					$p = "bimbingan/bimbingan";

					$data['judul_web'] 	  = "Data Bimbingan | Aplikasi SIPKISMK";
				}

					$this->load->view('users/header', $data);
					$this->load->view("users/pembimbing/$p", $data);
					$this->load->view('users/footer');


					if (isset($_POST['btnsimpan'])) {
						$nis	 					= htmlentities(strip_tags($this->input->post('nis')));
						$judul	 				= htmlentities(strip_tags($this->input->post('judul')));
						$catatan  	 		= htmlentities(strip_tags($this->input->post('catatan')));

						date_default_timezone_set('Asia/Jakarta');
						$tgl = date('Y-m-d');

						$cek_penempatan = $this->db->get_where('tbl_penempatan', "nis='$nis'");
						if ($cek_penempatan->num_rows() == 0) {
							$this->session->set_flashdata('msg',
								'
								<div class="alert alert-warning alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
									 </button>
									 <strong>Gagal!</strong> Mahasiswa belum menentukan tempat.
								</div>'
							);
							redirect('users/nilai/t');
						}else{

							$file_size = 1024 * 5; //5 MB
							$this->upload->initialize(array(
								"upload_path"   => "./lampiran/bimbingan/",
								"allowed_types" => "*",
								"max_size" => "$file_size"
							));

									if ( ! $this->upload->do_upload('file'))
									{
											$error = $this->upload->display_errors('<p>', '</p>');
											$this->session->set_flashdata('msg_file',
												 '
												 <div class="alert alert-warning alert-dismissible" role="alert">
														<button type="button" class="close" data-dismiss="alert" aria-label="Close">
															<span aria-hidden="true">&times; &nbsp;</span>
														</button>
														<strong>Gagal!</strong> '.$error.'.
												 </div>'
											 );

									 		redirect('users/bimbingan/t');
									}
									 else
									{
										$file = $this->upload->data();
										$filename = "lampiran/bimbingan/".$file['file_name'];
										$file 		= preg_replace('/ /', '_', $filename);

										$data = array(
											'kdpenempatan' => $cek_penempatan->row()->kdpenempatan,
											'nip'				   => $id_user,
											'nis'				   => $nis,
											'tanggal'			 => $tgl,
											'judul'			   => $judul,
											'catatan'			 => $catatan,
											'file'			   => $file
										);
										$this->db->insert('tbl_bimbingan', $data);

										$this->session->set_flashdata('msg',
											'
											<div class="alert alert-success alert-dismissible" role="alert">
												 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
													 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
												 </button>
												 <strong>Sukses!</strong> Bimbingan berhasil dikirim.
											</div>'
										);
										redirect('users/bimbingan');
									}
						}
					}

		}
  }


	public function nilai($aksi='', $id='')
	{
		$ceks = $this->session->userdata('prakrin_smk@Proyek-2017');
		$id_user = $this->session->userdata('id_user@Proyek-2017');
		$level = $this->session->userdata('level@Proyek-2017');
		if(!isset($ceks)) {
			redirect('web/login');
		}else{

			if ($level != 'pembimbing') {
				 redirect('web/error_not_found');
			}

			$data['user']   	 = $this->Mcrud->get_pemb_by_un($ceks);
			$this->db->join('tbl_penempatan','tbl_penempatan.nis=tbl_siswa.nis');
			$this->db->join('tbl_nilai','tbl_nilai.kdpenempatan=tbl_penempatan.kdpenempatan');
			if ($aksi == 'd') {
					$this->db->where('tbl_nilai.kdnilai', $id);
			}
			$this->db->order_by('tbl_siswa.nama_lengkap', 'ASC');
			$this->db->order_by('tbl_penempatan.tahun', 'DESC');
			$data['v_nilai'] 	 = $this->db->get('tbl_siswa');
			$data['email']		 = '';
			$data['level']		 = 'Pembimbing';

				if ($aksi == 't') {
					$p = "nilai/nilai_tambah";

					$data['judul_web'] 	  = "Nilai | Aplikasi SIPKISMK";
					$this->db->order_by('nis', 'DESC');
					$this->db->order_by('nama_lengkap', 'ASC');
					$data['v_siswa'] 	    = $this->db->get('tbl_siswa');
				}elseif ($aksi == 'd') {
					$p = "nilai/nilai_detail";

					$data['judul_web'] 	  = "Detail Nilai | Aplikasi SIPKISMK";
				}elseif ($aksi == 'h') {
					$this->db->delete('tbl_nilai', "kdnilai='$id'");

					$this->session->set_flashdata('msg',
						'
						<div class="alert alert-success alert-dismissible" role="alert">
							 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
							 </button>
							 <strong>Sukses!</strong> Nilai berhasil dihapus.
						</div>'
					);
					redirect('users/nilai');
				}else{
					$p = "nilai/nilai";

					$data['judul_web'] 	  = "Data Nilai | Aplikasi SIPKISMK";
				}

					$this->load->view('users/header', $data);
					$this->load->view("users/pembimbing/$p", $data);
					$this->load->view('users/footer');

					if (isset($_POST['btnsimpan'])) {
						$nis	 					= htmlentities(strip_tags($this->input->post('nis')));
						$nilai	 				= htmlentities(strip_tags($this->input->post('nilai')));
						$keterangan	 		= htmlentities(strip_tags($this->input->post('keterangan')));

						$cek_penempatan = $this->db->get_where('tbl_penempatan', "nis='$nis'");
						if ($cek_penempatan->num_rows() == 0) {
							$this->session->set_flashdata('msg',
								'
								<div class="alert alert-warning alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
									 </button>
									 <strong>Gagal!</strong> Mahasiswa belum menentukan tempat.
								</div>'
							);
							redirect('users/nilai/t');
						}else{
							$data = array(
								'kdpenempatan' => $cek_penempatan->row()->kdpenempatan,
								'keterangan'   => $keterangan,
								'nilai'				 => $nilai
							);
							$this->db->insert('tbl_nilai', $data);

							$this->session->set_flashdata('msg',
								'
								<div class="alert alert-success alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
									 </button>
									 <strong>Sukses!</strong> Nilai berhasil diisi.
								</div>'
							);
							redirect('users/nilai');
						}
					}

		}
  }




//---------------------------- Siswa ----------------------------//
	public function status_prakerin($aksi='', $id='')
	{
		$ceks = $this->session->userdata('prakrin_smk@Proyek-2017');
		$id_user = $this->session->userdata('id_user@Proyek-2017');
		$level = $this->session->userdata('level@Proyek-2017');
		if(!isset($ceks)) {
			redirect('web/login');
		}else{

			if ($level != 'siswa') {
				 redirect('web/error_not_found');
			}

			$cek_penempatan = $this->db->get_where('tbl_penempatan', array('nis' => "$id_user", 'status !=' => "ditolak"));
			
			$this->db->order_by('kdpenempatan', 'DESC');
			$cek_penempatan = $this->db->get_where('tbl_penempatan', array('nis' => "$id_user"));
            $cek_waktu = $this->db->get_where('tbl_industri', array('kdind' => "5"));
			$data['cek_penempatan'] = $cek_penempatan;
			$data['cek_waktu'] = $cek_waktu;
			$data['user']   	 = $this->Mcrud->get_siswa_by_nis($ceks);
			$data['email']		 = '';
			$data['level']		 = 'Siswa';

			if ($aksi == 't') {
				if ($this->db->get_where('tbl_penempatan', array('nis' => "$id_user", 'status !=' => "ditolak"))->num_rows() != 0) {
						redirect('web/error_not_found');
				}

				$p = "status/status_tambah";

				$data['judul_web'] 	  = "Daftar Penempatan Prakerin | Aplikasi SIPKISMK";

				$this->db->order_by('Judul', 'ASC');
				$data['v_industri']   = $this->db->get('tbl_industri');
			}else{
					$p = "status/status";

					$data['judul_web'] 	  = "Status Prakerin | Aplikasi SIPKISMK";

					$kdpenempatan  = $cek_penempatan->row()->kdpenempatan;
					$this->db->order_by('kdpenempatan', 'DESC');
					$data['query'] = $this->db->get_where("tbl_penempatan", "kdpenempatan = '$kdpenempatan'")->row();
			}

					$this->load->view('users/header', $data);
					$this->load->view("users/siswa/$p", $data);
					$this->load->view('users/footer');

					if (isset($_POST['btnsimpan'])) {
						$nama_industri	 				= htmlentities(strip_tags($this->input->post('nama_industri')));
						$wilayah	 				= htmlentities(strip_tags($this->input->post('wilayah')));
						$deskripsi	 				= htmlentities(strip_tags($this->input->post('deskripsi')));
						$alamat	 				= htmlentities(strip_tags($this->input->post('alamat')));
						$kdpemb						= $this->db->get_where('tbl_siswa', "nis='$id_user'")->row()->kdpemb;

						date_default_timezone_set('Asia/Jakarta');
						$tgl = date('Y-m-d');
						$tahun = date('Y');

							$file_size = 1024 * 5; //5 MB
							$this->upload->initialize(array(
								"upload_path"   => "./lampiran/surat/",
								"allowed_types" => "*",
								"max_size" => "$file_size"
							));

									if ( ! $this->upload->do_upload('file'))
									{
											$error = $this->upload->display_errors('<p>', '</p>');
											$this->session->set_flashdata('msg_file',
												 '
												 <div class="alert alert-warning alert-dismissible" role="alert">
														<button type="button" class="close" data-dismiss="alert" aria-label="Close">
															<span aria-hidden="true">&times; &nbsp;</span>
														</button>
														<strong>Gagal!</strong> '.$error.'.
												 </div>'
											 );

									 		redirect('users/status_prakerin/t');
									}
									 else
									{
										$file = $this->upload->data();
										$filename = $file['file_name'];
										$file 		= preg_replace('/ /', '_', $filename);

										$data = array(
											'nis'				   => $id_user,
											'kdpemb'		   => $kdpemb,
										
											'tanggal'			 => $tgl,
											'nama_industri'      => $nama_industri,
											'wilayah'			 => $wilayah,
												'deskripsi'			 => $deskripsi,
												'alamat'			 => $alamat,
											'tahun'			   => $tahun,
											'status'			 => 'proses',
											'surat'			   => $file
										);
										$this->db->insert('tbl_penempatan', $data);

										$this->session->set_flashdata('msg',
											'
											<div class="alert alert-success alert-dismissible" role="alert">
												 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
													 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
												 </button>
												 <strong>Sukses!</strong> Pendaftaran berhasil dikirim.
											</div>'
										);
										redirect('users/status_prakerin');
									}

					}

		}
	}

	public function bimbingan_siswa($aksi='', $id='')
	{
		$ceks = $this->session->userdata('prakrin_smk@Proyek-2017');
		$id_user = $this->session->userdata('id_user@Proyek-2017');
		$level = $this->session->userdata('level@Proyek-2017');
		if(!isset($ceks)) {
			redirect('web/login');
		}else{

			if ($level != 'siswa') {
				 redirect('web/error_not_found');
			}

			$data['user']   	 = $this->Mcrud->get_siswa_by_nis($ceks);
			$this->db->join('tbl_siswa', 'tbl_siswa.nis=tbl_bimbingan.nis');
			$this->db->where('tbl_siswa.nis', $id_user);
			if ($aksi == 'd') {
				$this->db->where('kdbimbingan', $id);
			}
			$this->db->order_by('kdbimbingan', 'DESC');
			$data['v_bimbingan'] 	 = $this->db->get('tbl_bimbingan');
			$data['email']		 = '';
			$data['level']		 = 'Siswa';

				if ($aksi == 'd') {
					$p = "bimbingan/bimbingan_detail";

					$data['judul_web'] 	  = "Detail Bimbingan | Aplikasi SIPKISMK";
				}else{
					$p = "bimbingan/bimbingan";

					$data['judul_web'] 	  = "Data Bimbingan | Aplikasi SIPKISMK";
				}

					$this->load->view('users/header', $data);
					$this->load->view("users/siswa/$p", $data);
					$this->load->view('users/footer');

		}
	}

	public function nilai_prakerin($aksi='', $id='')
	{
		$ceks = $this->session->userdata('prakrin_smk@Proyek-2017');
		$id_user = $this->session->userdata('id_user@Proyek-2017');
		$level = $this->session->userdata('level@Proyek-2017');
		if(!isset($ceks)) {
			redirect('web/login');
		}else{

			if ($level != 'siswa') {
				 redirect('web/error_not_found');
			}

			$data['user']   	 = $this->Mcrud->get_siswa_by_nis($ceks);
			$this->db->join('tbl_penempatan','tbl_penempatan.nis=tbl_siswa.nis');
			$this->db->join('tbl_nilai','tbl_nilai.kdpenempatan=tbl_penempatan.kdpenempatan');
			if ($aksi == 'd') {
					$this->db->where('tbl_nilai.kdnilai', $id);
			}
			$this->db->where('tbl_siswa.nis', $id_user);
			$this->db->order_by('tbl_siswa.nama_lengkap', 'ASC');
			$this->db->order_by('tbl_penempatan.tahun', 'DESC');
			$data['v_nilai'] 	 = $this->db->get('tbl_siswa');
			$data['email']		 = '';
			$data['level']		 = 'Siswa';

				if ($aksi == 'd') {
					$p = "nilai/nilai_detail";

					$data['judul_web'] 	  = "Detail Nilai | Aplikasi SIPKISMK";
				}else{
					$p = "nilai/nilai";

					$data['judul_web'] 	  = "Nilai | Aplikasi SIPKISMK";
				}

					$this->load->view('users/header', $data);
					$this->load->view("users/siswa/$p", $data);
					$this->load->view('users/footer');

		}
	}



	public function monitoring()
	{
		$ceks = $this->session->userdata('prakrin_smk@Proyek-2017');
		$id_user = $this->session->userdata('id_user@Proyek-2017');
		$level = $this->session->userdata('level@Proyek-2017');
		if(!isset($ceks)) {
			redirect('web/login');
		}else{

			if ($level != 'admin') {
				 redirect('404_override');
			}

			$data['user']   	 = $this->Mcrud->get_users_by_un($ceks);
			$this->db->order_by('nama', 'ASC');
			$data['v_jurusan'] = $this->db->get('tbl_jurusan');
			$data['email']		 = '';
			$data['level']		 = 'Admin';


					$p = "monitoring/monitoring";

					$data['judul_web'] 	  = "Monitoring | Aplikasi SIPKISMK";

					$this->load->view('users/header', $data);
					$this->load->view("users/admin/$p", $data);
					$this->load->view('users/footer');

		}
  }

}
