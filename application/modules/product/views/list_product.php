<?php
defined('BASEPATH') or exit('No direct script access allowed');

?>
<div class="content">
	<div class="container-fluid">
		<!-- your content here -->
		<div class="row">
							<div class="col-lg-3 col-md-4 col-sm-4 col-xs-4">
						<div class="small-box bg-info">
							<div class="inner">
								<h3>1500</h3>
								<p>categorie</p>
							</div>
							<div class="icon">
								<i class=""></i>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-4">

						<div class="small-box bg-purple">
							<div class="inner">
								<h3>1500</h3>
								<p>Accessoire</p>
							</div>
							<div class="icon">
								<i class="fas fa-car"></i>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-4">

						<div class="small-box bg-primary">
							<div class="inner">
								<h3>1500</h3>
								<p>moteur</p>
							</div>
							<div class="icon">
								<i class=""></i>
							</div>
						</div>
					</div>

            <div class="col-md-12">
				<div class="card card-outline card-secondary">
					<div class="card-header">
						<h4 class="card-title">Liste des articles</h4>
						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
						</div>
					</div>
					<div class="row" style="margin-top:1%;">
						<div class="dropdown col-md-5 col-sm-10 col-xs-10 offset-md-1 form-group">
							<button type="button" class="btn btn-primary dropdown-toggle form-control col-sm-10 col-xs-10 " data-toggle="dropdown">
								Catégorie
							</button>
							<div class="dropdown-menu">
								<a class="dropdown-item" href="#">catégorie 1</a>
								<a class="dropdown-item" href="#">catégorie 2</a>
								<a class="dropdown-item" href="#">catégorie 3</a>
							</div>
						</div>
						<div class="col-md-5 col-sm-10 col-xs-10 form-group" >
							<input type="search" name="" id="" class="form-control col-sm-10 col-xs-10" placeholder="Search">
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>Nom article</th>
										<th>Code Article</th>
										<th>Prix Unitaire</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($products as $item) { ?>

										<tr>
											<th><?php echo $item['product_name']; ?></th>
											<th><?php echo $item['product_code']; ?></th>
											<th><?php echo $item['unit_price']; ?></th>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>


			</div>
		</div>
	</div>
</div>
</div>
