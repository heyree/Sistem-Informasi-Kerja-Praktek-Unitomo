

<?php
$sub_menu3 = strtolower($this->uri->segment(3));
?>
<!-- Main content -->
<div class="content-wrapper">
  <!-- Content area -->
  <div class="content">

    <!-- Dashboard content -->
<?php if($status_pendaftaran == 0) { ?>
  <div class="row">
    <div class="col-md-12">
      <div class="alert alert-danger alert-dismissible" role="alert">
        <i class="icon-checkmark-circle"></i> Pengajuan Kerja Praktek Kerja Belum Dibuka
      </div>
    </div>
  </div>
  <!-- pal2019 -->
<?php } else {?>
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-success alert-dismissible" role="alert">
          <i class="icon-checkmark-circle"></i> Selamat Datang
        </div>
      </div>
    </div>
  <?php if ($cek_penempatan->num_rows() == 0){?>
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-danger alert-dismissible" role="alert">
          <strong>Anda belum memilih industri.</strong><br>
          CATATAN :
          <ol>
            <li>
              Jika Anda sudah memperoleh persetujuan dari industri silahkan mendaftar dengan memilih tombol daftar.
            </li>
            <li>
              Jika belum, silahkan unduh from permohonan kerja praktek dan kesediaan kerja praktek untuk industri dan mengisinya.
            </li>
            <li>
              Anda hanya bisa mendaftar 1 kali. Pilihlah industri yang benar-benar Anda inginkan.
            </li>
            <li>
              Jika ingin mengganti tempat industri, silahkan hubungi koordinator kerja praktek.
            </li>
          </ol>
          <hr>
          <a href="users/status_prakerin/t" class="btn btn-primary"><i class="icon-plus22"></i> Daftar</a>
          <a href="lampiran/surat/permohonan/permohonan.pdf" class="btn btn-success" target="_blank"><i class="icon-cloud-download"></i> Surat Permohonan</a>
          <a href="lampiran/surat/kesediaan/kesediaan.pdf" class="btn btn-danger" target="_blank"><i class="icon-cloud-download"></i> Surat Kesediaan</a>
        </div>
      </div>
    </div>
  <?php }else{?>
    <div class="row">
      <div class="col-md-12">
        <?php
      if ($cek_penempatan->row()->status == 'proses') {?>
            <div class="alert alert-warning alert-dismissible" role="alert">
              <i class="icon-spinner2 spinner"></i> <strong>Proses...</strong>, Menunggu persetujuan.
            </div>
          <?php

      }elseif ($cek_penempatan->row()->status == 'diterima') {
        error_reporting(0);
        $user = $query;
        $nama_siswa = $this->db->get_where('tbl_siswa', "nis='$user->nis'")->row()->nama_lengkap;
        if ($nama_siswa == '') {
            $nama_siswa = '-';
        }
        $nama_pembimbing = $this->db->get_where('tbl_pemb', "kdpemb='$user->kdpemb'")->row()->nama_lengkap;
        if ($nama_pembimbing == '') {
            $nama_pembimbing = '-';
        }
        $nama_industri = $this->db->get_where('tbl_penempatan', "kdpenempatan='$user->kdpenempatan'")->row()->nama_industri;
        if ($nama_industri == '') {
            $nama_industri = '-';
        }?>

        <div class="panel panel-flat">

            <div class="panel-body">

              <fieldset class="content-group">
                <legend class="text-bold"><i class="icon-cogs"></i> Status kerja praktek</legend>

                  <table width="100%" border=0>
                      <tr>
                        <th width="20%"><b>NIM</b></th>
                        <td width="2%"><b>:</b>&nbsp; </td>
                        <td> <b><?php echo $user->nis; ?></b></td>
                      </tr>
                      <tr>
                        <th><b>Nama Mahasiswa</b></th>
                        <td><b>:</b>&nbsp; </td>
                        <td> <?php echo ucwords($nama_siswa); ?></td>
                      </tr>
                      <tr>
                        <th><b>Nama Pembimbing</b></th>
                        <td><b>:</b>&nbsp; </td>
                        <td> <?php echo ucwords($nama_pembimbing); ?></td>
                      </tr>
                      <tr>
                        <th><b>Industri</b></th>
                        <td><b>:</b>&nbsp; </td>
                        <td> <?php echo ucwords($nama_industri); ?></td>
                      </tr>
                      <tr>
                        <th><b>Tanggal</b></th>
                        <td><b>:</b>&nbsp; </td>
                        <td> <?php echo ucwords($user->tanggal); ?></td>
                      </tr>
                      <tr>
                        <th><b>Wilayah</b></th>
                        <td><b>:</b>&nbsp; </td>
                        <td> <?php echo ucwords($user->wilayah); ?></td>
                      </tr>
                      <tr>
                        <th><b>Tahun</b></th>
                        <td><b>:</b>&nbsp; </td>
                        <td> <?php echo ucwords($user->tahun); ?></td>
                      </tr>
                      <tr>
                        <th><b>Status</b></th>
                        <td><b>:</b>&nbsp; </td>
                        <td>
                          <?php
                          if ($user->status == 'proses') {?>
                              <label class="label label-warning">Proses</label>
                          <?php
                        }elseif ($user->status == 'ditolak') {?>
                                <label class="label label-danger">Ditolak</label>
                            <?php
                          }elseif ($user->status == 'diterima') {?>
                              <label class="label label-success">Diterima</label>
                          <?php
                          }else{
                              echo "-";
                          }
                          ?>
                        </td>
                      </tr>

                      <tr>
                        <th><b>Surat</b></th>
                        <td><b>:</b>&nbsp; </td>
                        <td>
                          <?php if ($user->surat == '' or $user->surat == '-'){ ?>
                                  -
                          <?php }else{ ?>
                                  <a href="lampiran/surat/<?php echo $user->surat; ?>" target="_blank"><?php echo $user->surat; ?></a>
                          <?php } ?>
                        </td>
                      </tr>
                  </table>

                <hr>

              </fieldset>


            </div>

        </div>
        <?php
      }elseif ($cek_penempatan->row()->status == 'ditolak') {
          $kdpenempatan = $cek_penempatan->row()->kdpenempatan;
          $tolak = $this->db->get_where('tbl_tolak_penempatan', "kdpenempatan='$kdpenempatan'")->row();?>
          <div class="alert alert-danger alert-dismissible" role="alert">
            <i class="icon-cancel-circle2"></i> <strong>Penempatan kerja praktek ditolak</strong>, Pada tanggal <?php echo users::format($tolak->tanggal); ?> dikarenakan:
            <?php
            echo $tolak->alasan;?>
          </div>

          <div class="alert alert-danger alert-dismissible" role="alert">
            <strong>Anda belum memilih industri.</strong><br>
            CATATAN :
            <ol>
              <li>
                Jika Anda sudah memperoleh persetujuan dari industri silahkan mendaftar dengan memilih tombol daftar.
              </li>
              <li>
                Jika belum, silahkan unduh from permohonan kerja praktek dan kesediaan kerja praktek untuk industri dan mengisinya.
              </li>
              <li>
                Anda hanya bisa mendaftar 1 kali. Pilihlah industri yang benar-benar Anda inginkan.
              </li>
              <li>
                Jika ingin mengganti tempat industri, silahkan hubungi koordinator kerja praktek.
              </li>
              <li>
                PENGAJUAN SEBELUM PRODI MENENTUKAN JADWAL PENGAJUAN MAKA DIANGGAP TIDAK SAH
              </li>
            </ol>
            <hr>
            <a href="users/status_prakerin/t" class="btn btn-primary"><i class="icon-plus22"></i> Daftar Lagi</a>
            <a href="lampiran/surat/permohonan/permohonan.pdf" class="btn btn-success" target="_blank"><i class="icon-cloud-download"></i> Surat Permohonan</a>
            <a href="lampiran/surat/kesediaan/kesediaan.pdf" class="btn btn-danger" target="_blank"><i class="icon-cloud-download"></i> Surat Kesediaan</a>
          </div>
        <?php
        } ?>

      </div>
    </div>
  <?php } ?>
<?php } ?>
    <!-- /dashboard content -->
