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
    width:100px;
    height:30px;
    border-radius:5px;
    background-color:#dc3545;
    color:#fff;
    box-shadow:0px 0px 2px 1px rgba(0,0,0,0.2);
    text-align:center;
    line-height:30px;
    cursor:pointer;
    font-size:15px;
    margin-left:15px;
    }
    </style>
    <script type="text/javascript" src="./js/jquery-3.1.1.min.js" ></script>
    <script type="text/javascript" src="./js/qurryaddress.js" ></script>
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
              <h2 class="no-margin-bottom">รายละเอียดข้อมูลสินค้าเซต</h2>
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
                      <form action="" method="post" enctype="multipart/form-data">
                      <b><h3 class="text-center">ข้อมูลสินค้าเซต</h3></b>
                      <?php
                                include('connect.php');
                                $sql = "SELECT * FROM setproduct where set_id='".$_GET['id']."' ";
                                if($result = mysqli_query($con, $sql)){
                                    while($row = mysqli_fetch_array($result)){
                              ?>
                              <br>
                        <div class="form-row border" style="padding-top: 22px;padding-left: 6%; background-color: #bdbdbd;color: #000;">
                            <div class="form-group col-md-4">
                            รหัสสินค้าเซต : &nbsp;&nbsp;&nbsp;<?php echo $row['set_id'];?>
                            </div>
                            <div class="form-group col-md-4">
                            ชื่อสินค้าเซต : &nbsp;&nbsp;&nbsp;<?php echo $row['set_name'];?>
                            </div>
                            <div class="form-group col-md-4">
                            <label for="inputEmail4">ราคา/เซต : &nbsp;&nbsp;</label>
                              <?php echo number_format ($row['set_price'],2);?>&nbsp;&nbsp;บาท
                            </div>
                        </div>
                        <label for="inputEmail4" style="margin-top:15px;"><h3>ข้อมูลสินค้า</h3></label>
                        <hr>
                        <div class="row" style="margin-block-end: -30px;">
                          <div class="col-md-6"><label for="inputState">ชื่อสินค้า </label></div>  
                          <div class="col-md-6"> <label for="inputZip">ราคา (บาท)</label></div>           
                        </div>
                        <?php
                                include('connect.php');
                                $sqlpd = "SELECT * FROM setproduct_descirption where set_id='".$row['set_id']."' ";
                                if($resultpd = mysqli_query($con, $sqlpd)){
                                    while($rowpd = mysqli_fetch_array($resultpd)){
                              ?>
                        <div class="form-row" style="margin-top: -5px;">
                            <div class="form-group col-md-6">
                                      <?php
                                      include('connect.php');
                                      $sqldt = "SELECT * FROM product where product_id='".$rowpd['product_id']."' ";
                                      if($resultdt = mysqli_query($con, $sqldt)){
                                          while($rowdt = mysqli_fetch_array($resultdt)){
                                          ?>
                                           <input type="text" class="form-control" value="<?php echo $rowdt['product_name'];?>" readonly>
                                      <?php $price=$rowdt['product_saleprice']; }}?>
                            </div>
                            <div class="form-group col-md-6">

                              <input type="text" class="form-control" name="detail_price[]" value="<?php echo number_format ($price,2);?>" readonly>
                            </div>
                        </div>
                                          <? }}?>
                        <div class="form-row" style="margin-top: 25px;">
                          <div class="form-group col-md-12">
                            <center>
                              <a href="./product-set.php" class="adddata btn btn-info text-center">ย้อนกลับ</a>
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
    $(document).ready(function() {
        $('#perfixTables').DataTable({
            responsive: true
        });
    });
    </script>
</html>
