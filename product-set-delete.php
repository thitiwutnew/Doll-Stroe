<?php  
 include('./connect.php');
 if(isset($_POST["set_id"]))  
 {  
      $query = " DELETE FROM setproduct WHERE set_id = '".$_POST["set_id"]."' ";
      if ($con->query($query) === TRUE) {
            $count=0;
        $sqlem = "SELECT * FROM setproduct_descirption  where  set_id ='".$_POST['set_id']."'";
        if($resultem = mysqli_query($con, $sqlem)){
            while($rowem = mysqli_fetch_array($resultem)){
                $queryod = " DELETE FROM setproduct_descirption WHERE setdescription_id = '".$rowem["setdescription_id"]."' ";
                if ($con->query($queryod) === TRUE) {
                       $count+=1;
                    } else {
                        
                    }
            }
        }
        echo json_encode($count); 
    } else {
        echo json_encode("0"); 
    }
 }  
 if(isset($_POST["setdescription_id"]))  
 {  
    $queryod = " DELETE FROM setproduct_descirption WHERE setdescription_id = '".$_POST["setdescription_id"]."' ";
    if ($con->query($queryod) === TRUE) {
        echo json_encode("1"); 
        } else {
            echo json_encode("0"); 
        }
 }
 ?>
