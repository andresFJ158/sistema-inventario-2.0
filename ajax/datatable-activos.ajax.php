<?php

require_once "../controladores/activos.controlador.php";
require_once "../modelos/activos.modelo.php";

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";


class TablaActivos{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/ 

	public function mostrarTablaActivos(){

		$item = null;
    	$valor = null;
    	$orden = "id";

  		$activos = ControladorActivos::ctrMostrarActivos($item, $valor, $orden);	

  		if(count($activos) == 0){

  			echo '{"data": []}';

		  	return;
  		}
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($activos); $i++){

		  	/*=============================================
 	 		TRAEMOS LA CATEGORÍA
  			=============================================*/ 

		  	$item = "id";
		  	$valor = $activos[$i]["id_categoria"];

		  	$categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);


		  	/*=============================================
 	 		TRAEMOS LAS ACCIONES
  			=============================================*/ 

  			if(isset($_GET["perfilOculto"]) && $_GET["perfilOculto"] == "Especial"){

  				$botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarActivo' idActivo='".$activos[$i]["id"]."' data-toggle='modal' data-target='#modalEditarActivo'><i class='fa fa-pencil'></i></button></div>"; 

  			}else{

  				 $botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarActivo' idActivo='".$activos[$i]["id"]."' data-toggle='modal' data-target='#modalEditarActivo'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarActivo' idActivo='".$activos[$i]["id"]."' codigo='".$activos[$i]["codigo"]."'><i class='fa fa-times'></i></button></div>"; 

  			}

		 
		  	$datosJson .='[
			      "'.($i+1).'",
			      "'.$activos[$i]["codigo"].'",
			      "'.$categorias["categoria"].'",
			      "'.$activos[$i]["descripcion"].'",
			      "'.$activos[$i]["marca"].'",
			      "'.$activos[$i]["fecha_alta"].'",
			      "'.$activos[$i]["fecha_baja"].'",
			      "'.$activos[$i]["valor"].'",
			      "'.$activos[$i]["cantidad"].'",
			      "'.$activos[$i]["fecha"].'",
			      "'.$botones.'"
			    ],';

		  }

		  $datosJson = substr($datosJson, 0, -1);

		 $datosJson .=   '] 

		 }';
		
		echo $datosJson;


	}



}

/*=============================================
ACTIVAR TABLA DE ACTIVOS
=============================================*/ 
$activarActivos = new TablaActivos();
$activarActivos -> mostrarTablaActivos();

