<?php
/**
 *
 */
class Rutas
{

	static public function ctrlRuta(){
		$host=$_SERVER['HTTP_HOST'];
		return "http://".$host."/aplicativo/modulousuarios/";
	}

	/* static public function ctrlRutasFrontend(){
		$host=$_SERVER['HTTP_HOST'];
		return "http://".$host."/acielosabiertos/";
	} */

}
