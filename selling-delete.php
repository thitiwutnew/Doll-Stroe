<?php  
 include('./connect.php');
 if(isset($_POST["order_id"]))  
 {  
    $checkdelete =0;
    include('connect.php');
    $keyselling=[];
    $keyamount=[];
    $sql = "SELECT * FROM  selling
    JOIN selling_detail ON selling.sell_id = selling_detail.sell_id where selling.sell_id='".$_POST["order_id"]."'";
    
    if($result = mysqli_query($con, $sql)){
        while($row = mysqli_fetch_array($result)){
          array_push($keyselling,$row['product_id']);
          array_push($keyamount,$row['seld_amount']);
        }}
        
    for($i=0;$i<count($keyselling);$i++){
        $product_id= $keyselling[$i];
        $sqlupdate = "SELECT * FROM product  WHERE product_id='".$product_id."'";
        if($resultupdate = mysqli_query($con, $sqlupdate)){
            while($rowupdate = mysqli_fetch_array($resultupdate)){
              $amounts = $rowupdate['product_amount']+$keyamount[$i];
              
              $sqledit = "UPDATE product SET product_amount='".$amounts."' WHERE product_id='".$product_id."'"; 
              if(mysqli_query($con, $sqledit)){ 
                
              }
              else{
              
              }
              $amounts=0;
          }
        }
    }
    $query = " DELETE FROM selling WHERE sell_id = '".$_POST["order_id"]."' ";
    if ($con->query($query) === TRUE) {

        $querymo = " DELETE FROM sell_promotion WHERE sell_id = '".$_POST["order_id"]."' ";
            if ($con->query($querymo) === TRUE) {
                $checkdelete =1;
            } else {
                $checkdelete =0;
            }
        $querydetail = " DELETE FROM selling_detail WHERE sell_id = '".$_POST["order_id"]."' ";
            if ($con->query($querydetail) === TRUE) {
                $checkdelete =1;
            } else {
                $checkdelete =0;
            }

    } else {
        $checkdelete =0;
    }
    echo json_encode($checkdelete); 
 }  


 if(isset($_POST["detail_id"]))  
 {  
    $checkdelete =0;
    $query = " DELETE FROM selling_detail WHERE seld_id = '".$_POST["detail_id"]."' ";
    if ($con->query($query) === TRUE) {

        $querymo = " DELETE FROM sell_promotion WHERE sell_id = '".$_POST["order_id"]."' ";
            if ($con->query($querymo) === TRUE) {
                $checkdelete =1;
            } else {
                $checkdelete =0;
            }
        $querydetail = " DELETE FROM selling_detail WHERE sell_id = '".$_POST["order_id"]."' ";
            if ($con->query($querydetail) === TRUE) {
                $checkdelete =1;
            } else {
                $checkdelete =0;
            }

    } else {
        $checkdelete =0;
    }
    echo json_encode($checkdelete); 
 }  
