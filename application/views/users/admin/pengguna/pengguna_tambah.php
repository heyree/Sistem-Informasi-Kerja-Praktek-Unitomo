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
                <legend class="text-bold"><i class="icon-user-plus"></i> Tambah Pengguna <?php if ($sub_menu3 == 't_pemb') {echo "Pembimbing";}else{echo "Mahasiswa";} ?></legend>
                <?php
                echo $this->session->flashdata('msg');

                if ($sub_menu3 == 't_pemb') {?>
                <form class="form-horizontal" action="" method="post">
                  <div class="form-group">
                    <label class="control-label col-lg-3">Nama Jurusan</label>
                    <div class="col-lg-9">
                      <select class="form-control cari_jurusan" name="jurusan" required style="width:100%;">
                        <option value="">-- Pilih Jurusan --</option>
                        <?php foreach ($v_jurusan->result() as $baris){ ?>
                          <option value="<?php echo $baris->kdjurusan; ?>"><?php echo $baris->nama; ?></option>
                        <?php }; ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Username & Password</label>
                    <div class="col-lg-9">
                      <input type="text" name="username" class="form-control" value="" placeholder="Username" maxlength="32" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-lg-3">NIP</label>
                    <div class="col-lg-9">
                      <input type="text" name="nip" class="form-control" value="" placeholder="NIP" maxlength="21" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-lg-3">Nama Lengkap</label>
                    <div class="col-lg-9">
                      <input type="text" name="nama_lengkap" class="form-control" value="" placeholder="Nama Lengkap" maxlength="50" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-lg-3">Wilayah</label>
                    <div class="col-lg-9">
                      <input type="text" name="wilayah" class="form-control" value="" placeholder="Nama Lengkap" maxlength="50" required>
                    </div>
                  </div>

                  <a href="javascript:history.back()" class="btn btn-default"><< Kembali</a>
                  <button type="submit" name="btnsimpan" class="btn btn-primary" style="float:right;">Simpan</button>
                </form>
                <?php
                }else{ ?>
                  <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <label class="control-label col-lg-3">Nama Kelas</label>
                      <div class="col-lg-9">
                        <select class="form-control cari_kelas" name="kelas" required style="width:100%;">
                          <option value="">-- Pilih Kelas --</option>
                          <?php foreach ($v_kelas->result() as $baris){ ?>
                            <option value="<?php echo $baris->kdkelas; ?>"><?php echo $baris->nama; ?></option>
                          <?php }; ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-lg-3">NIM & Password</label>
                      <div class="col-lg-9">
                        <input type="text" name="nis" class="form-control" value="" placeholder="NIM" maxlength="11" required>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-lg-3">Telp</label>
                      <div class="col-lg-9">
                        <input type="text" name="telp" class="form-control" value="" placeholder="Telp" maxlength="14" required>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-lg-3">Nama Lengkap</label>
                      <div class="col-lg-9">
                        <input type="text" name="nama_lengkap" class="form-control" value="" placeholder="Nama Lengkap" maxlength="50" required>
                      </div>
                    </div>

                    <!-- <div class="form-group">
                      <label class="control-label col-lg-3">Nama Pembimbing</label>
                      <div class="col-lg-9">
                        <select class="form-control cari_pemb" name="kdpemb" required style="width:100%;">
                          <option value="">-- Pilih Pembimbing --</option>
                          <?php foreach ($v_pemb->result() as $baris){ ?>
                            <option value="<?php echo $baris->kdpemb; ?>"><?php echo $baris->nama_lengkap; ?></option>
                          <?php }; ?>
                        </select>
                      </div>
                    </div> -->

                    <div class="form-group">
                      <label class="control-label col-lg-3">Foto</label>
                      <div class="col-lg-9">
                        <input type="file" name="file" class="form-control" value="" placeholder="Foto" required>
                        <b style="color:red;font-size:10px;">*Max Size: 5 MB</b>
                      </div>
                    </div>

                    <a href="javascript:history.back()" class="btn btn-default"><< Kembali</a>
                    <button type="submit" name="btnsimpan2" class="btn btn-primary" style="float:right;">Simpan</button>
                  </form>
                <?php
                } ?>
              </fieldset>


            </div>

        </div>
      </div>
    </div>
    <!-- /dashboard content -->
