<?php

	session_start();
	session_unset();

	$_SESSION["estado"]="0";
	header ("Location:login/login.html");

	session_destroy();

?>