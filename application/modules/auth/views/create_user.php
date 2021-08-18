<?php 
defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<?php if ($message != "") {?>
				<div class="alert alert-danger">
					<p><?php echo $message;?></p>
				</div>
				<?php }?>
				<div class="card card-primary">
					<div class="card-header">
						<h3 class="card-title"><?php echo lang('account_new')?></h3>
					</div>
					<div class="card-body">
						<?php echo form_open('auth/create_user');?>
						<div class="row">
							<div class="col-md-4">
								<div class="input-group mb-3">
									<input type="text" class="form-control" name="identity" placeholder="usename">
									<div class="input-group-append">
										<div class="input-group-text">
											<span class="fas fa-user"></span>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="input-group mb-3">
									<input type="text" class="form-control" name="first_name"
										placeholder="<?php echo lang('account_first_name_label')?>">
									<div class="input-group-append">
										<div class="input-group-text">
											<span class="fas fa-user"></span>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="input-group mb-3">
									<input type="text" class="form-control" name="last_name"
										placeholder="<?php echo lang('account_last_name_label')?>">
									<div class="input-group-append">
										<div class="input-group-text">
											<span class="fas fa-user"></span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="input-group mb-3">
									<input type="text" class="form-control" name="company"
										placeholder="<?php echo lang('account_company_label')?>">
									<div class="input-group-append">
										<div class="input-group-text">
											<span class="fas fa-home"></span>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="input-group mb-3">
									<input type="text" class="form-control" name="email"
										placeholder="<?php echo lang('account_email_label')?>">
									<div class="input-group-append">
										<div class="input-group-text">
											<span class="fas fa-envelope"></span>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="input-group mb-3">
									<input type="text" class="form-control" name="phone"
										placeholder="<?php echo lang('account_phone_label')?>">
									<div class="input-group-append">
										<div class="input-group-text">
											<span class="fas fa-phone"></span>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="input-grou mb-3">
									<select class=" form-control" name="group_id">
										<option value=""><?php echo lang('select_role')?></option>
										<?php foreach ($group_available as $v) {?>

										<option value="<?php echo $v['id'];?>"><?php echo $v['name'];?></option>
										<?php }?>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="input-group mb-3">
									<div class="input-group-append">
										<div class="input-group-text">
											<span class="fas fa-lock"></span>
										</div>
									</div>
									<input type="text" class="form-control" name="password"
										placeholder="<?php echo lang('password_label')?>">
								</div>
							</div>
						</div>
						<div class="row">

							<div class="col-md-4">
								<div class="input-group mb-3">
									<div class="input-group-append">
										<div class="input-group-text">
											<span class="fas fa-lock"></span>
										</div>
									</div>
									<input type="text" class="form-control" name="password_confirm"
										placeholder="<?php echo lang('password_confirm_label')?>">
								</div>
							</div>
						</div>
					</div>
					<div class="card-footer">

						<button type="submit" class="btn btn-success"><?php echo lang('register')?></button>
					</div>
				</div>
				<?php echo form_close();?>
			</div>
		</div>
	</div>
</div>
</div>

