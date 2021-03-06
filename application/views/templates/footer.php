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
<footer class="main-footer non_print">
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
<script src="<?php echo base_url('assets/dist/js/warehouse.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/chart.js/Chart.js') ?>"></script>
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
<script src="<?php echo base_url('assets/plugins/toastr/toastr.min.js') ?>"></script>

<!--script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script-->

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

		const taux = 2000;
		//function creattion de produit ou article
		$("#prCode").on("keyup", function() {
			const pcode = $(this).val();
			$.get("product/check_product", {
					pcode: pcode
				},
				function(data) {
					if (data === "true") {
						toastr.warning("Ce code existe d??j??");
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
				toastr.warning("Ce code existe d??j??");
				erreur.push("code");
				$("#prCode_erreur").text("Ce code existe d??j??");
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
					price: price,
					prUnite: prUnite,
					pcurrency: pcurrency,
					vehicule: vehicule,
					pcat_id: pcat_id,
					pmin_qty: pmin_qty
				}, function(data) {
					toastr.success('Pi??ce ajout??e');
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
					toastr.success('V??hicule ajout??');
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
					toastr.success('Cat??gorie ajout??e');
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
							const message = 'Modification eff??ctu??e';
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
							const message = 'Modification eff??ctu??e';
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
							const message = 'Modification eff??ctu??e';
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
							const message = 'Modification eff??ctu??e';
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
						if (confirm(`Vouez-vous modifier l'unit?? de l'article?`)) {
							update_product(product_id, type_cel, valeur);
							const message = 'Modification eff??ctu??e';
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
					        
					        let px=valeur.indexOf("USD");
					        let prix_2=parseFloat(valeur.substr(0,px));
					    
					     	if (!isNaN(prix_2)) {
							if (confirm(`Vouez-vous modifier le prix de l'article?`)) {
								update_product(product_id, type_cel, prix_2);
								const message = 'Modification eff??ctu??e';
								toastr.success(message);
								$(this).data("valeur", prix_2);
							} else {
								$(this).text(old_value);
							}
						} else {
							const message = "Cette valeur n'est pas un nombre";
							toastr.danger(message);
							$(this).text(old_value);
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
								const message = 'Modification eff??ctu??e';
								toastr.success(message);
							} else {
								$(this).text(old_value);
							}
						} else {

							$(this).text(old_value);
							const message = 'Unit?? non accept??e, Utilisez le USD & CDF';
							toastr.warning(message);
						}
					} else {
						const message = 'Unit?? non accept??e, Utilisez le USD & CDF';
						toastr.warning(message);
						$(this).text(old_value);
					}
					break;
			}
		});
		//filtre produit et detail par un click
		$("body").on("click", ".ligne_product", function() {
			const id = $(this).data("product_id");
			const pr_code = $(this).data("pr_code");

			////////
			$(".ligne_product").removeClass("ligne_product_select");
			$(this).addClass("ligne_product_select");
			/////////////
			$("#pr_code_search_value").text("-");
			$("#pr_name_search_value").text("-");
			$("#pr_quantity_value").text("-");
			$("#pr_desc_search_value").text("-");
			$.get('<?php echo base_url("product/search_by_id_pr_stock") ?>', {
				id: id,
			}, function(data) {

				const product = JSON.parse(data);
				$("#pr_code_search_value").text(product.product_code);
				$("#pr_name_search_value").text(product.product_name);
				$("#pr_quantity_value").text(product.ws_quantity + " " + product.product_uom + "(S)");
				$("#pr_desc_search_value").text(product.lus_prod_loc_description);


			});
		});
		//function seach product by code
		function search_product_code(id) {
			$("#pr_code_search_value").text("-");
			$("#pr_name_search_value").text("-");
			$("#pr_quantity_value").text("-");
			$("#pr_desc_search_value").text("-");
			$.get('<?php echo base_url("product/search") ?>', {
				id: id,
			}, function(data) {
				$("#contenair_products").html(data);
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

		function search_product_vehicule(id) {

			$.get('<?php echo base_url("product/search_by_veh") ?>', {
				id: id,
			}, function(data) {

				$("#contenair_products").html(data);
			});

		}
		$("#s_vehicule").on("keyup", function () {
			const id = $(this).val();
			if (id === "") {
				vehicule_list();	
			}else{
				search_vehicule_like(id);
			}
		});
		function search_vehicule_like (id) {
			$.get('<?php echo base_url("product/search_vehicule_like")?>', {id:id,},
				function (data) {
					$("#pv_id").html(data);
					
				});
		}
		function vehicule_list () {
			$.get('<?php echo base_url("product/vehicule_list")?>',
				function (data) {
					$("#pv_id").html(data);
				},
			);
		}
		//function list product if de search box is empty
		function list_product() {
			$.get('<?php echo base_url("product/list_product") ?>', function(data) {

				$("#contenair_products").html(data);
			});
		}
		//search by code 
		$("#search_product").on("keyup", function() {

			const id = $(this).val();
			if (id === "") {
				list_product();

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
		$("body").on("change", "#id_vehicule_drop_down", function() {
			const vehicule = $(this).val();
			if (vehicule === "") {
				list_product();
			} else {

				search_product_vehicule(vehicule);
			}

		});

		//WAREHOUSE SCRPIT
		//Search code to do entry out operation
		function search_part_number_out(id) {
			$.get('<?php echo base_url("warehouse/filter_entries_out")?>', {id:id,},
				function (data) {
					$("#ws_product").html(data);
				}
				
			);
		}
		$("#ocode").on("keyup", function () {
			const id = $(this).val();
			if (id === "") {
				
			} else {
				search_part_number_out(id);
			}
		});
		//Search code to do entry in operation
		function search_part_number_in(id){
			$.get('<?php echo base_url("warehouse/filter_part_number");?>', {id:id,},
				
				function (data) {
					$("#products").html(data);
				}
				
			);
		}
		$("#scode").on("keyup", function () {

			const id = $(this).val();
			if (id === "") {
				
			}else{
				search_part_number_in(id);
			}
			
		});

		//opeartion entree stock
		$("body").on("change", "#nom_article_entree", function() {
			$("#entree_quantite").val("");
			$("#date_entree").val("");
		});

		function zone(id_v) {
			const id = id_v;
			$.get('<?php echo base_url("warehouse/create_entry_in") ?>', {
				id: id
			}, function(data) {
				return data;
			});

		}
		$("#zone_entree").on("change", function() {
			let zone = $.trim($("#zone_entree option:selected").text());
			let etagere = $.trim($("#etagere_produit option:selected").text());
			if (zone.length > 4) {
				if ($("#etagere_produit option:selected").val() == "") {
					$("#description_zone").text(zone);
				} else {
					$("#description_zone").text(zone + "," + etagere);
				}
			} else {
				$("#description_zone").empty();
			}
		});
		$("#etagere_produit").on("change", function() {
			let etagere = $.trim($("#etagere_produit option:selected").text());
			if (etagere.length > 7) {
				if ($("#zone_entree").val() == "") {
					toastr.warning("LA ZONE EST VIDE");
				} else {
					let desc = $.trim($("#zone_entree option:selected").text() + " , " + etagere);
					$("#description_zone").text($.trim(desc));
				}
			} else {
				$("#description_zone").empty();
			}

		});

		$("body").on("click", "#valider_entree", function(e) {
			e.preventDefault();
			const pid = $("#products").val(); //nom du produit
			const quantite_entree = $("#entree_quantite").val(); //la quantit?? du produit
			const date_entree = $("#date_entree").val(); //la date d"entr??e du produit
			const zone = $("#zone_entree").val();
			const etagere = $("#etagere_produit").val();
			const description = $("#description_zone").val();
			var erreur = new Array();

			if (pid === "") {
				toastr.warning('Le nom est vide');
				erreur.push("nom");
			}
			if (quantite_entree == 0) {
				toastr.warning('La quantit?? est vide');
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
					location.reload();
					toastr.success('Quantit?? ajout??e');
					liste_actualiser_entree(0);
				});
			}

		});
		//ligne entr??e
		function liste_actualiser_entree(pcode) {

			$.get('<?php echo base_url("warehouse/get_liste_entry") ?>', {
				id: pcode
			}, function(data) {
				$("#liste_entre_body").html(data);
			});

		}
		liste_actualiser_entree(0); //cette methode sert ?? charg?? la liste des entr??es et sert aussi ?? actualiser
		//
		$("body").on("click", ".ligne_entree", function() {
			//cette fait apparaitre le modal qui donne la possibilit?? d'ajouter la quantit?? d'un produit   
			const pid = $(this).data("pid");
			$("#btn_update_quantity").data('pid', pid);
		});
		$("body").on("click", "#btn_update_quantity", function() {

			const qty = $("#ajout_quantite").val();
			const pid = $(this).data("pid");
			const dateUpdate = $("#dateUpdate").val();

			let erreur = new Array();
			if (qty <= 0) {
				toastr.warning("La valeur doit ??tre supperieur ?? 0");
				erreur.push('zero');
			}
			if (qty === "") {
				toastr.warning("La quantit?? ne doit pas ??tre vide");
				erreur.push('vide');
			}
			if (dateUpdate === "") {
				toastr.warning("La date ne doit pas ??tre vide");
				erreur.push('vide');
			}
			if (erreur.length === 0) {

				$.get('<?php echo base_url("warehouse/update_quantity") ?>', {
					pid: pid,
					qty: qty,
					date_entry: dateUpdate
				}, function(data) {
					liste_actualiser_entree(0);
					toastr.success("Quantit?? ajout??e");
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
					toastr.success('D??p??t ajout?? avec success');
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
					toastr.success('Sortie d??pot avec success');
				});
			}
		});
		//filtre filtre_pr_stock_fac
		refresh_liste_product();

		function refresh_liste_product() {
			$.get('<?php echo base_url("pos/refresh_list_pr_stock") ?>', function(data) {
				$("#liste_pr_facture").html(data);
			});
		}
		//
		$("body").on("keyup focusin focusout", "#filtre_pr_stock_fac", function() {
			const code = $(this).val();
			if (code === "") {
				refresh_liste_product();
			} else {
				$.get('<?php echo base_url("pos/search_code_name_fac") ?>', {
					code: code
				}, function(data) {

					$("#liste_pr_facture").html(data);

				});
			}

		});
		$("body").on("change", "#type_facture_select", function() {
			$("#type_facture").text($(this).val());
		});

		$("body").on("click", ".ligne_pr_fact_search", function() {
			let id = $(this).data("pr_id");
			let code = $(this).data("pr_code");
			let name = $(this).data("pr_name");
			let devise = $(this).data("pr_devise");
			let price = parseFloat($(this).data("pr_price"));
			let qty = parseInt($(this).data("pr_qty"));
			$("#reduction").val(0); //initialisation du champ reduction ?? 1
			$("#reduction_aff").text("0%");
			///
			let qty_commander = 1;
			//add ligne facture
			let ligne = "<tr class='ligne_facture_pr' data-code='" + code + "' data-id='" + id + "' data-qty='" + qty + "' data-devise='" + devise + "'><td>" + name + "</td><td class='qty_" + id + "'>" + qty_commander + "</td><td class='pu_" + id + "'>" + price + " " + devise + "</td><td class='pt_" + id + " totaux_fact_ligne'>" + (price * parseInt(qty_commander)) + " " + devise + "</td><td class='delete_ligne_article pointer_hover non_print'><i class='fas fa-window-close'></i></td></tr>";
			//////////////////
			let v_id = document.getElementsByClassName("ligne_facture_pr");
			let t_id = [];
			//liste des id pour la verification avant de add sur la facture
			for (i = 0; i < v_id.length; i++) {
				t_id[i] = v_id[i].dataset.id;
			}
			//nous testons si l'id du produit existe
			if (t_id.find(e => e == id)) {
				//quantite
				let qt_actuel = parseInt($(".qty_" + id).text());

				//on test la quantite
				if (qty > qt_actuel) {

					qt_actuel++;
					$(".qty_" + id).text(qt_actuel);

				} else {
					toastr.warning("Rupture de stock");
				}
				//prix unitaire
				let prix_u = parseFloat($(".pu_" + id).text());
				//prix total
				let prix_t = parseFloat($(".pt_" + id).text());
				$(".pt_" + id).text((prix_u * qt_actuel) + " " + devise);
				//
			} else {
				if (id != '') {
					if (qty === 0) {
						toastr.warning("Il y a rupture de stock");
					} else {
						$("#facture_corp").append(ligne);
					}
				}
			}
			//totaux de totaux
			totaux(); //on effectue le calcul pour trouver la somme des articles sur le facture
		});
		//reduction total
		$("body").on("change keyup", "#reduction", function() {
			let reduction = $(this).val();
			let totaux_reduit = 0;
			let totaux_de_totaux = 0;
			let totaux_v = get_totaux();

			$("#reduction_aff").text(reduction + '%');
			if (reduction <= 1) {
				totaux();
			} else {
				totaux_reduit = (totaux_v / 100);
				totaux_reduit = totaux_reduit * reduction;
				totaux_de_totaux = (totaux_v - totaux_reduit).toFixed(2);
				$("#totaux_facture_usd").text((totaux_de_totaux) + ' USD');
			}
		});
		//reduction de la quantit??
		$("body").on("click", ".ligne_facture_pr", function() {
			let id = $(this).data('id');
			let devise = $(this).data('devise');
			let qty = parseInt($(".qty_" + id).text()) - 1;
			if (qty > 0) {
				$(".qty_" + id).text(qty);
				let prix_u = parseFloat($(".pu_" + id).text());
				//prix total
				let prix_total = prix_u * qty;
				$(".pt_" + id).text(prix_total + " " + devise);
			} else {
				$(this).remove(); //on supprime la ligne si la quanti?? devient z??ro ou inf??rieur
				$("#reduction").val(0); //initialisation du champ reduction ?? 1
				$("#reduction_aff").text("0 %");

			}
			//
			totaux();
		});
		//////////////////
		function count_ligne_facture() {
			return parseInt(document.getElementsByClassName("ligne_facture_pr").length);
		}
		//
		function totaux() {
			let taille = document.getElementsByClassName("totaux_fact_ligne").length;
			let taille_montant;
			let somme_usd = 0;
			let somme_cdf = 0;
			let montant_total_qty_pu = '';
			let montant_numerique = 0;
			let monaie = "";
			for (i = 0; i < taille; i++) {
				taille_str =
					montant_total_qty_pu = document.getElementsByClassName("totaux_fact_ligne")[i].textContent;
				taille_montant = montant_total_qty_pu.length;
				montant_numerique = montant_total_qty_pu.substring(0, (taille_montant - 3));
				monaie = montant_total_qty_pu.substring((taille_montant - 3), taille_montant);
				somme_usd = somme_usd + parseFloat(montant_numerique);
			}
			$("#totaux_facture_usd").text(somme_usd + " USD");


		}

		function usd_cdf(monaie, taux) {
			//	let somme_usd = document.getElementById("totaux_facture_usd").textContent;
			//	let somme_cdf = document.getElementById("totaux_facture_cdf").textContent;
			if (monaie === "CDF") {
				//	let totaux = (parseFloat(somme_usd.substring(0, (somme_usd.length - 3))) * taux) + (parseFloat(somme_cdf.substring(0, (somme_cdf.length - 3))));
				//$("#totaux_facture_usd_cdf").text(totaux + " CDF");
			} else {
				//let totaux = (parseFloat(somme_usd.substring(0, (somme_usd.length - 3)))) + (parseFloat(somme_cdf.substring(0, (somme_cdf.length - 3))) / taux);
				//$("#totaux_facture_usd_cdf").text(totaux + " USD");
			}
		}


		function get_totaux() {
			let taille = document.getElementsByClassName("totaux_fact_ligne").length;
			let somme = 0;
			for (i = 0; i < taille; i++) {
				somme = somme + parseFloat(document.getElementsByClassName("totaux_fact_ligne")[i].textContent);
			}
			return somme;
		}
		/////supprimer un article de la facture
		$("body").on("click", ".delete_ligne_article", function() {
			$(this).parent('tr').remove();
			totaux();
		});
		/////////
		$("body").on("click", ".ligne_facture_pr", function() {
			let code = $(this).data('code');
			$("#filtre_pr_stock_fac").val(code).focus();
			totaux(); //on effectue un nouveau calcul
		});
		//nouvelle facture
		function vider_facture() {
			$("#facture_corp").html("");
			totaux(); //on effectue un nouveau calcul
			refresh_liste_product();
			$("#filtre_pr_stock_fac").val("");
		}

		$("body").on("click", "#btn_nouvelle_fac", function() {
			vider_facture();
			$("#reduction").val(0); //initialisation du champ reduction ?? 1
			$("#reduction_aff").text("0%");
			location.reload();
		});
		//get devise totaux de totaux
		function get_devise_paye() {
			let devise = document.getElementById("totaux_facture_usd").textContent;
			return devise.substring(devise.length, (devise.length - 3));
		}
		//print fature
		$("body").on("click", "#print-facture", function() {
			let prCode = "";
			let prId = "";
			let prQty = 0;
			let qty_ws = 0;
			let commandes = [];
			let commande = {};
			let discount_amount = $("#reduction").val();
			let type_facture = $("#type_facture_select").val();

			if (count_ligne_facture() > 0) {
				if ($("#client").val() != "") {
					for (i = 0; i < count_ligne_facture(); i++) {
						///////////////////////
						prId = document.getElementsByClassName("ligne_facture_pr")[i].dataset.id;
						prCode = document.getElementsByClassName("ligne_facture_pr")[i].dataset.code;
						qty_ws = document.getElementsByClassName("ligne_facture_pr")[i].dataset.qty;
						prQty = $(".qty_" + (i + 1)).text();
						commande = {
							"prId": prId,
							"prCode": prCode,
							"prQty": prQty,
							"qty_new": (parseInt(qty_ws) - parseInt(prQty))
						};
						commandes[i] = commande;
					}

					$.get('<?php echo base_url("pos/create_invoice") ?>', {
						totaux: get_totaux(),
						commandes: commandes,
						devise: get_devise_paye(),
						discount_amount: discount_amount,
						type_facture: type_facture
					}, function(data) {

						toastr.success("Facture imprimer");
						print();
						refresh_liste_product();
						vider_facture();
						numero_facature(); //on charche le nullero de la facture
						$("#reduction").val(0); //initialisation du champ reduction ?? 1
						$("#reduction_aff").text("0 %");
						$("#type_facture").text("DETAIL");
						location.reload();
					});

				} else {
					toastr.warning("LE NOM DU CLIENT");
				}
			} else {

				toastr.warning("Rien ?? imprimer");
			}

		});

		//add store information

		$("body").on("click", "#btn_add_store", function(e) {
			e.preventDefault();

			const store_name = $("#store_name").val();
			const rccm = $("#rccm").val();
			const id_nat = $("#id_nat").val();
			const nif = $("#nif").val();
			const telephone = $("#telephone").val();
			const adresse = $("#adresse").val();

			$.get('<?php echo base_url('setting/create_store') ?>', {
				store_name: store_name,
				rccm: rccm,
				id_nat: id_nat,
				nif: nif,
				telephone: telephone,
				adresse: adresse
			}, function(data) {

				$("#modalStore").hide();
				location.reload();
				toastr.success('Information du magasin ajout??e');
			});
		});


		//add pos 
		$("#btn_add_pos").on("click", function(e) {
			e.preventDefault();
			const pos_name = $("#pos_name").val();
			const pos_address = $("#pos_address").val();
			const pos_id = $("#pos_id").val();

			$.get('<?php echo base_url('pos/create_pos') ?>', {
					pos_id: pos_id,
					pos_name: pos_name,
					pos_address: pos_address
				}, function(data) {
					$("#modalPos").hide();
					location.reload();
					toastr.success('Point de vente ajout??e');
				}

			);

		});
		numero_facature(); //on charche le nullero de la facture
		function numero_facature() {
			$.get('<?php echo base_url('pos/count_invoice') ?>',
				function(data) {
					let numero = parseInt(data) + 1;
					$("#numero_facture").text(numero);
				});
		}

		$("body").on("click", "#bt_rembourser", function(e) {
			e.preventDefault();
			let nombre_produit = $(".ligne_rembourser").length;
			let quantite = [];
			let produit_id = [];

			let numero_facture = $(".ligne_rembourser").data("facture");

			for (i = 0; i < nombre_produit; i++) {
				quantite[i] = $(".ligne_rembourser" + (i + 1)).data("quantite" + (i + 1));
				produit_id[i] = $(".ligne_rembourser" + (i + 1)).data("id" + (i + 1));
			}
			//quantite.forEach(item=>alert(item));
			$.get('<?php echo base_url('pos/approve_refund') ?>', {
					"numero_facture": numero_facture,
					"prod_id": produit_id,
					"quantite": quantite
				},
				function(data) {
					toastr.success('Facture rembourss??e');
					window.location.replace("<?php echo base_url('pos/list_invoice') ?>");
				});


		});
	})();
</script>

</body>

</html>
