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
  <?PHP
function convert($number){
$txtnum1 = array('ศูนย์','หนึ่ง','สอง','สาม','สี่','ห้า','หก','เจ็ด','แปด','เก้า','สิบ');
$txtnum2 = array('','สิบ','ร้อย','พัน','หมื่น','แสน','ล้าน','สิบ','ร้อย','พัน','หมื่น','แสน','ล้าน');
$number = str_replace(",","",$number);
$number = str_replace(" ","",$number);
$number = str_replace("บาท","",$number);
$number = explode(".",$number);
if(sizeof($number)>2){
return 'ทศนิยมหลายตัวนะจ๊ะ';
exit;
}
$strlen = strlen($number[0]);
$convert = '';
for($i=0;$i<$strlen;$i++){
  $n = substr($number[0], $i,1);
  if($n!=0){
    if($i==($strlen-1) AND $n==1){ $convert .= 'เอ็ด'; }
    elseif($i==($strlen-2) AND $n==2){  $convert .= 'ยี่'; }
    elseif($i==($strlen-2) AND $n==1){ $convert .= ''; }
    else{ $convert .= $txtnum1[$n]; }
    $convert .= $txtnum2[$strlen-$i-1];
  }
}

$convert .= 'บาท';
if($number[1]=='0' OR $number[1]=='00' OR
$number[1]==''){
$convert .= 'ถ้วน';
}else{
$strlen = strlen($number[1]);
for($i=0;$i<$strlen;$i++){
$n = substr($number[1], $i,1);
  if($n!=0){
  if($i==($strlen-1) AND $n==1){$convert
  .= 'เอ็ด';}
  elseif($i==($strlen-2) AND
  $n==2){$convert .= 'ยี่';}
  elseif($i==($strlen-2) AND
  $n==1){$convert .= '';}
  else{ $convert .= $txtnum1[$n];}
  $convert .= $txtnum2[$strlen-$i-1];
  }
}
$convert .= 'สตางค์';
}
return $convert;
}
?>
  <body>
    <div class="page">
      <!-- Main Navbar-->
		<?php include ('./menubar.php');?>
        <div class="content-inner">
          <!-- Page Header-->
          <header class="page-header">
            <div class="container-fluid">
              <h2 class="no-margin-bottom">จัดการข้อมูลสินค้าเซต</h2>
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
                    <button class="btn btn-success"><a href="./product-set-add.php" class="adddata">เพิ่มข้อมูล</a></button>
                    </div>
                    <div class="card-body">
                    <table id="perfixTables" class="table table-striped table-bordered">
                          <thead>
                            <tr>
                              <th class="text-center" style='width:15%;'>รหัสสินค้าเซต</th>
                              <th class="text-center">ชื่อสินค้าเซต</th>
                              <th class="text-center">ราคา (บาท)/เซต</th>
                              <th class="text-center">จัดการข้อมูล</th>
                            </tr>
                          </thead>
                          <tbody>
                              <?php
                                include('connect.php');
                                      $key =[];
                                      $sql = "SELECT * FROM  setproduct";
                                      if($result = mysqli_query($con, $sql)){
                                          while($row = mysqli_fetch_array($result)){
                                            array_push($key,$row['set_id']);
                                          }}
                                          for($i=count($key);$i>=0;$i--){
                                          $sql = "SELECT * FROM  setproduct where set_id='".$key[$i]."'";
                                          if($result = mysqli_query($con, $sql)){
                                            while($row = mysqli_fetch_array($result)){
                              ?>
                                    <tr>
                                    <td class="text-center "><?php echo $row['set_id']?></td>
                                    <td class="text-center"><?php echo $row['set_name']?></td>
                                    <td  class="text-right"><?php echo number_format ($row['set_price'],2)?></td>
                                    <td class="text-center">
                                        <a class="btn" href="./product-set-view.php?id=<?php echo $row['set_id']?>"> <i class='fa fa-eye' style='font-size:25px;color:blue'></i></a>
                                       <a class="btn" href="./product-set-edit.php?id=<?php echo $row['set_id']?>">  <i class='fa fa-edit' style='font-size:25px;color:orange'></i></a>
                                       <button class="btn" id="deletedata" value="<?php echo $row['set_id']?>">  <i class='fa fa-trash-o' style='font-size:25px;color:red'></i></button>
                                    </td>
                                    </tr>
                                        <?php } }}?>
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
                  <b><h4> คุณแน่ใจที่จะลบข้อมูล  : <b id="checkdata"></b></h4></b>
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
        </div>
      </div>
    </div>
        </div>
      </div>
    </div>
    <script>
      $(document).on('click', '#deletedata', function(){
        var at_id = $(this).val();
        document.getElementById("checkdata").innerHTML = at_id;
        $('#deletedataperfix').modal('show');
        $(document).on('click', '#submit', function(event){
           event.preventDefault();
           $.ajax({
                url:"./product-set-delete.php",
                method:"POST",
                data:{set_id:at_id},
                dataType:"json",
                success:function(data){
                  console.log(data);
                    if(data!=0){
                      at_id='';
                      window.location.href="./product-set.php";
                    }
                    else{
                      at_id='';
                      $('#deletedataperfix').modal('hide');
                    }
                }
           });
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
  <script>
    $(document).ready(function() {
        $('#perfixTables').DataTable({
          "ordering": false,
            responsive: true
        });
    });
    </script>
</html>
