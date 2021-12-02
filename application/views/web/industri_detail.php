<?php
$sub_menu3 = strtolower($this->uri->segment(3));
$user = $v_industri->row(); ?>
<div class="container" style="margin-top:-40px;">


      <div class="breadcrumb-line breadcrumb-line-component"><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
						<ul class="breadcrumb">
							<li><a href=""><i class="icon-home2 position-left"></i> Beranda</a></li>
              <li><a href="web/industri"> Industri</a></li>
							<li class="active"><?php echo ucwords($user->nama_industri); ?></li>
						</ul>
			</div>
      <br>

        <div class="panel panel-default">
          <div class="panel-body">

            <fieldset class="content-group">
              <legend class="text-bold"><i class="icon-office"></i> Detail Industri <?php echo ucwords($user->nama_industri); ?></legend>
                <center>
                  <img src="foto/<?php if ($user->foto == '') { echo'default.png'; }else{echo "industri/$user->foto";}?>" alt="<?php echo $user->nama_industri; ?>" class="img-circle" width="176" height="176">
                  <br>
                  <b>
                    Logo Industri <br>
                     <?php echo ucwords($user->nama_industri); ?>
                  </b>
                </center>
                <hr>
                <table width="100%" border=0>
                    <tr>
                      <th width="100"><b>Nama Industri</b></th>
                      <td width="2%"><b>:</b>&nbsp; </td>
                      <td> <b><?php echo $user->nama_industri; ?></b></td>
                    </tr>
                    <tr>
                      <th><b>Bidang Kerja</b></th>
                      <td><b>:</b>&nbsp; </td>
                      <td> <?php echo ucwords($user->bidang_kerja); ?></td>
                    </tr>
                    <tr>
                      <th><b>Deskripsi</b></th>
                      <td><b>:</b>&nbsp; </td>
                      <td> <?php echo ucwords($user->deskripsi); ?></td>
                    </tr>
                    <tr>
                      <th><b>Alamat Industri</b></th>
                      <td><b>:</b>&nbsp; </td>
                      <td> <?php echo ucwords($user->alamat_industri); ?></td>
                    </tr>
                    <tr>
                      <th><b>Wilayah</b></th>
                      <td><b>:</b>&nbsp; </td>
                      <td> <?php echo ucwords($user->wilayah); ?></td>
                    </tr>
                    <tr>
                      <th><b>Telepon</b></th>
                      <td><b>:</b>&nbsp; </td>
                      <td> <?php echo ucwords($user->telepon); ?></td>
                    </tr>
                    <tr>
                      <th><b>Website</b></th>
                      <td><b>:</b>&nbsp; </td>
                      <td> <?php echo ucwords($user->website); ?></td>
                    </tr>
                    <tr>
                      <th><b>Email</b></th>
                      <td><b>:</b>&nbsp; </td>
                      <td> <?php echo ucwords($user->email); ?></td>
                    </tr>
                    <tr>
                      <th><b>Syarat</b></th>
                      <td><b>:</b>&nbsp; </td>
                      <td> <?php echo ucwords($user->syarat); ?></td>
                    </tr>
                    <tr>
                      <th><b>Kuota</b></th>
                      <td><b>:</b>&nbsp; </td>
                      <td> <?php echo ucwords($user->kuota); ?></td>
                    </tr>
                </table>

              <hr>

            </fieldset>

          </div>
        </div>


</div>
