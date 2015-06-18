<?php
include('conexion.php');

/*inyecciones sql*/
$usu = addslashes($_POST['usu']);
$pass = addslashes($_POST['pass']);
$area = addslashes($_POST['area']);

$usuario = mysql_query("SELECT * FROM usuario WHERE User = '$usu'");
if(mysql_num_rows($usuario)<1){
	echo 'usuario';
}else{
	$area = mysql_query("SELECT * FROM usuario WHERE User = '$usu' AND Id_cat = '$area'");
	if(mysql_num_rows($area)<1){
		echo 'area';
	}else{
		$consulta = mysql_query("SELECT * FROM usuario WHERE User = '$usu' AND Pass = '$pass'");
		if(mysql_num_rows($consulta)<1){
			echo 'password';
		}else{
			$consulta2 = mysql_fetch_array($consulta);
			$_SESSION['User'] = $consulta2['User'];
			$_SESSION['Id_cat'] = $consulta2['Id_cat'];
			switch($consulta2['Id_cat']){
				case 1:
					echo 1;
				break;
				case 2:
					echo 2;
				break;
				case 3:
					echo 3;
				break;
			}
		}
	}
}
?>
