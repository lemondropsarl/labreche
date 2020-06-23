<?php 
defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<dic class="col-md-8">
				<div class="card card-outline card-warning">
					<div class="card-header">
						<h4 class="card-title"><?php echo lang('user_profile')?></h4>
					</div>
					<?php echo form_open('');?>
					<div class="card-body">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label"><?php echo lang('account_company_label')?></label>
									<input type="text" class="form-control" disabled
										value="<?php echo $user->company;?>">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label"><?php echo lang('account_email_label')?></label>
									<input type="email" class="form-control" value="<?php echo $user->email;?>">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label"><?php echo lang('account_username_label')?></label>
									<input type="text" class="form-control" value="<?php echo $user->username;?>">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class=" control-label"><?php echo lang('account_first_name_label')?></label>
									<input type="text" class="form-control" value="<?php echo $user->first_name;?>">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="control-label"><?php echo lang('account_last_name_label')?></label>
									<input type="text" class="form-control" value="<?php echo $user->last_name;?>">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="bmd-label-floating">Phone number</label>
									<input type="text" class="form-control" value="<?php echo $user->phone;?>">
								</div>
							</div>
						</div>
					</div>
					<div class="card-footer">
						<button type="submit"
							class="btn btn-warning pull-right"><?php echo lang('update_profile_label') ?></button>
					</div>
					<?php echo form_close();?>
				</div>
			</dic>
			<dic class="col-md-4">
				<div class="card card-outline card-success">
					<div class="card-header align-self-auto">

						<img class=" img-circle img-size-75"
							src="<?php echo base_url('assets/dist/img/avatar5.png');?>" />

						<text class="card-subtitle text-center bottom-left">Position</text>
					</div>
					<div class="card-body">
						<h6 class="small">Groups</h6>
						<div>
							<?php foreach($user_groups as $ug) : ?>
							<span class="badge badge-success small"><?php echo $ug->description; ?></span>
							<?php endforeach; ?>
						</div>

						<h6 class="small">Permissions</h6>
						<div>

							<?php foreach($user_acl as $acl) : ?>

							<?php if($this->ion_auth_acl->has_permission($acl['key'], $user_acl)) : ?><span
								class="badge badge-success"><?php echo $acl['name']; ?></span><?php else: ?><span
								class="badge badge-danger"><?php echo $acl['name']; ?></span><?php endif; ?><?php if($acl['inherited']) : ?>
							<span class="badge badge-warning"><?php echo $acl['name']; ?></span><?php endif; ?>
							<?php endforeach; ?>

						</div>
					</div>
				</div>
			</dic>
		</div>
		<div class="row">
			<?php if ($this->ion_auth_acl->has_permission('A')) {?>
			<div class="col-md-12">
				<div class="card card-outline card-danger">
					<div class="card-header">

						<h4 class="card-title"><?php echo lang('manage_user_permission')?></h4>
						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse"><i
									class="fas fa-minus"></i></button>
						</div>
					</div>


					<div class="card-body">
						<div class="table-responsive">

							<?php echo form_open('badmin/user_permissions/'.$user_id); ?>

							<table class="table">
								<thead>
									<tr>
										<th><span class="badge badge-secondary"><?php echo lang('permissions')?></span>
										</th>
										<th><span class="badge badge-success"><?php echo lang('allow')?></span></th>
										<th><span class="badge badge-danger"><?php echo lang('deny')?></span></th>
										<th><span
												class="badge badge-warning"><?php echo lang('inherit_from_group')?></span>
										</th>
									</tr>
								</thead>
								<tbody>
									<?php if($permissions) : ?>
									<?php foreach($permissions as $k => $v) : ?>
									<tr>
										<td><?php echo $v['name']; ?></td>
										<td>

											<?php echo form_radio("perm_{$v['id']}", '1', set_radio("perm_{$v['id']}", '1', $this->ion_auth_acl->is_allowed($v['key'], $user_acl))); ?>

										</td>
										<td>
											<?php echo form_radio("perm_{$v['id']}", '0', set_radio("perm_{$v['id']}", '0', $this->ion_auth_acl->is_denied($v['key'], $user_acl))) ?>
										</td>
										<td>
											<?php echo form_radio("perm_{$v['id']}", 'X', set_radio("perm_{$v['id']}", 'X', ( $this->ion_auth_acl->is_inherited($v['key'], $user_acl) || ! array_key_exists($v['key'], $user_acl)) ? TRUE : FALSE)); ?>
											(<?php echo lang('inherit')?>
											<?php echo ($this->ion_auth_acl->is_inherited($v['key'], $group_permissions, 'value')) ?  lang('allow') : lang('deny'); ?>)
										</td>
									</tr>
									<?php endforeach; ?>
									<?php else: ?>
									<tr>
										<td colspan="4">There are currently no permissions to manage, please add
											some
											permissions</td>
									</tr>
									<?php endif; ?>
								</tbody>
							</table>

							<p>
								<button type="submit" class="btn btn-danger"
									value="update"><?php echo lang('update_permission')?></button>

							</p>

							<?php echo form_close(); ?>
						</div>
					</div>

				</div>
			</div>
			<div class="col-md-12">
				<div class="card card-outline card-primary">
					<div class="card-header">
						<h4 class="card-title"><?php echo lang('manage_user_group')?></h4>
						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse"><i
									class="fas fa-minus"></i></button>
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<?php echo form_open('badmin/group_permissions'.$user_id);?>
							<table class="table">
								<thead>
									<tr>
										<th><span class="badge badge-secondary"><?php echo lang('groups')?></span></th>
										<th><span class="badge badge-danger"><?php echo lang('no_label')?></span>/<span class="badge badge-success"><?php echo lang('yes_label')?></span></th>

									</tr>
								</thead>
								<tbody>
									<?php if ($groups) {
											$ug = array();
											foreach ($user_groups as  $value) {
												$ug[] = $value->id;
											}
									
											foreach ($groups as $v) {?>

									<tr>
										<td><?php echo $v->name;?></td>
										<?php if (in_array($v->id,$ug)) { ?>
										<td>
											

												<input type="checkbox" value="1" name="group_<?php echo$v->id;?>" checked>
											
										</td>

										<?php	}else {?>
										<td>
											<input type="checkbox" value="0" name="group_<?php echo$v->id;?>">

										</td>
										<?php }?>
									</tr>

									<?php
										}
										}?>
								</tbody>
							</table>
							<p>
								<button type="submit" class="btn btn-primary" value="assign"><?php echo lang('update_group_acl')?></button>

							</p>
							<?php echo form_close();?>
						</div>
					</div>

				</div>
			</div>
			<?php } ?>
		</div>
	</div>
</div>
