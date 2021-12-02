<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Costume extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model', 'model');

    }

    public function index()
    {

    }
    public function getPembimbing(Type $var = null)
    {
        $data = $this->model->getData('tbl_pemb');
        echo json_encode($data);
    }
    public function simpanPembimbing(Type $var = null)
    {
        $nis = $this->input->post('nis');
        $kdpemb = $this->input->post('kdpemb');
        $insert = [
            'kdpemb' => $kdpemb,
        ];
        $this->model->updateData('tbl_siswa', 'nis', $nis, $insert);
        $this->model->updateData('tbl_penempatan', 'nis', $nis, $insert);
        $this->session->set_flashdata('msg',
            '
    <div class="alert alert-success alert-dismissible" role="alert">
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
         </button>
         <strong>Sukses!</strong> Pembimbing berhasil di simpan.
    </div>'
        );
        redirect('users/penempatan');
    }

    public function tes(Type $var = null)
    {
        $data = $this->session->userdata();
        $id_user = $this->session->userdata('id_user@Proyek-2017');
        $dosen = $this->model->findData('tbl_pemb', 'nip', $id_user)->row()->kdpemb;
        echo json_encode($dosen);
    }
    public function bimbingan($aksi = '', $id = '')
    {
        $ceks = $this->session->userdata('prakrin_smk@Proyek-2017');
        $id_user = $this->session->userdata('id_user@Proyek-2017');
        $level = $this->session->userdata('level@Proyek-2017');
        if (!isset($ceks)) {
            redirect('web/login');
        } else {

            $data['user'] = $this->Mcrud->get_pemb_by_un($ceks);
            $this->db->join('tbl_siswa', 'tbl_siswa.nis=tbl_bimbingan.nis');
            $this->db->where('nip', $id_user);
            if ($aksi == 'd') {
                $this->db->where('kdbimbingan', $id);
            }
            $this->db->order_by('kdbimbingan', 'DESC');
            $data['v_bimbingan'] = $this->db->get('tbl_bimbingan');
            $data['email'] = '';
            $data['level'] = 'Pembimbing';

            if ($aksi == 't') {
                $pembimbing = $this->model->findData('tbl_pemb', 'nip', $id_user)->row()->kdpemb;
                $p = "bimbingan/bimbingan_tambah";

                $data['judul_web'] = "Tambah Bimbingan | Aplikasi SIPKISMK";
                $this->db->order_by('nis', 'DESC');
                $this->db->order_by('nama_lengkap', 'ASC');
                $this->db->where('kdpemb', $pembimbing);
                $data['v_siswa'] = $this->db->get('tbl_siswa');
            } elseif ($aksi == 'd') {
                $p = "bimbingan/bimbingan_detail";

                $data['judul_web'] = "Detail Bimbingan | Aplikasi SIPKISMK";
            } elseif ($aksi == 'h') {

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

            } else {
                $p = "bimbingan/bimbingan";

                $data['judul_web'] = "Data Bimbingan | Aplikasi SIPKISMK";
            }

            $this->load->view('users/header', $data);
            $this->load->view("users/siswa/$p", $data);
            $this->load->view('users/footer');

            if (isset($_POST['btnsimpan'])) {
                $nis = htmlentities(strip_tags($this->input->post('nis')));
                $judul = htmlentities(strip_tags($this->input->post('judul')));
                $catatan = htmlentities(strip_tags($this->input->post('catatan')));

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
                } else {

                    $file_size = 1024 * 5; //5 MB
                    $this->upload->initialize(array(
                        "upload_path" => "./lampiran/bimbingan/",
                        "allowed_types" => "*",
                        "max_size" => "$file_size",
                    ));

                    if (!$this->upload->do_upload('file')) {
                        $error = $this->upload->display_errors('<p>', '</p>');
                        $this->session->set_flashdata('msg_file',
                            '
												 <div class="alert alert-warning alert-dismissible" role="alert">
														<button type="button" class="close" data-dismiss="alert" aria-label="Close">
															<span aria-hidden="true">&times; &nbsp;</span>
														</button>
														<strong>Gagal!</strong> ' . $error . '.
												 </div>'
                        );

                        redirect('users/bimbingan/t');
                    } else {
                        $file = $this->upload->data();
                        $filename = "lampiran/bimbingan/" . $file['file_name'];
                        $file = preg_replace('/ /', '_', $filename);

                        $data = array(
                            'kdpenempatan' => $cek_penempatan->row()->kdpenempatan,
                            'nip' => $id_user,
                            'nis' => $nis,
                            'tanggal' => $tgl,
                            'judul' => $judul,
                            'catatan' => $catatan,
                            'file' => $file,
                            'status' => 'siswa',
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
    public function simpanBimbinganSiswa(Type $var = null)
    {
        $ceks = $this->session->userdata('prakrin_smk@Proyek-2017');
        $id_user = $this->session->userdata('id_user@Proyek-2017');
        $level = $this->session->userdata('level@Proyek-2017');
        $nis = htmlentities(strip_tags($this->input->post('nis')));
        $judul = htmlentities(strip_tags($this->input->post('judul')));
        $catatan = htmlentities(strip_tags($this->input->post('catatan')));

        date_default_timezone_set('Asia/Jakarta');
        $tgl = date('Y-m-d');

        $cek_penempatan = $this->db->get_where('tbl_penempatan', "nis='$id_user'");
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
            redirect('users/buat_bimbingan/t');
        } else {

            $file_size = 1024 * 5; //5 MB
            $this->upload->initialize(array(
                "upload_path" => "./lampiran/bimbingan/",
                "allowed_types" => "*",
                "max_size" => "$file_size",
            ));

            if (!$this->upload->do_upload('file')) {
                $error = $this->upload->display_errors('<p>', '</p>');
                $checkPembimbing = $this->model->findData('tbl_siswa', 'nis', $id_user)->row();
                $pembimbing = $this->model->findData('tbl_pemb', 'kdpemb', $checkPembimbing->kdpemb)->row();
                $data = array(
                    'kdpenempatan' => $cek_penempatan->row()->kdpenempatan,
                    'nip' => $pembimbing->nip,
                    'nis' => $id_user,
                    'tanggal' => $tgl,
                    'judul' => $judul,
                    'catatan' => $catatan,
                    'source' => 'siswa',
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
                redirect('users/bimbingan_siswa');
            } else {
                $file = $this->upload->data();
                $filename = "lampiran/bimbingan/" . $file['file_name'];
                $type=$file['file_ext'];
                $file = preg_replace('/ /', '_', $filename);
                $checkPembimbing = $this->model->findData('tbl_siswa', 'nis', $id_user)->row();
                $pembimbing = $this->model->findData('tbl_pemb', 'kdpemb', $checkPembimbing->kdpemb)->row();
                $data = array(
                    'kdpenempatan' => $cek_penempatan->row()->kdpenempatan,
                    'nip' => $pembimbing->nip,
                    'nis' => $id_user,
                    'tanggal' => $tgl,
                    'judul' => $judul,
                    'catatan' => $catatan,
                    'file' => $file,
                    'source' => 'siswa',
                    'type'=>$type,
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
                // echo json_encode($data);
                redirect('users/bimbingan_siswa');
            }

        }
    }

}

/* End of file  Costume.php */
