<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content">
	<div class="container-fluid">
		<!-- your content here -->
		<div class="row">
            <div class="col-md-12">
				<div class="card card-outline card-primary">
					<div class="card-header">
					<p>
						<a class="pull-right btn btn-primary" href="<?php echo base_url('auth/create_user');?>">
							<?php echo lang('new')?>
						</a>
					</p>
						<h4 class="card-title"><?php echo lang('list_users')?></h4>
                  		<!--p class="card-category"> Here is a subtitle for this table</p-->
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-striped">
								<thead class="text-primary">
									<th>First name</th>
									<th>Ladt name</th>
									<th>Email</th>
									<th>Phone number</th>
									<th>&nbsp;</th>
								</thead>
								<tbody>
									<?php 
										foreach ($users as $user) {?>
											<tr>
												<td><?php echo $user->first_name;?></td>
												<td><?php echo$user->last_name;?></td>
												<td><?php echo$user->email;?></td>
												<td><?php echo$user->phone;?></td>
												<td>
													<a class="text-primary" href="<?php echo site_url('badmin/manage_user/'.$user->id);?>">Details</a>
												</td>
											</tr>
									<?php	}?>
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


