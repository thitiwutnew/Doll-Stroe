<?php  
 include('./connect.php');
 if(isset($_POST["position_id"]))  
 {  
    
    $sqlposition = "SELECT * FROM employee where position_id='".$_POST['position_id']."'";
    if($resultposition = mysqli_query($con, $sqlposition)){
        $count = mysqli_num_rows ( $resultposition );
        if($count>0){
            echo json_encode("2"); 
        }
        else{
            $query = " DELETE FROM position WHERE position_id = '".$_POST["position_id"]."' ";
            if ($con->query($query) === TRUE) {
              echo json_encode("1"); 
          } else {
              echo json_encode("0"); 
          }
        }
    }
 }  
 ?>
