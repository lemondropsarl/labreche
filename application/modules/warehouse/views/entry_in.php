<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>


<div class="content">

	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">

				<div class="card card-outline card-primary">
					<div class="card-header">
						<h4>Entrée stock</h4>
						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse">
								<i class="fas fa-minus"></i>
							</button>
						</div>
					</div>
					<div class="card-body">
						<form class="form" action="" method="post">
							<div class="row">
								<div class="form-group col-md">
									<label for="label">
										NOM ARTICLE
									</label>
									<input type="search" name="scode" id="scode" class="form-control" placeholder="part number">

									<select id="products" class="form-control">
										<?php
										foreach ($products as $item) {
										?>
											<option class="option" value="<?php echo $item["product_id"]; ?>"><?php echo $item["product_code"] . "-" . $item["product_name"]; ?></option>
										<?php
										}

										?>
									</select>
								</div>
								<div class="form-group col-md">
									<label for="entree_quantite">Quantité</label>
									<input type="number" min="1" class="form-control" name="entree_quantite" id="entree_quantite" placeholder="Quantité">
								</div>
								<div class="form-group col-md">
									<label for="date_entree">Date entrée</label>
									<input type="date" min="1" class="form-control" name="date_entree" id="date_entree">
								</div>
								<div class="form-group col-md">
									<label for="zone_entree" class="label">ZONE</label>
									<select name="zone_entree" id="zone_entree"  class="form-control">
										<option value="">ZONE</option>
										<?php
										foreach ($zones as $items) {
										?>
											<option value="<?php echo $items["zone_id"]; ?>"><?php echo $items["zone_name"]; ?></option>
										<?php
										}

										?>
									</select>
								</div>
								<div class="form-group col-md">
									<label for="etagere_produit" class="label">ETAGERE</label>
									<select name="etagere_produit" id="etagere_produit" class="form-control">
										<option value="">ETAGERE</option>
										<?php
										foreach ($shelfs as $items) {
										?>
											<option value="<?php echo $items["shelf_id"]; ?>">
												<?php echo $items["shelf_name"]; ?>
											</option>
										<?php
										}

										?>
									</select>
								</div>
							</div>
							<div style="margin-bottom: 2%;">
								<div class="description_entree" class="form-group" style="margin-bottom: 2%;">
									<label for="description_zone">DESCRIPTION</label>
									<textarea class="form-control" id='description_zone' cols="10" rows="2" placeholder="Description de localisation de l'article ou du produit">
										</textarea>
								</div>
								<div class="row">
									<div class="form-group col-md-4">
										<button class="btn btn-success form-control" id="valider_entree">Valider</button>
									</div>

								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-12">

				<div class="card card-outline card-info">
					<div class="card-header">
						<div class="form-group col-md-6 form-inline">
							<label for="entre_filtre" class="label">RECHERCHE</label>
							<input type="search" class="form-control" id="entree_filtre" name="entree_filtre" placeholder="Code article">
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered table-striped">
								<thead class="thead-dark">
									<tr>
									<th class="center">DATE ENTREE</th>
										<th class="center">PART  NUMBER</th>
										<th class="center">NOM ARTICLE</th>
										<th class="center">TYPE VEHICULE</th>
										<th class="center">QUANTITE</th>
									</tr>
								</thead>
								<tbody id="liste_entre_body">


								</tbody>
							</table>

						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>

<!-- Modal entree -->
<div class="modal fade" id="modalEntree" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Ajouter quantité</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<?php echo form_open('product/create_category'); ?>
				<div class="form-group">
					<label for="cat_name">AJOUT QUANTITE</label>
					<input type="number" class="form-control" name="ajout_quantite" id="ajout_quantite" placeholder="Quantité" required>
				</div>
				<div class="form-group">
					<label for="cat_name">Date</label>
					<input type="date" class="form-control" name="dateUpdate" id="dateUpdate" placeholder="date" required>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
				<button type="button" id="btn_update_quantity" data-pid='' class="btn btn-success">Ajouter</button>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>
