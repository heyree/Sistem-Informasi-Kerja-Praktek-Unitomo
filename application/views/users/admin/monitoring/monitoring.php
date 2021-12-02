<?php
$thn = date('Y'); ?>
<style>
    .circle-chart {
      width: 100px;
      position: relative;
      display: inline-block;
      margin-right: 2em;

    }
    .circle-chart__text {
      position: absolute;
      width: 100%;
      height: 100%;
      text-align: center;
      left: 0;
      top: 0;
      line-height: 4;
      font-family: sans-serif;
      /*font-size: 12px;*/
      font-weight: bold;
    }
  </style>

  <script type="text/javascript">
    var chart1; // globally available
  $(document).ready(function() {
        chart1 = new Highcharts.Chart({
           chart: {
              renderTo: 'grafik',
              type: 'column'
           },
           title: {
              text: 'Grafik Nilai KP - Total'
           },
           xAxis: {
              categories: ['Jurusan']
           },
           yAxis: {
              title: {
                 text: ''
              }
           },
                series:
              [
              <?php
              foreach ($v_jurusan->result() as $baris) {

                $nilai = $this->db->query("SELECT AVG(tbl_nilai.nilai) AS total FROM tbl_siswa
                                            INNER JOIN tbl_kelas ON tbl_kelas.kdkelas=tbl_siswa.kdkelas
                                            INNER JOIN tbl_jurusan ON tbl_jurusan.kdjurusan=tbl_kelas.kdjurusan
                                            INNER JOIN tbl_penempatan ON tbl_penempatan.nis=tbl_siswa.nis
                                            INNER JOIN tbl_nilai ON tbl_nilai.kdpenempatan=tbl_penempatan.kdpenempatan
                                              WHERE
                                                  tbl_jurusan.kdjurusan='$baris->kdjurusan'
                                              AND
                                                  tbl_penempatan.tahun='$thn'
                                          ")->row()->total;

              ?>
                    {
                        name: '<?php echo strtoupper($baris->nama); ?>',
                        data: [<?php echo $nilai; ?>]
                    },
              <?php
              }?>

              ]
        });
     });
  </script>


<!-- Main content -->
<div class="content-wrapper">

  <!-- Content area -->
  <div class="content">

    <div class="row">

      <div class="col-md-8">
      <div class="panel panel-flat">
          <div class="panel-body">
            <fieldset class="content-group">
              <legend class="text-bold"><i class="icon-stats-bars2"></i> GRAFIK HASIL KP</legend>
              <div id ="grafik"></div>
            </fieldset>
          </div>
      </div>
      </div>

      <div class="col-md-4">
        <div class="panel panel-flat">
            <div class="panel-body">
                <?php
                $total_siswa = $this->db->query("SELECT * FROM tbl_siswa
                                            INNER JOIN tbl_penempatan ON tbl_penempatan.nis=tbl_siswa.nis
                                            WHERE
                                                tbl_penempatan.tahun='$thn'")->num_rows();

                $total_nilai = $this->db->query("SELECT AVG(tbl_nilai.nilai) AS total FROM tbl_siswa
                                            INNER JOIN tbl_penempatan ON tbl_penempatan.nis=tbl_siswa.nis
                                            INNER JOIN tbl_nilai ON tbl_nilai.kdpenempatan=tbl_penempatan.kdpenempatan
                                              WHERE
                                                  tbl_penempatan.tahun='$thn'
                                          ")->row()->total;
                ?>

                <div class="col-md-5">
                  <div class="circle-chart circle-chart--with-track">
                  <?php echo number_format($total_nilai, 0,",",".");?>
                  </div>
                </div>
                <div class="col-md-7">
                  <h4 style="color:#26a69a;margin-bottom:-20px;">Rata-Rata Nilai</h4><br>
                  <b>Tahun Ajaran : <?php echo $thn; ?></b> <br>
                  <b>Jml. Siswa : <?php echo number_format($total_siswa, 0,",","."); ?></b>
                </div>
            </div>
        </div>
        <div class="panel panel-flat">
            <div class="panel-body">
              <table class="table table-striped" width="100%" border="0">
                <?php
                // error_reporting(0);
                foreach ($v_jurusan->result() as $baris) {

                  $nilai = $this->db->query("SELECT AVG(tbl_nilai.nilai) AS total FROM tbl_siswa
                                              INNER JOIN tbl_kelas ON tbl_kelas.kdkelas=tbl_siswa.kdkelas
                                              INNER JOIN tbl_jurusan ON tbl_jurusan.kdjurusan=tbl_kelas.kdjurusan
                                              INNER JOIN tbl_penempatan ON tbl_penempatan.nis=tbl_siswa.nis
                                              INNER JOIN tbl_nilai ON tbl_nilai.kdpenempatan=tbl_penempatan.kdpenempatan
                                                WHERE
                                                    tbl_jurusan.kdjurusan='$baris->kdjurusan'
                                                AND
                                                    tbl_penempatan.tahun='$thn'
                                            ")->row()->total;
                                              ?>
                  <tr>
                    <td width="80%"><?php echo ucwords($baris->nama); ?></td>
                    <td align="right"><?php echo $nilai; ?></td>
                  </tr>
                <?php
                } ?>
              </table>
            </div>
        </div>
      </div>

    </div>
    <!-- /dashboard content -->

    <script src="assets/chart/raphael-min.js"></script>
    <script src="assets/chart/circle-chart.js"></script>
    <script>
      window.onload = function () {
        var el, c1;
        el = document.querySelector('.circle-chart--with-track');
        c1 = new CircleChart(el, { trackColour: '#bec3ce', fill: '#106c37', colour: '#26a69a', stroke: 10 });
        if (window.MutationObserver) {
          var config = { attributes: false, childList: true, characterData: false };
          var observer = new MutationObserver(function(mutations) {
              console.log(c1.inner.innerText);
              c1.changeValue(parseFloat(c.inner.innerHTML));
          });
          observer.observe(c1.elem, config);
        }
      }
      </script>

      <script src="assets/js/linechart/highcharts.js"></script>
      <script src="assets/js/linechart/exporting.js"></script>
