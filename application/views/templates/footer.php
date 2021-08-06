<?php
defined('BASEPATH') or exit('No direct script access allowed');

global $app;
$this->load->config('app', TRUE);
$this->app = $this->config->item('application', 'app');
?>
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
	<!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
<!-- Main Footer -->
<footer class="main-footer">
	<strong>Copyright &copy; <script>
			document.write(new Date().getFullYear())
		</script> <?php echo $this->app['name']; ?> <a href="https://www.lemondropsarl.com">Lemondrop Technology</a>.</strong>
	All rights reserved.
	<div class="float-right d-none d-sm-inline-block">
		<b>Version</b> 1.0.0
	</div>
</footer>
</div>
<!-- ./wrapper -->
<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?php echo base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
<!-- Bootstrap -->
<script src="<?php echo base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<!-- AdminLTE -->
<script src="<?php echo base_url('assets/dist/js/adminlte.js') ?>"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="<?php echo base_url('assets/plugins/chart.js/Chart.min.js') ?>"></script>
<script src="<?php echo base_url('assets/dist/js/demo.js') ?>"></script>
<script src="<?php echo base_url('assets/dist/js/pages/dashboard3.js') ?>"></script>
<!-- jQuery -->
<!-- Bootstrap 4 -->
<!-- Select2 -->
<script src="<?php echo base_url('assets/plugins/select2/js/select2.full.min.js') ?>"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="<?php echo base_url('assets/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') ?>"></script>
<!-- InputMask -->
<script src="<?php echo base_url('assets/plugins/moment/moment.min.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/inputmask/jquery.inputmask.min.js') ?>"></script>
<!-- date-range-picker -->
<script src="<?php echo base_url('assets/plugins/daterangepicker/daterangepicker.js') ?>"></script>
<!-- bootstrap color picker -->
<script src="<?php echo base_url('assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') ?>"></script>
<!-- Tempusdominus Bootstrap 4 -->
<!-- Bootstrap Switch -->
<script src="<?php echo base_url('assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/sweetalert2/sweetalert2.min.js') ?>"></script>

<!-- Toastr -->
<script type="text/javascript">
	$(function() {
		<?php if ($this->session->flashdata('success')) { ?>
			toastr.success("<?php $this->session->flashdata('success'); ?>");
		<?php } else if ($this->session->flashdata('error')) { ?>
			toastr.error("<?php $this->session->flashdata('error'); ?>");
		<?php } else if ($this->session->flashdata('warning')) { ?>
			toastr.warning("<?php $this->session->flashdata('warning'); ?>");
		<?php } else if ($this->session->flashdata('info')) { ?>
			toastr.info("<?php $this->session->flashdata('info'); ?>");
		<?php } ?>
	});
</script>
<script>
	(function() {

		//function creattion de produit ou article
		$("#bt_create_produit").on("click", function(e) {
			e.preventDefault();
			const pcode = $("#prCode").val();
			const pname = $("#nomArticle").val();
			const pbrand = $("#prMarque").val();
			const pmodel = $("#prModele").val();
			const price = $("#prPrix").val();
			const prUnite = $("#prUnite").val();
			const pcurrency = $("#pcurrency").val();
			const vehicule = $("#pv_id").val();
			const pcat_id = $("#pcat_id").val();
			var erreur = new Array();
			$(".erreur").hide();
			var message = $("#message_server");
			message.text("");
			if (pcode === "") {
				erreur.push("code");
				$("#prCode_erreur").css("display", "flex");
			}

			if (pname === "") {
				erreur.push("");
				$("#erreur_nom").css("display", "flex");

			}
			if (pbrand === "") {
				erreur.push("");
				$("#erreur_marque").css("display", "flex");
			}
			if (pmodel === "") {
				erreur.push("");
				$("#erreur_modele").css("display", "flex");
			}
			if (price === "") {
				erreur.push("");
				$("#erreur_prix").css("display", "flex");
			}
			if (price === "") {
				erreur.push("");
				$("#erreur_prix").css("display", "flex");
			}
			if (price <= 0) {
				erreur.push("");
				$("#erreur_prix").css("display", "flex");
			}
			if (isNaN(price)) {
				erreur.push("");
				$("#erreur_prix").css("display", "flex");
			}
			if (prUnite === 0) {
				erreur.push("");
				$("#erreur_unite").css("display", "flex");
			}
			if (pcurrency === 0) {
				erreur.push("");
				$("#erreur_currency").css("display", "flex");
			}
			if (erreur.length === 0) {
				$.get('<?php echo base_url("product/create_operation") ?>', {
					pname: pname,
					pcode: pcode,
					pbrand: pbrand,
					pmodel: pmodel,
					price: price,
					prUnite: prUnite,
					pcurrency: pcurrency,
					vehicule: vehicule,
					pcat_id: pcat_id
				}, function(data) {
					
					message.text("Piece ajoutée");
					
				});
			} else {

			}


		});
		//add car
		$("#btn_add_car").on("click", function(e) {
			e.preventDefault();
			const brand = $("#vehicule_brand").val();
			const model = $("#vehicule_model").val();
			var erreur = new Array();
			$(".erreur").hide();
			if (brand === "") {
				erreur.push("");
				$("#erreur_marque_vehicule").css("display", "flex");
			}
			if (model === "") {
				erreur.push("");
				$("#erreur_model_vehicule").css("display", "flex");
			}
			if (erreur.length === 0) {
				$.get('<?php echo base_url("product/create_vehicule") ?>', {
					vehicule_brand: brand,
					vehicule_model: model,
				}, function(data) {

					alert(data);
				});
			}

		});
		//add categorie
		$("#btn_add_categori").on("click", function(e) {
			e.preventDefault();
			const cat_name = $("#cat_name").val();
			const cat_description = $("#cat_description").val();
			var erreur = new Array();
			$(".erreur").hide();
			if (cat_name === "") {
				erreur.push("");
				$("#erreur_cat_vehicule").css("display", "flex");
			}
			if (cat_description === "") {
				erreur.push("");
				$("#erreur_description_vehicule").css("display", "flex");
			}
			if (erreur.length === 0) {
				$.get('<?php echo base_url("product/create_category") ?>', {
					cat_name: cat_name,
					cat_description: cat_description,
				}, function(data) {
					alert(data);
				});
			}


		});

	})();
</script>

</body>

</html>
