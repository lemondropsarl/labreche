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
                                <dd class="col-sm-8"><?php echo $store['Store_name'];?></dd>
                                <dt class="col-sm-4">RCCM</dt>
                                <dd class="col-sm-8"><?php echo $store['rccm'];?></dd>
                                <dt class="col-sm-4">ID. NAT</dt>
                                <dd class="col-sm-8"><?php echo $store['id_nat'];?></dd>
                                <dt class="col-sm-4">No IMPOT</dt>
                                <dd class="col-sm-8"><?php echo $store['nif'];?></dd>
                                
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
                        <h4>Points de vente et Depots</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group form">
                           <div class="col-md-6">

                               <label>Nom depot</label>
                               <select name="ws" id="" class="form-control">
                                   <?php foreach ($warehouses as $item) {?>
                                       
                                       <option value="<?php echo $item['warehouse_id']?>"><?php echo $item['warehouse_name']?></option>
                                <?php   }?>
                               </select>
                               <a href="#" data-toggle="modal" data-target="#modalWare"><i class="fa fa-plus-square"></i> nouveau dépôt</a>
                           </div>
                           
                            <div class="col-md-6">
                                <label>Point de vente</label>
                               <select name="pos" id="" class="form-control">
								   <?php foreach ($pos as $item) {?>
									   
									   <option value="<?php echo $item['pos_ws_id']?>"><?php echo $item['pos_name']?></option>
								<?php   }?>
                               </select>
                               <a href="#" data-toggle="modal"  data-target="#modalPos"><i class="fa fa-plus-square"></i> Nouveau point de vente</a>

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
										<label for="">1$ =</label>
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
						<input type="text" value="<?php echo $store['Store_name']?>" class="form-control" name="store_name" id="store_name" placeholder="Nom du magasin">
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
				
				<?php }?>
			</div>
			<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
					<button type="button" id="btn_add_store" class="btn btn-success">Enregistrer</button>
			</div>
				
			<?php echo	form_close(); ?>
	</div>
</div>

<!-- modal warehouse-->

<div class="modal fade" id="modalWare" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Ajouter Depot</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?php echo form_open('warehouse/create_warehouse'); ?>
			<div class="modal-body">
				<div class="form-group">
					<label for="ws_name">DESIGNATION</label>
					<input type="text" class="form-control" name="ws_name" id="ws_name" placeholder="Nom du depot">
				</div>
				
                <div class="form-group">
					<label for="ws_address">ADRESSE</label>
					<input type="text" class="form-control" name="ws_address" id="ws_address" placeholder="Adresse">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
				<button type="button" id="btn_add_ws" class="btn btn-success">Enregistrer</button>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>

<div class="modal fade" id="modalPos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Ajouter Point de vente</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?php echo form_open('pos/create_pos'); ?>
			<div class="modal-body">
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
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
				<button type="button" id="btn_add_pos" class="btn btn-success">Enregistrer</button>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>
