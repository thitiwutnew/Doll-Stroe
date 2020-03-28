<?php  
 include('./connect.php');
 if(isset($_POST["pro_id"]))  
 {  
      $query = " DELETE FROM promotion WHERE pro_id = '".$_POST["pro_id"]."' ";
      if ($con->query($query) === TRUE) {
          
        echo json_encode("1"); 
    } else {
        echo json_encode("0"); 
    }
 }  

 ?>
