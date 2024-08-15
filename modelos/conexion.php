<?php

class Conexion{

	static public function conectar(){
		$link = new PDO("mysql:host=localhost;dbname=u767726139_gse",
			"u767726139_admin",
            "&Kg66bp30;");
		$link->exec("set names utf8");
		return $link;
	}
}