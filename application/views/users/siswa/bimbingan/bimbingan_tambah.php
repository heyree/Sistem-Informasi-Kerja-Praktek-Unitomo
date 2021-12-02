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
        <h5 class="panel-title">+ Bimbingan</h5>
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
          <form action="<?=base_url('costume/simpanBimbinganSiswa')?>" method="post" enctype="multipart/form-data">
            
            <div class="col-sm-12 pull-left" style="margin-top: 10px;">
              <label for="judul"><b>Judul</b></label>
              <input type="text" class="form-control" id="judul" name="judul" value="" placeholder="Judul" maxlength="50" required>
            </div>
            <div class="col-sm-12 pull-left" style="margin-top: 10px;">
              <label for="catatan"><b>Catatan</b></label>
              <textarea class="form-control" id="catatan" name="catatan" rows="4" cols="80" placeholder="Catatan" required></textarea>
            </div>
            <div class="col-sm-12 pull-left" style="margin-top: 10px;">
              <label for="file"><b>File</b></label>
              <input type="file" class="form-control" id="file" name="file" value="" placeholder="File" >
              <b style="color:red;font-size:10px;">*Max Size: 5 MB</b>
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
