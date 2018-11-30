<?php
	
	session_start();
	if($_SESSION["fk_idEstado"]!="1")
	{
		header ("Location:../../login/login_error.html");
	}
	
?>