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
	date_default_timezone_set('UTC');
	$Y = date("Y");
	$M = date("m");
	$D = date("d");
	$H = date("G")+7;
	$MI = date(":i:s");
	$datessql = $Y."-".$M."-".$D;
	$ID=$_GET['price'];
	if($ID!=null){
		$qq="SELECT * FROM promotion Where pro_price = '".$ID."' AND pro_enddate >= '".$datessql."'";
	}
	
		$resultpd=mysql_query($qq,$connection);
		$num=mysql_affected_rows();
	    $json=new mysql2json;
		$data=$json->getJSON($resultpd,$num);
  
        if($num!=0){
            echo $data;
        }
        else{
            echo "0";
        }
?>