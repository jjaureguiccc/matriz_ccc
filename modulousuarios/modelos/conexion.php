<?php

class Conexion{

	static public function conectar(){

		try {

			$link = new PDO("mysql:host=localhost;dbname=gestionpat2",
				"root",
				"");
			$link->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
			$link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$link->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
			$link->exec("set names utf8");

			return $link;

		} catch (Exception $e) {

			echo 'Excepción capturada: ',  $e->getMessage(), "\n";

		}

	}

}
