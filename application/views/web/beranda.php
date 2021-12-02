<?php
$ceks = $this->session->userdata('prakrin_smk@Proyek-2017'); ?>
<!-- Page content of course! -->
<main class="bs-docs-masthead" id="content" role="main" style="margin-left:-20px;margin-right:-20px;margin-top:-60px;">
 <div class="container">
	 <center>
		 <img src="foto/logo.png" alt="Logo" class="img-circle" height="176" width="176">
	 </center>
	 <p class="lead">
		 Selamat Datang di Sistem Praktek Kerja. Sistem Praktek Kerja yang digunakan
		 untuk mengelola praktik kerja industri mulai dari persiapan, pelaksana dan evaluasi
	 </p>
	 <p class="lead">
		 <?php
		 if ($ceks) {?>
		 	<!-- <a href="web/logout" class="btn btn-outline-inverse btn-lg">Keluar</a> -->
			<br>
		<?php
		 }else{ ?>
			 <a href="web/login" class="btn btn-outline-inverse btn-lg">Masuk</a>
		<?php
		 } ?>
	 </p>
	 <!-- <?php
	 if (!$ceks) {?>
	 <p class="version">v1.0</p>
	 <?php
 	 } ?> -->
 </div>
</main>
