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
										<a href="#create_vehicule"><i class="fas fa-plus-square"></i> Ajouter type véhicule</a>
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
										<a href="#create_categorie"><i class="fas fa-plus-square"></i> Ajouter catégorie</a>
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
