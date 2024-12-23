<?php

require_once "conexion.php";

class ModeloProductos{
	/*=============================================
	MOSTRAR PRODUCTOS
	=============================================*/
	static public function mdlMostrarProductos($tabla, $item, $valor, $orden) {
		$tablaStock = "registros_inventario";
		if ($item != null) {
			$stmt = Conexion::conectar()->prepare("
				SELECT p.*, 
					COALESCE(SUM(s.cantidad), 0) AS stock 
				FROM $tabla p
				LEFT JOIN $tablaStock s ON p.id = s.id_producto
				WHERE p.$item = :$item
				GROUP BY p.id
				ORDER BY p.$orden DESC
			");
			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt->fetch();
		} else {
			$stmt = Conexion::conectar()->prepare("
				SELECT p.*, 
						COALESCE(SUM(s.cantidad), 0) AS stock 
				FROM $tabla p
				LEFT JOIN $tablaStock s ON p.id = s.id_producto
				GROUP BY p.id
				ORDER BY p.$orden DESC
			");
			$stmt->execute();
			return $stmt->fetchAll();
		}
		$stmt = null;
	}
	
	/*=============================================
	REGISTRO DE PRODUCTO
	=============================================*/
	static public function mdlIngresarProducto($tabla, $datos){
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_categoria, codigo, descripcion, imagen, precio_compra, precio_venta) VALUES (:id_categoria, :codigo, :descripcion, :imagen, :precio_compra, :precio_venta)");
		$stmt->bindParam(":id_categoria", $datos["id_categoria"], PDO::PARAM_INT);
		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_compra", $datos["precio_compra"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_venta", $datos["precio_venta"], PDO::PARAM_STR);
		if($stmt->execute()){
			return "ok";
		}else{
			return "error";
		}
		$stmt->close();
		$stmt = null;
	}
	/*=============================================
	EDITAR PRODUCTO
	=============================================*/
	static public function mdlEditarProducto($tabla, $datos){
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_categoria = :id_categoria, descripcion = :descripcion, imagen = :imagen, precio_compra = :precio_compra, precio_venta = :precio_venta WHERE codigo = :codigo");
		$stmt->bindParam(":id_categoria", $datos["id_categoria"], PDO::PARAM_INT);
		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_compra", $datos["precio_compra"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_venta", $datos["precio_venta"], PDO::PARAM_STR);
		if($stmt->execute()){
			return "ok";
		}else{
			return "error";
		}
		$stmt->close();
		$stmt = null;
	}
	/*=============================================
	BORRAR PRODUCTO
	=============================================*/
	static public function mdlEliminarProducto($tabla, $datos){
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);
		if($stmt -> execute()){
			return "ok";
		}else{
			return "error";	
		}
		$stmt -> close();
		$stmt = null;
	}
	/*=============================================
	ACTUALIZAR PRODUCTO
	=============================================*/
	static public function mdlActualizarProducto($tabla, $item1, $valor1, $valor){
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE id = :id");
		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":id", $valor, PDO::PARAM_STR);
		if($stmt -> execute()){
			return "ok";
		}else{
			return "error";	
		}
		$stmt -> close();
		$stmt = null;
	}
	/*=============================================
	MOSTRAR SUMA VENTAS
	=============================================*/	
	static public function mdlMostrarSumaVentas($tabla){
		$stmt = Conexion::conectar()->prepare("SELECT SUM(ventas) as total FROM $tabla");
		$stmt -> execute();
		return $stmt -> fetch();
		$stmt -> close();
		$stmt = null;
	}
	/*
	MOSTRAR STOCK PRODUCTO
	*/
	static public function mdlMostrarStockProducto($tabla, $id){
		$stmt = Conexion::conectar()->prepare("SELECT SUM(cantidad) as total FROM $tabla WHERE id_producto = :id");
		$stmt->bindParam(":id", $id, PDO::PARAM_STR);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		$stmt = null;
		return $result['total'] ?? 0;
	}
	
	/*=============================================
	REGISTRO DE INVENTARIO
	=============================================*/
	static public function mdlRegistroInventario($tabla, $datos){
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_producto,cantidad,glosa) VALUES (:id_producto, :cantidad, :glosa)");
		$stmt->bindParam(":id_producto", $datos["id_producto"], PDO::PARAM_INT);
		$stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_STR);
		$stmt->bindParam(":glosa", $datos["glosa"], PDO::PARAM_STR);
		if($stmt->execute()){
			return "ok";
		}else{
			return "error";
		}
		$stmt->close();
		$stmt = null;
	}
		/*=============================================
	REGISTRO DE INVENTARIO
	=============================================*/
}