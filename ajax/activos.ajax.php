<?php

require_once "../controladores/activos.controlador.php";
require_once "../modelos/activos.modelo.php";

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

class AjaxActivos{

  /*=============================================
  GENERAR CÓDIGO A PARTIR DE ID CATEGORIA
  =============================================*/
  public $idCategoria;

  public function ajaxCrearCodigoActivo(){

  	$item = "id_categoria";
  	$valor = $this->idCategoria;
    $orden = "id";

  	$respuesta = ControladorActivos::ctrMostrarActivos($item, $valor, $orden);

  	echo json_encode($respuesta);

  }


  /*=============================================
  EDITAR ACTIVO
  =============================================*/ 

  public $idActivo;
  public $traerActivos;
  public $nombreActivo;

  public function ajaxEditarActivo(){

    if($this->traerActivos == "ok"){

      $item = null;
      $valor = null;
      $orden = "id";

      $respuesta = ControladorActivos::ctrMostrarActivos($item, $valor,
        $orden);

      echo json_encode($respuesta);


    }else if($this->nombreActivo != ""){

      $item = "descripcion";
      $valor = $this->nombreActivo;
      $orden = "id";

      $respuesta = ControladorActivos::ctrMostrarActivos($item, $valor,
        $orden);

      echo json_encode($respuesta);

    }else{

      $item = "id";
      $valor = $this->idActivo;
      $orden = "id";

      $respuesta = ControladorActivos::ctrMostrarActivos($item, $valor,
        $orden);

      echo json_encode($respuesta);

    }

  }

}


/*=============================================
GENERAR CÓDIGO A PARTIR DE ID CATEGORIA
=============================================*/	

if(isset($_POST["idCategoria"])){

	$codigoActivo = new AjaxActivos();
	$codigoActivo -> idCategoria = $_POST["idCategoria"];
	$codigoActivo -> ajaxCrearCodigoActivo();

}
/*=============================================
EDITAR ACTIVO
=============================================*/ 

if(isset($_POST["idActivo"])){

  $editarActivo = new AjaxActivos();
  $editarActivo -> idActivo = $_POST["idActivo"];
  $editarActivo -> ajaxEditarActivo();

}

/*=============================================
TRAER ACTIVO
=============================================*/ 

if(isset($_POST["traerActivo"])){

  $traerActivo = new AjaxActivos();
  $traerActivo -> traerActivo = $_POST["traerActivo"];
  $traerActivo -> ajaxEditarActivo();

}

/*=============================================
TRAER ACTIVO
=============================================*/ 

if(isset($_POST["descripcionActivo"])){

  $traerActivo = new AjaxActivos();
  $traerActivo -> descripcionActivo = $_POST["descripcionActivo"];
  $traerActivo -> ajaxEditarActivo();

}