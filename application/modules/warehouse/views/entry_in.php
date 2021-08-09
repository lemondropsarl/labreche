<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="container">
	<div class="panel panel-primary">
		<div class="panel-heading">ENTREE STOCK</div>
		<div class="panel-body">
			<form class="form" action="" method="post">
				<div class="row">
					<div class="form-group col-md">
						<label for="label">
							NOM ARTICLE
						</label>

						<select id="products" class="form-control">
							<?php
							foreach ($products as $items) {
							?>
								<option class="option" value="<?php echo $items["product_id"]; ?>"><?php echo $items["product_name"]; ?></option>
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
						<select name="zone_entree" id="zone_entree" class="form-control">
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
				<div class="row" style="margin-bottom: 2%;">
					<div class="description_entree" class="form-group">
						<label for="description_zone">DESCRIPTION</label>
						<textarea class="form-control" id='description_zone' cols="30" rows="5" placeholder="Description de localisation de l'article ou du produit">
                        </textarea>
					</div>
					<div class="form-group col-md-4">
						<button class="btn btn-success" id="valider_entree">Valider</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
