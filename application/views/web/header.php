<?php
$ceks  = $this->session->userdata('prakrin_smk@Proyek-2017');
$level = $this->session->userdata('level@Proyek-2017');

if ($level == 'admin') {
	$cek    = $this->db->get_where('tbl_user', "username='$ceks'")->row();
	$link_nilai = 'users/nilai_praktik';
}elseif ($level == 'pembimbing') {
	$cek    = $this->db->get_where('tbl_pemb', "username='$ceks'")->row();
	$link_nilai = 'users/nilai';
}else{
	$cek    = $this->db->get_where('tbl_siswa', "nis='$ceks'")->row();
	$link_nilai = 'users/nilai_prakerin';
}

$menu 		= strtolower($this->uri->segment(1));
$sub_menu = strtolower($this->uri->segment(2));
$sub_menu3 = strtolower($this->uri->segment(3));
?>

<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
	<base href="<?php echo base_url();?>"/>
	<link rel="icon" href="<?php echo base_url();?>/favicon.ico" type="image/ico">
	<title>Praktek Kerja</title>

	<!-- Global stylesheets -->
	<link href="assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="assets/css/re-bootstrap.css" rel="stylesheet" type="text/css">
	<link href="assets/css/re-core.css" rel="stylesheet" type="text/css">
	<link href="assets/css/re-components.css" rel="stylesheet" type="text/css">
	<link href="assets/css/colors.css" rel="stylesheet" type="text/css">
	<link href="assets/css/docs.min.css" rel="stylesheet" type="text/css">
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

</head>

<body class="login-container" >
	<!-- Main navbar -->
	<div class="navbar navbar-inverse">
		<div class="navbar-header">
			<a class="navbar-brand" href="<?php echo base_url(); ?>">PRAKTEK KERJA <span class="label bg-success-400"></span></a>

			<ul class="nav navbar-nav pull-right visible-xs-block">
				<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
			</ul>
		</div>

		<div class="navbar-collapse collapse" id="navbar-mobile">
			<!-- <p class="navbar-text"><span class="label bg-success-400">Online</span></p> -->

			<ul class="nav navbar-nav navbar-right">
			

			</ul>
		</div>
	</div>
	<!-- /main navbar -->


		<!-- Page container -->
		<div class="page-container">

			<!-- Page content -->
			<div class="page-content">

				<!-- Main content -->
				<div class="content-wrapper">

					<!-- Content area -->
					<div class="content">
