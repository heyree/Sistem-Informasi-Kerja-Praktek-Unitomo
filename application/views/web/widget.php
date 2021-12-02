<div class="col-md-4">

  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-body">
        <form action="web/info" method="post">
          <input type="search" name="cari" value="" class="form-control" placeholder="Pencarian Info...">
          <input type="submit" name="btncari" class="btn btn-info" value="Cari Info" style="float:right;margin-top:-36px;">
        </form>
        <br>
        <?php
        foreach ($v_label->result() as $baris) {?>
          <label class="label label-default"><?php echo $baris->nama_label; ?></label>
        <?php
        } ?>
      </div>
    </div>
  </div>

  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 style="margin:0px;">Berita Terkini</h4>
      </div>
      <div class="panel-body">
        <?php
        foreach ($v_info->result() as $baris) { ?>
        <div class="col-md-12">
          <a href="web/info/<?php echo $baris->kdinfo; ?>" style="font-size:16px;">
          <div class="col-md-3">
            <img src="<?php echo $baris->gambar; ?>" alt="gambar" min-width="176" max-width="176" min-height="176" max-height="176" class="img-responsive">
          </div>
          <div class="col-md-9">
            <?php echo $baris->judul; ?>
          </div>
          </a>
        </div>
        <div class="col-md-12">
          <br>
        </div>
        <?php
        } ?>
      </div>
    </div>
  </div>

</div>
