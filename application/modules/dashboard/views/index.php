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
        <div class="col-md-12">
          <canvas id="p_overview"></canvas>
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
            fill : false,
            backgroundColor: 'RGBA(255,42,80,0.4)',
            borderColor: 'RGBA(138,42,80,0.4)',
            borderWidth: [2, 2, 2, 2, 2,2,2]
			}]
		};
		var options ={
			responsive: true,
        title: {
          display: true,
          position: "top",
          text: "Evolution global USD",
          fontSize: 16,
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

//product overview chart
var overview = JSON.parse(`<?php echo $overview_chart ?>`);
var overviewChart = document.getElementById('p_overview');
 const overData = {
    labels : overview.label,
    datasets : [{
      label : 'produit les plus vendu',
      data : overview.data,
      backgroundColor : 'rgba(153, 102, 255, 0.2)',
      borderColor : 'rgb(153, 102, 255)',
      borderWidth : 1
    }]
 };
 const overviewConfig ={
  type: 'bar',
  data: overData,
  options: {
    indexAxis: 'y',
    // Elements options apply to all of the options unless overridden in a dataset
    // In this case, we are setting the border of each horizontal bar to be 2px wide
    elements: {
      bar: {
        borderWidth: 2,
      }
    },
    responsive: true,
    plugins: {
      legend: {
        position: 'right',
      },
      title: {
        display: true,
        text: 'Chart.js Horizontal Bar Chart'
      }
    }
  },
 };
 var overviewChart = new Chart(overData,overviewConfig);
</script>
