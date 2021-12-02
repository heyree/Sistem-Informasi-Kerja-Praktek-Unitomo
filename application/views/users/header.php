<?php
$cek    = $user->row();
$nama   = $cek->nama_lengkap;

$menu 		= strtolower($this->uri->segment(1));
$sub_menu = strtolower($this->uri->segment(2));
$sub_menu3 = strtolower($this->uri->segment(3));
?>

<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from demo.interface.club/limitless/layout_2/LTR/default/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 25 Apr 2017 11:59:08 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
	<base href="<?php echo base_url();?>" />
    <link rel="icon" href="<?php echo base_url();?>/favicon.ico" type="image/ico">
	<title>Sistem Kerja Praktek</title>

	<!-- Global stylesheets -->
	<link href="assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="assets/css/re-bootstrap.css" rel="stylesheet" type="text/css">
	<link href="assets/css/re-core.css" rel="stylesheet" type="text/css">
	<link href="assets/css/re-components.css" rel="stylesheet" type="text/css">
	<link href="assets/css/colors.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script type="text/javascript" src="assets/js/plugins/loaders/pace.min.js"></script>
	<script type="text/javascript" src="assets/js/core/libraries/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/loaders/blockui.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<!-- /core JS files -->
	
	<!-- Theme JS files -->
	<script type="text/javascript" src="assets/js/core/app.js"></script>
	<!-- /theme JS files -->

	<script>
		$(document).ready(function () {
			window.setInterval(function () {
				var sisawaktu = $("#waktu").html();
				sisawaktu = eval(sisawaktu);
				if (sisawaktu == 0) {
					location.href = "http://praktek.pe.hu/users/profile";
				} else {
					$("#waktu").html(sisawaktu - 1);
				}
			}, 1000);
		});
	</script>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Outfit">
	<style type="text/css">
		body {
			font-size: 12pt;
			font-family: "Outfit", sans-serif;
			background-color: #eaecf4;
		}

		#waktu {
			font-size: 25pt;
			color: red;
		}
	</style>

	<script src="assets/js/select2.min.js"></script>
	<script>
		$(document).ready(function () {
			$(".cari_label").select2({
				placeholder: "Pilih Label"
			});
			$(".cari_jurusan").select2({
				placeholder: "Pilih Jurusan"
			});
			$(".cari_kelas").select2({
				placeholder: "Pilih Kelas"
			});
			$(".cari_pemb").select2({
				placeholder: "Pilih Pembimbing"
			});
			$(".cari_siswa").select2({
				placeholder: "Pilih Siswa"
			});
			$(".cari_industri").select2({
				placeholder: "Pilih Industri"
			});
		});
	</script>

	<?php
	if ($sub_menu == "" or $sub_menu == "profile" or $sub_menu == "lap_sk" or $sub_menu == "lap_sm" or $sub_menu=='buat_bimbingan' or $sub_menu=='tambahBimbingan') {?>
	<!-- Theme JS files -->
	<link rel="stylesheet" href="assets/calender/css/style.css">
	<link rel="stylesheet" href="assets/calender/css/pignose.calendar.css">
	<script type="text/javascript" src="assets/js/core/app.js"></script>
	<script type="text/javascript" src="assets/js/plugins/visualization/d3/d3.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/visualization/d3/d3_tooltip.js"></script>
	<script type="text/javascript" src="assets/js/plugins/forms/styling/switchery.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/forms/styling/uniform.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
	<script type="text/javascript" src="assets/js/plugins/ui/moment/moment.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/pickers/daterangepicker.js"></script>
	<script type="text/javascript" src="assets/js/core/app.js"></script>
	<!-- <script type="text/javascript" src="assets/js/pages/dashboard.js"></script> -->
	<script src="assets/calender/js/pignose.calendar.js"></script>
	<!-- /theme JS files -->
	<?php
	} ?>

	<?php
	if ($sub_menu == "info" or $sub_menu == "j_k" or $sub_menu == "pengguna" or $sub_menu == "industri" or $sub_menu == "penempatan" or $sub_menu == "nilai_praktik" or
	    $sub_menu == "d_siswa" or $sub_menu == "bimbingan" or $sub_menu == "nilai" or
			$sub_menu == "status_prakerin" or $sub_menu == "bimbingan_siswa" or $sub_menu == "nilai_prakerin" or $sub_menu=="buat_bimbingan" or $sub_menu=='tambahBimbingan') {?>
	<!-- Theme JS files -->
	<script type="text/javascript" src="assets/js/plugins/tables/datatables/datatables.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/editors/summernote/summernote.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/forms/styling/uniform.min.js"></script>
	<script type="text/javascript" src="assets/js/core/app.js"></script>
	<script type="text/javascript" src="assets/js/pages/editor_summernote.js"></script>
	<script type="text/javascript" src="assets/js/pages/datatables_basic.js"></script>
    <script type="text/javascript" src="assets/js/core/app.js"></script>
	<!-- /theme JS files -->
	<?php
	} ?>


</head>

