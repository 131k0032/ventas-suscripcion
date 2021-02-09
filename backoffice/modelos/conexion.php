<?php 
	// conectara la bd opcion 1
	class Conexion{

		public function conectar(){
			$link = new PDO("mysql:host=localhost;dbname=ventas-suscripcion",
							"root",
							"",
							array(PDO::ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION,PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8")
				);
			return $link;
		}

	}

	// conectara la bd opcion 2

	// class Conexion{

	// 	public function conectar(){
	// 		$link = new PDO("mysql:host=localhost;dbname=ventas-suscripcion");
							
	// 		$link->exec("set names uft8");
	// 		return $link;
	// 	}

	// }

 ?>