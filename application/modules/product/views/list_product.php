<?php
defined('BASEPATH') or exit('No direct script access allowed');

?>
<div class="content">
	<div class="container-fluid">
		<!-- your content here -->
		<div class="row">
			<!--div class="col-lg-3 col-md-4 col-sm-4 col-xs-4">
				<div class="small-box bg-info">
					<div class="inner">
						<h3>1500</h3>
						<p>categorie</p>
					</div>
					<div class="icon">
						<i class=""></i>
					</div>
				</div>
			</div-->
			<!--div class="col-lg-3 col-md-4 col-sm-4 col-xs-4">

				<div class="small-box bg-purple">
					<div class="inner">
						<h3>1500</h3>
						<p>Accessoire</p>
					</div>
					<div class="icon">
						<i class="fas fa-car"></i>
					</div>
				</div>
			</div-->
			<!--div class="col-lg-3 col-md-4 col-sm-4 col-xs-4">

				<div class="small-box bg-primary">
					<div class="inner">
						<h3>1500</h3>
						<p>moteur</p>
					</div>
					<div class="icon">
						<i class=""></i>
					</div>
				</div>
			</div-->

			<div class="col-md-12">
				<div class="card card-outline card-secondary">
					<div class="card-header">
						<h3 class="card-title">Liste des articles</h3>
						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
						</div>
					</div>
					<div class="row" style="margin-top:1%;">
					<div class="col-md-4 col-sm-10 col-xs-10 offset-md-1 form-group">
							<select class="form-control" id='id_vehicule_drop_down'>
								<option value="">VEHICULE</option>
								<?php foreach ($vehicules as $item) { ?>
									<option value="<?php echo $item['vehicule_id']; ?>"><?php echo $item['vehicule_brand']; ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="col-md-3 col-sm-10 col-xs-10  form-group">
							<select class="form-control" id='id_categorie_drop_down'>
								<option value="">CATEGORIE</option>
								<?php foreach ($categories as $item) { ?>
									<option value="<?php echo $item['cat_id']; ?>"><?php echo $item['cat_name']; ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="col-md-3 col-sm-10 col-xs-10 form-group">
							<input type="search" name="search_product" id="search_product" class="form-control col-sm-10 col-xs-10" placeholder="Search">
						</div>
					</div>
					<div class="card-body">
						<div class="container">
							<div class="row">
								<div class="col">

									<div class="small-box bg-info">
										<div class="inner">
											<h3 id="pr_code_search_value">-</h3>
											<p class="text-center">CODE ARTICLE</p>
										</div>
										<div class="icon">
											<i class="far fa-clipboard"></i>
										</div>

									</div>
								</div>
								<div class="col">
									<div class="small-box  bg-gradient-navy">
										<div class="inner">
											<h3 id="pr_name_search_value">-</h3>
											<p class="text-center">NOM ARTICLE</p>
										</div>
										<div class="icon">

											<i class="fas fa-tag"></i>
										</div>

									</div>
								</div>
								<div class="col">
									<div class="small-box bg-danger">
										<div class="inner">
											<h3 id="pr_quantity_value">-</h3>
											<p class="text-center">QUANTITE EN STOCK</p>
										</div>
										<div class="icon">
											<i class="fas fa-warehouse"></i>
										</div>

									</div>
								</div>
								<div class="col">
									<div class="small-box bg-warning">
										<div class="inner">
											<p class="text-center">DESCRIPTION</p>
											<h5 id="pr_desc_search_value">-</h5>

										</div>
										<div class="icon">
											<i class="fas fa-clipboard-list"></i>
										</div>

									</div>
								</div>
							</div>
						</div>
						<div class="table-responsive">
							<table class="table table-bordered table-striped">
								<thead class="bg-dark text-center">
									<tr>
										<th>Code article</th>
										<th>Nom article</th>
									     <th>vehicule</th>
										<th>Unit??</th>
										<th>Prix </th>
										
										<th>Action</th>
								
									</tr>
								</thead>
								<tbody id='contenair_products'>
									<?php foreach ($products as $item) { ?>
										<tr class='ligne_product' data-product_id="<?php echo $item['product_id']; ?>" data-pr_code="<?php echo $item['product_code']; ?>">
											<td class="cel-product" data-type_cel="code" data-valeur="<?php echo $item['product_code']; ?>"><?php echo $item['product_code']; ?></td>
											<td class="cel-product" data-type_cel="name" data-valeur="<?php echo $item['product_name']; ?>"><?php echo $item['product_name']; ?></td>
											<td class="cel-product" data-type_cel="vehicule_brand" data-valeur="<?php echo $item['vehicule_brand']; ?>"><?php echo $item['vehicule_brand']; ?></td>
											<td class="cel-product" data-type_cel="uom" data-valeur="<?php echo $item['product_uom']; ?>"><?php echo $item['product_uom']; ?></td>
											<td class="cel-product" data-type_cel="price" data-valeur="<?php echo $item['unit_price']; ?>"><?php echo $item['unit_price']." ".$item['product_currency']; ?></td>
											<!-- td class="cel-product" data-type_cel="currency" data-valeur="<?php echo $item['product_currency']; ?>"><?php echo $item['product_currency']; ?></td !-->
											<td>
												<a href="<?php echo site_url('product/details/' . $item['product_id']); ?>">Modifi??r<i class="fa fa-arrow-right"></i></a>
											</td!>
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
