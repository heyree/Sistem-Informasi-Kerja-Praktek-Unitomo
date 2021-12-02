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
                <legend class="text-bold"><i class="icon-user"></i> Edit <?php if ($sub_menu3 == 'e_kelas') {echo "Kelas";}else{echo "Jurusan";} ?></legend>
                <?php
                echo $this->session->flashdata('msg');
                if ($sub_menu3 == 'e_kelas') {?>
                <form class="form-horizontal" action="" method="post">
                  <div class="form-group">
                    <label class="control-label col-lg-3">Nama Kelas</label>
                    <div class="col-lg-9">
                      <input type="text" name="kelas" class="form-control" value="<?php echo $user->nama; ?>" placeholder="Nama Kelas" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Nama Jurusan</label>
                    <div class="col-lg-9">
                      <select class="form-control cari_jurusan" name="jurusan" required style="width:100%;">
                        <option value="">-- Pilih Jurusan --</option>
                        <?php foreach ($v_jurusan->result() as $baris){ ?>
                          <option value="<?php echo $baris->kdjurusan; ?>" <?php if($user->kdjurusan == $baris->kdjurusan){echo "selected";} ?>><?php echo $baris->nama; ?></option>
                        <?php }; ?>
                      </select>
                    </div>
                  </div>

                  <a href="javascript:history.back()" class="btn btn-default"><< Kembali</a>
                  <button type="submit" name="btnupdate" class="btn btn-primary" style="float:right;">Update</button>
                </form>
                <?php
                }else{ ?>
                <form class="form-horizontal" action="" method="post">
                  <div class="form-group">
                    <label class="control-label col-lg-3">Nama Jurusan</label>
                    <div class="col-lg-9">
                      <input type="text" name="jurusan" class="form-control" value="<?php echo $user->nama; ?>" placeholder="Nama Jurusan" required>
                    </div>
                  </div>

                  <a href="javascript:history.back()" class="btn btn-default"><< Kembali</a>
                  <button type="submit" name="btnupdate" class="btn btn-primary" style="float:right;">Update</button>
                </form>
                <?php
                } ?>

              </fieldset>


            </div>

        </div>
      </div>
    </div>
    <!-- /dashboard content -->
