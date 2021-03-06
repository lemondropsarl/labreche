<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content">
	<div class="container-fluid">
       
		<div class="row">
			<div class="col-md-6">
				<div class="card card-outline card-primary">
					<div class="card-header">
						<h4 class="card-title"><?php echo lang('list_of_group')?></h4>
						<div class="card-tools">
							<a class="pull-left btn btn-primary" href="#" data-toggle="modal" data-target="#group">
								<?php echo lang('new')?>
							</a>
						</div>
					</div>

					<div class="card-body">
						<div class=" table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th><?php echo lang('name_label')?></th>
										<th><?php echo lang('description_label')?></th>
									</tr>
								</thead>
								<tbody>
									<?php 
                                            foreach ($groups as $v) {?>
									<tr>
										<td><?php echo $v->name;?></td>
										<td><?php echo $v->description;?></td>
									</tr>
									<?php }
                                        ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="card card-outline card-info">
					<div class="card-header">
						<h4 class="card-title"><?php echo lang('list_of_permission')?></h4>
						<div class="card-tools">
							<a class="pull-left btn btn-info" href="#" data-toggle="modal" data-target="#perm">
								<?php echo lang('new')?>
							</a>
						</div>

					</div>

					<div class="card-body">
						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th><?php echo lang('key_label')?></th>
										<th><?php echo lang('name_label')?></th>

									</tr>
								</thead>
								<tbody>
									<?php 
                                            foreach ($permissions as $v) {?>
									<tr>
										<td><?php echo $v['key'];?></td>
										<td><?php echo $v['name'];?></td>
									</tr>
									<?php }
                                        ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="card card-outline card-danger">
					<div class="card-header">
						<h4 class="card-title"><?php echo lang('group_permissions_label')?></h4>
						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse"><i
									class="fas fa-minus"></i></button>
						</div>

					</div>
					<div class="card-body">
						<div class="table-responsive">

							<table class="table">
								<thead>
									<tr>
										<th><?php echo lang('groups')?></th>
										<?php 
											$perm =array();
											$gp = array();
											foreach ($permissions as  $v) {
												$id = $v['id'];
												$name = $v['name'];
												$perm[$id] = $name;
											}
											foreach ($groups as $v) {
												$id =$v->id;
												$name =$v->name;
												$gp[$id] = $name;
											}
                                                foreach (array_keys(current($matrix)) as $perm_name) {?>
										<th><?php echo lang($perm[$perm_name]);?></th>
										<?php }
                                            ?>
									</tr>
								</thead>
								<tbody>
									<?php 
									 echo form_open('badmin/update_gp');
                                            foreach (array_keys($matrix) as $group_id) {?>
									<tr>
										<td><?php echo $gp[$group_id];?></td>
										<?php 
														foreach (array_keys($matrix[$group_id]) as $perm_id) {
															if ($matrix[$group_id][$perm_id] == '1') {?>
										<td>
											<input type="checkbox"
												name="<?php echo $perm_id;?>_<?php echo $group_id;?>_" value="1"
												checked>
										</td>
										<?php }else {?>
										<td>
											<input type="checkbox"
												name="<?php echo $perm_id;?>_<?php echo $group_id;?>_" value="0">
										</td>
										<?php	}
														}?>
									</tr>
									<?php	}
                                        ?>
								</tbody>
							</table>
							<p>
								<button type="submit" class="btn btn-danger" value="save"><?php echo lang('update_permission')?></button>
							</p>
							<?php echo form_close();?>
						</div>
					</div>

				</div>
			</div>
		</div>
		<!--modals-->
	</div>
</div>
</div>
<div class="modal fade" tabindex="-1" id="group" role="dialog" aria-labelledby="groupLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
            <h4 class="modal-title"><?php echo lang('new_group_label')?></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
			</div>
			<?php echo form_open('auth/create_group');?>
			<div class="modal-body">
				<div class="form-group">
					<label class=" control-label"><?php echo lang('name_label')?></label>
					<input type="text" class="form-control" name="group_name" />
				</div>
				<div class="form-group">
					<label class="control-label"><?php echo lang('description_label')?></label>
					<input type="text" class="form-control" name="description" />
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-success"><?php echo lang('save_label')?></button>
			</div>
			<?php echo form_close();?>
		</div>
	</div>
</div>
<div class="modal fade" tabindex="-1" id="perm" role="dialog" aria-labelledby="permLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"><?php echo lang('new_permission_label')?>-</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
			</div>
			<?php echo form_open('badmin/add_permission');?>
			<div class="modal-body">
				<div class="form-group bmd-form-group">
					<label class=" control-label"><?php echo lang('key_label')?></label>
					<input type="text" class="form-control" name="perm_key" />
				</div>
				<div class="form-group bmd-form-group">
					<label class=" control-label"><?php echo lang('name_label')?></label>
					<input type="text" class="form-control" name="perm_name" />
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-success"><?php echo lang('save_label')?></button>
			</div>
			<?php echo form_close();?>
		</div>
	</div>
</div>

