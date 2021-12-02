<?php
$sub_menu3 = strtolower($this->uri->segment(3)); ?>
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
                <legend class="text-bold"><i class="icon-office"></i> Tambah Info</legend>
                <?php
                echo $this->session->flashdata('msg');?>
                  <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                      <div class="form-group">
                      <label class="control-label col-lg-3">Info Kerja Praktek</label>
                      <div class="col-lg-9">
                        <input type="text" name="Judul" class="form-control" value="" placeholder="Info" maxlength="50" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-lg-3">Status</label>
                      <div class="col-lg-9">
                        <select name="Status">
<option value="1">Ditutup</option>
<option value="2">Sudah Dibuka</option>
</select>
                      </div>
                    </div>
      <div class="form-group">
                      <label class="control-label col-lg-3">Deskripsi</label>
                      <div class="col-lg-9">
                        <input type="text" name="deskripsi" class="form-control" value="" placeholder="Deskripsi" maxlength="50" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-lg-3">Persyaratan</label>
                      <div class="col-lg-9">
                        <input type="file" name="file" class="form-control" value="" placeholder="Foto" required>
                        <b style="color:red;font-size:10px;">*Max Size: 5 MB</b>
                      </div>
                    </div>

                    <a href="javascript:history.back()" class="btn btn-default"><< Kembali</a>
                    <button type="submit" name="btnsimpan" class="btn btn-primary" style="float:right;">Simpan</button>
                  </form>
              </fieldset>


            </div>

        </div>
      </div>
    </div>
    <!-- /dashboard content -->
