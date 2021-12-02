<div class="container" style="margin-top:-40px;">


      <div class="breadcrumb-line breadcrumb-line-component"><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
						<ul class="breadcrumb">
							<li><a href=""><i class="icon-home2 position-left"></i> Beranda</a></li>
							<li class="active">Informasi</li>
						</ul>
			</div>
      <br>

      <div class="col-md-8">
        <div class="panel panel-default">
          <div class="panel-body">
            <?php
            if (isset($_POST['btncari'])) {
                if ($v_info->num_rows() == 0) {
                  echo "<b><center>Pencarian Info tidak ditemukan</center></b>";
                }
            }
            foreach ($v_info->result() as $baris) {?>
              <div class="col-md-12">
                <br>
                <div class="col-md-3">
                  <img src="<?php echo $baris->gambar; ?>" alt="gambar" min-width="176" max-width="176" min-height="176" max-height="176" class="img-responsive">
                </div>
                <div class="col-md-9">
                  <a href="web/info/<?php echo $baris->kdinfo; ?>" style="font-size:25px;"><?php echo $baris->judul; ?></a>
                  <br>
                  <?php
                  echo substr($baris->deskripsi,0, 300);
                   ?>...
                   <br><br>
                   <div class="" style="font-size:12px;color:gray;">
                     <i class="glyphicon glyphicon-tags" style="font-size:10px;"></i> <?php echo $baris->nama_label; ?> &nbsp;&nbsp;
                     <i class="glyphicon glyphicon-calendar" style="font-size:10px;"></i> <?php echo $this->Mcrud->format($baris->tanggal); ?> *
                     <a href="web/info/<?php echo $baris->kdinfo; ?>">Read More</a>
                   </div>
                </div>
              </div>
              <div class="col-md-12">
                <br>
                <hr>
              </div>
            <?php
            } ?>
          </div>
        </div>
      </div>

      <?php $this->load->view('web/widget'); ?>

</div>
