<?php
class Login_cliente
{
  public function evaluar_cliente($correo_cliente, $contrasena_ingreso_cliente)
  {
	
	session_start();
	  
	$cont=0;
	  
	//Consulta de la DB
	  
	include('conexion_db.php');
	  
	$sql = "SELECT * FROM cliente_domicilio WHERE Correo_cliente_domi = '$correo_cliente' AND Contrsena_cliente_domi = '$contrasena_ingreso_cliente'";

	if(!$result = $db->query($sql))
	{
	  die('Datos no encontrados!!! [' . $db->error . ']');
	}
	
	while($row = $result->fetch_assoc())
	{
		$ccorreo_client=stripslashes($row["Correo_cliente_domi"]);		
		$ccontrasena_client=stripslashes($row["contrasena_ingreso_cliente"]);

		if (($ccorreo_client==$correo_cliente) && ($contrasena_ingreso_cliente == $ccontrasena_client))
		{
			$cont=$cont=1;
		}

	} //Fin del WHILE
	  
	//Consulta de la DB
	
	if ($cont!="0") 
	{
		$_SESSION["Correo_cliente_domi"]=$ccorreo_client;
		$_SESSION["contrasena_ingreso_cliente"]=$ccontrasena_client;

		switch ($ccorreo_client) 
		{
			header ("Location:interfaz_sistema/index.html");
		}
	}

	if ($cont=="0") 
	{
		header ("Location:login/login_error.html");
	}
  }	
}

$nuevo=new Login_cliente();
$nuevo->evaluar_cliente($_POST["correo_cliente"], $_POST["contrasena_ingreso_cliente"])

?>