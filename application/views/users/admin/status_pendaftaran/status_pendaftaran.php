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
          <h6 class="panel-title"><i class="icon-office"></i> Status Pendaftaran <a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
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
                <table class="table datatable-basic" width="100%">
                  <thead>
                    <tr>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                      $no = 1;
                      foreach ($v_status_pendaftaran->result() as $sp) {
                      ?>
                        <tr>
                          <td><?php echo $sp->status == 1 ? 'Dibuka' : 'Ditutup'; ?></td>
                          <td>
                            <a href="users/status_pendaftaran/e/<?php echo $sp->id; ?>" class="btn btn-success btn-xs"><i class="icon-pencil7"></i></a>
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
