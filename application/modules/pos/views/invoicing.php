<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>FACTURATION</title>
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
	<link rel="stylesheet" href="<?php echo base_url('assets/plugins/toastr/toastr.css') ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/dist/css/main.css') ?>">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
</head>

<body class="container-fluid">
	<header class="header row p-3 my-3 bg-dark text-white">
		<h2>BREACHE</h2>
	</header>
	<div class="row">
		<section class="col-md-6 col-sm-12 col-xs-12">
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
							<input type="search" placeholder="Code ou Nom article" name="filtre_pr_stock_fac" id="filtre_pr_stock_fac" class="form-control" required="required">
						</div>
						<div class="group-form col">
							<label for="qty_change">Quantité</label>
							<input class="form-control" placeholder="Quantité" type="number" min=1 name="qty_change" id="qty_change">
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
		<section class="col-md-6">
			<table class="table table-striped table-bordered table-hover">
				<thead class="text-center">
					<tr class="bg-secondary">
						<th>DESIGNATION</th>
						<th>QUANTITE</th>
						<th>P.UNITAIRE</th>
						<th>TOTAL</th>
					</tr>
				</thead>
				<tbody id="facture_corp">

				</tbody>
				<tfoot class="bg-warning">
					<tr class="font-weight-bold text-center" style="font-size:2em;">
						<td>
							TOTAUX :
						</td>
						<td id="totaux_facture" data-totaux='0'>
							0
						</td>
					</tr>
				</tfoot>
			</table>
			<div class="row" style="margin-bottom: 2%;">
				<div class="col-3">
					<button class="btn btn-danger print text-uppercase" id="btn_nouvelle_fac">Nouvelle <i class="fas fa-file"></i></button>
				</div>
				<div class="col-3">
					<button class="btn btn-success text-uppercase" id="print-facture">Imprimer <i class="fas fa-print"></i></button>
				</div>
				<div class="col-4">
					<button class="btn btn-primary print text-uppercase" id="save-facture">Enregistrer <i class="fas fa-save"></i></button>
				</div>
			</div>
		</section>
	</div>