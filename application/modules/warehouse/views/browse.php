<?php 
defined('BASEPATH') OR exit('No direct script access allowed');



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
		</div>

		<div class="col-md-12">
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
										<?php foreach ($stock_list as $item) {?>
											
											<tr>
												<td><?php echo $item['pcode'];?></td>
												<td><?php echo $item['pname'];?></td>
												<td><?php echo $item['uom'];?></td>
												<td><?php echo $item['min_qty'];?></td>
												<td><?php echo $item['qty'];?></td>
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
</div>
