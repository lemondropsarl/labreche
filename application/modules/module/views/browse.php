<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card card-outline card-secondary">
					
					<div class="card-header">
						<h4 class="card-title"><?php echo lang('module_quick_action_label')?></h4>
						<div class="card-tools">

							<button type="button" class="btn btn-tool" data-card-widget="collapse"><i
									class="fas fa-minus"></i></button>

						</div>
					</div>
					
					<div class="card-body">
							<div class="row">
								<div class="col-md-6">
								<?php echo form_open_multipart()?>
									<div class=" wrapper">
										<input type="file" name="extension"/>
										<button type="submit" class="btn btn-warning"><i class="fas fa-upload"></i></button>
									</div>
									<?php echo form_Close()?>
								</div>
								<?php if ($module_name !="") {?>
									<div class="col-md-6">
									<?php echo form_open('module/install_module/'.$module_name);?>
									
										<div class="card">
											<div class="card-body">
												<p class="text-center"><?php echo lang('upload_success')?></p>
												<div>
													<button class="btn btn-success"><?php echo lang('install_label')?></button>
												</div>
											</div>
										</div>
										<?php echo form_close();?>
										
									</div>
							<?php	}?>
							</div>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="card card-outline card-primary">
					<div class="card-header">
						<h4 class="card-title"><?php echo lang('module_installed_label')?></h4>
						<div class="card-tools">

							<button type="button" class="btn btn-tool" data-card-widget="collapse"><i
									class="fas fa-minus"></i></button>

						</div>
					</div>
					<div class="card-body">

						<div class="row">
							<?php foreach ($modules as $v) {?>

						<div class="col-md-3">
								<div class="card">
									<div class="card-header align-self-center">
										<a href="#">
											<img class="img img-rounded img-size-50"
												src="<?php echo base_url('assets/dist/img/default-150x150.png');?>" />
										</a>
										
									</div>
									<div class="card-body">
										<h6 class="card-subtitle text-bold text-center"><?php echo $v['module_display_name']?></h6>
										<p class="description-text text-justify small">
											<?php echo $v['module_description']?>
										</p>
										<div class="row">
											<div class="col-lg-4">
												<h8>v<?php echo $v['module_version']?></h8>
											</div>
											<div class="col-lg-3">

												<span class="badge pull-left <?php if ($v['module_status'] == 1) {
													echo "badge-success";
													}else {
													echo "badge-danger";
													}?>"><?php if ($v['module_status'] == 1) {?>
														
														<?php }else {?>
														
														<?php }?>
														</span>
											</div>
											<div class="col-lg-5">
												<?php if ($v['is_preloaded'] == 1) {?>
												   <span class="badge badge-primary small"><?php echo lang('preloaded')?></span>
												<?php }?>
											</div>
											<div class="col-md-12">
												<?php if (1.1 > intval($v['module_version'])) {?>
												<span class="badge badge-warning">

													<a href="<?php echo site_url('module/update_extension/'.$v['module_name'])?>"
													class=" small text-white">
														<?php echo lang('update_label')?>
														
													</a>
												</span>
												<?php }?>
											</div>
										</div>
									</div>
								</div>
							</div>
							<?php }?>
						</div>
					</div>
				</div>

			</div>
			<div class="col-md-12">
				<div class="card card-outline card-success">
					
					<div class="card-header">
						<h4 class="card-title"><?php echo lang('module_online_label')?></h4>
						<div class="card-tools">

							<button type="button" class="btn btn-tool" data-card-widget="collapse"><i
									class="fas fa-minus"></i></button>

						</div>
					</div>
					
					<div class="card-body">

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
