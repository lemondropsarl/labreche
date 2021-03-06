<?php
defined('BASEPATH') or exit('No direct script access allowed');


global $app;
$this->load->config('app', TRUE);
$this->app = $this->config->item('application', 'app');
$user = $this->session->userdata('identity');


$active = '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $this->app['name']; ?> <?php echo $title ?></title>

	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome Icons -->
	<link rel="stylesheet" href="<?php echo base_url('assets/plugins/fontawesome-free/css/all.min.css') ?>">
	<!-- IonIcons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url('assets/dist/css/adminlte.min.css') ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/plugins/toastr/toastr.min.css') ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/dist/css/main.css') ?>">
	<!--link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css"-->

</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->

<body class="hold-transition sidebar-mini">

	<div class="wrapper">
		<!-- Navbar -->
		<nav class="main-header navbar navbar-expand navbar-white navbar-light">
			<!-- Left navbar links -->
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
				</li>
				<!--li class="nav-item d-none d-sm-inline-block">
					<a href="<?php echo base_url('dashboard') ?>" class="nav-link">Home</a>
				</li-->
			</ul>

			<!-- Right navbar links -->
			<ul class="navbar-nav ml-auto">
				<!-- Messages Dropdown Menu -->

				<!-- Notifications Dropdown Menu -->
				<!--li class="nav-item dropdown">
					<a class="nav-link" data-toggle="dropdown" href="#">
						<i class="far fa-bell"></i>
						<span class="badge badge-warning navbar-badge">15</span>
					</a>
					<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
						<span class="dropdown-item dropdown-header">15 Notifications</span>
						<div class="dropdown-divider"></div>
						<a href="#" class="dropdown-item">
							<i class="fas fa-envelope mr-2"></i> 4 new messages
							<span class="float-right text-muted text-sm">3 mins</span>
						</a>
						<div class="dropdown-divider"></div>
						<a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
					</div>
				</li-->

			</ul>
		</nav>
		<!-- /.navbar -->

		<!-- Main Sidebar Container -->
		<aside class="main-sidebar sidebar-dark-primary elevation-4">
			<!-- Brand Logo -->
			<a href="<?php echo base_url('dashboard') ?>" class="brand-link">
				<img src="<?php echo base_url('assets/dist/img/AdminLTELogo.png') ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
				<span class="brand-text font-weight-light"><?php echo $this->app['name']; ?></span>
			</a>

			<!-- Sidebar -->
			<div class="sidebar">
				<!-- Sidebar user panel (optional) -->
				<div class="user-panel mt-3 pb-3 mb-3 d-flex">
					<div class="image">
						<img src="<?php echo base_url('assets/dist/img/user2-160x160.jpg') ?>" class="img-circle elevation-2" alt="User Image">
					</div>
					<div class="info">
						<a href="#" class="d-block"><?php echo $user ?></a>|
						<a href="<?php echo base_url('auth/logout')?>">Deconnexion</a>
					</div>
				</div>

				<!-- Sidebar Menu -->
				<nav class="mt-2">
					<ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-legacy" data-widget="treeview" role="menu" data-accordion="false">

						<!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
						<?php
						foreach ($menus as $menu) {
							if (in_array($menu['name'], $acl_modules) && $menu['name'] == $menu['parent']) { ?>
								<li class="nav-item ">
									<a class="nav-link <?php if ($menu['name'] == $this->uri->segment(1)) {
															echo "active";
														} ?>" href="<?php echo base_url($menu['url']); ?>">
										<i class="nav-icon fas <?php echo $menu['icon']; ?>"></i>
										<p><?php echo $menu['text']; ?></p>
									</a>
								</li>
							<?php } elseif (in_array($menu['name'], $acl_modules)) {

								$colnum = 1; ?>

								<li class="nav-item  has-treeview menu-open">
									<a class="nav-link <?php if ($menu['name'] == $this->uri->segment(1)) {
															echo "active";
														} ?>" href="javascript:void(0)">
										<?php if (in_array($menu['name'], $acl_modules)) { ?>

											<i class="nav-icon fas <?php echo $menu['icon']; ?>"></i>
											<p><?php echo $menu['text']; ?>
												<i class="fas fa-angle-left right"></i>
											</p>
										<?php  } ?>
									</a>
									<ul class="nav nav-treeview">
										<?php foreach ($subs as $sub) {
											if ($sub['parent'] == $menu['name']) { ?>
												<li class="nav-item">
													<a class="nav-link" href="<?php echo base_url($sub['url']); ?>">
														<i class="far fa-circle nav-icon"></i>
														<p><?php echo $sub['text']; ?></p>
													</a>
											<?php }
										} ?>
												</li>
									</ul>
								</li>
						<?php

							}
						}

						?>
					</ul>
				</nav>
				<!-- /.sidebar-menu -->
			</div>
			<!-- /.sidebar -->
		</aside>
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<div class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1 class="m-0 text-dark">
							</h1>
						</div><!-- /.col -->
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="#">Home</a></li>
								<li class="breadcrumb-item active"><?php echo $title ?></li>
							</ol>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.container-fluid -->
			</div>
			<!-- /.content-header -->
