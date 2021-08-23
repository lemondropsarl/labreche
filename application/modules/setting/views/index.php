<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/* End of file filename.php */
?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h4 class="title">Informations du Magasin</h4>
                    </div>
                    <?php if ($store != null) {?>
                       
                        <div class="card-body">
                            <div class="col-md-12">
                            <dl class="row dl-horizontal">
                                <dt class="col-sm-4">DESIGNATION</dt>
                                <dd class="col-sm-8"><?php echo $store['store_name'];?></dd>
                                <dt class="col-sm-4">RCCM</dt>
                                <dd class="col-sm-8"><?php echo $store['rccm'];?></dd>
                                <dt class="col-sm-4">ID. NAT</dt>
                                <dd class="col-sm-8"><?php echo $store['id_nat'];?></dd>
                                <dt class="col-sm-4">No IMPOT</dt>
                                <dd class="col-sm-8"><?php echo $store['nif'];?></dd>
								<dt class="col-sm-4">TELEPHONE</dt>
                                <dd class="col-sm-8"><?php echo $store['telephone'];?></dd>
								<dt class="col-sm-4">ADRESSE</dt>
                                <dd class="col-sm-8"><?php echo $store['adresse'];?></dd>
                                
                          </dl>  
                                
                            </div>
                           
                        </div>
                        <div class="card-footer align-right">
                                <a href="#" class="btn btn-secondary" data-toggle="modal" data-target="#modalStore">Modifier</a>
                        </div>
                   <?php } else { ?>
                    <div class="card-body">
                       <div class="col-md-12 align-center">
                           <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalStore">Nouveau</a>
                          
                       </div>
                   </div>
                  <?php }?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h4 class="title">Points de vente et Depots</h4>
						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
						</div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                           <div class="col-md-6">

                               <label>Nom depot</label>
                               <select name="ws" id="ws" class="form-control">
                                   <?php foreach ($warehouses as $item) {?>
                                       
                                       <option value="<?php echo $item['warehouse_id']?>"><?php echo $item['warehouse_name']?></option>
                                <?php   }?>
                               </select>
							   <div class="row">
							   <?php echo form_open('setting/create_warehouse'); ?>
									
										<div class="form-group form-inline">
											<label for="ws_name">DESIGNATION</label>
											<input type="text" class="form-control" name="ws_name" id="ws_name" placeholder="Nom du depot">
										</div>
										
										<div class="form-group form-inline">
											<label for="ws_address">ADRESSE</label>
											<input type="text" class="form-control" name="ws_address" id="ws_address" placeholder="Adresse">
										</div>									
										<button type="submit" id="" class="btn btn-success">Ajouter depot</button>
									
									<?php echo form_close(); ?>
								   
							   </div>
                           </div>
                           <hr class="line divider"/>
                            <div class="col-md-6">
                                <label>Point de vente</label>
                               <select name="pos" id="pos" class="form-control">
								   <?php foreach ($pos as $item) {?>
									   
									   <option value="<?php echo $item['pos_ws_id']?>"><?php echo $item['pos_name']?></option>
								<?php   }?>
                               </select>
							   <?php echo form_open('pos/create_pos');?>
							   <div class="form-group">
										<label for="pos_name">DESIGNATION</label>
										<input type="text" class="form-control" name="pos_name" id="pos_name" placeholder="Nom du point de vente" required>
								</div>
									
								<div class="form-group">
										<label for="pos_address">ADRESSE</label>
										<input type="text" class="form-control" name="pos_address" id="pos_address" placeholder="Adresse">
								</div>
								<div class="form-group">
										<label for="pos_id">CONNECTER AU DEPOT</label>
										<select name="pos_id" id="pos_id" class="form-control">
											<?php foreach ($warehouses as $item) {?>
														
													<option value="<?php echo $item['warehouse_id']?>"><?php echo $item['warehouse_name']?></option>
											<?php  }?>
										</select>
								</div>
								
							<button type="submit"  class="btn btn-primary">Ajouter point de vente</button>
		
							<?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<div class="col-md-6">
				<div class="card card-outline card-info">
					<div class="card-header">
						<h4 class="title">Taux d'echange</h4>
					</div>
					<div class="card-body">
						<?php echo 	form_open('setting/update_rate');?>
								<div class="form-group form-inline form-row">
									<div class="col-sm-2 align-content-end">
										<label for="">1$=</label>
									</div>
									<div class="col-sm-6 row">
										<input type="number" step="any" name="rate" id="rate" value="<?php echo $c_rate['rate']?>" class="form-control">
										<label for="">CDF</label>
									</div>
									<div class="col-sm-4">
										<button type="submit"  class="btn btn-success">Mise à jour</button>
									</div>
								</div>
						<?php echo 	form_close(); ?>
						
						
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="card card-outline card-info">
					<div class="card-header">
						<h4 class="title">Facturier & Point de vente</h4>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-striped">
								<thead>
									<tr>
										<th>Identifiant</th>
										<th>Point de vente</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($up as $item) {?>
										<tr>
											<td><?php echo $item['username']?></td>
											<td><?php echo $item['pos_name']?></td>
										</tr>
								<?php	}?>
								</tbody>
							</table>
						</div>
						<?php echo form_open('pos/assign_user_pos')?>
						<div class="form-group">
							<label for="">Utilisateurs(Facturiers)</label>
							<div class="col-sm-8">

								<select name="user" id="user" class="form-control">
									<?php foreach ($users as $item) {?>
										# code...
										<option value="<?php echo $item['user_id']?>"><?php echo $item['username']?></option>
								<?php	}?>
								</select>
							</div>
						</div>
						<i class="fa fa-arrow-down"></i>
						<div class="form-group">
							<label for="">Point de vente(Affectation)</label>
							<div class="col-sm-8">

								<select name="pos" id="pos" class="form-control">
									<?php foreach ($pos as $item) {?>
										
										<option value="<?php echo $item['pos_ws_id']?>"><?php echo $item['pos_name']?></option>
									<?php }?>
								</select>
							</div>
						</div>

					</div>
					<div class="card-footer">
						<button class="btn btn-success" type="submit">valider affection</button>
					</div>
					<?php echo form_close()?>
				</div>
			</div>
        </div>
    </div>
