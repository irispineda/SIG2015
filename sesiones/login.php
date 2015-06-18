<?php
include('conexion.php');
if(isset($_SESSION['User'])==true and isset($_SESSION['Id_cat'])==true){
	if ($_SESSION['Id_cat'] == 1){
		header('Location:index.php');
	}else if ($_SESSION['Id_cat'] == 2){
		header('Location:index_e.php');
	}else if($_SESSION['Id_cat'] == 3){
		header('Location:index_t.php');
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Inicio de Sesi&oacute;n</title>
	<link href="../css/style.css" rel="stylesheet" type="text/css" />
	<script src="../js/jquery.js"></script>
	<script src="../js/myjava.js"></script>
</head>
<body>
	<div id="wrap">
		<div id="header">
			<h1>Alcald&iacute;a Municipal de Cuyultit&aacute;n</h1>
			<p>Sistema de Informaci&oacute;n Gerencial</p>
		</div>
			<div class="contenedor">
				<h2>Inicio de sesi&oacute;n</h2>
				</br>
				<div id="formulario">
					
						<div id="resultado"></div>
							<p><input type="text" id="usu" value="" placeholder="USUARIO"></p>
							<p><input type="password" id="pass" value="" placeholder="********"></p>
							<label>Elija su categor&iacutea:</label>
								<br/>
								<br/>
								<select id="area">
									<option value='1'>Administrador</option>
									<option value='2'>Estrat&eacute;gico</option>
									<option value='3'>T&aacute;ctico</option>
								</select>
							<br/>
							<br/>
							<p><button id="ingresar">ENTRAR</button></p>
							<br />
							<div id="mensaje"></div>
					
				</div>
			</div>

		<div id="footer">
			<div class="fleft"><a href="#">Homepage</a></div>
			<div class="fright"><a href="#">Acerca de</a></div>
			<div class="fcenter"><a href="#">Contacto</a></div>
		</div>
	</div>
</body>
</html>