<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-4">
				<div class="small-box  bg-gradient-navy">
					<div class="inner">
						<h3><?php echo $count_stock;?></h3>
						<p>Articles disponible</p>
					</div>
					<div class="icon">
						<i class="fas fa-product-hunt"></i>
					</div>
					<a href="#" class="small-box-footer"></a>
						
				</div>
			</div>
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-4">
				<div class="small-box bg-primary">
					<div class="inner">
						<h3><?php if ($value_usd['total']) {
						 echo number_format($value_usd['total'],2,',', ' '); }else {?>
							 0
						 <?php }?>
						
						</h3>							
						<p>Valeur du stock USD</p>
					</div>
					<div class="icon">
						<i class="fas fa-dollar-sign"></i>
					</div>
					<a href="#" class="small-box-footer"></a>
				</div>
			</div>
			<div class="col-lg-3 col-md-2 col-sm-2 col-xs-2">
				<div class="small-box bg-gradient-gray">
					<div class="inner">
						<h3><?php echo $count_entries_out;?></h3>
						<p>Total sortie journlière</p>
					</div>
					<div class="icon">
						<i class="fas fa-calendar-check"></i>
					</div>
					<a href="<?php echo base_url('warehouse/entry_out');?>" class="small-box-footer"
						>plus d'infos <i class="fa fa-arrow-alt-circle-right"></i
					></a>
				</div>
			</div>
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-4">
				<div class="small-box bg-red">
					<div class="inner">
						<h3><?php echo $count_critical_stock;?></h3>
						<p>Total stock en critique</p>
					</div>
					<div class="icon">
						<i class="ion ion-pie-graph"></i>
					</div>
					<a href="<?php echo base_url('warehouse/critical_stock');?>" class="small-box-footer"
						>plus d'infos <i class="fa fa-arrow-alt-circle-right"></i
					></a>
				</div>
			</div>
		</div>

		<div class="row">	
		<div class="col-md-12">
					<div class="card card-outline card-info">
						<div class="card-header">
							<div class="card-title">
								<h4>Liste stock</h4>
							</div>
						</div>

						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered table-striped">
									<thead class="thead-dark">
										<tr>
											<th class="center">Code article</th>
											<th class="center">Nom article</th>
											<th class="center">Unité</th>
											<th class="center">Min. qté</th>
											<th class="center">Act. Qté</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($stock_list as $item) {?>
											
											<tr>
												<td><?php echo $item['pcode'];?></td>
												<td><?php echo $item['pname'];?></td>
												<td><?php echo $item['uom'];?></td>
												<td><?php echo $item['min_qty'];?></td>
												<td class="text-bold"><?php echo $item['qty'];?></td>
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
