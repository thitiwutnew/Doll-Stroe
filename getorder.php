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
	if($ID!=null){
		 $totalresult =[];
				$sql = "SELECT * FROM receive
				WHERE order_id ='".$_GET['ID']."'";
		
					$result = mysql_query($sql,$connection);
					$num_rows = mysql_num_rows($result);
					
						if($num_rows>0){
							$qq="SELECT *, SUM(details_receive.detail_receive_amount) as Amount FROM order_detail 
							JOIN receive on order_detail.order_id = receive.order_id 
							join details_receive ON ( receive.receive_id = details_receive.receive_id AND order_detail.product_id = details_receive.product_id) 
							JOIN product ON details_receive.product_id=product.product_id 
							WHERE order_detail.order_id='".$ID."' GROUP BY product.product_id HAVING SUM(details_receive.detail_receive_amount) !=-1";
							$resultpd=mysql_query($qq,$connection);
							while($row = mysql_fetch_array($resultpd)){
							array_push($totalresult,$row);
							}
						}
						else{
							$qq="SELECT *FROM  order_detail 
							JOIN product ON order_detail.product_id=product.product_id 
							WHERE order_detail.order_id='".$ID."' ";
							$resultpd=mysql_query($qq,$connection);
							while($row = mysql_fetch_array($resultpd)){
							array_push($totalresult,$row);
							}
						}
					
	}
	echo json_encode($totalresult);
?>