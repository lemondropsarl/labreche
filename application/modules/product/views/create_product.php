<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="content">
	<div class="container-fluid">
		<!-- your content here -->
		<div class="row">
			<div class="col-md-12">
				<div class="card card-outline card-secondary">
					<div class="card-header">
						<h4 class="card-title">Nouveau article</h4>
						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
						</div>
					</div>
					<div class="card-body">
						<?php echo form_open('product/create_operation'); ?>
						<form class="form">
							<div class="form-row">
								<div class="col-md-5">
									<div class="form-group">
										<label for="prCode">Code article:</label>
										<input type="text" class="form-control" id="prCode" placeholder="Code article" name="pcode" required>
										<div class="valid-feedback">Valid.</div>
										<div class="invalid-feedback">Please fill out this field.</div>
									</div>
									<div class="form-group">
										<label for="prCode">Nom article:</label>
										<input type="text" class="form-control" id="nomArticle" placeholder="Nom article" name="pname" required>
										<div class="valid-feedback">Valid.</div>
										<div class="invalid-feedback">Please fill out this field.</div>
									</div>
									<div class="row">
										<div class="form-group col-6">
											<label for="pr_marque">Marque:</label>
											<input type="text" class="form-control" id="prMarque" placeholder="Marque" name="pbrand" required>
											<div class="valid-feedback">Valid.</div>
											<div class="invalid-feedback">Please fill out this field.</div>
										</div>
										<div class="form-group col-6">
											<label for="prModele">Modele</label>
											<input type="text" class="form-control" id="prModele" placeholder="Modele" name="pmodel" required>
											<div class="valid-feedback">Valid.</div>
											<div class="invalid-feedback">Please fill out this field.</div>
										</div>
									</div>
									<div class="row">
										<div class="form-group col-4">
											<label for="prPrix">Prix</label>
											<input type="number" class="form-control" id="prPrix" placeholder="Prix" name="price" required>
											<div class="valid-feedback">Valid.</div>
											<div class="invalid-feedback">Please fill out this field.</div>
										</div>

										<div class="form-group col-4">
											<label for="prUnite">Unité</label>
											<select class="form-control" id="prUnite" placeholder="Unite" name="uom">
												<?php foreach ($uoms as $option) {?>
													# code...
													<option value="<?php echo $option['uom_name'];?>"><?php echo $option['uom_name'];?></option>
												<?php }?>
												
											</select>
											<div class="valid-feedback">Valid.</div>
											<div class="invalid-feedback">Please fill out this field.</div>
										</div>
										<div class="form-group col-4">
											<label for="currency">Devise</label>
											<select class="form-control" id="prUnite" placeholder="Unite" name="pcurrency">
												
													<option value="CDF">CDF</option>
													<option value="USD">USD</option>
												
												
											</select>
											<div class="valid-feedback">Valid.</div>
											<div class="invalid-feedback">Please fill out this field.</div>
										</div>
									</div>
								</div>
								<div class="col-md-5 offset-md-1">

									<div class="form-group">
										<label for="prCode">Véhicule:</label>
										<select type="text" class="form-control" id="vehicule" placeholder="véhicule" name="pv_id">
											<?php foreach ($vehicules as $option) {?>
												# code...
												<option value="<?php echo $option['vehicule_id'];?>"><?php echo $option['vehicule_brand'];?></option>
											<?php }?>
										</select>
										<div class="valid-feedback">Valid.</div>
										<div class="invalid-feedback">Please fill out this field.</div>
									</div>
									<div class="form-group">
										<a href="#" data-toggle="modal" data-target="#modalVehicule"><i class="fas fa-plus-square"></i> Ajouter type véhicule</a>
									</div>
									<div class="form-group">
										<label for="categorie">Catégorie:</label>
										<select type="text" class="form-control" id="category" placeholder="Catégorie" name="pcat_id">
											<?php foreach ($categories as $option) {?>
												# code...
												<option value="<?php echo $option['cat_id'];?>"><?php echo $option['cat_name'];?></option>
											<?php }?>
										</select>
										<div class="valid-feedback">Valid.</div>
										<div class="invalid-feedback">Please fill out this field.</div>
									</div>
									<div class="form-group">
										<a href="#" data-toggle="modal" data-target="#modalCategory"><i class="fas fa-plus-square"></i> Ajouter catégorie</a>
									</div>
								</div>
							</div>
							<div class="form-group row" style="border-top: 1px solid grey;padding-top:2%;">
								<button type="submit" class="btn btn-primary form-control col-6 offset-3">Créer</button>
							</div>
						</form>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal vehicule -->
<div class="modal fade" id="modalVehicule" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Ajouter type véhicule</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?php echo form_open('product/create_vehicule'); ?>
			<div class="modal-body">					
					<div class="form-group">
						<label for="marque_vehicule">Marque</label>
						<input type="text" class="form-control" name="vehicule_brand" id="vehicule_brand" placeholder="Marque véhicule" require>
					</div>
					<div class="form-group">
						<label for="modele_vehicule">Modele</label>
						<input type="text" class="form-control" name="vehicule_model" id="vehicule_model" placeholder="Modele véhicule" require>
					</div>
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
				<button type="submit" class="btn btn-success">Enregistrer</button>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>

<!-- Modal category -->
<div class="modal fade" id="modalCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Ajouter catégorie</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<?php echo form_open('product/create_category'); ?>

				
					<div class="form-group">
						<label for="cat_name">Nom catégorie</label>
						<input type="text" class="form-control" name="cat_name" id="cat_name" placeholder="Nom catégorie" require>
					</div>
					<div class="form-group">
						<label for="cat_description">Description</label>
						<textarea class="form-control" name="cat_description" id="cat_description" cols="30" rows="5" placeholder="Déscription catégorie"></textarea>
					</div>
				

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
				<button type="submit" class="btn btn-success">Enregistrer</button>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>
