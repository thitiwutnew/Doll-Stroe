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
    <script type="text/javascript" src="./js/qurryaddress.js" ></script>
  </head>
  <body onload="Add()<?php if($_POST["Subdistrict"]==null){}else{echo ",EditeSubdistrict(".$_POST["Subdistrict"].")";}?><?php if($_POST["District"]==null){}else{echo ",EditeDistrict(".$_POST["District"].")";}?><?php if($_POST["Proviance"]==null){}else{echo ",EditeProviance(".$_POST["Proviance"].")";}?><?php if($_POST["Proviance"]==null){}else{echo ",Editecode(".$_POST["Postcode"].")";}?>">
    <?php
     include('connect.php');
     $sqldataqurry = "SELECT * FROM employee";
     if($resultdataqurry = mysqli_query($con, $sqldataqurry)){
         $count = mysqli_num_rows($resultdataqurry);
         while($row = mysqli_fetch_array($resultdataqurry)){
             if(substr($row['emp_id'],2)==$count){
               $count++;
             }
         }
         if($count==0){$count++;}
         $id = "EP".$count;
     }
      if(isset($_POST["add"])){
        $checkstatus=0;
        if($_POST["em_id"]!=null){
          $sqlposition = "SELECT * FROM employee where emp_idcard='".$_POST['emp_idcard']."'";
          if($resultposition = mysqli_query($con, $sqlposition)){
              $count = mysqli_num_rows ( $resultposition );
              if($count>0){
                $emp_idcard =  $_POST["emp_idcard"];
                $_POST["emp_idcard"]=null;
                echo '<script>
                        $(document).ready(function(){
                          $("#modaledit").modal("show");
                        });
                      </script>';
              }
              else{
                    $sql = "INSERT INTO employee (emp_id,emp_idcard,prefix_id,emp_name,emp_sur,position_id,no,tambon,amphoe,province,postalcode,emp_tel,username,password,emp_type)
                    VALUES ('".$_POST["em_id"]."','".$_POST["emp_idcard"]."','".$_POST["prefix_id"]."','".$_POST["emp_name"]."','".$_POST["emp_sur"]."','".$_POST["position_id"]."',
                    '".$_POST["no"]."','".$_POST["Subdistrict"]."','".$_POST["District"]."','".$_POST["Proviance"]."',
                    '".$_POST["Postcode"]."','".$_POST["emp_tel"]."','".$_POST["username"]."','".md5($_POST["emp_idcard"])."','".$_POST["statususer"]."')";

                    if ($con->query($sql) === TRUE) {
                        $checkstatus=2;
                      echo '<script>window.location.href="./employee.php"</script>';
                    }
                     else {
                      echo '<script>
                      $(document).ready(function(){
                        $("#modalerror").modal("show");
                      });modalerrorid
                    </script>';
                    }
                  }
                }


        }

        else{
          $checkstatus=1;
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
              <h2 class="no-margin-bottom">เพิ่มข้อมูลพนักงาน</h2>
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
                      <label for="inputEmail4"><h3>ข้อมูลส่วนตัว</h3></label>
                      <hr>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                            <label for="inputEmail4">รหัสพนักงาน <b style="color:red;font-size:15px;"></b></label>
                            <input type="text" class="form-control" name="em_id" value="<?php echo $id;?>" readonly>
                            </div>
                            <div class="form-group col-md-8">
                            <label for="inputEmail4">เลขบัตรประชาชน : <b style="color:red;font-size:15px;">*</b></label>
                            <input id="checkidcard" type="number" class="form-control" value="<?php echo $_POST["emp_idcard"];?>" maxlenght="13" name="emp_idcard" >
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-2">
                              <label for="inputState">คำนำหน้าชื่อ <b style="color:red;font-size:15px;">*</b></label>
                              <select name="prefix_id"  class="form-control">
                                      <?php
                                      include('connect.php');
                                      $sql = "SELECT * FROM prefix";
                                      if($result = mysqli_query($con, $sql)){
                                          while($row = mysqli_fetch_array($result)){
                                          ?>
                                          <option value="<?php echo $row['prefix_id']?>" <?php if( $_POST["prefix_id"]==$row['prefix_id'] ){ echo "selected";}?>><?php echo $row['prefix_name']?></option>
                                      <?php }}?>
                              </select>
                            </div>
                            <div class="form-group col-md-3 ">
                              <label for="inputCity">ชื่อพนักงาน <b style="color:red;font-size:15px;">*</b></label>
                              <input type="text" class="form-control" name="emp_name" placeholder="กรอกข้อมูล" value="<?php echo $_POST["emp_name"];?>" required>
                            </div>
                            <div class="form-group col-md-3">
                              <label for="inputCity">นามสกุล <b style="color:red;font-size:15px;">*</b></label>
                              <input type="text" class="form-control" name="emp_sur" placeholder="กรอกข้อมูล" value="<?php echo $_POST["emp_sur"];?>" required>
                            </div>
                            <div class="form-group col-md-4">
                              <label for="inputZip">ตำแหน่ง <b style="color:red;font-size:15px;">*</b></label>
                                <select name="position_id"  class="form-control">
                                        <?php
                                        include('connect.php');
                                        $sql = "SELECT * FROM position";
                                        if($result = mysqli_query($con, $sql)){
                                            while($row = mysqli_fetch_array($result)){
                                            ?>
                                            <option value="<?php echo $row['position_id']?>" <?php if( $_POST["position_id"]==$row['position_id'] ){ echo "selected";}?>><?php echo $row['position_name']?></option>
                                        <?php }}?>
                                </select>
                            </div>
                            <div class="form-group col-md-1"></div>
                            </div>
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="inputCity">ที่อยู่ <b style="color:red;font-size:15px;">*</b></label>
                            <input type="text" class="form-control" name="no" value="<?php echo $_POST["no"];?>" placeholder="กรอกข้อมูล" required>
                          </div>
                          <div class="form-group col-md-6">
                            <label for="inputCity">เบอร์โทรศัพท์ติดต่อ <b style="color:red;font-size:15px;">*</b></label>
                            <input type="number" class="form-control"  name="emp_tel" placeholder="กรอกข้อมูล" value="<?php echo $_POST["emp_tel"];?>" required>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="Proviance">จังหวัด <b style="color:red;font-size:15px;">*</b></label>
                            <select name="Proviance" id="Proviance" class="form-control" value="<?php echo $_POST["Proviance"];?>" required > </select>
                          </div>
                          <div class="form-group col-md-6">
                            <label for="District">อำเภอ <b style="color:red;font-size:15px;">*</b></label>
                            <select name="District" id="District" class="form-control" required></select>
                          </div>
                          <div class="form-group col-md-6">
                            <label for="Subdistrict">ตำบล <b style="color:red;font-size:15px;">*</b></label>
                            <select name="Subdistrict" id="Subdistrict" class="form-control" required></select>
                          </div>
                          <div class="form-group col-md-6">
                              <label for="Postcode">รหัสไปรษณีย์ <b style="color:red;font-size:15px;">*</b></label>
                              <select name="Postcode" id="Postcode"  class="form-control" required>
                              </select>
                              </div>
                        </div>
                        <hr>
                        <label for="inputEmail4"><h3>ข้อมูลเข้าใช้งานระบบ</h3></label>
                      <hr>
                      <div class="form-row">
                          <div class="form-group col-md-4">
                            <label for="Proviance">ผู้ใช้งาน <b style="color:red;font-size:15px;">*</b></label>
                            <input type="text" class="form-control" name="username" placeholder="ผู้ใช้งาน" value="<?php echo $_POST["username"];?>" required>
                          </div>
                          <div class="form-group col-md-4">
                            <label for="Subdistrict">สถานะเข้าใช้งาน <b style="color:red;font-size:15px;">*</b></label>
                            <select name="statususer" class="form-control">
                              <option value="Admin" <?php if( $_POST["statususer"]=="Admin"){ echo "selected";}?>>ผู้ดูแลระบบ</option>
                              <option value="Staff" <?php if( $_POST["statususer"]=="Staff"){ echo "selected";}?>>เจ้าหน้าที่</option>
                              <option value="Customer" <?php if( $_POST["statususer"]=="Customer"){ echo "selected";}?>>ลูกค้า</option>
                            </select>
                          </div>

                        </div>
                        <div class="form-row" style="margin-top: 25px;">
                          <div class="form-group col-md-12">
                            <center>
                              <a href="employee.php" class="adddata btn btn-info text-center">กลับ</a>
                              <button type="submit" name="add" class="btn btn-success text-center">บันทึกข้อมูล</button>
                            </center>
                          </div>
                        </div>
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
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <center>
                  <h4> เพิ่มข้อมูลพนักงาน: <b><?php echo $_POST['emp_name']." ".$_POST['emp_sur'];?></b> สำเร็จ</h4>
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
                  <h4> เพิ่มข้อมูลพนักงาน : <b><?php echo $_POST['emp_name']." ".$_POST['emp_sur'];?></b> ไม่สำเร็จ</h4>
                  </center>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-success" data-dismiss="modal">ตกลง</button>
                </div>
              </div>
            </div>
          </div>
          <div class="modal fade" id="modalerrorid" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                  <h4> เลขบัตรประชาชนไม่ถูกต้อง</h4>
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
                  มีข้อมูลเลขบัตรประชาชน <b><?php echo $emp_idcard ; ?></b> นี้อยู่แล้ว
                  </center>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-success" data-dismiss="modal">ตกลง</button>
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
  $("#checkidcard").change(function(){
     var id = $(this).val();
     let sum;
     if(id.length==13){
      for(i=0, sum=0; i < 12; i++){
        sum += parseFloat(id.charAt(i))*(13-i);
      }
      if((11-sum%11)%10==(id.charAt(12))){

      }
      else{
        $(document).ready(function(){
          $("#modalerrorid").modal("show");
        });
      }
     }
     else{
      $(document).ready(function(){
          $("#modalerrorid").modal("show");
        });
     }
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
