(function($){
	jQuery(document).ready(function($) {

		
		browser_location = window.location.pathname.substr(1).split("/")[2];
		
		$(".removeAttachFile").bind("click", function(){

			var name_file = $(this).parent().children("input[type='hidden']").val();

			//console.log(name_file);
			$("div."+name_file+"").find("input").attr('value', '');
			$(this).parent().parent().remove();

			//$("input[name='"+name_file+"']").attr('value', '');
			//$("input[name='"+name_file+"']").parent().parent().children(".file-path-wrapper").find("input").attr('value', '');			
		});

		$(".preview").bind("click", function(){		
			$("#post").parsley({
				excluded:"input[type=checkbox], :hidden"
			});
		});

		$("input[name='save']").bind("click", function(){		
			$("#post").parsley({
				excluded:""
			});
		});


		$(window).bind("load", function(){
			if(browser_location == 'post.php'){

				
				$("#post").parsley().validate();

			}

			if($('#post').parsley().isValid()){
				$('#form-invalid').hide();
			}else{
				$('#form-invalid').show();
			}

		});



		//$('#form-invalid').toggleClass('hidden', !ok);
		// Configurar Datepicker
		$( ".datepicker" ).datepicker({
			selectMonths: true, // Creates a dropdown to control month
			selectYears: 15, // Creates a dropdown of 15 years to control year
			format: 'mm-dd-yyyy',
			onSet: function () {		    	
				this.close();
			}    		
		});

		// Configurar Ventana Modal
		$('.modal-trigger').leanModal({
			  dismissible: true, // Modal can be dismissed by clicking outside of the modal
			  opacity: .5, // Opacity of modal background
			  in_duration: 300, // Transition in duration
			  out_duration: 200, // Transition out duration
			  ready: function() {  }, // Callback for Modal open
			  complete: function() {  } // Callback for Modal close
		  }
		);

		// Agregar atributo para subir mutiples archivos en el formulario
		$('#post').attr('enctype', 'multipart/form-data');

		// Agregar atributo para validaciòn del formulario con ParsleyJS
		$('#post').attr('data-parsley-validate', '');



		// Asignar y Configurar los elementos colapsables
		$('.collapsible, .collapsible2').collapsible({
		  accordion : true // A setting that changes the collapsible behavior to expandable instead of the default accordion style
	  	});

		// Configurar el Tooltip de los input
		$('.tooltipped').tooltip({delay: 50});

		blocks = ["Courses", "Experiences", "Skills"]; // List blocks (Blocks, Jobs, Etc..)

		// Se les aplica a todos los campos ocultos el atributo del grupo 2
		// Estos seran excluidos de las validaciones
		$("#Experiences, #Skills, #Courses").find("input, select").each(function(){
			$(this).attr('data-parsley-group', 2);
				//data-parsley-group
		});

		// Deshabilitar la validaciòn de ParsleyJS en algunos elementos
		$('#post').parsley({
			// No validar los siguientes elementos
			excluded: "input[data-parsley-group=2], select[data-parsley-group=2], textarea[data-parsley-group=2]",
		});

		 $('#post').parsley().on('field:validated', function() {
		    var ok = $('.parsley-error').length === 0;
		    $('#form-invalid').toggleClass('hidden', ok);
		  });
		 
		/*
		$("#post").submit(function(event){
			if(!$('#post').parsley().isValid()){
				event.preventDefault();
				return false;
			}
		});
		*/
		$("#publish").on("click", function(){
			if(!$('#post').parsley().isValid()){
				var confirmar = confirm("Your resume will be Saved but it's incomplete. Please complete!");

				if(confirmar){
					$('#post').parsley({
					    excluded: "input, select, textarea",
					});

					//alert("Your Resume has been Saved but it's still INCOMPLETE. Please Complete!");
				}
				else{
					//event.preventDefault();
					//return false;

				}
			}

		});

		blocks.forEach(function(item){
			var Clone;
			var block_index = 1;

			if($(".add" + item)){
				//jQuery("#post").parsley().isValid();
				// Fixeo temporal
				// Recorrer todos los select que tengan error de validaciòn
				// Cambiar el top (esto es porque sino se ve mal el html)
				
				$(".input-field select").each(function(){
					var block_parent = $(this).parent().parent();
				});

				$(".add" + item).on("click", function(){	
					  // Clonar bloque
					  if($("#"+ item)){
						Clone = $("#"+ item).clone();				
					  }

					// Si ya existe un elemento generar incremental, 
					if($("."+ item)){
						// Contar elementos repetidos que no esten ocultos y no tengan la clase jmc-block
						block_index = parseInt($("."+ item).not(":hidden, .jmc-block").filter(".jmc-list-item").length) + 1;  
						console.log("item: "+ item);
						console.log("block_index: "+ block_index);
					}


					// Asignar titulo al elemento que se agregará
					Clone.find(".collapsible-header").html("<i class='material-icons'>send</i><strong>" + item + "</strong> (Por favor completar todos los campos)");
					// Remover el id que se hereda de los bloques ocultos de ejemplo
					Clone.attr('id', '');
					
					if(!Clone.hasClass("jmc-list-item")){
						Clone.addClass('jmc-list-item');
					}
					// Recorrer todos los campos uno por uno
					Clone.find("input, textarea, select").each(function(){
						name = $(this).attr('name');

						// Cambio el valor del atributo al grupo 1, 
						// este grupo 1 se le aplica las validaciones
						$(this).attr('data-parsley-group', 1);

						// Agregar el prefijo "jmc" a todos los campos 
						name_parse = name.replace("jmc-", "");
						

						if($(this).attr('type') == 'select'){
							// Remover las opciones seleccionadas heredadas
							$(this).find("option:selected").attr('selected', false);
							// Elegir la opcion que tiene valor vacío
							$(this).find("option:selected").val('');
						}

						// Eliminar los datos de los campos de texto
						if($(this).attr('type') == 'text'){
							$(this).attr('id', '');
							$(this).attr('value', '');
							$(this).removeClass('hasDatepicker');

							if($(this).hasClass('datepicker')){
								$(this).datepicker({
									selectMonths: true, // Creates a dropdown to control month
									selectYears: 15, // Creates a dropdown of 15 years to control year
									format: 'mm-dd-yyyy',
									onSet: function () { this.close(); }    		
								});
							}

						}

						// Asignar como nombre del campo el indice y su nombre
						$(this).attr('name', item.toLocaleLowerCase() + "[" + block_index + "][" + name_parse + "]");
					  });

					// Activar la visualizaciòn de los select por MaterializeCSS
					Clone.find("select").material_select();

				  //  Remover atributos que lo ocultan y "mostrar" el elemento
				  if(Clone.hasClass("hide") || Clone.is(":hidden")){
					if(Clone.hasClass("hide")){
						Clone.removeClass('hide');			  		
					}
					if(Clone.is(":hidden")){
						Clone.show();
					}
				  }

				  // Si el elemento Clonado ya existe y se repite (màs de 1 vez)
				  // recorrer todos los campos del elemento, y asignarle el atributo con grupo 2
				  // para evitar que sea obligatorio al validar
				  // solo el primer elemento sera el obligatorio, los demas "NO"
					if(block_index > 1){ 
						//console.log("HAY MAS DE 1");
						Clone.find("input, select").each(function(){
							$(this).attr('data-parsley-group', 2); //data-parsley-group="block2"
						});
					}

					List_Clones = $(this).parent().parent().find("ul.collapsible2");
					List_Clones.append(Clone);

					// Renderizar los Select de MaterializeCSS
					$("select").material_select();

					// Remover los select que no tengan valor, porque se duplicaban
					// (Temporalmente para fixear)
					$("input.select-dropdown").each(function(){
						if(!this.value){ this.remove(); }
					});

					// Input Checkbox (yes/no) 
					$(".hide_show").on("change", function(){
						isChecked 	= $(this).attr('checked');
						itemID 		= $(this).attr('id');
						
						block 		= $(this).parent().parent().parent().parent();
						items 		= block.find("." + itemID);

						// Mostrar los elementos asociados si es true
							//console.log(items);
						if(isChecked){
							items.show();								
						}
						else{
							// limpiar todos los campos
							items.each(function(){
								$(this).find("select option:selected").attr('selected', false);
								// Elegir la opcion que tiene valor vacío
								$(this).find("select option:selected").val('');
								$(this).find("select").material_select();

								$(this).find("input[type='text']").attr('value', '');
								$(this).find("input[type='checkbox']").attr('checked', false);
							});

							items.hide();								
						}

					});

					// Validar formulario cada vez que cambien los campos
					// Para los elementos dinamicos que se vayan agregando
					$(".datepicker, select").change(function(){
						$(this).parsley().validate();
					});


				});
				
				// Recorrer todos los elementos que no son el bloque de ejemplo con ID que esta oculto
				// y que tampoco sea el primer elemento de los obtenidos
				// agregar al grupo 2, para que no sean obligatorio completar (validacion ParsleyJS)
				$("."+item).not(".jmc-block, #"+item).not(":first").each(function(){
					$(this).find("input, select, textarea").each(function(){
						$(this).attr('data-parsley-group', 2); //data-parsley-group="block2"
					});				
				});

			}
		});

		//$(".jmc-block select").material_select();
		$("select").material_select();

		// Al cambiar el valor de los "input radio" (yes/no), ocultar/mostrar elementos asociados
		$(".hide_show").on("change", function(){
			isChecked 	= $(this).attr('checked');
			itemID 		= $(this).attr('id');

			block 		= $(this).parent().parent().parent().parent();
			items 		= block.find("." + itemID);

			if(isChecked){
				items.show();								
			}
			else{
				// limpiar todos los campos
				items.each(function(){
					$(this).find("select option:selected").attr('selected', false);
					// Elegir la opcion que tiene valor vacío
					$(this).find("select option:selected").val('');
					$(this).find("select").material_select();

					$(this).find("input[type='text']").attr('value', '');
					$(this).find("input[type='checkbox']").attr('checked', false);
				});

				items.hide();								
			}
		});

		// Luego renderizar los input radio (yes/no), ocultar/mostrar elementos asociados segun su valor (true/false)
		$(".hide_show").each(function(){
			isChecked 	= $(this).attr('checked');
			itemID 		= $(this).attr('id');

			block 		= $(this).parent().parent().parent().parent();
			items 		= block.find("." + itemID);

			if(isChecked){
				items.show();								
			}
			else{
				// limpiar todos los campos
				items.each(function(){
					$(this).find("select option:selected").attr('selected', false);
					// Elegir la opcion que tiene valor vacío
					$(this).find("select option:selected").val('');
					$(this).find("select").material_select();
					
					$(this).find("input[type='text']").attr('value', '');
					$(this).find("input[type='checkbox']").attr('checked', false);
				});
	
				items.hide();								
			}
		});

		// Validar formulario cada vez que cambien los campos
		$(".datepicker, select").change(function(){
			$(this).parsley().validate();
		});
	});
})(jQuery);