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
                <legend class="text-bold"><i class="icon-office"></i>Info Praktek<?php echo ucwords($user->nama_industri); ?></legend>
                <?php
                echo $this->session->flashdata('msg');?>
                  <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <label class="control-label col-lg-3">Info Prakter</label>
                      <div class="col-lg-9">
                        <input type="text" name="nama_industri" class="form-control" value="<?php echo $user->Judul; ?>" placeholder="Nama Industri" maxlength="50" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-lg-3">Status</label>
                      <div class="col-lg-9">
<select name="Status" value="<?php echo $user->Status; ?>" >
<option value="1">Ditutup</option>
<option value="2">Dibuka</option>
</select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-lg-3">Deskripsi</label>
                      <div class="col-lg-9">
                        <textarea name="deskripsi" rows="4" cols="80" class="form-control" placeholder="Deskripsi" required><?php echo $user->deskripsi; ?></textarea>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-lg-3">Foto</label>
                      <div class="col-lg-9">
                        <input type="file" name="file" class="form-control" value="" placeholder="Foto">
                        <b style="color:red;font-size:10px;">*Max Size: 5 MB</b>
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
