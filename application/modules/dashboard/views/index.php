<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<div class="content">
	<div class="container-fluid">
		<!-- your content here -->
		<?php if ($this->ion_auth_acl->has_permission('A')) {?>
			<div class="row">
				<div class="col-md-6">
          <canvas id="sales_chart" height="200px"></canvas>
        </div>
        <div class="col-md-6">
          <canvas id="pos_sales_chart" height="200px"></canvas>
        </div>
				
			</div>
			
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
<!--script src="<?php echo base_url('assets/dist/js/dashboard.js')?>"></script-->
<script src="<?php echo base_url('assets/plugins/chart.js/Chart.js')?>"></script>
<script type="text/javascript">

//global_sales
var global_sales = JSON.parse(`<?php echo $global_sales_chart ?>`);
	var ctx = document.getElementById('sales_chart');
	
		//chart data
		var data = {
			labels : global_sales.label ,
			datasets:[{
				label: "Vente mensuel",
            data: global_sales.data,
            backgroundColor: [
              "#DEB887",
              "#A9A9A9",
              "#DC143C",
              "#F4A460",
              "#2E8B57",
              "#1D7A46",
              "#CDA776",
            ],
            borderColor: [
              "#CDA776",
              "#989898",
              "#CB252B",
              "#E39371",
              "#1D7A46",
              "#F4A460",
              "#CDA776",
            ],
            borderWidth: [1, 1, 1, 1, 1,1,1]
			}]
		};
		var options ={
			responsive: true,
        title: {
          display: true,
          position: "top",
          text: "Evolution global",
          fontSize: 18,
          fontColor: "#111"
        },
        legend: {
          display: true,
          position: "bottom",
          labels: {
            fontColor: "#333",
            fontSize: 16
          }
        }
		};
	
		const config = {
			type: 'line',
			data: data,
			options: options
		  };
		var salesChart = new Chart(ctx, config);

    //pos_daily sales
    var pos_sales = JSON.parse(`<?php echo $pos_sales_chart ?>`);
	  var posChart = document.getElementById('pos_sales_chart');
    const pos_data = {
  labels: pos_sales.label,
  datasets: [{
    label: 'Point de vente',
    data: pos_sales.data,
    backgroundColor: [
      'rgb(255, 99, 132)',
      'rgb(54, 162, 235)',
      'rgb(255, 205, 86)'
    ],
    hoverOffset: 4
  }]
};
const config_pos = {
  type: 'pie',
  data: pos_data,
};
var pos_salesChart = new Chart(posChart, config_pos);
</script>
