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
                               <select name="" id="" class="form-control">
                                   <option value=""></option>
                               </select>
                               <a href="#" data-toggle="modal"  data-target="#modalPos"><i class="fa fa-plus-square"></i> Nouveau point de vente</a>

                            </div>
                        </div>
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
			<?php echo form_open('setting/create_store'); ?>
			<div class="modal-body">
				<div class="form-group">
					<label for="store_name">DESIGNATION</label>
					<input type="text" class="form-control" name="store_name" id="store_name" placeholder="Nom du magasin">
				</div>
				
                <div class="form-group">
					<label for="rccm">RCCM</label>
					<input type="text" class="form-control" name="rccm" id="rccm" placeholder="RCCM">
				</div>
				<div class="form-group">
					<label for="id_nat">iD. NAT</label>
					<input type="text" class="form-control" name="id_nat" id="id_nat" placeholder="Identification National">
				</div>
				<div class="form-group">
					<label for="nif">NUMERO IMPOT</label>
					<input type="text" class="form-control" name="nif" id="nif" placeholder="Numero Impot">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
				<button type="button" id="btn_add_store" class="btn btn-success">Enregistrer</button>
			</div>
			<?php echo form_close(); ?>
		</div>
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
					<input type="text" class="form-control" name="pos_address" id="pos_address" placeholder="Adresse" reauired>
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
