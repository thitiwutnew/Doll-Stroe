<?php
 include('./connect.php');
 if(isset($_POST["cus_id"]))
 {

   $query = " DELETE FROM customer WHERE cus_id = '".$_POST["cus_id"]."' ";
   if ($con->query($query) === TRUE) {
      
     echo json_encode("1");
 } else {
     echo json_encode("0");
 }
}
 ?>
