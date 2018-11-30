<?php
class Login
{
  public function evaluar($nombre_usuario, $apellido_usuario, $documento_ingreso, $contrasena_ingreso, $fk_idRol)
  {
	
	session_start();
	  
	$cont=0;
	  
	//Consulta de la DB
	  
	include('conexion_db.php');
	  
	$sql = "SELECT * FROM usuario WHERE Numero_documento = '$documento_ingreso' AND Contrasena_ingreso = '$contrasena_ingreso'";

	if(!$result = $db->query($sql))
	{
	  die('Datos no encontrados!!! [' . $db->error . ']');
	}
	
	while($row = $result->fetch_assoc())
	{
		$nnombre_usuario=stripslashes($row["Nombre_usuario"]);
		$aapellido_usuario=stripslashes($row["Apellido_usuario"]);
		$ddocumento=stripslashes($row["Numero_documento"]);
		$ccontrasena=stripslashes($row["Contrasena_ingreso"]);
		$ffk_idRoll=stripslashes($row["fk_idRol"]);
		$ffk_idEstadoo=stripslashes($row["fk_idEstado"]);

		if (($ddocumento==$documento_ingreso) && ($contrasena_ingreso == $ccontrasena))
		{
			$cont=$cont=1;
		}

	} //Fin del WHILE
	  
	//Consulta de la DB
	
	if ($cont!="0") 
	{
		$_SESSION["fk_idRol"]=$ffk_idRoll;
		$_SESSION["Nombre_usuario"]=$nnombre_usuario;
		$_SESSION["Apellido_usuario"]=$aapellido_usuario;
		$_SESSION["fk_idEstado"]="1";

		switch ($ffk_idEstadoo)
		{
			case '1':
				switch ($ffk_idRoll) 
				{
					case '1':
						header ("Location:interfaz_sistema/index.html");
					break;
						
					case '2':
						header ("Location:interfaz_sistema/pages/index_user.php");
					break;
				}
			break;

			case '2':
				header("Location: login/user_ban.html");
			break;
		}
	}

	if ($cont=="0") 
	{
		header ("Location:login/login_error.html");
	}
  }	
}

$nuevo=new Login();
$nuevo->evaluar($_POST["nombre_usuario"], $_POST["apellido_usuario"], $_POST["documento_ingreso"], $_POST["contrasena_ingreso"], $_POST["fk_idRol"])

?>