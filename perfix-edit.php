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
    width:30px;
    height:30px;
    border-radius:50%;
    background-color:#4bd7ef;
    color:#fff;
    box-shadow:0px 0px 2px 1px rgba(0,0,0,0.2);
    text-align:center;
    line-height:30px;
    margin-top:0px;
    cursor:pointer;
    font-size:15px;
    }
    </style>
    <script type="text/javascript" src="./js/jquery-3.1.1.min.js" ></script>
  </head>
  <body >
    <?php 
    
     include('connect.php');
     $sqldataqurry = "SELECT * FROM prefix where prefix_id='".$_GET['id']."'";
     if($resultdataqurry = mysqli_query($con, $sqldataqurry)){
         $count = mysqli_num_rows($resultdataqurry);
         while($row = mysqli_fetch_array($resultdataqurry)){
            $id=$row['prefix_id'];
            $name=$row['prefix_name'];
         }
     }
      if(isset($_POST["add"])){
        $checkstatus=0;
        if($_POST["prefix_name"]!=null){
            $sqlposition = "SELECT * FROM prefix where prefix_name='".$_POST['prefix_name']."' AND prefix_id!='".$_GET['id']."'";
            if($resultposition = mysqli_query($con, $sqlposition)){
                $count = mysqli_num_rows ( $resultposition );
                if($count>0){
                  echo '<script>
                  $(document).ready(function(){
                    $("#modaledit").modal("show");
                  });
                </script>';
                }
                else{
                    $sqledit = "UPDATE prefix SET prefix_name='".$_POST["prefix_name"]."' WHERE prefix_id='".$_GET['id']."'"; 
                    if(mysqli_query($con, $sqledit)){ 
                      echo '<script>
                      $(document).ready(function(){
                        $("#modalsuccess").modal("show");
                      });
                    </script>';
                        $name=$_POST["prefix_name"];
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
              <h2 class="no-margin-bottom">แก้ไขข้อมูลคำนำหน้าชื่อ</h2>
            </div>
          </header>
          <!-- Dashboard Counts Section-->
          <section class="dashboard-counts no-padding-bottom">
            <div class="container-fluid">
            <div class="row">
                <!-- Line Charts-->
                <div class="col-lg-12">
                  <div class="line-chart-example card">
                    <div class="card-body">
                      <form name="myform" action="" method="post" enctype="multipart/form-data">
                      <label for="inputEmail4"><h3>ข้อมูลคำนำหน้าชื่อ</h3></label>
                      <hr>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                            <label for="inputEmail4">รหัสคำนำหน้าชื่อ :</label>
                            <input type="text" class="form-control" name="perfix_id" value="<?php echo $id;?>" readonly>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                              <label for="inputState">ชื่อคำนำหน้า :</label>
                              <input type="text" class="form-control" name="prefix_name" value="<?php echo $name;?>">
                              <?php
                                 if($checkstatus==1){ ?>
                                    <p style="color:red;">** กรุณากรอกข้อมูล</p>
                               <?php
                                }
                              ?>
                            </div>
                        </div>
                        <div class="form-row" style="margin-top: 25px;">
                          <div class="form-group col-md-12">
                            <center>
                              <a href="./perfix.php" class="adddata btn btn-info text-center">กลับ</a>
                              <a id="editdata" class="btn btn-success text-center" value="<?php echo $name;?>">บันทึกข้อมูล</a>
                            </center>
                          </div>
                        </div>
                        <input type="hidden" name="add">
                        </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
       <!-- Modal -->
       <div class="modal fade" id="modalsuccess" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">การแจ้งเตือน</h5>
                </div>
                <div class="modal-body">
                  <center>
                  <h4> แก้ไขข้อมูลคำนำหน้าชื่อ : <b><?php echo $_POST['prefix_name'];?></b> สำเร็จ</h4>
                  </center>
                </div>
                <div class="modal-footer">
                  <button id="successs" type="button" class="btn btn-success" data-dismiss="modal">ตกลง</button>
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
                  <h4> แก้ไขข้อมูลคำนำหน้าชื่อ : <b><?php echo $_POST['prefix_name'];?></b> ไม่สำเร็จ</h4>
                  </center>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-success" data-dismiss="modal">ตกลง</button>
                </div>
              </div>
            </div>
          </div>
          <div class="modal fade" id="modaledit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                  มีข้อมูล <b><?php echo $_POST["prefix_name"]; ?></b> อยู่แล้ว
                  </center>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-success" data-dismiss="modal">ตกลง</button>
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
    <!-- JavaScript files-->
    <script src="./vendor/jquery/jquery.min.js"></script>
    <script src="./vendor/popper.js/umd/popper.min.js"> </script>
    <script src="./vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="./vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="./vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="./js/jquery.dataTables.min.js"></script>
    <!-- Main File-->
    <script src="./js/front.js"></script>
    <script>
         $(document).on('click', '#successs', function(){   
    		window.location.href="./perfix.php"
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
  </body>
</html>