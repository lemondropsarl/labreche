<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<div class="content">
	<div class="container-fluid">
		<!-- your content here -->
		<div class="row">
            <div class="col-md-12">
				<div class="row">
					<div class="col-lg-3">

						<div class="small-box bg-info">
							<div class="inner">
								<h3>1500</h3>
								<p>categorie</p>
							</div>
							<div class="icon">
								<i class=""></i>
							</div>
						</div>
					</div>
					<div class="col-lg-3">

						<div class="small-box bg-purple">
							<div class="inner">
								<h3>1500</h3>
								<p>Accessoire</p>
							</div>
							<div class="icon">
								<i class="fas fa-car"></i>
							</div>
						</div>
					</div>
					<div class="col-lg-3">

						<div class="small-box bg-primary">
							<div class="inner">
								<h3>1500</h3>
								<p>moteur</p>
							</div>
							<div class="icon">
								<i class=""></i>
							</div>
						</div>
					</div>
				</div>
				<div class="card card-outline card-secondary">
					<div class="card-header">
						<h4 class="card-title">Liste des articles</h4>
						<div class="card-tools">
								<button type="button" class="btn btn-tool" data-card-widget="collapse"><i
									class="fas fa-minus"></i></button>
						</div>

					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>Nom article</th>
										<th>Code Article</th>
										<th>Prix Unitaire</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($products as $item) {?>
										
										<tr>
											<th><?php echo $item['product_name'];?></th>
											<th><?php echo $item['product_code'];?></th>
											<th><?php echo $item['unit_price'];?></th>
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