</div>

<!-- modal store-->

<div class="modal fade" id="modalStore" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Ajouter Magasin</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			
			<?php echo form_open('setting/create_store');?>
			<div class="modal-body">
				<?php if ($store != null) {?>
				
					<div class="form-group">
						<label for="store_name">DESIGNATION</label>
						<input type="text" value="<?php echo $store['store_name']?>" class="form-control" name="store_name" id="store_name" placeholder="Nom du magasin">
					</div>
					
					<div class="form-group">
						<label for="rccm">RCCM</label>
						<input type="text"  value="<?php echo $store['rccm']?>" class="form-control" name="rccm" id="rccm" placeholder="RCCM">
					</div>
					<div class="form-group">
						<label for="id_nat">iD. NAT</label>
						<input type="text"  value="<?php echo $store['id_nat']?>" class="form-control" name="id_nat" id="id_nat" placeholder="Identification National">
					</div>
					<div class="form-group">
						<label for="nif">NUMERO IMPOT</label>
						<input type="text"  value="<?php echo $store['nif']?>" class="form-control" name="nif" id="nif" placeholder="Numero Impot">
					</div>
					<div class="form-group">
						<label for="telephone">TELEPHONE</label>
						<input type="tel"  value="<?php echo $store['telephone']?>" class="form-control" name="telephone" id="telephone" placeholder="Téléphone">
					</div>
					<div class="form-group">
						<label for="adresse">ADRESSE</label>
						<input type="text"  value="<?php echo $store['adresse']?>" class="form-control" name="adresse" id="adresse" placeholder="Adresse">
					</div>
						
				<?php }else {?>
					<div class="form-group">
						<label for="store_name">DESIGNATION</label>
						<input type="text"  class="form-control" name="store_name" id="store_name" placeholder="Nom du magasin">
					</div>
					
					<div class="form-group">
						<label for="rccm">RCCM</label>
						<input type="text"   class="form-control" name="rccm" id="rccm" placeholder="RCCM">
					</div>
					<div class="form-group">
						<label for="id_nat">iD. NAT</label>
						<input type="text"  class="form-control" name="id_nat" id="id_nat" placeholder="Identification National">
					</div>
					<div class="form-group">
						<label for="nif">NUMERO IMPOT</label>
						<input type="text"   class="form-control" name="nif" id="nif" placeholder="Numero Impot">
					</div>
					<div class="form-group">
						<label for="telephone">TELEPHONE</label>
						<input type="tel"  class="form-control" name="telephone" id="telephone" placeholder="Téléphone">
					</div>
					<div class="form-group">
						<label for="adresse">ADRESSE</label>
						<input type="text"  class="form-control" name="adresse" id="adresse" placeholder="Adresse">
					</div>
				<?php }?>
			</div>
			<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
					<button type="button" id="btn_add_store" class="btn btn-success">Enregistrer</button>
			</div>
				
			<?php echo	form_close(); ?>
	</div>
</div>

