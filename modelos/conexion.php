<?php

class Conexion{

	static public function conectar(){
		$link = new PDO("mysql:host=localhost;dbname=u767726139_sistema",
			"u767726139_andres",
            "kMoV:TR>D8");
		$link->exec("set names utf8");
		return $link;
	}
}