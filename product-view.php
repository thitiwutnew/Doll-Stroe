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
              <h2 class="no-margin-bottom">รายละเอียดข้อมูลสินค้า</h2>
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
                      <label for="inputEmail4"><h3>ข้อมูลสินค้า</h3></label>
                      <hr>
                      <?php
                                include('connect.php');
                                $sql = "SELECT * FROM product join units on product.unit_id=units.unit_id where product.product_id='".$_GET['id']."' ";
                                if($result = mysqli_query($con, $sql)){
                                    while($row = mysqli_fetch_array($result)){
                              ?>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                            รหัสสินค้า :&nbsp;<?php echo $row['product_id'];?>
                            </div>
                        </div>
                        <hr>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                            ชื่อสินค้า :&nbsp;<?php echo $row['product_name'];?>
                            </div>
                        </div>
                        <hr>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                            จำนวนสินค้า :&nbsp;<?php echo $row['product_amount'];?> <?php echo $row['unit_name'];?>
                            </div>
                        </div>
                        <hr>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                            ราคาทุน/หน่วย :&nbsp;<?php echo number_format ($row['product_costprice'],2);?>&nbsp;บาท
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            ราคาขาย/หน่วย :&nbsp;<?php echo number_format ($row['product_saleprice'],2);?>&nbsp;บาท
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            ราคาส่ง/หน่วย :&nbsp;<?php echo number_format ($row['product_wholesaleprice'],2);?>&nbsp;บาท
                            </div>
                        </div>
                        <hr>
                        </div>
                        <label for="inputEmail4" style="margin-left:15px;"><h3>รูปภาพประกอบสินค้า</h3></label>
                      <hr>
                        <div class="form-row" style="margin-top:35px;margin-left:25px;">
                            <?php
                                $img = $row['product_img1'];
                                if($img!=null){ ?>
                                      <div class="col-md-3">
                                        <img src="./imageproduct/<?php echo $img;?>" style="width: 90%;height:300px;">
                                      </div>
                               <?php }
                            ?>
                             <?php
                                $img = $row['product_img2'];
                                if($img!=null){ ?>
                                      <div class="col-md-3">
                                        <img src="./imageproduct/<?php echo $img;?>" style="width: 90%;height: 300px;">
                                      </div>
                               <?php }
                            ?>
                             <?php
                                $img = $row['product_img3'];
                                if($img!=null){ ?>
                                      <div class="col-md-3">
                                        <img src="./imageproduct/<?php echo $img;?>" style="width: 90%;height: 300px;">
                                      </div>
                               <?php }
                            ?>
                             <?php
                                $img = $row['product_img4'];
                                if($img!=null){ ?>
                                      <div class="col-md-3">
                                        <img src="./imageproduct/<?php echo $img;?>" style="width: 90%;height: 300px;">
                                      </div>
                               <?php }
                            ?>
                        </div>
                        <div class="form-row" style="margin-top: 25px;">
                          <div class="form-group col-md-12">
                            <center>
                              <a href="./product.php" class="adddata btn btn-info text-center">ย้อนกลับ</a>
                            </center>
                          </div>
                        </div>
                        <?php
                                    }}
                              ?>
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
      var countimg=2;
     $(".imgAdd").click(function(){
         if(countimg===2){
            $(this).closest(".row").find('.imgAdd').before('<div class="col-md-3 imgUp"><div class="imagePreview"></div><label class="btn btn-primary">เลือกรูปภาพ<input type="file" class="uploadFile img" name="img[1]" value="Upload Photo" style="width:0px;height:0px;overflow:hidden;"></label><i class="fa fa-times del"></i></div>');

         }
         if(countimg===3){
            $(this).closest(".row").find('.imgAdd').before('<div class="col-md-3 imgUp"><div class="imagePreview"></div><label class="btn btn-primary">เลือกรูปภาพ<input type="file" class="uploadFile img" name="img[2]" value="Upload Photo" style="width:0px;height:0px;overflow:hidden;"></label><i class="fa fa-times del"></i></div>');

         }
         if(countimg===4){
            $(this).closest(".row").find('.imgAdd').before('<div class="col-md-3 imgUp"><div class="imagePreview"></div><label class="btn btn-primary">เลือกรูปภาพ<input type="file" class="uploadFile img" name="img[3]" value="Upload Photo" style="width:0px;height:0px;overflow:hidden;"></label><i class="fa fa-times del"></i></div>');

         }
         if(countimg>=4){
            $(".imgAdd").hide();
         }
         countimg++;
        });
        $(document).on("click", "i.del" , function() {
            $(this).parent().remove();
            countimg--;
            if(countimg<5){
                $(".imgAdd").show();
            }
        });
        $(function() {
            $(document).on("change",".uploadFile", function()
            {
                    var uploadFile = $(this);
                var files = !!this.files ? this.files : [];
                if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

                if (/^image/.test( files[0].type)){ // only image file
                    var reader = new FileReader(); // instance of the FileReader
                    reader.readAsDataURL(files[0]); // read the local file

                    reader.onloadend = function(){ // set image data as background of div
                        //alert(uploadFile.closest(".upimage").find('.imagePreview').length);
        uploadFile.closest(".imgUp").find('.imagePreview').css("background-image", "url("+this.result+")");
                    }
                }

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