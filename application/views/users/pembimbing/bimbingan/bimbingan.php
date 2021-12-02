<style>
  @import url(http://fonts.googleapis.com/css?family=Calibri:400,300,700);

.mt-100 {
    margin-top: 100px
}

.mb-100 {
    margin-bottom: 100px
}

.card {
    position: relative;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -ms-flex-direction: column;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0px solid transparent;
    border-radius: 0px
}

.card-body {
    -webkit-box-flex: 1;
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    padding: 1.25rem
}

.card .card-title {
    position: relative;
    font-weight: 600;
    margin-bottom: 10px
}

.comment-widgets {
    position: relative;
    margin-bottom: 10px
}

.comment-widgets .comment-row {
    border-bottom: 1px solid transparent;
    padding: 14px;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    margin: 10px 0
}

.p-2 {
    padding: 0.5rem !important
}

.comment-text {
    padding-left: 15px
}

.w-100 {
    width: 100% !important
}

.m-b-15 {
    margin-bottom: 15px
}

.btn-sm {
    padding: 0.25rem 0.5rem;
    font-size: 0.76563rem;
    line-height: 1.5;
    border-radius: 1px
}

.btn-cyan {
    color: #fff;
    background-color: #27a9e3;
    border-color: #27a9e3
}

.btn-cyan:hover {
    color: #fff;
    background-color: #1a93ca;
    border-color: #198bbe
}

.comment-widgets .comment-row:hover {
    background: rgba(0, 0, 0, 0.05)
}
</style>
<?php
$sub_menu3 = strtolower($this->uri->segment(3)); ?>
<!-- Main content -->
<div class="content-wrapper">
  <!-- Content area -->
  <div class="content">
    <!-- Dashboard content -->
    <div class="row">
      <!-- Basic datatable -->
      <div class="panel panel-flat">
        <div class="panel-heading">
          <h6 class="panel-title"><i class="icon-book3"></i> Data Bimbingan <b><?php echo ucwords($user->row()->nama_lengkap); ?></b> <a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
          <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
                <li><a data-action="close"></a></li>
            </ul>
           </div>
        </div>

        <div class="panel-body">
                <?php
                echo $this->session->flashdata('msg');
                ?>
                <a href="<?=base_url('users/tambahBimbingan/'.$nis)?>" class="btn btn-success">Bimbingan</a>
                
                <!-- <table class="table table-bordered datatable-basic" width="100%">
                 <tbody>
                   <?php foreach ($v_bimbingan as $key => $value):?>
                    <?php if($value->source=='siswa'): ?>
                   <tr>
                     <td><?=$value->catatan?></td>
                     <td style="width: 10%;"></td>
                   </tr>
                   <?php elseif($value->source=='pembimbing'): ?>
                   <tr>
                     <td style="width: 10%;"></td>
                     <td><?=$value->catatan?></td>
                   </tr>
                   <?php endif; ?>
                   <?php endforeach; ?>
                 </tbody>
                </table> -->

<!-- use for comment session -->
<div class="row d-flex justify-content-center">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body text-center">
                <h4 class="card-title">History Bimbingan</h4>
            </div>
            <div class="comment-widgets">
                <!-- Comment Row -->
                <?php foreach ($v_bimbingan as $key => $value):?>
                <div class="d-flex flex-row comment-row m-t-0">
                    <div class="p-2">
                        <img src="<?php if($value->source=='siswa'){ echo base_url("foto/siswa/".$value->foto_siswa);} else{ echo base_url('foto/default.png');} ?>" alt="user" width="50" class="rounded-circle">
                    </div>
                    <div class="comment-text w-100">
                        <h6 class="font-medium"><?php if($value->source=='siswa'){  echo $value->nama_siswa;} else{ echo $value->nama_pembimbing;} ?></h6> <span class="m-b-15 d-block">Judul: <?=$value->judul?> <br>Catatan:<?=$value->catatan?></span>
                        <div class="comment-footer"> <span class="text-muted float-right"><?=$value->tanggal?></span>
                        <!-- <button type="button" class="btn btn-cyan btn-sm">Edit</button>  -->
                        <?php if($value->file!==null): ?>
                        <button type="button" class="btn btn-success btn-sm" onclick="showLampiran('<?=$value->file?>','<?=$value->type?>')">Lampiran</button>
                        <?php endif;?>
                        <!-- <button type="button" class="btn btn-danger btn-sm">Delete</button> </div> -->
                      </div>
                    </div>
                </div> 
                <?php endforeach; ?>
              
            </div> <!-- Card -->
        </div>
    </div>
</div>
<!-- end comment session -->
          </div>
        </div>
      </div>

      <!-- /basic datatable -->
    </div>
    <!-- /dashboard content -->
    <!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->
    <link href="assets/css/modal.css" rel="stylesheet" type="text/css">

  <div id="id01" class="w3-modal">
    <div class="w3-modal-content w3-card-4">
      <header class="w3-container w3-teal"> 
        <span onclick="document.getElementById('id01').style.display='none'" 
        class="w3-button w3-display-topright">&times;</span>
        <h4>Lampiran</h4>
      </header>
      <div class="w3-container">
        
      </div>
      <footer class="w3-container">
          <div class="lampiran">
             
          </div>
        <!-- <button type="submit" class="btn btn-success btn-xs">Simpan </button> -->
      </footer>
    </div>
  </div>
</div>
<script>
    function showLampiran(document,type) {
        $("#id01").attr('style','display:block') 
        let html="";
        if (type=='.pdf') {
            html=` <embed src="<?=base_url();?>${document}" style="width: 100%;height: 500px;" type="">`;
        } else{
            html=`<img src="<?=base_url();?>${document}" style="width: 100%;height: 500px;" alt="">`;
        }
        $(".lampiran").html(html)
        console.log(document);
        console.log(type);
     }
</script>