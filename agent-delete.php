<?php
 include('./connect.php');
 if(isset($_POST["agent_id"]))
 {

   $query = " DELETE FROM agent WHERE agent_id = '".$_POST["agent_id"]."' ";
   if ($con->query($query) === TRUE) {
         $count=0;
     $sqlem = "SELECT * FROM agent_detail  where  agent_id ='".$_POST['agent_id']."'";
     if($resultem = mysqli_query($con, $sqlem)){
         while($rowem = mysqli_fetch_array($resultem)){
             $queryod = " DELETE FROM agent_detail WHERE agent_detail_id = '".$rowem["agent_detail_id"]."' ";
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
if(isset($_POST["agent_detail_id"]))
{
 $queryod = " DELETE FROM agent_detail WHERE agent_detail_id = '".$_POST["agent_detail_id"]."' ";
 if ($con->query($queryod) === TRUE) {
     echo json_encode("1");
     } else {
         echo json_encode("0");
     }
}
 ?>
