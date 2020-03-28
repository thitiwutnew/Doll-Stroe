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
    <script src="./js/jquery-3.1.1.min.js"></script>
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
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
  ?>
    <div class="page">
      <!-- Main Navbar-->
		<?php include ('./menubar.php');?>
        <div class="content-inner">
          <!-- Page Header-->
          <header class="page-header">
            <div class="container-fluid">
              <h2 class="no-margin-bottom">จัดการข้อมูลโปรโมชั่น</h2>
            </div>
          </header>
          <!-- Dashboard Counts Section-->
          <section class="dashboard-counts no-padding-bottom">
            <div class="container-fluid">
            <div class="row">
                <!-- Line Charts-->
                <div class="col-lg-12">
                  <div class="line-chart-example card">
                    <div class="card-header d-flex align-items-center">
                    <a href="./promotion-add.php" class="adddata btn btn-success">เพิ่มข้อมูล</a>
                    </div>
                    <div class="card-body">
                    <table id="perfixTables" class="table table-striped table-bordered">
                          <thead>
                            <tr>
                              <th class="text-center" style='width:10%;'>รหัสโปรโมชั่น</th>
                              <th class="text-center">ชื่อโปรโมชั่น</th>
                              <th class="text-center">วันที่เริ่ม</th>
                              <th class="text-center">วันที่สิ้นุด</th>
                              <th class="text-center">จัดการข้อมูล</th>
                            </tr>
                          </thead>
                          <tbody>
                              <?php
                                include('connect.php');
                                $sql = "SELECT * FROM promotion";
                                if($result = mysqli_query($con, $sql)){
                                    while($row = mysqli_fetch_array($result)){
                              ?>
                                    <tr>
                                    <td class="text-center "><?php echo $row['pro_id']?></td>
                                    <td class="text-center ">
                                        <?php echo $row['pro_name'];?>
                                    </td>
                                    <td class="text-center ">
                                      <?php echo DateThai($row['pro_startdate'])?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo DateThai($row['pro_enddate'])?>
                                    </td>
                                    <td class="text-center">
                                        <a class="btn" href="./promotion-view.php?pro_id=<?php echo $row['pro_id']?>" ><i class='fa fa-eye' style='font-size:25px;color:blue'></i></a>
                                        <a class="btn" href="./promotion-edit.php?pro_id=<?php echo $row['pro_id']?>"> <i class='fa fa-edit' style='font-size:25px;color:orange'></i></a>
                                       <button id="deletedata" class="btn" value="<?php echo $row['pro_id']?>,<?php echo $row['pro_id']." ".$row['pro_name']?>" ><i class='fa fa-trash-o' style='font-size:25px;color:red'></i></button>
                                    </td>
                                    </tr>
                                        <?php } }?>
                          </tbody>
                        </table>
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
                  <b><h4> คุณแน่ใจที่จะลบข้อมูลโปรโมชั่น  : <b id="checkdata"></b></h4></b>
                  </center>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                  <button id="submit" type="button" class="btn btn-danger">ลบข้อมูล</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      <!-- Modal -->
      <!--<div class="modal fade" id="modalerror" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                  <h4> ไม่สามารถลบข้อมูล : <b id="errorname"></b> ข้อมูลนี้ถูกใช้อยู่ !!</h4>
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
    </div>-->
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
                  <h4> คุณแน่ใจที่จะแก้ไขข้อมูลลูกค้า  : <b id="checkedata"></b></h4>
                  </center>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                  <button id="submit" type="button" class="btn btn-danger">แก้ไขข้อมูล</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script>
      $(document).on('click', '#deletedata', function(){
        var at_id = $(this).val();
        var sunstring = at_id.search(",");
        id= at_id.substring(0,sunstring)
        sunstring = sunstring+1;
        let names = at_id.substring(sunstring)
        document.getElementById("checkdata").innerHTML = names;
        $('#deletedataperfix').modal('show');
        $(document).on('click', '#submit', function(event){
           event.preventDefault();
           $.ajax({
                url:"./promotion-delete.php",
                method:"POST",
                data:{pro_id:id},
                dataType:"json",
                success:function(data){
                  console.log(data);
                    if(data==1){
                      at_id='';
                      window.location.href="./promotion.php";
                    }
                    else if(data==2){
                      document.getElementById("errorname").innerHTML = names;
                      $('#deletedataperfix').modal('hide');
                      $('#modalerror').modal('show');
                      at_id='';
                      names='';
                      id='';
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

       var at_id = $(this).val();
       var sunstring = at_id.search(",");
       id= at_id.substring(0,sunstring)
       sunstring = sunstring+1;
       let names = at_id.substring(sunstring)
       document.getElementById("checkedata").innerHTML = names;
       $('#modaledit').modal('show');
       $(document).on('click', '#submit', function(event){
          window.location.href="./agent-edit.php?id="+id;
      });
     });
    </script>
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
  <!--<script>
    $(document).ready(function() {
        $('#perfixTables').DataTable({
            responsive: true
        });
    });
  </script>-->
</html>
