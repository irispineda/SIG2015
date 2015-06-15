<?php
	class PHPBD{
		//variable para el enlace a la bd
		private $link;
		
		// Conectando, seleccionando la base de datos
		public function conectar(){
			$this->link = mysqli_connect('localhost', 'root', '', 'sig') 
			or die('No se pudo conectar: ' . mysql_error());
		}
		
		// Cerrar la conexión
		public function cerrar(){
			mysqli_close($this->link);
		}
		
		public function consultar($query){
			$result = mysqli_query($this->link,$query) or die('Consulta fallida: ' . mysql_error());
			
			return $result;
		}
		
		// Liberar resultados
		public function liberar($result){
			mysqli_free_result($result);
		}
		
		//formatea fechas
		public function formateaFecha($fecha){
			$newFecha=explode("/",$fecha);
			return $newFecha[2]."-".$newFecha[1]."-".$newFecha[0];
		}
	}
?>