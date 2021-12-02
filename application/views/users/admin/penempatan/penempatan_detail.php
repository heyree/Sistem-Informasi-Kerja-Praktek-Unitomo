<?php
error_reporting(0);
$sub_menu3 = strtolower($this->uri->segment(3));
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
}
?>
<!-- Main content -->
<div class="content-wrapper">
  <!-- Content area -->
  <div class="content">

    <!-- Dashboard content -->
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-flat">

            <div class="panel-body">

              <fieldset class="content-group">
                <legend class="text-bold"><i class="icon-link2"></i> Detail Penempatan <?php echo ucwords($nama_siswa); ?></legend>

                  <table width="100%" border=0>
                      <tr>
                        <th width="30%">NIM</th>
                        <td width="2%">:&nbsp; </td>
                        <td> <?php echo $user->nis; ?></td>
                      </tr>
                      <tr>
                        <th>Nama Mahasiswa</th>
                        <td>:&nbsp; </td>
                        <td> <?php echo ucwords($nama_siswa); ?></td>
                      </tr>
                      <tr>
                        <th>Nama Pembimbing</th>
                        <td>:&nbsp; </td>
                        <td> <?php echo ucwords($nama_pembimbing); ?></td>
                      </tr>
                      <tr>
                        <th>Nama Industri</th>
                        <td>:&nbsp; </td>
                        <td> <?php echo ucwords($nama_industri); ?></td>
                      </tr>
                      <tr>
                        <th>Tanggal</th>
                        <td>:&nbsp; </td>
                        <td> <?php echo ucwords($user->tanggal); ?></td>
                      </tr>
                      <tr>
                        <th>Wilayah</th>
                        <td>:&nbsp; </td>
                        <td> <?php echo ucwords($user->wilayah); ?></td>
                      </tr>
                      <tr>
                        <th>Tahun</th>
                        <td>:&nbsp; </td>
                        <td> <?php echo ucwords($user->tahun); ?></td>
                      </tr>
                      <tr>
                        <th>Status</th>
                        <td>:&nbsp; </td>
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
                        <th>Surat</th>
                        <td>:&nbsp; </td>
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
                  <a href="javascript:history.back()" class="btn btn-default"><< Kembali</a>

              </fieldset>


            </div>

        </div>
      </div>
    </div>
    <!-- /dashboard content -->
