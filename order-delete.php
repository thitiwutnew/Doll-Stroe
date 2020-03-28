<?php  
 include('./connect.php');
 if(isset($_POST["order_id"]))  
 {  
      $query = "UPDATE ordering SET order_status='1' WHERE order_id='".$_POST['order_id']."'";
      if ($con->query($query) === TRUE) {
       
        echo json_encode("1"); 
    } else {
        echo json_encode("0"); 
    }
 }  
 if(isset($_POST["detail_id"]))  
 {  
      $query = "DELETE FROM order_detail WHERE detail_id = '".$_POST["detail_id"]."'";
      if ($con->query($query) === TRUE) {
       
        echo json_encode("1"); 
    } else {
        echo json_encode("0"); 
    }
 }  
