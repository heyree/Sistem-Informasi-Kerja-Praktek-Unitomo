
  <?php
  $baris = $v_info->row();?>
<div class="container" style="margin-top:-40px;">

      <div class="breadcrumb-line breadcrumb-line-component"><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
						<ul class="breadcrumb">
							<li><a href=""><i class="icon-home2 position-left"></i> Beranda</a></li>
							<li><a href="web/info">Informasi</a></li>
              <li class="active"><?php echo $baris->judul; ?></li>
						</ul>
			</div>
      <br>

      <div class="col-md-8">
        <div class="panel panel-default">
          <div class="panel-body">
            <a href="web/info/<?php echo $baris->kdinfo; ?>" style="font-size:25px;"><?php echo $baris->judul; ?></a>
            <br>
            <div class="" style="font-size:12px;color:gray;">
              <i class="glyphicon glyphicon-user" style="font-size:10px;"></i> <?php echo $baris->penulis; ?> &nbsp;&nbsp;
              <i class="glyphicon glyphicon-tags" style="font-size:10px;"></i> <?php echo $baris->nama_label; ?> &nbsp;&nbsp;
              <i class="glyphicon glyphicon-calendar" style="font-size:10px;"></i> <?php echo $this->Mcrud->format($baris->tanggal); ?>
            </div>
            <hr>

                <center>
                  <img src="<?php echo $baris->gambar; ?>" alt="gambar" min-width="176" max-width="176" min-height="176" max-height="176" class="img-responsive">
                </center>
                <br>
                  <?php
                  echo $baris->deskripsi;
                   ?>...
                   <br><br>

          </div>
        </div>
      </div>

      <?php $this->load->view('web/widget'); ?>

</div>
