<script type="text/javascript" src="assets/js/plugins/tables/datatables/datatables.min.js"></script>

<script type="text/javascript" src="assets/js/core/app.js"></script>
<script type="text/javascript" src="assets/js/pages/datatables_basic.js"></script>

<div class="container" style="margin-top:-40px;">


      <div class="breadcrumb-line breadcrumb-line-component"><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
						<ul class="breadcrumb">
							<li><a href=""><i class="icon-home2 position-left"></i> Beranda</a></li>
							<li class="active">Industri</li>
						</ul>
			</div>
      <br>

        <div class="panel panel-default">
          <div class="panel-body">
            <table class="table datatable-basic table-striped" width="100%">
              <thead>
                <tr>
                  <th width="30px;">No.</th>
                  <th width="50">Logo</th>
                  <th>Nama Industri</th>
                  <th>Bidang Usaha</th>
                  <th>Wilayah</th>
                  <th>Telpon</th>
                  <th class="text-center" width="70">Aksi</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                  $no = 1;
                  foreach ($v_industri->result() as $baris) {
                  ?>
                    <tr>
                      <td><?php echo $no.'.'; ?></td>
                      <td><img src="foto/industri/<?php echo $baris->foto; ?>" alt="industri" width="50" height="50"></td>
                      <td><?php echo $baris->nama_industri; ?></td>
                      <td><?php echo $baris->bidang_kerja; ?></td>
                      <td><?php echo $baris->wilayah; ?></td>
                      <td><?php echo $baris->telepon; ?></td>
                      <td>
                        <a href="web/industri/<?php echo $baris->kdind; ?>" class="btn btn-info btn-xs">Detail</a>
                    </tr>
                  <?php
                  $no++;
                  } ?>
              </tbody>
            </table>
          </div>
        </div>


</div>
