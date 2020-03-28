<?php  
 include('./connect.php');
 if(isset($_POST["prefix_id"]))  
 {  

    $sqlposition = "SELECT * FROM employee where prefix_id='".$_POST['prefix_id']."'";
    if($resultposition = mysqli_query($con, $sqlposition)){
        $count = mysqli_num_rows ( $resultposition );
        if($count>0){
            echo json_encode("2"); 
        }
        else{
            $query = " DELETE FROM prefix WHERE prefix_id = '".$_POST["prefix_id"]."' ";
            if ($con->query($query) === TRUE) {
              echo json_encode("1"); 
          } else {
              echo json_encode("0"); 
          }
        }
    }
 }  
 ?>
