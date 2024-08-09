<?php

class ControladorActivos{

	/*=============================================
	MOSTRAR ACTIVOS
	=============================================*/

	static public function ctrMostrarActivos($item, $valor, $orden){

		$tabla = "activos";

		$respuesta = ModeloActivos::mdlMostrarActivo($tabla, $item, $valor, $orden);

		return $respuesta;

	}

	/*=============================================
	CREAR ACTIVO
	=============================================*/

	static public function ctrCrearActivos(){

		if(isset($_POST["nuevaDescripcion"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaDescripcion"]) &&
			   preg_match('/^[0-9]+$/', $_POST["nuevoValor"])){

		   		/*=============================================
				VALIDAR IMAGEN
				=============================================*/

			   	$ruta = "vistas/img/productos/default/anonymous.png";

			   	if(isset($_FILES["nuevaImagen"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["nuevaImagen"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorio = "vistas/img/productos/".$_POST["nuevoCodigo"];

					mkdir($directorio, 0755);

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["nuevaImagen"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/productos/".$_POST["nuevoCodigo"]."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["nuevaImagen"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["nuevaImagen"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/productos/".$_POST["nuevoCodigo"]."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["nuevaImagen"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}

				$tabla = "activos";

				$datos = array("id_categoria" => $_POST["nuevaCategoria"],
					"codigo" => $_POST["nuevoCodigo"],
					"descripcion" => $_POST["nuevaDescripcion"],
					"marca" => $_POST["nuevaMarca"],
					"fecha_alta" => $_POST["nuevaFechaAlta"],
					"fecha_baja" => $_POST["nuevaFechaBaja"],
					"valor" => $_POST["nuevoValor"],
					"cantidad" => $_POST["nuevaCantidad"]);

				$respuesta = ModeloActivos::mdlIngresarActivo($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "El activo ha sido guardado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "activos";

										}
									})

						</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El activo no puede ir con los campos vacíos o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "activos";

							}
						})

			  	</script>';
			}
		}

	}

	/*=============================================
	EDITAR ACTIVOS
	=============================================*/

	static public function ctrEditarActivo(){

		if(isset($_POST["editarDescripcion"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarDescripcion"])){
				$tabla = "activos";

				$datos = array("id_categoria" => $_POST["editarCategoria"],
					"codigo" => $_POST["editarCodigo"],
					"descripcion" => $_POST["editarDescripcion"],
					"marca" => $_POST["editarMarca"],
					"fecha_alta" => $_POST["editarFechaAlta"],
					"fecha_baja" => $_POST["editarFechaBaja"],
					"valor" => $_POST["editarValor"],
					"cantidad" => $_POST["editarCantidad"]);
				$respuesta = ModeloActivos::mdlEditarActivo($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

						swal({
							type: "success",
							title: "El activo ha sido editado correctamente",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
							}).then(function(result){
										if (result.value) {
										
										}
									})
						</script>';
				}
			}else{
				echo'<script>
					swal({
						type: "error",
						title: "¡El activo no puede ir con los campos vacíos o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
						}).then(function(result){
							if (result.value) {
							window.location = "activos";
							}
						})
					</script>';
			}
		}
	}

	/*=============================================
	BORRAR ACTIVO
	=============================================*/
	static public function ctrEliminarActivo(){

		if(isset($_GET["idActivo"])){

			$tabla ="activos";
			$datos = $_GET["idActivo"];

			$respuesta = ModeloActivos::mdlEliminarActivo($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El Activo ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "activos";
								}
							})
				</script>';
			}		
		}
	}
}