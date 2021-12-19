<?php 
defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card card-primary">
					<div class="card-header">
						<h4 class="card-title">Details produit</h4>
						<div class="card-tools">
							<button
								type="button"
								class="btn btn-tool"
								data-card-widget="collapse"
							>
								<i class="fas fa-minus"></i>
							</button>
						</div>
					</div>
					<div class="card-body">
					<?php echo form_open('product/update_operation')?>
						<form class="form">
							<input type="hidden" name="product_id" value="<?php echo $product_id?>">
							<div class="form-row">
								<div class="col-md-5">
									<div class="form-group">
										<label for="prCode" class="label text-secondary">Code article</label>
										<input type="text" class="form-control" data-verification="0" id="prCode" placeholder="Code article" name="pcode" value="<?php echo $product['product_code']?>" required>
										<div class="erreur cache bg-danger" id="prCode_erreur">Vérifier le code article</div>

									</div>
									<div class="form-group">
										<label for="nomArticle"  class="label text-secondary">Nom article</label>
										<input type="text" class="form-control" id="nomArticle" placeholder="Nom article" name="pname"value="<?php echo $product['product_name']?>" required>
										<div class="erreur cache bg-danger" id='erreur_nom'>Vérifier le nom</div>

									</div>
									<div class="row">
																			<div class="form-group col-4">
											<label for="pmin_qty">Min. Qté</label>
											<input type="number" class="form-control" id="pmin_qty" placeholder="Qté minimum" name="pmin_qty" value="<?php echo $product['min_qty']?>" required>
											<div class="erreur cache" id='erreur_min_qty'>Vérifier le mininum</div>

										</div>
									</div>
									<div class="row">
										<div class="form-group col-4">
											<label for="prPrix"  class="label text-secondary">Prix</label>
											<input type="number" class="form-control" id="prPrix" placeholder="Prix" name="price" value="<?php echo $product['unit_price']?>" required>
											<div class="erreur cache bg-danger" id='erreur_prix'>Vérifier le prix</div>

										</div>

										<div class="form-group col-4">
											<label for="prUnite"  class="label text-secondary">Unité</label>
											<select class="form-control" id="prUnite" name="prUnite" >
											<?php foreach ($uoms as $option) { ?>
													
													<option value="<?php echo $option['uom_name']; ?>"
													<?php if ($product['product_uom'] == $option['uom_name']) {
													echo "selected=selected";
												}?>"><?php echo $option['uom_name']; ?></option>
												<?php } ?>

											</select>
											<div class="erreur cache bg-danger" id='erreur_unite'>Vérifier l'unité</div>

										</div>
										
									</div>
								</div>
								<div class="col-md-5 offset-md-1">

									<div class="form-group">
										<label for="vehicule"  class="label text-secondary">Véhicule</label>
										<input type="search" name="s_vehicule" id="s_vehicule" class="form-control">
										<select type="text" class="form-control" id="pv_id" name="pv_id">
											<?php foreach ($vehicules as $option) { ?>
												# code...
												<option value="<?php echo $option['vehicule_id']; ?>"
												 <?php if ($product['product_vehicule_id'] == $option['vehicule_id']) {
													echo "selected=selected";
												}?>"><?php echo $option['vehicule_brand']; ?></option>
											<?php } ?>
										</select>

									</div>
									
									<div class="form-group">
										<label for="pcat_id"  class="label text-secondary">Catégorie</label>
										<select type="text" class="form-control" id="pcat_id" placeholder="Catégorie" name="pcat_id">
											<?php foreach ($categories as $option) { ?>
												
												<option value="<?php echo $option['cat_id']; ?>"
												<?php if ($product['product_cat_id'] == $option['cat_id']) {
													echo "selected=selected";
												}?>"><?php echo $option['cat_name']; ?></option>
											<?php } ?>
										</select>

									</div>
									
								</div>
							</div>
							<div class="form-group row" style="border-top: 1px solid grey;padding-top:2%;">
								<button type="submit"  class="btn btn-success form-control col-5 offset-4">Confirmer la modification</button>
							</div>
						</form>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
			
		</div>
	</div>
</div>
