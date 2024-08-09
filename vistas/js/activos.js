/*=============================================
CARGAR LA TABLA DINÁMICA DE ACTIVOS
=============================================*/

$.ajax({

	url: "ajax/datatable-activos.ajax.php",
	success:function(respuesta){
		
		console.log("respuesta", respuesta);

	}

})

var perfilOculto = $("#perfilOculto").val();

$('.tablaActivos').DataTable( {
    "ajax": "ajax/datatable-activos.ajax.php?perfilOculto="+perfilOculto,
    "deferRender": true,
	"retrieve": true,
	"processing": true,
	"language": {

			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
			"sFirst":    "Primero",
			"sLast":     "Último",
			"sNext":     "Siguiente",
			"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}

	}

} );

/*=============================================
CAPTURANDO LA CATEGORIA PARA ASIGNAR CÓDIGO
=============================================*/
// $("#nuevaCategoria").change(function(){

// 	var idCategoria = $(this).val();

// 	var datos = new FormData();
//   	datos.append("idCategoria", idCategoria);

//   	$.ajax({

//       url:"ajax/productos.ajax.php",
//       method: "POST",
//       data: datos,
//       cache: false,
//       contentType: false,
//       processData: false,
//       dataType:"json",
//       success:function(respuesta){

//       	if(!respuesta){

//       		var nuevoCodigo = idCategoria+"01";
//       		$("#nuevoCodigo").val(nuevoCodigo);

//       	}else{

//       		var nuevoCodigo = Number(respuesta["codigo"]) + 1;
//           	$("#nuevoCodigo").val(nuevoCodigo);

//       	}
                
//       }

//   	})

// })

/*=============================================
EDITAR ACTIVO
=============================================*/

$(".tablaActivos tbody").on("click", "button.btnEditarActivo", function() {

    var idActivo = $(this).attr("idActivo"); 
    
    var datos = new FormData();
    datos.append("idActivo", idActivo);

    $.ajax({
        url: "ajax/activos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            var datosCategoria = new FormData();
            datosCategoria.append("idCategoria", respuesta["id_categoria"]);

            $.ajax({
                url: "ajax/categorias.ajax.php",
                method: "POST",
                data: datosCategoria,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta) {
                    $("#editarCategoria").val(respuesta["id"]);
                    $("#editarCategoria").html(respuesta["categoria"]);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log("Error en la solicitud de categoría:", textStatus, errorThrown);
                }
            });

            $("#editarCodigo").val(respuesta["codigo"]);
            $("#editarDescripcion").val(respuesta["descripcion"]);
            $("#editarMarca").val(respuesta["marca"]);
            $("#editarFechaAlta").val(respuesta["fecha_alta"]);
            $("#editarFechaBaja").val(respuesta["fecha_baja"]);
            $("#editarValor").val(respuesta["valor"]);
            $("#editarCantidad").val(respuesta["cantidad"]);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log("Error en la solicitud de activo:", textStatus, errorThrown);
        }
    });
});


/*=============================================
ELIMINAR ACTIVO
=============================================*/

$(".tablaActivos tbody").on("click", "button.btnEliminarActivo", function(){

	var idActivo = $(this).attr("idActivo");
	var codigo = $(this).attr("codigo");
	
	swal({

		title: '¿Está seguro de borrar el activo?',
		text: "¡Si no lo está puede cancelar la accíón!",
		type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar activo!'
        }).then(function(result) {
        if (result.value) {
        window.location = "index.php?ruta=activos&idActivo="+idActivo+"&codigo="+codigo;
        }
	})
})