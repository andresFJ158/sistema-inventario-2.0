<?php

class Conexion{

	static public function conectar(){
		$link = new PDO("mysql:host=localhost;dbname=u767726139_gse",
			"u767726139_admin",
            "^4r+qzM$Z");
		$link->exec("set names utf8");
		return $link;
	}
}