<?php
$sub_menu3 = strtolower($this->uri->segment(3)); ?>
<!-- Main content -->
<div class="content-wrapper">
  <!-- Content area -->
  <div class="content">
    <!-- Dashboard content -->
    <div class="row">
      <!-- Basic datatable -->
      <div class="panel panel-flat">
        <div class="panel-heading">
          <h6 class="panel-title"><i class="icon-users"></i> Data Pengguna <a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
          <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
                <li><a data-action="close"></a></li>
            </ul>
           </div>
        </div>

        <div class="panel-body">
          <div class="tabbable">
            <ul class="nav nav-tabs nav-tabs-highlight nav-justified">
              <li class="<?php if($sub_menu3 == ''){echo 'active';} ?>"><a href="#tbl_pemb" data-toggle="tab" aria-expanded="true">+ Pembimbing</a></li>
              <li class="<?php if($sub_menu3 == 'tbl_siswa'){echo 'active';} ?>"><a href="#tbl_siswa" data-toggle="tab" aria-expanded="true">+ Mahasiswa</a></li>
            </ul>

            <div class="tab-content">
              <div class="tab-pane <?php if($sub_menu3 == ''){echo 'active';} ?>" id="tbl_pemb">

                <?php
                echo $this->session->flashdata('msg_pemb');
                ?>
                <a href="users/pengguna/t_pemb" class="btn btn-primary"><i class="icon-user-plus"></i> Pembimbing Baru</a>

                <table class="table datatable-basic" width="100%">
                  <thead>
                    <tr>
                      <th width="30px;">No.</th>
                      <th>Username</th>
                      <th>Nama Lengkap</th>
                      <th>NIP</th>
                      <th class="text-center" width="130">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                      $no = 1;
                      foreach ($v_pemb->result() as $baris) {
                      ?>
                        <tr>
                          <td><?php echo $no.'.'; ?></td>
                          <td><?php echo $baris->username; ?></td>
                          <td><?php echo $baris->nama_lengkap; ?></td>
                          <td><?php echo $baris->nip; ?></td>
                          <td>
                            <a href="users/pengguna/d_pemb/<?php echo $baris->kdpemb; ?>" class="btn btn-info btn-xs"><i class="icon-eye"></i></a>
                            <!-- <a href="users/pengguna/e_pemb/<?php echo $baris->kdpemb; ?>" class="btn btn-success btn-xs"><i class="icon-pencil7"></i></a> -->
                            <a href="users/pengguna/h_pemb/<?php echo $baris->kdpemb; ?>" class="btn btn-danger btn-xs" onclick="return confirm('Apakah Anda yakin?')"><i class="icon-trash"></i></a>
                          </td>
                        </tr>
                      <?php
                      $no++;
                      } ?>
                  </tbody>
                </table>

              </div>

              <div class="tab-pane <?php if($sub_menu3 == 'tbl_siswa'){echo 'active';} ?>" id="tbl_siswa">

                <?php
                echo $this->session->flashdata('msg_siswa');
                ?>
                <a href="users/pengguna/t_siswa" class="btn btn-primary"><i class="icon-user-plus"></i> Mahasiswa Baru</a>

                <table class="table datatable-basic" width="100%">
                  <thead>
                    <tr>
                      <th width="30px;">No.</th>
                      <th>NIM</th>
                      <th>Nama Lengkap</th>
                      <th>Telp</th>
                      <th>Nama Pembimbing</th>
                      <th class="text-center" width="130">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                      error_reporting(0);
                      $no = 1;
                      foreach ($v_siswa->result() as $baris) {
                        $nama_pembimbing = $this->db->get_where('tbl_pemb', "kdpemb='$baris->kdpemb'")->row()->nama_lengkap;
                        if ($nama_pembimbing == '') {
                            $nama_pembimbing = 'Belum Ada Pembimbing';
                        }
                      ?>
                        <tr>
                          <td><?php echo $no.'.'; ?></td>
                          <td><?php echo $baris->nis; ?></td>
                          <td><?php echo $baris->nama_lengkap; ?></td>
                          <td><?php echo $baris->telp; ?></td>
                          <td><?php echo $nama_pembimbing; ?>
                          </td>
                          <td>
                            <a href="users/pengguna/d_siswa/<?php echo $baris->nis; ?>" class="btn btn-info btn-xs"><i class="icon-eye"></i></a>
                            <!-- <a href="users/pengguna/e_siswa/<?php echo $baris->nis; ?>" class="btn btn-success btn-xs"><i class="icon-pencil7"></i></a> -->
                            <a href="users/pengguna/h_siswa/<?php echo $baris->nis; ?>" class="btn btn-danger btn-xs" onclick="return confirm('Apakah Anda yakin?')"><i class="icon-trash"></i></a>
                          </td>
                        </tr>
                      <?php
                      $no++;
                      } ?>
                  </tbody>
                </table>

              </div>
            </div>

          </div>
        </div>
      </div>

      <!-- /basic datatable -->
    </div>
    <!-- /dashboard content -->
