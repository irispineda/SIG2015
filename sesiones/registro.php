<?php
	$user=$_POST['usu'];
	$pass=$_POST['pass'];
	$nombre= $_POST['nom'];
	$categ=$_POST['area'];
	
	
	$checkusuario=mysql_query("SELECT * FROM usuario WHERE User='$user'");
	$check_user=mysql_num_rows($checkusuario);
			if($check_user>0){
				echo ' <script language="javascript">alert("Atencion, ya existe el usuario designado, verifique sus datos");</script> ';
			}else{
		
				mysql_query("INSERT INTO usuario VALUES('$user','$pass','$nombre','$categ')");
		
				echo ' <script language="javascript">alert("Usuario registrado con éxito");</script> ';
				
			}
			
		

	
?>