<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<div class="content">
	<div class="container-fluid">
		<!-- your content here -->
		<?php if ($this->ion_auth_acl->has_permission('A')) {?>
			
		<?php }else{?>

			<div class="row">
				<div class="col-xl-4 col-lg-12">
				
					<h1><?php echo $this->lang->line('welcome_message');?></h1>
					
				</div>
			</div>
	<?php	}?>
	</div>
</div>
</div>
