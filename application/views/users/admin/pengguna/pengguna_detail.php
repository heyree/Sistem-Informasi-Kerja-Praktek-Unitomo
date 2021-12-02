<?php
$sub_menu3 = strtolower($this->uri->segment(3));
$user = $query; ?>
<!-- Main content -->
<div class="content-wrapper">
  <!-- Content area -->
  <div class="content">

    <!-- Dashboard content -->
    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <div class="panel panel-flat">

            <div class="panel-body">

              <fieldset class="content-group">
                <legend class="text-bold"><i class="icon-user"></i> Detail Pengguna <?php if ($sub_menu3 == 'd_pemb') {echo "Pembimbing";}else{echo "Siswa";} ?></legend>
                <?php
                echo $this->session->flashdata('msg');
                ?>
                <center>
                  <img src="foto/<?php if ($sub_menu3 == 'd_pemb') { echo'default.png'; }else{echo "siswa/$user->foto";}?>" alt="<?php echo $user->nama_lengkap; ?>" class="img-circle" width="176" height="176">
                  <br>
                  <b>
                    <?php if ($sub_menu3 == 'd_pemb') {echo "Pembimbing";}else{echo "Siswa";} ?>
                  </b>
                </center>
                <hr>
                <?php
                if ($sub_menu3 == 'd_pemb') {?>
                <table width="100%" border=0>
                    <tr>
                      <th width="30%"><b>Username</b></th>
                      <td width="2%"><b>:</b>&nbsp;</td>
                      <td> <b><?php echo $user->username; ?></b></td>
                    </tr>
                    <tr>
                      <th><b>Nama Lengkap</b></th>
                      <td><b>:</b>&nbsp;</td>
                      <td> <?php echo ucwords($user->nama_lengkap); ?></td>
                    </tr>
                    <tr>
                      <th><b>NIP</b></th>
                      <td><b>:</b>&nbsp;</td>
                      <td> <?php echo $user->nip; ?></td>
                    </tr>
                    <tr>
                      <th><b>Jurusan</b></th>
                      <td><b>:</b>&nbsp;</td>
                      <td>
                        <?php $jurusan = $this->db->get_where('tbl_jurusan', "kdjurusan='$user->kdjurusan'")->row()->nama;
                        echo $jurusan; ?>
                      </td>
                    </tr>
                    <tr>
                      <th><b>Wilayah</b></th>
                      <td><b>:</b>&nbsp;</td>
                      <td> <?php echo ucwords($user->wilayah); ?></td>
                    </tr>
                </table>
                <?php
                }else{ ?>
                  <table width="100%" border=0>
                      <tr>
                        <th width="30%"><b>NIS</b></th>
                        <td width="2%"><b>:</b>&nbsp;</td>
                        <td> <b><?php echo $user->nis; ?></b></td>
                      </tr>
                      <tr>
                        <th><b>Nama Lengkap</b></th>
                        <td><b>:</b>&nbsp;</td>
                        <td> <?php echo ucwords($user->nama_lengkap); ?></td>
                      </tr>
                      <tr>
                        <th><b>Telp</b></th>
                        <td><b>:</b>&nbsp;</td>
                        <td> <?php echo $user->telp; ?></td>
                      </tr>
                      <tr>
                        <th><b>Kelas</b></th>
                        <td><b>:</b>&nbsp;</td>
                        <td>
                          <?php $kelas = $this->db->get_where('tbl_kelas', "kdkelas='$user->kdkelas'")->row();
                          echo $kelas->nama; ?>
                        </td>
                      </tr>
                      <tr>
                        <th><b>Jurusan</b></th>
                        <td><b>:</b>&nbsp;</td>
                        <td>
                          <?php $jurusan = $this->db->get_where('tbl_jurusan', "kdjurusan='$kelas->kdjurusan'")->row();
                          echo $jurusan->nama; ?>
                        </td>
                      </tr>
                      <tr>
                        <th><b>Nama Pembimbing</b></th>
                        <td><b>:</b>&nbsp;</td>
                        <td>
                          <b>
                          <?php $nama_pemb = $this->db->get_where('tbl_pemb', "kdpemb='$user->kdpemb'")->row();
                          echo $nama_pemb->nama_lengkap; ?>
                          </b>
                        </td>
                      </tr>
                  </table>
                <?php
                } ?>
                <hr>
                  <a href="javascript:history.back()" class="btn btn-default"><< Kembali</a>

              </fieldset>


            </div>

        </div>
      </div>
    </div>
    <!-- /dashboard content -->
