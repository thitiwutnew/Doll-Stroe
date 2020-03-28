<?php  
 include('./connect.php');
 if(isset($_POST["product_id"]))  
 {  
    
    $sqlposition = "SELECT * FROM order_detail where product_id='".$_POST['product_id']."'";
    if($resultposition = mysqli_query($con, $sqlposition)){
        $count = mysqli_num_rows ( $resultposition );
        if($count>0){
            echo json_encode("2"); 
        }
        else{
            $query = " DELETE FROM product WHERE product_id = '".$_POST["product_id"]."' ";
            if ($con->query($query) === TRUE) {
                echo json_encode("1"); 
            } else {
                echo json_encode("0"); 
            }
        }
    }
 }  
 if(isset($_POST["idimg"]))  
 {  
      $id=substr($_POST["idimg"],0,1);
    if($id==2){
        $sqledit = "UPDATE product SET product_img2='' WHERE product_id='".$_POST["id"]."'"; 
        if(mysqli_query($con, $sqledit)){ 
            echo json_encode("1");
        } else { 
            echo json_encode("0");
        } 
    }
    if($id==3){
        $sqledit = "UPDATE product SET product_img3='' WHERE product_id='".$_POST["id"]."'"; 
        if(mysqli_query($con, $sqledit)){ 
            echo json_encode("1");
        } else { 
            echo json_encode("0");
        } 
    }
    if($id==4){
        $sqledit = "UPDATE product SET product_img4='' WHERE product_id='".$_POST["id"]."'"; 
        if(mysqli_query($con, $sqledit)){ 
            echo json_encode("1");
        } else { 
            echo json_encode("0");
        } 
    }
 } 
 ?>
