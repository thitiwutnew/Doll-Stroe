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
	$type=$_GET['TYPE'];
	if($type=='Proviance'){
		$query="SELECT PROVINCE_ID, PROVINCE_NAME FROM province ORDER BY PROVINCE_NAME ASC ";
	}
	 if($type=='District') 
	{
		$query="SELECT AMPHUR_ID, AMPHUR_NAME FROM amphur ORDER BY AMPHUR_NAME ASC";
	} 
	 if($type=='District' && $ID!=null) {
		$query="SELECT AMPHUR_ID, AMPHUR_NAME FROM amphur WHERE PROVINCE_ID='".$ID."'";
	} 
	 if($type=='Subdistrict'){
		$query="SELECT DISTRICT_ID, DISTRICT_NAME FROM district ORDER BY DISTRICT_NAME ASC";
	}
	 if($type=='Subdistrict' && $ID!=null){
		$query="SELECT DISTRICT_ID, DISTRICT_NAME FROM district WHERE AMPHUR_ID='".$ID."'";
	} 
	if($type=='Postcode'){
		$query="SELECT POST_CODE FROM amphur_postcode ORDER BY POST_CODE ASC";
	}
	 if($type=='Postcode' && $ID!=null){
		$query="SELECT POST_CODE FROM amphur_postcode WHERE AMPHUR_ID='".$ID."'";
	}
	$result=mysql_query($query,$connection);
	$num=mysql_affected_rows();
	
	$json=new mysql2json;
	$data=$json->getJSON($result,$num);
	echo $data;
?>