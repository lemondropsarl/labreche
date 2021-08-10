<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card card-outline card-secondary">
					<div class="card-header">
						<h4 class="card-title">Effectuer sortie depot</h4>
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
						<?php echo form_open('warehouse/create_entry_out');?>
						<div class="row">
							<div class="form-group col-lg-4">
								<label for="product">Nom article</label>
								<select
									name="ws_product"
									id="ws_prroducts"
									class="form-control"
								>
									<?php foreach ($products as $item) {?>
									# code...
									<option
										class="option"
										value="<?php echo $item['pid'];?>"
									>
										<?php echo $item['pname'];?>
									</option>
									<?php }?>
								</select>
							</div>
							<div class="form-group col-lg-2">
								<label for="entree_quantite">Quantité</label>
								<input
									type="number"
									min="1"
									class="form-control"
									name="o_qty"
									id="o_qty"
									placeholder="Quantité"
								/>
							</div>
                            <div class="form-group col-lg-2">
								<label for="entree_quantite">Date</label>
								<input
									type="date"
									class="form-control"
									name="o_date"
									id="o_date"
									placeholder="Date de sortie"
								/>
							</div>
							<div class="form-group col-lg-4">
								<label for="product">Destination</label>
								<select name="so_dest" id="so_dest" class="form-control">
									<?php foreach ($warehouses as $item) {?>
									# code...
									<option
										class="option"
										value="<?php echo $item['warehouse_id'];?>"
									>
										<?php echo $item['warehouse_name'];?>
									</option>
									<?php }?>
								</select>
								<a href="#" data-toggle="modal" data-target="#modalWarehouse"
									><i class="fa fa-plus-square"></i> Creer un mini depot</a
								>
							</div>
						</div>
					</div>
					<div class="card-footer">
						<button class="btn btn-success">Valider</button>
					</div>
					<?php echo form_close();?>
				</div>
                <div class="card card-outline card-success">
                    <div class="card-header">
						<h4 class="card-title">Sortie depot recents</h4>						
					</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table wy-table-bordered-all table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="center">Date operation</th>
                                        <th class="center">Nom article</th>
                                        <th class="center">Destination</th>
                                        <th class="center">Quantité</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($ws_products as $item) {?>
                                    <tr>
                                            
                                            <td><?php echo $item['entry_date'];?></td>
                                            <td><?php echo $item['name'];?></td>
                                            <td><?php echo $item['warehouse_name'];?></td>
                                            <td class="text-bold  align-content-end"><?php echo $item['quantity'];?></td>                                           
                                        </tr>
                                        <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
			</div>
		</div>
	</div>
</div>
<div
	class="modal fade"
	id="modalWarehouse"
	tabindex="-1"
	role="dialog"
	aria-labelledby="exampleModalLabel"
	aria-hidden="true"
>
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Ajouter Depot</h5>
				<button
					type="button"
					class="close"
					data-dismiss="modal"
					aria-label="Close"
				>
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?php echo form_open('warehouse/create_warehouse'); ?>
			<div class="modal-body">
				<div class="form-group">
					<label for="ws_address">Nom du depot</label>
					<input
						type="text"
						class="form-control"
						name="ws_name"
						id="ws_name"
						placeholder="Nom depot"
						require
					/>
				</div>
				<div class="form-group">
					<label for="ws_address">Adresse</label>
					<input
						type="text"
						class="form-control"
						name="ws_address"
						id="ws_address"
						placeholder="Adresse depot"
						require
					/>
				</div>
				<div class="erreur cache bg-danger" id="error_warehouse">
					L'adresse est obligatoire
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">
					Fermer
				</button>
				<button type="submit" id="btn_add_ws" class="btn btn-success">
					Enregistrer
				</button>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>
