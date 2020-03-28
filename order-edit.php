<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ระบบจัดการร้านตุ๊กตา</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="./vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="./vendor/font-awesome/css/font-awesome.min.css">
    <!-- Fontastic Custom icon font-->
    <link rel="stylesheet" href="./css/fontastic.css">
    <!-- Google fonts - Poppins -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="./css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="./css/custom.css">
    <link rel="stylesheet" href="./css/styledesing.css">
    <link rel="stylesheet" href="./css/jquery.dataTables.min.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="./img/favicon.ico">
    <style>
    .imagePreview {
    width: 100%;
    height: 180px;
    background-position: center center;
    background:url(http://cliquecities.com/assets/no-image-e3699ae23f866f6cbdf8ba2443ee5c4e.jpg);
    background-color:#fff;
        background-size: cover;
    background-repeat:no-repeat;
        display: inline-block;
    box-shadow:0px -3px 6px 2px rgba(0,0,0,0.2);
    }
    .btn-primary
    {
    display:block;
    border-radius:0px;
    box-shadow:0px 4px 6px 2px rgba(0,0,0,0.2);
    margin-top:-5px;
    }
    .imgUp
    {
    margin-bottom:15px;
    }
    .del
    {
    position:absolute;
    top:0px;
    right:15px;
    width:30px;
    height:30px;
    text-align:center;
    line-height:30px;
    background-color:rgba(255,255,255,0.6);
    cursor:pointer;
    }
    .imgAdd
    {
    width:100%;
    height:30px;
    border-radius:5px;
    background-color:#dc3545;
    color:#fff;
    box-shadow:0px 0px 2px 1px rgba(0,0,0,0.2);
    text-align:center;
    line-height:30px;
    margin-top:5px;
    cursor:pointer;
    font-size:15px;
    margin-left:1%;
    }
    </style>
    <script type="text/javascript" src="./js/jquery-3.1.1.min.js" ></script>
    <script type="text/javascript" src="./js/qurryaddress.js" ></script>
  </head>
  <body onload="Add();">
    <?php 
     date_default_timezone_set("Asia/Bangkok");
     function DateThai($strDate)
     {
       $strYear = date("Y",strtotime($strDate))+543;
       $strMonth= date("n",strtotime($strDate));
       $strDay= date("j",strtotime($strDate));
       $strHour= date("H",strtotime($strDate));
       $strMinute= date("i",strtotime($strDate));
       $strSeconds= date("s",strtotime($strDate));
       $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤษจิกายน","ธันวาคม");
       $strMonthThai=$strMonthCut[$strMonth];
       return "$strDay $strMonthThai $strYear";
     }
     include('connect.php');
     $sqldataqurry = "SELECT * FROM Ordering";
     if($resultdataqurry = mysqli_query($con, $sqldataqurry)){
         $count = mysqli_num_rows($resultdataqurry);
         while($row = mysqli_fetch_array($resultdataqurry)){
             if(substr($row['order_id'],2)==$count){
               $count++;
             }
         }
         if($count==0){$count++;}
         $id = "OD".$count;
         date_default_timezone_set('UTC');
         $Y = date("Y");
         $M = date("m");
         $D = date("d");
         $H = date("G")+7;
         $MI = date(":i:s");
         $datessql = $Y."-".$M."-".$D." ". $H.$MI;
         $dates = $D."-".$M."-".$Y." ". $H.$MI;
     }
      if(isset($_POST["add"])){
        $checkstatus=0;
        if($_POST["order_id"]!=null){
                        for($i=0;$i<count($_POST["product_id"]);$i++)
                        {
                            $sqledit = "UPDATE order_detail SET product_id='".$_POST["product_id"][$i]."',detail_amount='".$_POST["detail_amount"][$i]."',detail_price='".$_POST["detail_price"][$i]."'
                             WHERE detail_id='".$_POST['id_detail'][$i]."'"; 
                                if(mysqli_query($con, $sqledit)){ 
                                  echo '<script>
                                  $(document).ready(function(){
                                    $("#modalsuccess").modal("show");
                                  });
                                </script>';
                                } else { 
                                  echo '<script>
                                  $(document).ready(function(){
                                    $("#modalerror").modal("show");
                                  });
                                </script>';
                                } 
                        }
        }
        else{
          echo '<script>
          $(document).ready(function(){
            $("#modalerror").modal("show");
          });
        </script>';
          }
      } 
    ?>
    <div class="page">
      <!-- Main Navbar-->
		<?php include ('./menubar.php');?>
        <div class="content-inner">
          <!-- Page Header-->
          <header class="page-header">
            <div class="container-fluid">
              <h2 class="no-margin-bottom">รายละเอียดข้อมูลการสั่งซื้อสินค้า</h2>
            </div>
          </header>
          <!-- Dashboard Counts Section-->
          <section class="dashboard-counts no-padding-bottom">
            <div class="container-fluid">
            <div class="row">
                <!-- Line Charts-->
                <div class="col-lg-12">
                <?php
                    if($checkstatus==2){ ?>
                             <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Successful !</strong>  แก้ไขข้อมูลการสั่งซื้อสินค้าสำเร็จ
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                             </div>
                        <?php
                    }
                    else if($checkstatus==3){ ?>
                             <div class="alert alert-danger  alert-dismissible fade show" role="alert">
                                <strong>Unsuccessful !</strong>  แก้ไขข้อมูลการสั่งซื้อสินค้าไม่สำเร็จ
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                             </div>
                    <?php }  ?>
                  <div class="line-chart-example card">
                    <div class="card-body">
                      <form name="myform" action="" method="post" enctype="multipart/form-data">
                      <label for="inputEmail4"><h3>ข้อมูลการสั่งซื้อสินค้า</h3></label>
                      <hr>
                      <?php 
                                include('connect.php');
                                $sql = "SELECT * FROM Ordering where order_id='".$_GET['id']."' ";
                                if($result = mysqli_query($con, $sql)){
                                    while($row = mysqli_fetch_array($result)){
                              ?>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                            <label for="inputEmail4">รหัสสั่งซื้อสินค้า :</label>
                            <input type="text" class="form-control" name="order_id" value="<?php echo $row['order_id'];?>" readonly>
                            </div>
                            <div class="form-group col-md-4">
                            <label for="inputEmail4">วันที่สั่งซื้อสินค้า :</label>
                            <input type="text" class="form-control"  value="<?php echo DateThai($row['order_date']);?>" readonly>
                            </div>
                            <div class="form-group col-md-4">
                            <label for="inputEmail4">พนักงาน :</label>
                            <?php 
                                include('connect.php');
                                $sqlem = "SELECT * FROM employee where emp_id='".$row['emp_id']."' ";
                                if($resultem = mysqli_query($con, $sqlem)){
                                    while($rowem = mysqli_fetch_array($resultem)){
                              ?>
                              <input type="text" class="form-control" value="<?php echo $rowem['emp_name']." ".$rowem['emp_sur'];?>" readonly>
                              <?php }}?>
                            </div>
                        </div>
                        <hr>
                        <label for="inputEmail4" style="margin-top:20px;"><h3>ข้อมูลสินค้า</h3></label>
                        <table class="table table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                    <th class="text-center" scope="col">ลำดับ</th>
                                    <th class="text-center" scope="col">ชื่อสินค้า</th>
                                    <th class="text-center"scope="col">จำนวน</th>
                                    <th class="text-center" scope="col">ราคา (บาท)</th>
                                    <th class="text-center" scope="col">จัดการข้อมูล</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                include('connect.php');
                                $sqlpd = "SELECT * FROM order_detail where order_id='".$row['order_id']."' ";
                                if($resultpd = mysqli_query($con, $sqlpd)){
                                    while($rowpd = mysqli_fetch_array($resultpd)){
                                        $countno +=1;
                                    ?>
                                    <input type="hidden" name="id_detail[]" value="<?php echo $rowpd['detail_id'];?>">
                                     <tr>
                                    <th scope="row"  class="text-center"><?php echo  $countno;?></th>
                                    <td>
                                            <?php 
                                            include('connect.php');
                                            $sqlaa = "SELECT * FROM product where product_id='".$rowpd['product_id']."'";
                                            if($resultaa = mysqli_query($con, $sqlaa)){
                                                while($rowaa = mysqli_fetch_array($resultaa)){
                                                ?>
                                                <input type="hidden" name="product_id[]" value="<?php echo $rowaa['product_id']?>">
                                               <?php echo $rowaa['product_name']?>
                                            <?php }}?>
                                    </td>
                                    <td>
                                    <input type="number" class="form-control" name="detail_amount[]" value="<?php echo $rowpd['detail_amount'];?>" >
                                    </td>
                                    <td>
                                    <input type="number" class="form-control" name="detail_price[]" value="<?php echo $rowpd['detail_price'];?>" readonly>
                                    </td>
                                    <td>
                                    <p id="deletedata" class="imgAdd" value="<?php echo $rowpd['detail_id'];?>">ลบข้อมูล</p>
                                    </td>
                                    </tr>
                                    <?php }}?>
                                </tbody>
                                </table>
                        <div class="form-row" style="margin-top: 25px;">
                          <div class="form-group col-md-12">
                            <center>
                              <a href="order.php" class="adddata btn btn-info text-center">ย้อนกลับ</a>
                              <a id="editdata" class="btn btn-success text-center" value="<?php echo $row["order_id"]?>">แก้ไขข้อมูล</a>
                              <input type="hidden" name="add">
                            </center>
                          </div>
                        </div>
                                          <?php }}?>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
                   <!-- Modal -->
                   <div class="modal fade" id="deletedataperfix" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">การแจ้งเตือน</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <center>
                  ต้องการลบข้อมูลใช่หรือไม่
                  </center>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                  <button id="submit" type="button" class="btn btn-danger">ลบข้อมูล</button>
                </div>
              </div>
            </div>
          </div>
            <!-- Modal -->
              <!-- Modal -->
       <div class="modal fade" id="modalsuccess" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">การแจ้งเตือน</h5>
                </div>
                <div class="modal-body">
                  <center>
                  <h4> แก้ไขข้อมูลการสั่งซื้อสินค้า : <b><?php echo $_POST['order_id'];?></b> สำเร็จ</h4>
                  </center>
                </div>
                <div class="modal-footer">
                  <button id="successs" type="button" class="btn btn-success" data-dismiss="modal">ตกลง</button>
                </div>
              </div>
            </div>
          </div>
          <div class="modal fade" id="modaledits" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">การแจ้งเตือน</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <center>
                  <h4> คุณแน่ใจที่จะแก้ไข  : <b id="checkedata"></b></h4>
                  </center>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                  <button id="submit" type="button" class="btn btn-danger">แก้ไขข้อมูล</button>
                </div>
              </div>
            </div>
          </div>
      <!-- Modal -->
      <div class="modal fade" id="modalerror" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">การแจ้งเตือน</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <center>
                  <h4> แก้ไขข้อมูลการสั่งซื้อสินค้า : <b><?php echo $_POST['order_id'];?></b> ไม่สำเร็จ</h4>
                  </center>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-success" data-dismiss="modal">ตกลง</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="./vendor/jquery/jquery.min.js"></script>
    <script src="./vendor/popper.js/umd/popper.min.js"> </script>
    <script src="./vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="./vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="./vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="./js/jquery.dataTables.min.js"></script>
    <!-- Main File-->
    <script src="./js/front.js"></script>
  </body>
  <script>
       $(document).on('click', '#successs', function(){   
    		window.location.href="./order.php"
    }); 
      $(document).on('click', '#deletedata', function(){   
        var at_id = $(this).attr("value");  
        $('#deletedataperfix').modal('show');
        $(document).on('click', '#submit', function(event){  
           event.preventDefault();  
           $.ajax({  
                url:"./order-delete.php",  
                method:"POST",  
                data:{detail_id:at_id},  
                dataType:"json",  
                success:function(data){ 
                    if(data==1){
                      at_id='';
                      location.reload();
                    }
                    else{
                      at_id='';
                      $('#deletedataperfix').modal('hide');
                    }
                }  
           });   
      });  
      });  
      

     $(document).on('click', '#editdata', function(){   
       
       var at_id = document.getElementById("editdata").getAttribute("value"); 
      document.getElementById("checkedata").innerHTML = at_id;
      $('#modaledits').modal('show');
      $(document).on('click', '#submit', function(event){  
         document.myform.submit();
     });  
    });  
    </script>
  <script>
    $(document).ready(function() {
        $('#perfixTables').DataTable({
            responsive: true
        });
    });
    </script>
</html>