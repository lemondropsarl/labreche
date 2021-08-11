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
						<h4 class="card-title">Liste des articles</h4>
						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
						</div>
					</div>
					<div class="row" style="margin-top:1%;">
						<div class="col-md-5 col-sm-10 col-xs-10 offset-md-1 form-group">
							<select class="form-control" id='id_categorie_drop_down'>
								<option value="">CATEGORIE</option>
								<?php foreach ($categories as $item) { ?>
									<option value="<?php echo $item['cat_id']; ?>"><?php echo $item['cat_name']; ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="col-md-5 col-sm-10 col-xs-10 form-group">
							<input type="search" name="search_product" id="search_product" class="form-control col-sm-10 col-xs-10" placeholder="Search">
						</div>
					</div>

					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered table-striped">
								<thead class="bg-dark text-center">
									<tr>
										<th>Code article</th>
										<th>Nom article</th>
										<th>Marque</th>
										<th>Modèle</th>
										<th>Unité</th>
										<th>Prix </th>
										<th>Dévise</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody id='contenair_products'>
									<?php foreach ($products as $item) { ?>
										<tr data-product_id="<?php echo $item['product_id']; ?>">
											<td class="cel-product" data-type_cel="code" data-valeur="<?php echo $item['product_code']; ?>"><?php echo $item['product_code']; ?></td>
											<td class="cel-product" data-type_cel="name" data-valeur="<?php echo $item['product_name']; ?>"><?php echo $item['product_name']; ?></td>
											<td class="cel-product" data-type_cel="brand" data-valeur="<?php echo $item['product_brand']; ?>"><?php echo $item['product_brand']; ?></td>
											<td class="cel-product" data-type_cel="model" data-valeur="<?php echo $item['product_model']; ?>"><?php echo $item['product_model']; ?></td>
											<td class="cel-product" data-type_cel="uom" data-valeur="<?php echo $item['product_uom']; ?>"><?php echo $item['product_uom']; ?></td>
											<td class="cel-product" data-type_cel="price" data-valeur="<?php echo $item['unit_price']; ?>"><?php echo $item['unit_price']; ?></td>
											<td class="cel-product" data-type_cel="currency" data-valeur="<?php echo $item['product_currency']; ?>"><?php echo $item['product_currency']; ?></td>
											<td>
												<a href="<?php echo site_url('product/details/' . $item['product_id']); ?>"><i class="fa fa-arrow-right"></i></a>
											</td>
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