<body>

	<!-- Main navbar -->
	<div class="navbar navbar-default header-highlight">
		<div class="navbar-header">
			<a class="navbar-brand" href="" style="color:white;"> APLIKASI<span class="label bg-success-400"></span></a>

			<ul class="nav navbar-nav visible-xs-block">
				<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
				<li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
			</ul>
		</div>

		<div class="navbar-collapse collapse" id="navbar-mobile">
			<ul class="nav navbar-nav">
				<li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a>
				</li>
			</ul>

			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown dropdown-user">
					<a class="dropdown-toggle" data-toggle="dropdown">
						<img src="foto/<?php if($level == 'Siswa'){echo"siswa/";} if($level != 'Pembimbing' ){if($cek->foto == ''){echo 'default.png';}else{echo $cek->foto;}}else{echo"default.png";} ?>"
							class="img-circle" alt="" width="30" height="28">
						<span><?php echo ucwords($nama); ?></span>
						<i class="caret"></i>
					</a>
					<ul class="dropdown-menu dropdown-menu-right">
						<li><a href="users/profile"><i class="icon-user"></i> Profil</a></li>
						<li class="divider"></li>
						<li><a href="web/logout"><i class="icon-switch2"></i> Logout</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
	<!-- /main navbar -->


	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main sidebar -->
			<div class="sidebar sidebar-main">
				<div class="sidebar-content">

					<!-- User menu -->
					<div class="sidebar-user">
						<div class="category-content">
							<div class="media">
								<a href="users/profile" class="media-left"><img
										src="foto/<?php if($level == 'Siswa'){echo"siswa/";} if($level != 'Pembimbing' ){if($cek->foto == ''){echo 'default.png';}else{echo $cek->foto;}}else{echo"default.png";} ?>"
										class="img-circle img-sm" alt=""></a>
								<div class="media-body">
									<span class="media-heading text-semibold"><?php echo ucwords($nama); ?></span>
									<div class="text-size-mini text-muted">
										<i class="icon-pin text-size-small"></i> &nbsp;<?php if($level == 'Siswa'){echo"Mahasiswa";}else {echo ucwords($level);} ?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- /user menu -->


					<!-- Main navigation -->
					<div class="sidebar-category sidebar-category-visible">
						<div class="category-content no-padding">
							<ul class="navigation navigation-main navigation-accordion">

								<!-- Main -->
								<li class="navigation-header"><span>Main</span> <i class="icon-menu"
										title="Main pages"></i></li>
								<!-- <li class="<?php if ($sub_menu == "") { echo 'active';}?>"><a href=""><i class="icon-home4"></i> <span>Beranda</span></a></li> -->
								<?php if ($level == 'Siswa'){?>
								<li class="<?php if ($sub_menu == "status_prakerin") { echo 'active';}?>"><a
										href="users/status_prakerin"><i class="icon-cogs"></i> <span>Status
											KP</span></a></li>
								<?php } ?>
								<li class="<?php if ($sub_menu == "profile") { echo 'active';}?>"><a
										href="users/profile"><i class="icon-user"></i> <span>Profil</span></a></li>

								<?php if ($level == 'Admin'){ ?>
								<!--<li class="<?php /**if ($sub_menu == "info") { echo 'active';}*/?>"><a href="users/info"><i class="icon-info22"></i> <span>Kelola Info</span></a></li>-->
								<li class="<?php if ($sub_menu == "j_k") { echo 'active';}?>"><a href="users/j_k"><i
											class="icon-database-add"></i> <span>Jurusan & Kelas</span></a></li>
								<li class="<?php if ($sub_menu == "pengguna") { echo 'active';}?>"><a
										href="users/pengguna"><i class="icon-users"></i> <span>Kelola
											Pengguna</span></a></li>
								<!--<li class="<?php //if ($sub_menu == "pengguna") { echo 'active';}?>"><a href="users/industri"><i class="icon-users"></i> <span>Kelola Industri</span></a></li>-->
								<li class="<?php if ($sub_menu == "penempatan") { echo 'active';}?>"><a
										href="users/penempatan"><i class="icon-link2"></i> <span>Penempatan</span></a>
								</li>
								<li class="<?php if ($sub_menu == "nilai_praktik") { echo 'active';}?>"><a
										href="users/nilai_praktik"><i class="icon-star-full2"></i> <span>Nilai
											Praktik</span></a></li>
								<li class="<?php if ($sub_menu == "monitoring") { echo 'active';}?>"><a
										href="users/monitoring"><i class="icon-stats-bars2"></i>
										<span>Monitoring</span></a></li>
								<li class="<?php if ($sub_menu == "status_pendaftaran") { echo 'active';}?>"><a
										href="users/status_pendaftaran"><i class="icon-megaphone"></i> <span>Status
											Pendaftaran</span></a></li>
								<?php }elseif ($level == 'Pembimbing'){?>
								<li class="<?php if ($sub_menu == "d_siswa") { echo 'active';}?>"><a
										href="users/d_siswa"><i class="icon-book3"></i> <span>Daftar Mahasiswa</span></a>
								</li>
								<!-- <li class="<?php if ($sub_menu == "bimbingan") { echo 'active';}?>"><a
										href="users/bimbingan"><i class="icon-pencil7"></i> <span>Bimbingan</span></a>
								</li> -->
								<li class="<?php if ($sub_menu == "nilai") { echo 'active';}?>"><a href="users/nilai"><i
											class="icon-star-full2"></i> <span>Nilai</span></a></li>
								<?php }elseif ($level == 'Siswa'){?>
								<li class="<?php if ($sub_menu == "bimbingan_siswa" || $sub_menu==='buat_bimbingan' || $sub_menu=='tambahBimbingan') { echo 'active';}?>"><a
										href="users/bimbingan_siswa"><i class="icon-envelop5"></i>
										<span>Bimbingan</span></a></li>
								<li class="<?php if ($sub_menu == "nilai_prakerin") { echo 'active';}?>"><a
										href="users/nilai_prakerin"><i class="icon-star-full2"></i> <span>Nilai
											KP</span></a></li>
								<?php } ?>


								<!-- /main -->

								<!-- Logout -->
								<li class="navigation-header"><span>Keluar</span> <i class="icon-menu"
										title="Forms"></i></li>
								<li><a href="web/logout"><i class="icon-switch2"></i> <span>Keluar </span></a></li>

								<!-- /logout -->

							</ul>
						</div>
					</div>
					<!-- /main navigation -->

				</div>
			</div>
			<!-- /main sidebar -->