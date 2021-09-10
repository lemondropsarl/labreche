<?php
defined('BASEPATH') or exit('No direct script access allowed');

?>
<div class="cnntent">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-8">
				<div class="card card-outline card-info">
					<div class="card-header">
						<h4 class="title">Détails facture</h4>
						<div class="card-tools">
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-stripped">
								<thead class="thead-dark">
									<tr>
										<th>No #</th>
										<th>DESIGNATION</th>
										<th>Quantity</th>
										<th>Prix unitaire</th>
										<th>Prix Total</th>
									</tr>
								</thead>
								<tbody>
									<?php
									
									$num = 1;
									foreach ($inv_details as $item) { ?>
										<tr  class="ligne_rembourser ligne_rembourser<?php echo $num ?>" data-quantite<?php echo $num ?>="<?php echo $item['quantity']; ?>" data-id<?php echo $num ?>="<?php echo $item['id']; ?>" data-facture="<?php echo $item['pi_invoice_id']; ?>" >
											<td><?php echo $num ?></td>
											<td><?php echo $item['pname'] ?></td>
											<td><?php echo $item['quantity'] ?></td>
											<td><?php echo $item['uprice'] ?></td>
											<td class="text-md-right"><?php echo $item['total']?></td>
										</tr>
									<?php
										$num++;
									} ?>
								</tbody>
								<tfooter>
									<tr>
										<th colspan="4" class="bg-dark">Sous Total</th>
										<td class="text-bold text-md-right"><?php echo strval((int)$inv['inv_total_amount'] - (int)$inv['inv_vat_amount']) ?></td>
									</tr>
									<tr>
										<th colspan="4" class="bg-dark">Reduction</th>
										<td class="text-bold text-md-right"><?php echo $inv['inv_discount_amount'] ?></td>
									</tr>
									<tr>
										<th colspan="3" class="bg-dark">TVA</th>
										<td>16%</td>
										<td class="text-bold text-md-right"><?php echo $inv['inv_vat_amount'] ?></td>
									</tr>
									<tr>
										<th colspan="4" class="bg-dark">Total General</th>

										<td class="text-bold text-md-right"><?php echo $inv['inv_total_amount'] ?></td>
									</tr>
								</tfooter>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card card-outline card-default">
					<div class="card-header">
						<h4 class="title">Panneau</h4>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-sm-6">

								<button type="button" name="btn_print" id="btn_print" class="btn btn-success">Imprimer</button>
							</div>
							<div class="col-sm-6">
								<button type="button" id="bt_rembourser" class="btn btn-danger">Rembourser</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
