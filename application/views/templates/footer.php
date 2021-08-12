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
<script src="<?php echo base_url('assets/dist/js/warehouse.js') ?>"></script>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<!-- Toastr -->
<script type="text/javascript">
	$(function() {
		toastr.options = {
			"closeButton": true,
			"debug": false,
			"newestOnTop": false,
			"progressBar": false,
			"positionClass": "toast-top-full-width",
			"preventDuplicates": true,
			"onclick": null,
			"showDuration": "300",
			"hideDuration": "1000",
			"timeOut": "5000",
			"extendedTimeOut": "1000",
			"showEasing": "swing",
			"hideEasing": "linear",
			"showMethod": "fadeIn",
			"hideMethod": "fadeOut"
		}

	});
</script>
<script>
	(function() {

		//function creattion de produit ou article
		$("#prCode").on("keyup", function() {
			const pcode = $(this).val();
			$.get("product/check_product", {
					pcode: pcode
				},
				function(data) {

					if (data === "true") {
						toastr.warning("Ce code existe déjà");
						$("#prCode").data("verification", pcode);
					} else {
						$("#prCode").data("verification", "0");
					}
				}
			);
		});
		$("#bt_create_produit").on("click", function(e) {
			e.preventDefault();
			const verification = $("#prCode").data("verification");
			const pcode = $("#prCode").val();
			const pname = $("#nomArticle").val();
			const pbrand = $("#prMarque").val();
			const pmodel = $("#prModele").val();
			const price = $("#prPrix").val();
			const prUnite = $("#prUnite").val();
			const pcurrency = $("#pcurrency").val();
			const vehicule = $("#pv_id").val();
			const pcat_id = $("#pcat_id").val();
			const pmin_qty = $('#pmin_qty').val();
			var erreur = new Array();
			$(".erreur").hide();
			var message = $("#message_server");
			message.text("");

			if (verification === pcode) {
				toastr.warning("Ce code existe déjà");
				erreur.push("code");
				$("#prCode_erreur").text("Ce code existe déjà");
				$("#prCode_erreur").css("display", "flex");
			}
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
			if (pmin_qty === 0) {
				erreur.push("");
				$("#erreur_min_qty").css("display", "flex");
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
					pcat_id: pcat_id,
					pmin_qty: pmin_qty
				}, function(data) {
					toastr.success('Pièce ajoutée');
				});
			} else {

			}


		});
		//add car
		$("#btn_add_car").on("click", function(e) {
			e.preventDefault();
			const brand = $("#vehicule_brand").val();

			var erreur = new Array();
			$(".erreur").hide();
			if (brand === "") {
				erreur.push("");
				$("#erreur_marque_vehicule").css("display", "flex");
			}

			if (erreur.length === 0) {
				$.get('<?php echo base_url("product/create_vehicule") ?>', {
					vehicule_brand: brand
				}, function(data) {
					$('#modalVehicule').hide();
					location.reload();
					toastr.success('Véhicule ajouté');
				});
			}

		});
		//add categorie
		$("#btn_add_category").on("click", function(e) {
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
					$('#modalCategory').hide();
					location.reload();
					toastr.success('Catégorie ajoutée');
				});
			}


		});
		//modification product cell
		function update_product(id, type, valeur) {
			$.get('<?php echo base_url("product/update_product") ?>', {
				product_id: id,
				type: type,
				valeur: valeur
			}, function(data) {

			});
		}
		$("body").on("dblclick", ".cel-product", function() {
			$(this).attr("contenteditable", "true"); //add the content editable attribute
		});
		//avec focus
		$("body").on("focusout", ".cel-product", function() {
			const product_id = $(this).parent().data("product_id"); //the id parent
			const type_cel = $(this).data("type_cel"); //type of cell
			const valeur = $(this).text(); //valeur de la cellule
			const old_value = $(this).data("valeur");
			$(this).attr("contenteditable", "false"); //delete the content editable attribute

			switch (type_cel) {
				case 'code':
					if (valeur !== "") {

						if (confirm(`Voulez-vous modifier le Code de l'article?`)) {
							update_product(product_id, type_cel, valeur);
							const message = 'Modification efféctuée';
							toastr.success(message);
						} else {
							$(this).text(old_value);
						}

					} else {

						$(this).text(old_value);
						const message = 'Echec de Modification';
						toastr.danger(message);
					}
					break;
				case 'name':
					if (valeur !== "") {
						if (confirm(`Vouez-vous modifier le nom de l'article?`)) {
							update_product(product_id, type_cel, valeur);
							const message = 'Modification efféctuée';
							toastr.success(message);
						} else {
							$(this).text(old_value);
						}
					} else {
						const message = 'Echec de Modification';
						toastr.danger(message);
						$(this).text(old_value);
					}
					break;
				case 'brand':
					if (valeur !== "") {
						if (confirm(`Vouez-vous modifier la marque de l'article?`)) {
							update_product(product_id, type_cel, valeur);
							const message = 'Modification efféctuée';
							toastr.success(message);
						} else {
							$(this).text(old_value);
						}
					} else {

						const message = 'Echec de Modification';
						toastr.danger(message);
						$(this).text(old_value);
					}
					break;
				case 'model':
					if (valeur !== "") {
						if (confirm(`Vouez-vous modifier le modele de l'article?`)) {
							update_product(product_id, type_cel, valeur);
							const message = 'Modification efféctuée';
							toastr.success(message);
						} else {
							$(this).text(old_value);
						}
					} else {
						const message = 'Echec de Modification';
						toastr.danger(message);
						$(this).text(old_value);
					}
					break;
				case 'uom':
					if (valeur !== "") {
						if (confirm(`Vouez-vous modifier l'unité de l'article?`)) {
							update_product(product_id, type_cel, valeur);
							const message = 'Modification efféctuée';
							toastr.success(message);
						} else {
							$(this).text(old_value);
						}
					} else {
						const message = 'Echec de Modification';
						toastr.danger(message);
						$(this).text(old_value);
					}
					break;
				case 'price':
					if (valeur !== "") {
						if (!isNaN(valeur)) {
							if (confirm(`Vouez-vous modifier le prix de l'article?`)) {
								update_product(product_id, type_cel, valeur);
								const message = 'Modification efféctuée';
								toastr.success(message);
								$(this).data("valeur", valeur);
							} else {
								$(this).text(old_value);
							}
						} else {
							$(this).text(old_value);
							alert("Cette valeur n'est pas un nombre");
						}

					} else {
						const message = 'Echec de Modification';
						toastr.danger(message);
						$(this).text(old_value);
					}
					break;
				case 'currency':
					if (valeur !== "") {
						if ((valeur === "CDF") || (valeur === "USD")) {
							if (confirm(`Vouez-vous modifier le Code de l'article?`)) {
								update_product(product_id, type_cel, valeur);
								const message = 'Modification efféctuée';
								toastr.success(message);
							} else {
								$(this).text(old_value);
							}
						} else {

							$(this).text(old_value);
							const message = 'Unité non acceptée, Utilisez le USD & CDF';
							toastr.warning(message);
						}
					} else {
						const message = 'Unité non acceptée, Utilisez le USD & CDF';
						toastr.warning(message);
						$(this).text(old_value);
					}
					break;
			}
		});
		//function seach product by code
		function search_product_code(id) {
			$.get('<?php echo base_url("product/search") ?>', {
				id: id,
			}, function(data) {
				$("#contenair_products").html(data);
			});
			/////////////
			$.get('<?php echo base_url("product/search_by_id_pr_stock") ?>', {
				id: id,
			}, function(data) {
				const product = JSON.parse(data);
				$("#pr_code_search_value").text(product.product_code);
				$("#pr_name_search_value").text(product.product_name);
				$("#pr_quantity_value").text(product.lus_quantity + " " + product.product_uom + "(S)");
				$("#pr_desc_search_value").text(product.lus_prod_loc_description);


			});
		}
		//function search product by categori
		function search_product_cat(id) {

			$.get('<?php echo base_url("product/search_by_cat") ?>', {
				id: id,
			}, function(data) {

				$("#contenair_products").html(data);
			});

		}
		//function list product if de search box is empty
		function list_product() {
			$.get('<?php echo base_url("product/list_product") ?>', function(data) {

				$("#contenair_products").html(data);
			});
		}
		//search by code 
		$("#search_product").on("keyup", function() {
			$("#pr_code_search_value").text("-");
			$("#pr_name_search_value").text("-");
			$("#pr_quantity_value").text("-");
			$("#pr_desc_search_value").text("-");

			const id = $(this).val();
			if (id === "") {
				list_product();
				$("#pr_code_search_value").text("-");
				$("#pr_name_search_value").text("-");
				$("#pr_quantity_value").text("-");
				$("#pr_desc_search_value").text("-");

			} else {
				search_product_code(id);
			}

		});
		//search combo box
		$("body").on("change", "#id_categorie_drop_down", function() {
			const categorie = $(this).val();
			if (categorie === "") {
				list_product();
			} else {

				search_product_cat(categorie);
			}

		});
		//opeartion entree stock
		$("body").on("change", "#nom_article_entree", function() {
			$("#entree_quantite").val("");
			$("#date_entree").val("");
		});

		$("#zone_entree,#etagere_produit").on("change", function() {
			//let desc = $("#description_zone").val();
			//$("#description_zone").text(desc + " " + $(this).val());
		});

		$("body").on("click", "#valider_entree", function(e) {
			e.preventDefault();
			const pid = $("#products").val(); //nom du produit
			const quantite_entree = $("#entree_quantite").val(); //la quantité du produit
			const date_entree = $("#date_entree").val(); //la date d"entrée du produit
			const zone = $("#zone_entree").val();
			const etagere = $("#etagere_produit").val();
			const description = $("#description_zone").val();
			var erreur = new Array();

			if (pid === "") {
				toastr.warning('Le nom est vide');
				erreur.push("nom");
			}
			if (quantite_entree == 0) {
				toastr.warning('La quantité est vide');
				erreur.push("quantite");

			}
			if (zone === "") {
				toastr.warning('La zone est vide');
				erreur.push("zone");
			}
			if (etagere === "") {
				toastr.warning("L'etagere est vide");
				erreur.push("etagere");
			}

			if (erreur.length === 0) {
				$.get('<?php echo base_url("warehouse/create_entry_in") ?>', {
					pid: pid,
					si_qty: quantite_entree,
					si_date: date_entree,
					prod_zone_id: zone,
					prod_shelf_id: etagere,
					prod_loc_description: description
				}, function(data) {
					toastr.success('Quantité ajoutée');
				});
			}

		});
		//ligne entrée
		function liste_actualiser_entree(pcode) {

			$.get('<?php echo base_url("warehouse/get_liste_entry") ?>', {
				id: pcode
			}, function(data) {
				$("#liste_entre_body").html(data);
			});

		}
		liste_actualiser_entree(0); //cette methode sert à chargé la liste des entrées et sert aussi à actualiser
		//
		$("body").on("click", ".ligne_entree", function() {
			//cette fait apparaitre le modal qui donne la possibilité d'ajouter la quantité d'un produit   
			const pid = $(this).data("pid");
			$("#btn_update_quantity").data('pid', pid);
		});
		$("body").on("click", "#btn_update_quantity", function() {

			const qty = $("#ajout_quantite").val();
			const pid = $(this).data("pid");
			const dateUpdate = $("#dateUpdate").val();

			let erreur = new Array();
			if (qty <= 0) {
				toastr.warning("La valeur doit être supperieur à 0");
				erreur.push('zero');
			}
			if (qty === "") {
				toastr.warning("La quantité ne doit pas être vide");
				erreur.push('vide');
			}
			if (dateUpdate === "") {
				toastr.warning("La date ne doit pas être vide");
				erreur.push('vide');
			}
			if (erreur.length === 0) {

				$.get('<?php echo base_url("warehouse/update_quantity") ?>', {
					pid: pid,
					qty: qty,
					date_entry: dateUpdate
				}, function(data) {
					liste_actualiser_entree(0);
					toastr.success("Quantité ajoutée");
				});

			}

		});
		//filtre entre
		$("#entree_filtre").on("keyup change", function() {

			const pcode = $(this).val();
			if (pcode === "") {
				liste_actualiser_entree(0);
			} else {
				liste_actualiser_entree(pcode);
			}

		});

		//ad warehouse 
		$("#btn_add_ws").on("click", function(e) {
			e.preventDefault();
			const ws_name = $("#ws_name").val();
			const ws_address = $("#ws_address").val();
			var erreur = new Array();
			$(".erreur").hide();
			if (ws_name === "") {
				erreur.push("");
				$("#error_ws_name").css("display", "flex");
			}
			if (ws_address === "") {
				erreur.push("");
				$("#error_ws_address").css("display", "flex");
			}
			if (erreur.length === 0) {
				$.get('<?php echo base_url("warehouse/create_warehouse") ?>', {
					ws_name: ws_name,
					ws_address: ws_address
				}, function(data) {
					$('#modalWarehouse').hide();
					location.reload();
					toastr.success('Dépôt ajouté avec success');
				});
			}
		});
		//add entry out 
		$("#btn_add_entry_out").on("click", function(e) {
			e.preventDefault();
			const ws_product = $("#ws_product").val();
			const o_qty = $("#o_qty").val();
			const o_date = $("#o_date").val();
			const so_dest = $("#so_dest").val();


			var erreur = new Array();
			$(".erreur").hide();
			if (ws_product === "") {
				erreur.push("");
				$("#error_ws_product").css("display", "flex");
			}
			if (o_qty === "") {
				erreur.push("");
				$("#error_o_qty").css("display", "flex");
			}
			if (o_date === "") {
				erreur.push("");
				$("#error_o_date").css("display", "flex");
			}
			if (so_dest === "") {
				erreur.push("");
				$("#error_o_dest").css("display", "flex");
			}
			if (erreur.length === 0) {
				$.get('<?php echo base_url("warehouse/create_entry_out") ?>', {
					ws_product: ws_product,
					o_qty: o_qty,
					o_date: o_date,
					so_dest: so_dest
				}, function(data) {
					location.reload();
					toastr.success('Sortie dépot avec success');
				});
			}
		});

	})();
</script>

</body>

</html>
