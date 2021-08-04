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
						<?php echo form_open('product/create'); ?>
						<form class="form">
							<div class="form-row">
								<div class="col-md-5">
									<div class="form-group">
										<label for="prCode">Code article:</label>
										<input type="text" class="form-control" id="prCode" placeholder="Code article" name="prCode" required>
										<div class="valid-feedback">Valid.</div>
										<div class="invalid-feedback">Please fill out this field.</div>
									</div>
									<div class="form-group">
										<label for="prCode">Nom artcile:</label>
										<input type="text" class="form-control" id="nomArticle" placeholder="Nom article" name="nomArticle" required>
										<div class="valid-feedback">Valid.</div>
										<div class="invalid-feedback">Please fill out this field.</div>
									</div>
									<div class="row">
										<div class="form-group col-6">
											<label for="pr_marque">Marque:</label>
											<input type="text" class="form-control" id="prMarque" placeholder="Marque" name="prMarque" required>
											<div class="valid-feedback">Valid.</div>
											<div class="invalid-feedback">Please fill out this field.</div>
										</div>
										<div class="form-group col-6">
											<label for="prModele">Modele</label>
											<input type="text" class="form-control" id="prModele" placeholder="Modele" name="prModele" required>
											<div class="valid-feedback">Valid.</div>
											<div class="invalid-feedback">Please fill out this field.</div>
										</div>
									</div>
									<div class="row">
										<div class="form-group col-6">
											<label for="prPrix">Prix</label>
											<input type="text" class="form-control" id="prPrix" placeholder="Prix" name="prPrix" required>
											<div class="valid-feedback">Valid.</div>
											<div class="invalid-feedback">Please fill out this field.</div>
										</div>

										<div class="form-group col-6">
											<label for="prUnite">Unité</label>
											<select class="form-control" id="prUnite" placeholder="Unite" name="prUnite">
												<option value="">Unite</option>
												<option value="sache">saché</option>
												<option value="carton">carton</option>
												<option value="piece">piece</option>
												<option value="kilo">kilo</option>
												<option value="metre">metre</option>
												<option value="bouteille">Bouteille</option>
												<option value="litre">litre</option>
												<option value="metre">metre</option>
											</select>
											<div class="valid-feedback">Valid.</div>
											<div class="invalid-feedback">Please fill out this field.</div>
										</div>
									</div>
								</div>
								<div class="col-md-5 offset-md-1">

									<div class="form-group">
										<label for="prCode">Véhicule:</label>
										<select type="text" class="form-control" id="prCode" placeholder="véhicule" name="veicule">
											<option value="">Véhicule</option>
										</select>
										<div class="valid-feedback">Valid.</div>
										<div class="invalid-feedback">Please fill out this field.</div>
									</div>
									<div class="form-group">
										<a href="#" data-toggle="modal" data-target="#modalVehicule"><i class="fas fa-plus-square"></i> Ajouter type véhicule</a>
									</div>
									<div class="form-group">
										<label for="categorie">Catégorie:</label>
										<select type="text" class="form-control" id="prCode" placeholder="Catégorie" name="categorie">
											<option value="">Catégorie</option>
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
								<button class="btn btn-primary form-control col-6 offset-3">Créer</button>
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
			<?php echo form_open('product/create'); ?>
			<div class="modal-body">

				<form class="form" action="" method="post">
					<div class="form-group">
						<label for="nom_vehicule">Nom véhicule</label>
						<input type="text" class="form-control" name="" id="nom_vehicule" placeholder="Nom véhicule" require>
					</div>
					<div class="form-group">
						<label for="marque_vehicule">Marque</label>
						<input type="text" class="form-control" name="" id="marque_vehicule" placeholder="Marque véhicule" require>
					</div>
					<div class="form-group">
						<label for="modele_vehicule">Modele</label>
						<input type="text" class="form-control" name="" id="modele_vehicule" placeholder="Modele véhicule" require>
					</div>
				</form>


			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
				<button type="button" class="btn btn-success">Enregistrer</button>
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
			<?php echo form_open('product/create'); ?>
			<div class="modal-body">

				<form class="form" action="" method="post">
					<div class="form-group">
						<label for="cat_name">Nom catégorie</label>
						<input type="text" class="form-control" name="" id="cat_name" placeholder="Nom catégorie" require>
					</div>
					<div class="form-group">
						<label for="cat_description">Description</label>
						<textarea class="form-control" name="cat_description" id="cat_description" cols="30" rows="5" placeholder="Déscription catégorie"></textarea>
					</div>
				</form>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
				<button type="button" class="btn btn-success">Enregistrer</button>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>
