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
  </head>
  <body>
    <div class="page">
      <!-- Main Navbar-->
		<?php include ('./menubar.php');?>
        <div class="content-inner">
          <!-- Page Header-->
          <header class="page-header">
            <div class="container-fluid">
              <h2 class="no-margin-bottom">รายละเอียดข้อมูลพนักงาน</h2>
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
                      <label for="inputEmail4" style="background-color: #bbd8ff; padding: 10px;width: 150px;padding-top: 15px;"><h3>ข้อมูลพนักงาน</h3></label>
                      <hr>
                      <?php 
                        include('connect.php');
                        $sqldataqurry = "SELECT * FROM employee where emp_id='".$_GET['id']."'";
                        if($resultdataqurry = mysqli_query($con, $sqldataqurry)){
                            $count = mysqli_num_rows($resultdataqurry);
                            while($row = mysqli_fetch_array($resultdataqurry)){ ?>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                            รหัสพนักงาน :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['emp_id'];?>
                            <hr>
                            </div>
                            <div class="form-group col-md-12">
                            เลขบัตรประชาชน :&nbsp;&nbsp;<?php echo $row['emp_idcard'];?>
                            </div>
                        </div>
                        <hr>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                            <?php 
                                      include('connect.php');
                                      $sql = "SELECT * FROM position where position_id='".$row['position_id']."'";
                                      if($result = mysqli_query($con, $sql)){
                                          while($rows = mysqli_fetch_array($result)){
                                          ?>
                                           ตำแหน่งงาน :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $rows['position_name'];?>
                                         <?php }}?>
                            </div>
                        </div>
                        <hr>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                      <?php 
                                      include('connect.php');
                                      $sql = "SELECT * FROM prefix where prefix_id='".$row['prefix_id']."'";
                                      if($result = mysqli_query($con, $sql)){
                                          while($rows = mysqli_fetch_array($result)){
                                          ?>
                                           ชื่อ - นามสกุล :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $rows['prefix_name'];?> <?php echo $row['emp_name'];?> <?php echo $row['emp_sur'];?>
                                         <?php }}?>
                            </div>
                        </div>
                        <hr>
                        <div class="form-row">
                          <div class="form-group col-md-12">
                          ที่อยู่ :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <?php echo $row['no'];?> 
                          ตำบล&nbsp;<?php 
                                        $sql = "SELECT * FROM district where DISTRICT_ID='".$row['tambon']."'";
                                        if($result = mysqli_query($con, $sql)){
                                            while($rowss = mysqli_fetch_array($result)){
                                            ?>
                                             <?php echo $rowss['DISTRICT_NAME'];?>
                                        <?php }}?> 
                          อำเภอ&nbsp;<?php 
                                        $sql = "SELECT * FROM amphur where AMPHUR_ID='".$row['amphoe']."'";
                                        if($result = mysqli_query($con, $sql)){
                                            while($rowss = mysqli_fetch_array($result)){
                                            ?>
                                             <?php echo $rowss['AMPHUR_NAME'];?>
                                        <?php }}?> 
                          จังหวัด&nbsp;<?php 
                                        $sql = "SELECT * FROM province where PROVINCE_ID='".$row['province']."'";
                                        if($result = mysqli_query($con, $sql)){
                                            while($rowss = mysqli_fetch_array($result)){
                                            ?>
                                            <?php echo $rowss['PROVINCE_NAME'];?>
                                        <?php }}?>
                         &nbsp;<?php echo $row['postalcode'];?>
                          
                          </div>
                        </div>
                        <hr>
                        <div class="form-row">
                          <div class="form-group col-md-12">
                            เบอร์โทรศัพท์&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['emp_tel'];?>
                          </div>
                        </div>
                        <hr>
                        <label for="inputEmail4" style="background-color: #bbd8ff; padding: 10px;width: 210px;padding-top: 15px;"><h3>ข้อมูลเข้าใช้งานระบบ</h3></label>
                      <hr>
                      <div class="form-row">
                          <div class="form-group col-md-12">
                            ผู้ใช้งาน :&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['username'];?>
                          </div>
                        </div>
                        <hr>
                        <div class="form-row">
                          <div class="form-group col-md-12">
                           สถานะเข้าใช้งาน :&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['emp_type'];?>
                          </div>
                        </div>
                        <hr>
                        <div class="form-row" style="margin-top: 25px;">
                          <div class="form-group col-md-12">
                            <center>
                              <a href="employee.php" class="adddata btn btn-info text-center">กลับไปดูข้อมูลทั้งหมด</a>
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
      var countimg=0;
     $(".imgAdd").click(function(){
         if(countimg<=2){
            $(this).closest(".row").find('.imgAdd').before('<div class="col-md-3 imgUp"><div class="imagePreview"></div><label class="btn btn-primary">เลือกรูปภาพ<input type="file" class="uploadFile img" name="img[]" value="Upload Photo" style="width:0px;height:0px;overflow:hidden;"></label><i class="fa fa-times del"></i></div>');
            countimg++;
         }
         if(countimg>=3){
            $(".imgAdd").hide();
         }
        });
        $(document).on("click", "i.del" , function() {
            $(this).parent().remove();
            countimg--;
            if(countimg<3){
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