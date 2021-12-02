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
          <h6 class="panel-title"><i class="icon-office"></i> Data Info <a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
          <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
                <li><a data-action="close"></a></li>
            </ul>
           </div>
        </div>

        <div class="panel-body">
                <?php
                echo $this->session->flashdata('msg');
                ?>
                <a href="users/industri/t" class="btn btn-primary"><i class="icon-plus2"></i> Info Baru</a>

                <table class="table datatable-basic" width="100%">
                  <thead>
                    <tr>
                      <th width="30px;">No.</th>
                      <th width="100">Foto</th>
                      <th>Info KP</th>
                      <th>Status</th>
                      <th>Deskripsi</th>
                      <th class="text-center" width="170">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                      $no = 1;
                      foreach ($v_industri->result() as $baris) {
                      ?>
                        <tr>
                          <td><?php echo $no.'.'; ?></td>
                          <td><img src="foto/industri/<?php echo $baris->foto; ?>" alt="industri" width="100" height="100"></td>
                          <td><?php echo $baris->Judul; ?></td>
                          <td><?php echo $baris->Status; ?></td>
                          <td><?php echo $baris->deskripsi; ?></td>
                          <td>
                            <a href="users/industri/d/<?php echo $baris->kdind; ?>" class="btn btn-info btn-xs"><i class="icon-eye"></i></a>
                            <a href="users/industri/e/<?php echo $baris->kdind; ?>" class="btn btn-success btn-xs"><i class="icon-pencil7"></i></a>
                            <a href="users/industri/h/<?php echo $baris->kdind; ?>" class="btn btn-danger btn-xs" onclick="return confirm('Apakah Anda yakin?')"><i class="icon-trash"></i></a>
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

      <!-- /basic datatable -->
    </div>
    <!-- /dashboard content -->
