<?php
  $cek    = $user->row();
  $nama    = $cek->nama_lengkap;

  $tgl = date('m-Y');
?>

<!-- Main content -->
<div class="content-wrapper">
  <!-- Content area -->
  <div class="content">

    <!-- Dashboard content -->
    <div class="row">
      <!-- Basic datatable -->
      <div class="panel panel-flat bg-info">
        <div class="panel-heading">
          <h3 class="panel-title">
            <center>Selamat Datang, <?php echo ucwords($nama); ?></center>
          </h3>
        </div>
      </div>
      <!-- /basic datatable -->

      <div class="row">
        <div class="col-lg-12">

          <!-- Quick stats boxes -->
          <div class="row">
            <div class="col-lg-6">
              <!-- Current server load -->
              <div class="panel bg-orange-400">
                <div class="panel-body">
                  <div class="heading-elements">
                    <span class="heading-text"><i class="icon-users"></i></span>
                  </div>
                  <h3 class="no-margin">
                  <?php
                    echo number_format($this->db->query("SELECT * FROM tbl_industri")->num_rows(), 0,",",".");
                  ?>
                  </h3>
                  Jumlah Pendamping
                </div>
                <?php if ($level == 'Admin'): ?>
                <a href="users/data/pendamping" style="color:#f1f1f1;text-align:center;">
                <div id="server-load" style="border:1px solid #222;padding:10px;background:#333;">
                    Selengkapnya <i class="icon-circle-right2"></i>
                </div>
                </a>
                <?php endif; ?>
              </div>
              <!-- /current server load -->
            </div>

            <div class="col-lg-6">
              <!-- Current server load -->
              <div class="panel bg-teal-400">
                <div class="panel-body">
                  <div class="heading-elements">
                    <span class="heading-text"><i class="icon-piggy-bank"></i></span>
                  </div>
                  <h3 class="no-margin">
                  <?php
                    echo number_format($this->db->query("SELECT * FROM tbl_pemb")->num_rows(), 0,",",".");
                  ?></h3>
                  Jumlah Debitur
                </div>
                <?php if ($level == 'Admin'): ?>
                <a href="users/debitur" style="color:#f1f1f1;text-align:center;">
                <div id="server-load" style="border:1px solid #222;padding:10px;background:#333;">
                    Selengkapnya <i class="icon-circle-right2"></i>
                </div>
                </a>
                <?php endif; ?>
              </div>
              <!-- /current server load -->
            </div>

          </div>
          <!-- /quick stats boxes -->

          <div class="row">
            <div class="col-lg-12">

              <div class="calendar"></div>
              <div class="box"></div>
              <br>
            </div>

            <br>
          </div>

        </div>


      </div>

    </div>
    <!-- /dashboard content -->


    <script type="text/javascript">
    $(function() {
      function onClickHandler(date, obj) {
        /**
         * @date is an array which be included dates(clicked date at first index)
         * @obj is an object which stored calendar interal data.
         * @obj.calendar is an element reference.
         * @obj.storage.activeDates is all toggled data, If you use toggle type calendar.
               * @obj.storage.events is all events associated to this date
         */

        var $calendar = obj.calendar;
        var $box = $calendar.parent().siblings('.box').show();
        var text = 'Anda memilih tanggal ';

        if(date[0] !== null) {
          text += date[0].format('DD MMMM YYYY');
        }

        if(date[0] !== null && date[1] !== null) {
          text += ' ~ ';
        } else if(date[0] === null && date[1] == null) {
          text += 'tidak ada';
        }

        if(date[1] !== null) {
          text += date[1].format('DD MMMM YYYY');
        }

        $box.text(text);
      }

      $('.calendar').pignoseCalendar({
        lang: 'ind',
        select: onClickHandler,
        theme: 'blue' // light, dark, blue
      });
    });

    </script>
