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
  <body>
  <?PHP
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
    <div class="page">
      <!-- Main Navbar-->
		<?php include ('./menubar.php');?>
        <div class="content-inner">
          <!-- Page Header-->
          <header class="page-header">
            <div class="container-fluid">
              <h2 class="no-margin-bottom">รายละเอียดข้อมูลการรับสินค้า</h2>
            </div>
          </header>
          <!-- Dashboard Counts Section-->
          <section class="dashboard-counts no-padding-bottom">
            <div class="container-fluid">
            <div class="row">
                <!-- Line Charts-->
                <div class="col-lg-12" >
                  <div class="line-chart-example card">
                    <div class="card-body">
                      <form action="" method="post" enctype="multipart/form-data" id="printableArea">
                      <b><h3 class="text-center">ข้อมูลการรับสินค้า</h3></b>
                      <div class="form-row">
                        <div class="form-group col-md-12">
                         <center> <img src="./img/logo.png" alt="" style="width: 15%;"></center><br>
                          <b>ตุ๊กตาจากโรงงาน</b>
                        </div>
                        <div class="form-group col-md-12" style="margin-top: -10px;">
                        ตั้งอยู่ที่ โยธาธิการ ตำบล บ้านพริก อำเภอ บ้านนา จังหวัด นครนายก 26110.
                        </div>
                        <div class="form-group col-md-12" style="margin-top: -10px;">
                        เบอร์โทรศัพท์หลัก : 084-6984-558. หรือ 097-1353-029.
                        </div>
                      </div>
                      <?php
                                include('connect.php');
                                $sql = "SELECT * FROM receive
                                JOIN employee ON  receive.emp_id = employee.emp_id
                                 where receive.receive_id='".$_GET['id']."' ";
                                if($result = mysqli_query($con, $sql)){
                                    while($row = mysqli_fetch_array($result)){
                              ?>
                        <div class="form-row border" style="padding-top: 10px;padding-left: 2%;border: 4px solid #000000!important;">
                            <div class="form-group col-md-7">
                            เลขที่ใบการรับสินค้า :  <?php echo $row['receive_id'];?>
                            </div>
                            <div class="form-group col-md-5">
                                  เลขที่ใบสั่งซื้อสินค้า :  <?php echo $row['order_id'];?>
                            </div>
                            <div class="form-group col-md-7" style="margin-top: -10px;">
                                  ชื่อพนักงาน : <?php echo $row['emp_name']." ".$row['emp_sur'];?>
                            </div>
                            <div class="form-group col-md-5" style="margin-top: -10px;">
                                  วันที่รับสินค้า : <?php echo DateThai($row['received_date']);?>
                            </div>
                          
                        </div>
                        <?php }} ?>
                        <br>
                        <div class="form-row" style="margin-top: -20px; padding-top: 10px;padding-left: 2%;border: 4px solid #000000!important;">
                        <table class="table table-bordered">
                            <thead>
                            <th style="width: 5%;">ลำดับ</th>
                            <th style="width: 10%;">รหัสสินค้า</th>
                            <th  style="width:60%;">รายการสินค้า</th>
                            <th>จำนวนการรับสินค้า</th>
                            </thead>
                            <tbody>
                            <?php
                                include('connect.php');
                                $sqlpd = "SELECT * FROM details_receive
                                JOIN product ON  details_receive.product_id = product.product_id
                                 where details_receive.receive_id='".$_GET['id']."' AND details_receive.detail_receive_amount!=0";
                                if($resultpd = mysqli_query($con, $sqlpd)){
                                    while($rowpd = mysqli_fetch_array($resultpd)){
                                      $nocountpd +=1;
                              ?>
                                <tr>
                                  <th><?php echo $nocountpd;?></th>
                                  <th> <?php echo $rowpd['product_id'];?></th>
                                  <th>  <?php
                                      include('connect.php');
                                      $product_id=$rowpd['product_id'];
                                      $sqldt = "SELECT * FROM product where product_id='".$product_id."' ";
                                      if($resultdt = mysqli_query($con, $sqldt)){
                                          while($rowdt = mysqli_fetch_array($resultdt)){
                                          ?>
                                          <?php echo $rowdt['product_name']; $unit= $rowdt['unit_id'];?>
                                      <?php }}?></th>
                                  
                                     
                                      <?php
                                      $qq = "SELECT *, SUM(details_receive.detail_receive_amount) as Amount,SUM(details_receive.detail_receive_amount) as Amounts FROM order_detail 
                                      JOIN receive on order_detail.order_id = receive.order_id 
                                      join details_receive ON ( receive.receive_id = details_receive.receive_id AND order_detail.product_id = details_receive.product_id) 
                                      JOIN product ON details_receive.product_id=product.product_id 
                                      WHERE order_detail.order_id='".$_GET['ido']."' AND order_detail.product_id='".$product_id."'  GROUP BY product.product_id HAVING SUM(details_receive.detail_receive_amount) !=-1";
                                      if($resultdt = mysqli_query($con, $qq)){
                                          while($rowdt = mysqli_fetch_array($resultdt)){

                                           

                                          ?>
                                           <th  class="text-right"><?php echo $rowpd['detail_receive_amount'];?></th>
                                        
                                         
                                          
                                      <?php }}?>
                                 </tr>
                              <? }}?>
                            </tbody>
                        </table>
                        </div>
                        </form>
                        <div class="form-row" style="margin-top: 25px;">
                          <div class="form-group col-md-12">
                            <center>
                            <button id="cmd" class="btn btn-success"onclick="printDiv('printableArea')">ปริ้นใบเสร็จการรับสินค้า</button>
                              <a href="product-receipt.php" class="adddata btn btn-info text-center">ย้อนกลับ</a>
                            </center>
                          </div>
                        </div>
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
    function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
    $(document).ready(function() {
        $('#perfixTables').DataTable({
            responsive: true
        });
    });
    </script>
</html>
