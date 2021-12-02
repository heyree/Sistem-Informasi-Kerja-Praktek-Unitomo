<script src="assets/js/jquery-ui.js"></script>
<script>
$( function() {
  $( "#datepicker" ).datepicker();
} );
</script>
<div class="content-wrapper">
  <!-- Content area -->
  <div class="content">

    <!-- Dashboard content -->

  <div class="row">
            <!-- Basic datatable -->
    <div class="col-md-3"></div>
    <div class="panel panel-flat col-md-6">
      <div class="panel-heading">
        <h5 class="panel-title">Daftar Penempatan</h5>
        <div class="heading-elements">
          <ul class="icons-list">
            <li><a data-action="collapse"></a></li>
          </ul>
        </div>

        </div>
        <hr style="margin:0px;">
        <div class="panel-body">
          <?php
          echo $this->session->flashdata('msg');
          ?>
          <form action="" method="post" enctype="multipart/form-data">
            <div class="col-sm-12 pull-left" style="margin-top: 10px;">
              <label for="nama"><b>Nama Industris</b></label>
              <input type="text" class="form-control" id="nama_industri" name="nama_industri" value="" placeholder="Nama Industri" required>
            </div>
            <div class="col-sm-12 pull-left" style="margin-top: 10px;">
              <label for="wilayah"><b>Wilayah</b></label>
              <input type="text" class="form-control" id="wilayah" name="wilayah" value="" placeholder="Wilayah" required>
            </div>
             <div class="col-sm-12 pull-left" style="margin-top: 10px;">
              <label for="wilayah"><b>Alamat</b></label>
              <input type="text" class="form-control" id="alamat" name="alamat" value="" placeholder="Alamat" required>
            </div>
             <div class="col-sm-12 pull-left" style="margin-top: 10px;">
              <label for="wilayah"><b>Tentang Perusahaan Kerja Praktek</b></label>
              <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="" placeholder="Deskripsi" required>
            </div>
            <div class="col-sm-12 pull-left" style="margin-top: 10px;">
              <label for="surat"><b>Surat</b></label>
              <input type="file" class="form-control" id="surat" name="file" value="" placeholder="Surat">
            </div>
            <div class="col-sm-12 pull-left" style="margin-top: 10px;">
              <hr>
              <a href="javascript:history.back()" class="btn btn-default">Kembali</a>
              <button type="submit" name="btnsimpan" class="btn btn-primary" style="float:right;">Simpan</button>
              <button type="reset" class="btn btn-default" style="float:right;margin-right:10px;">Reset</button>
            </div>
        </form>

      </div>
    </div>
    <!-- /basic datatable -->
  </div>
  <!-- /dashboard content -->
