<?php  
 include('./connect.php');
 if(isset($_POST["order_id"]))  
 {  $keyselling=[];
    $keyamount=[];
    $keydpid=[];
    $sql = "SELECT * FROM  receive
    JOIN details_receive ON receive.receive_id = details_receive.receive_id where receive.receive_id='".$_POST["order_id"]."'";
    
    if($result = mysqli_query($con, $sql)){
        while($row = mysqli_fetch_array($result)){
          array_push($keyselling,$row['product_id']);
          array_push($keyamount,$row['detail_receive_amount']);
        }}
        
    for($i=0;$i<count($keyselling);$i++){
        $product_id= $keyselling[$i];
        $sqlupdate = "SELECT * FROM product  WHERE product_id='".$product_id."' ";
        if($resultupdate = mysqli_query($con, $sqlupdate)){
            while($rowupdate = mysqli_fetch_array($resultupdate)){
              $amounts = $rowupdate['product_amount']-$keyamount[$i];
              
              $sqledit = "UPDATE product SET product_amount='".$amounts."' WHERE product_id='".$product_id."' "; 
              if(mysqli_query($con, $sqledit)){ 
                
              }
              else{
              
              }
              $amounts=0;
          }
        }
    }
    $sqlposition = " DELETE FROM receive WHERE receive_id = '".$_POST["order_id"]."' ";
    if ($con->query($sqlposition) === TRUE) {

        $sqlpositionss = " DELETE FROM details_receive WHERE receive_id = '".$_POST["order_id"]."' ";
        if ($con->query($sqlpositionss) === TRUE) {
                    echo json_encode("1"); 
        
        } else {
            echo json_encode("0"); 
        }

    }
 }  
