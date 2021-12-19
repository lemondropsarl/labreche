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
										<label for="prCode" class="label text-secondary">Code article</label>
										<input type="text" class="form-control" data-verification="0" id="prCode" placeholder="Code article" name="pcode" required>
										<div class="erreur cache bg-danger" id="prCode_erreur">Vérifier le code article</div>

									</div>
									<div class="form-group">
										<label for="nomArticle"  class="label text-secondary">Nom article</label>
										<input type="text" class="form-control" id="nomArticle" placeholder="Nom article" name="pname" required>
										<div class="erreur cache bg-danger" id='erreur_nom'>Vérifier le nom</div>

									</div>
									<div class="row">
																			<div class="form-group col-4">
											<label for="pmin_qty">Min. Qté</label>
											<input type="number" class="form-control" id="pmin_qty" placeholder="Qté minimum" name="pmin_qty" required>
											<div class="erreur cache" id='erreur_min_qty'>Vérifier le mininum</div>

										</div>
									</div>
									<div class="row">
										<div class="form-group col-4">
											<label for="prPrix"  class="label text-secondary">Prix</label>
											<input type="number" class="form-control" id="prPrix" placeholder="Prix" name="price" required>
											<div class="erreur cache bg-danger" id='erreur_prix'>Vérifier le prix</div>

										</div>

										<div class="form-group col-4">
											<label for="prUnite"  class="label text-secondary">Unité</label>
											<select class="form-control" id="prUnite" placeholder="Unite" name="prUnite">
												<?php foreach ($uoms as $option) { ?>
													# code...
													<option value="<?php echo $option['uom_name']; ?>"><?php echo $option['uom_name']; ?></option>
												<?php } ?>

											</select>
											<div class="erreur cache bg-danger" id='erreur_unite'>Vérifier l'unité</div>

										</div>
										<!--div class="form-group col-4">
											<label for="currency"  class="label text-secondary">Devise</label>
											<select class="form-control" id="pcurrency" placeholder="Unite" name="pcurrency">
												<option value="CDF">CDF</option>
												<option value="USD">USD</option>
											</select>

										</div-->
									</div>
								</div>
								<div class="col-md-5 offset-md-1">

									<div class="form-group">
										<label for="vehicule"  class="label text-secondary">Véhicule</label>
										<input type="search" name="s_vehicule" id="s_vehicule" class="form-control">
										<select type="text" class="form-control" id="pv_id" name="pv_id">
											<?php foreach ($vehicules as $option) { ?>
												# code...
												<option value="<?php echo $option['vehicule_id']; ?>"><?php echo $option['vehicule_brand']; ?></option>
											<?php } ?>
										</select>

									</div>
									<div class="form-group">
										<a href="#" data-toggle="modal" data-target="#modalVehicule"><i class="fas fa-plus-square"></i> Ajouter type véhicule</a>
									</div>
									<div class="form-group">
										<label for="pcat_id"  class="label text-secondary">Catégorie</label>
										<select type="text" class="form-control" id="pcat_id" placeholder="Catégorie" name="pcat_id">
											<?php foreach ($categories as $option) { ?>
												# code...
												<option value="<?php echo $option['cat_id']; ?>"><?php echo $option['cat_name']; ?></option>
											<?php } ?>
										</select>

									</div>
									<div class="form-group">
										<a href="#" data-toggle="modal" data-target="#modalCategory"><i class="fas fa-plus-square"></i> Ajouter catégorie</a>
									</div>
								</div>
							</div>
							<div class="form-group row" style="border-top: 1px solid grey;padding-top:2%;">
								<button type="button" id='bt_create_produit' class="btn btn-success form-control col-5 offset-4">Créer</button>
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
				<div class="erreur cache bg-danger" id="erreur_marque_vehicule">
					La catégorie est obligatoire
				</div>
				

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
				<button type="button" id="btn_add_car" class="btn btn-success">Enregistrer</button>
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
				<div class="erreur cache bg-danger" id="erreur_cat_vehicule">
					La catégorie est obligatoire
				</div>
				<div class="form-group">
					<label for="cat_description">Description</label>
					<textarea class="form-control" name="cat_description" id="cat_description" cols="30" rows="5" placeholder="Déscription catégorie"></textarea>
				</div>
				<div class="erreur cache bg-danger" id="erreur_description_vehicule">
					La description est obligatoire
				</div>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
				<button type="button" id="btn_add_category" class="btn btn-success">Enregistrer</button>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>
