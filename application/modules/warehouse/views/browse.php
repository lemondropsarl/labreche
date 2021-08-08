<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

$user_id = $this->session->flashdata('user_id');

?>

<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-4">
				<div class="small-box bg-primary">
					<div class="inner">
						<h3>1500</h3>
						<p>Valeur du stock CDF</p>
					</div>
					<div class="icon">
						<i class="fas fa-dollar-sign"></i>
					</div>
					<a href="http://" class="small-box-footer"
						>plus d'infos <i class="fa fa-arrow-alt-circle-right"></i
					></a>
				</div>
			</div>
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-4">
				<div class="small-box bg-primary">
					<div class="inner">
						<h3>1500</h3>
						<p>Valeur du stock USD</p>
					</div>
					<div class="icon">
						<i class="fas fa-dollar-sign"></i>
					</div>
					<a href="http://" class="small-box-footer"
						>plus d'infos <i class="fa fa-arrow-alt-circle-right"></i
					></a>
				</div>
			</div>
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-4">
				<div class="small-box bg-gradient-gray">
					<div class="inner">
						<h3>1500</h3>
						<p>TOTAL SORTIE</p>
					</div>
					<div class="icon">
						<i class="fas fa-calendar-check"></i>
					</div>
					<a href="http://" class="small-box-footer"
						>plus d'infos <i class="fa fa-arrow-alt-circle-right"></i
					></a>
				</div>
			</div>
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-4">
				<div class="small-box bg-red">
					<div class="inner">
						<h3>1500</h3>
						<p>TOTAL STOCK CRITIQUE</p>
					</div>
					<div class="icon">
						<i class="ion ion-pie-graph"></i>
					</div>
					<a href="http://" class="small-box-footer"
						>plus d'infos <i class="fa fa-arrow-alt-circle-right"></i
					></a>
				</div>
			</div>

			<div class="col-md-12">
				<div class="card">
					<div class="card-header card-outline card-success">
						<div class="card-title">
							<h4>Mouvement recent du depot</h4>
						</div>
					</div>
					<div class="card-body">
						<h3>can only show 5 recent movement</h3>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-12">
			<div class="row">
				<div class="col-md-4">
					<div class="card card-secondary">
						<div class="card-header">
							<div class="card-title">
								<h4>Entree stock</h4>
							</div>
						</div>
						<div class="card-body">
                            <?php echo form_open('warehouse/entry_in')?>
                                <input type="hidden" name="pid">
								<div class="form-row">
									<div class="col-md-12">

										<div class="form-group">
											<label for="pname">Nom article:</label>		
											<input type="number" class="form-control" id="si_pname" placeholder="Nom article" name="pname" disabled="true" />
								
										</div>
										<div class="form-group col-6">
											<label for="si_qty">Quantité</label>
											<input type="number" class="form-control" id="si_qty" placeholder="quantité" name="si_qty" required>
											<div class="erreur cache" id="si_qty_erreur">Vérifier la quantite</div>
		
										</div>
										<div class="form-group col-6">
											<label>Date d'entree</label>
											<input type="date" name="si_date" id="">
										</div>
										<div class="form-group col-6">
											<label>Zone</label>
											<select class="form-control" name="prod_zone_id" id="">
												<?php foreach ($zones as $item) {?>
													# code...
													<option value="<?php echo $item['zone_id'];?>"><?php echo $item['zone_name'];?></option>
												<?php }?>
											</select>
										</div>
										<div class="form-group col-6">
											<label>Etagère</label>
											<select class="form-control" name="prod_shelf_id" id="">
												<?php foreach ($shelfs as $item) {?>
													# code...
													<option value="<?php echo $item['shelf_id'];?>"><?php echo $item['shelf_name'];?></option>
												<?php }?>
											</select>
										</div>
									</div>

								</div>                         
								
							</div>
							<div class="card-footer">
								<div class="form-group btn-group">
									<button type="button" class="btn btn-success">Terminé</button>
								</div>
							</div>
							<?php echo form_close();?>
					</div>
					<div class="card card-warning">
						<div class="card-header">
							<div class="card-title">
								<h4>sortie stock</h4>
							</div>
						</div>
						<div class="card-body"></div>
					</div>
				</div>
				<div class="col-md-8">
					<div class="card card-outline card-info">
						<div class="card-header">
							<div class="card-title">
								<h4>Liste stock</h4>
							</div>
						</div>

						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>Code article</th>
											<th>Nom article</th>
											<th>Unité</th>
											<th>Min. qté</th>
											<th>Act. Qté</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
