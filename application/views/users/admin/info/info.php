<?php
$sub_menu3 = strtolower($this->uri->segment(3)); ?>

<div class="content-wrapper">
  <!-- Content area -->
  <div class="content">

    <!-- Dashboard content -->

  <div class="row">
            <!-- Basic datatable -->
            <div class="panel panel-flat">
              <div class="panel-heading">
                <h6 class="panel-title"><i class="icon-info22"></i> Kelola Informasi <a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
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
                    <li class="<?php if($sub_menu3 == ''){echo 'active';} ?>"><a href="#t_info" data-toggle="tab" aria-expanded="true"><i class="icon-info22"></i> INFORMASI</a></li>
                    <li class="<?php if($sub_menu3 == 'u_f'){echo 'active';} ?>"><a href="#t_u_f" data-toggle="tab" aria-expanded="true"><i class="icon-cloud-upload"></i> UPLOAD FILE</a></li>
                  </ul>

                  <div class="tab-content">
                    <div class="tab-pane <?php if($sub_menu3 == ''){echo 'active';} ?>" id="t_info">

                      <?php
                      echo $this->session->flashdata('msg_t');
                      ?>

                      <a href="users/info/t" class="btn btn-primary" style="margin-bottom:10px;">Tambah Data +</a>
                      <label class="label label-default" style="float:right;"> <i class="glyphicon glyphicon-tags"></i>&nbsp; Label :
                          <select class="label label-default cari_label" name="label" onchange="tbl_info(this.value)">
                            <option value="0">Semua</option>
                            <?php foreach ($v_label->result() as $baris): ?>
                              <option value="<?php echo $baris->kdlabel; ?>"><?php echo $baris->nama_label; ?></option>
                            <?php endforeach; ?>
                          </select>
                      </label>
                      <button type="button" name="refresh" class="btn btn-default" onclick="reload_tbl_info()" style="float:right;margin-right:10px;"><i class="glyphicon glyphicon-refresh"></i> Refresh</button>

                          <div id='tbl_info'></div>

                    </div>

                    <div class="tab-pane <?php if($sub_menu3 == 'u_f'){echo 'active';} ?>" id="t_u_f">
                      <script src="assets/js/jquery-ui.js"></script>
                      <script>
                      $( function() {
                        $( "#datepicker" ).datepicker();
                      } );
                      </script>
                      <?php
                      echo $this->session->flashdata('msg_file');
                      ?>
                      <form action="" method="post" enctype="multipart/form-data">
                        <div class="col-sm-12 pull-left" style="margin-top: 10px;">
                          <label for="judul"><b>Judul</b></label>
                          <input type="text" class="form-control" id="judul" name="judul" value="" placeholder="Judul" required>
                        </div>
                        <div class="col-sm-6 pull-left" style="margin-top: 10px;">
                          <label for="file"><b>File</b></label>
                          <input type="file" class="form-control" id="file" name="file" value="" placeholder="File" required>
                          <b style="color:red;font-size:10px;">*Max Size: 5 MB</b>
                        </div>
                        <div class="col-sm-6 pull-left" style="margin-top: 10px;">
                          <label for="datepicker"><b>Tanggal</b></label>
                          <input type="text" class="form-control daterange-single" id="datepicker" name="tanggal" value="<?php echo date('d-m-Y'); ?>" placeholder="Tanggal-Bulan-Tahun, Contoh: <?php echo date('d-m-Y'); ?>" maxlength="10" required>
                        </div>
                        <div class="col-sm-12 pull-left" style="margin-top: 10px;">
                          <label for="keterangan"><b>Keterangan</b></label>
                          <textarea class="form-control" id="keterangan" name="keterangan" rows="4" cols="80" placeholder="Keterangan" required></textarea>
                        </div>
                        <div class="col-sm-12 pull-left" style="margin-top: 10px;">
                          <hr>
                          <button type="submit" name="btnupfile" class="btn btn-primary" style="float:right;">Simpan</button>
                          <button type="reset" class="btn btn-default" style="float:right;margin-right:10px;">Reset</button>
                        </div>
                      </form>
                      <div class="col-sm-12 pull-left" style="margin-top: 10px;">
                        <hr>
                        <button type="button" name="refresh" class="btn btn-default" onclick="tbl_file()"><i class="glyphicon glyphicon-refresh"></i> Refresh</button>

                        <div id='tbl_file'></div>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>

    </div>
    <!-- /dashboard content -->

<script type="text/javascript">

  $(document).ready(function() {
    tbl_info();
    tbl_file();
  });

  function tbl_info(id_label)
  {
    $.ajax({
       url:"<?php echo site_url('users/data_info/')?>"+id_label,
       type: "GET",
       success:function(data){
         $("#tbl_info").html(data);
      }
    });
  }

  function tbl_file()
  {
    $.ajax({
       url:"<?php echo site_url('users/data_file/')?>",
       type: "GET",
       success:function(data){
         $("#tbl_file").html(data);
      }
    });
  }

  function reload_tbl_info()
  {
    id_label = $('select[name=label]').val();
    tbl_info(id_label);
  }

</script>
