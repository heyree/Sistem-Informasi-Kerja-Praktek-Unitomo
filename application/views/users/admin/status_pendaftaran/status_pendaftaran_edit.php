<?php
$sub_menu3 = strtolower($this->uri->segment(3));
$user = $query;  ?>
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
                <legend class="text-bold"><i class="icon-office"></i>Status Pendaftaran</legend>
                <?php
                echo $this->session->flashdata('msg');?>
                  <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <label class="control-label col-lg-3">Status</label>
                      <div class="col-lg-9">
                        <select name="status">
                          <?php if($user->status == 0) { ?>
                          <option value="0" selected >Ditutup</option>
                          <option value="1">Dibuka</option>
                          <?php } else { ?>
                          <option value="0">Ditutup</option>
                          <option value="1" selected >Dibuka</option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>

                    <a href="javascript:history.back()" class="btn btn-default"><< Kembali</a>
                    <button type="submit" name="btnupdate" class="btn btn-primary" style="float:right;">Simpan</button>
                  </form>
              </fieldset>


            </div>

        </div>
      </div>
    </div>
    <!-- /dashboard content -->
