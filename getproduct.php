<?php
	require("mysql2json.class.php");
	$hostname_connection = "localhost";
	$database_connection = "doll-stroe";
	$username_connection = "root";
	$password_connection = "123456789";
	$connection = mysql_connect($hostname_connection, $username_connection, $password_connection) or trigger_error(mysql_error(),E_USER_ERROR); 
	mysql_query("SET character_set_results=utf8");
	mysql_query("SET character_set_client=utf8");
	mysql_query("SET character_set_connection=utf8");
	mysql_select_db($database_connection, $connection);
	
	$ID=$_GET['ID'];
	if($ID==1){
		$qq="SELECT * FROM product ";
	}
	else{
		$qq="SELECT * FROM agent ";
	}
	
		$resultpd=mysql_query($qq,$connection);
		$num=mysql_affected_rows();
	    $json=new mysql2json;
		$data=$json->getJSON($resultpd,$num);
		echo $data;
?>