<?php
defined('BASEPATH') or exit('No direct script access allowed');

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>FACTURATION</title>
	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
	<!-- Font Awesome Icons -->
	<link rel="stylesheet" href="<?php echo base_url('assets/plugins/fontawesome-free/css/all.min.css') ?>" />
	<!-- IonIcons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" />
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url('assets/dist/css/adminlte.min.css') ?>" />
	<link rel="stylesheet" href="<?php echo base_url('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>" />
	<link rel="stylesheet" href="<?php echo base_url('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') ?>" />
	<link rel="stylesheet" href="<?php echo base_url('assets/plugins/toastr/toastr.css') ?>" />
	<link rel="stylesheet" href="<?php echo base_url('assets/dist/css/main.css') ?>" />
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />
</head>

<body class="container-fluid">
	<nav class="navbar navbar-expand-md bg-dark navbar-dark fixed-top">
		<a href="<?php echo base_url('pos/check') ?>" class="navbar-brand nav-link">
			<i class="fa fa-arrow-circle-left"></i> DEPOT</a>
		<ul class="navbar-nav mr-auto">
			<li class="nav-item nav-link">
				Point de vente :
				<?php echo $pos['pos_name'] ?>
			</li>
		</ul>
		<div class="pull-right">
			<ul class="navbar-nav">
				<li class="nav-item">
					Utilisateur :
					<?php echo	$this->session->userdata('username'); ?>
				</li>
			</ul>
		</div>
	</nav>
	<br />
	<div class="row">
		<section class="col-md-6 col-sm-12 col-xs-12 non_print">
			<div class="card card-outline">
				<div class="card-header">
					<div class="card-tools">
						<button type="button" class="btn btn-tool" data-card-widget="collapse">
							<i class="fas fa-minus"></i>
						</button>
					</div>
					<form class="form row">
						<div class="group-form col">
							<label for="filtre_pr_stock_fac">Code ou nom</label>
							<input type="search" placeholder="Code ou Nom article" name="filtre_pr_stock_fac" id="filtre_pr_stock_fac" class="form-control" required="required" />
						</div>
					</form>
				</div>
				<div class="card-body">
					<table class="table table-striped table-bordered table-hover">
						<thead class="bg-dark text-center">
							<tr class="pointer_hover">
								<th>CODE</th>
								<th>NOM ARTICLE</th>
								<th>PRIX UNITAIR</th>
								<th>QUANTITE EN STOCK</th>
							</tr>
						</thead>
						<tbody id="liste_pr_facture">
							<!-- liste d'article !-->
						</tbody>
					</table>
				</div>
			</div>
		</section>
		<section class="col-md-6 col-sm-12 col-xs-12 card card-outline">
			<h3 class="non_print">FACTURE</h3>
			<div class="container-fluid">
				<div class="row">
					<div class="form-inline">
						<div class="form-group">
							<label for="client">CLIENT: </label>
							<input type="text" name="client" id="client" placeholder="Nom du client" class="form-control" />
						</div>
					</div>
				</div>
			</div>
			<div class="container">
				<?php
				foreach ($store_information as $item) {
				?>
					<div class="row">
						<h2 class="col-12 text-center">
							<?php echo strtoupper($item["store_name"]); ?>
						</h2>
					</div>
					<div class="row">
						<h5 class="col-12 text-center gras">
							RCCM:
							<?php echo strtoupper($item["rccm"]); ?>
						</h5>
					</div>
					<div class="row">
						<span class="col-10 text-center gras">
							<?php echo strtoupper($item["adresse"]); ?>
						</span>
						<h3 class="col-2 text-center gras">N° <span id='numero_facture'>0</span></h3>
					</div>
					<div class="row">
						<span class="col-12 text-left gras">
							TEL:
							<?php echo strtoupper($item["telephone"]); ?>
						</span>
					</div>

				<?php
				}
				?>
			</div>

			<table class="table table-bordered table-hover print">
				<thead class="text-center">
					<tr class="bg-dark">
						<th>DESIGNATION</th>
						<th>QUANTITE</th>
						<th>P.UNITAIRE</th>
						<th>TOTAL</th>
					</tr>
				</thead>
				<tbody id="facture_corp"></tbody>
				<tfoot class="facture_footer">
					<tr>
						<td class="bg-dark" colspan="3">REDUCTION</td>
						<td id="reduction_aff" >0%</td>
					</tr>
					<tr>
						<td class="bg-dark" colspan="3">TOTAUX</td>
						<td id="totaux_facture_usd" data-totaux="0">0 USD</td>
					</tr>
					<tr>
						<td class="bg-dark" colspan="3">TYPE FACTURE</td>
						<td id="type_facture">DETAIL</td>
					</tr>
				</tfoot>
			</table>
			<div class="non_print reduction_type_detail">
				<label>REDUCTION </label>
				<input type="number" name="reduction" min="0" id="reduction"  class="" placeholder="REDUCTION">
				<label>TYPE FACTURE</label>
				<select name="type_facture" id="type_facture_select" class="">
					<option value="DETAIL">DETAIL</option>
					<option value="GROS">GROS</option>
				</select>
			</div>

			<div class="row non_print" style="margin-bottom: 2%">
				<div class="col-5">
					<button class="btn btn-danger print  form-control" id="btn_nouvelle_fac">
						Nouvelle <i class="fas fa-file"></i>
					</button>
				</div>
				<div class="col-5">
					<button class="btn btn-success text-uppercase form-control" id="print-facture">
						Imprimer<i class="fas fa-print"></i>
					</button>
				</div>
			</div>
		</section>
	</div>
</body>

</html>
