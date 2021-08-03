<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<div class="content">
	<div class="container-fluid">
		<!-- your content here -->
		<div class="row">
			<div class="col-md-12">
				<div class="card card-outline card-secondary">
					<div class="card-header">
                        <h4 class="card-title">Nouveau article</h4>
						<div class="card-tools">
								<button type="button" class="btn btn-tool" data-card-widget="collapse"><i
									class="fas fa-minus"></i></button>
						</div>
                    </div>
					<div class="card-body">
                        <?php echo form_open('product/create');?>
                            <div class="form-group form-row">
                                <label class="col-sm-2 col-form-label">Nom article</label>
                                <div class="col-sm-6">
                                    <input type="text" name="product_name" class="form-control"> 
                                </div>
                            </div>
                            <div class="form-group form-row">
                                <label class="col-sm-2 col-form-label">Article code</label>
                                <div class="col-sm-6">
                                    <input type="text" name="product_name" class="form-control"> 
                                </div>
                            </div>
                            <div class="form-group form-row">
                                <label class="col-sm-2 col-form-label">Prix</label>
                                <div class="col-sm-6">
                                    <input type="text" name="product_name" class="form-control"> 
                                </div>
                            </div>
                        <?php echo form_close();?>
                        
                    </div>
				</div>
			</div>
		</div>
	</div>
</div>
