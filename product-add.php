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
  <body onload="Add();">
    <?php
     include('connect.php');
     $sqldataqurry = "SELECT * FROM product";
     if($resultdataqurry = mysqli_query($con, $sqldataqurry)){
         $count = mysqli_num_rows($resultdataqurry);
         while($row = mysqli_fetch_array($resultdataqurry)){
             if(substr($row['product_id'],2)==$count){
               $count++;
             }
         }
         if($count==0){$count++;}
         $id = "PD".$count;
     }
      if(isset($_POST["add"])){
        $checkstatus=0;
        if($_POST["product_name"]==null){
                      $product_name=1;
        }
        if($_POST["product_amount"]==null){
             $product_amount=1;
        }
        if($_POST["unit_id"]==null){
             $unit_id=1;
        }
        if($_POST["product_costprice"]==null){
            $product_costprice=1;
        }
        if($_POST["product_saleprice"]==null){
               $product_saleprice=1;
        }
        if($_POST["product_wholesaleprice"]==null){
              $product_wholesaleprice=1;
        }
        if($_FILES["img"]["name"][0]==null){
            $img=1;
      }
        if(($_POST["product_name"]!=null && $_POST["product_amount"]!=null) && ($_POST["unit_id"]!=null  && $_FILES["img"]["name"][0]!=null)){

                    $sqlposition = "SELECT * FROM product where product_name='".$_POST['product_name']."'";
                    if($resultposition = mysqli_query($con, $sqlposition)){
                        $count = mysqli_num_rows ( $resultposition );
                        if($count>0){
                          $product_namessssss=$_POST['product_name'];
                          $_POST['product_name']=null;
                          echo '<script>
                                  $(document).ready(function(){
                                    $("#modaledit").modal("show");
                                  });
                                </script>';
                        }
                        else{
                            $sql = "INSERT INTO product (product_id,product_name,product_amount,unit_id,product_costprice,product_saleprice,product_wholesaleprice,product_img1,product_img2,product_img3,product_img4)
                            VALUES ('".$_POST["product_id"]."','".$_POST["product_name"]."','".$_POST["product_amount"]."','".$_POST["unit_id"]."',
                            '".$_POST["product_costprice"]."','".$_POST["product_saleprice"]."','".$_POST["product_wholesaleprice"]."','".$_FILES["img"]["name"][0]."',
                            '".$_FILES["img"]["name"][1]."','".$_FILES["img"]["name"][2]."','".$_FILES["img"]["name"][3]."')";

                            if ($con->query($sql) === TRUE) {
                                for($i=0;$i<count($_FILES["img"]["name"]);$i++)
                                {
                                    if($_FILES["img"]["name"][$i] != "")
                                    {
                                        if(move_uploaded_file($_FILES["img"]["tmp_name"][$i],"./imageproduct/".$_FILES["img"]["name"][$i]))
                                        {

                                        }
                                    }
                                }
                                echo '<script>window.location.href="./product.php"</script>';
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
              <h2 class="no-margin-bottom">เพิ่มข้อมูลสินค้า</h2>
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
                        <div class="form-row" style="margin-top:35px;">
                            <div class="form-group col-md-3">
                            <label for="inputEmail4">รหัสสินค้า <b style="color:red;font-size:15px;">*</b></label>
                            <input type="text" class="form-control" name="product_id" value="<?php echo $id;?>" readonly>
                            </div>
                            <div class="form-group col-md-5">
                              <label for="inputState">ชื่อสินค้า <b style="color:red;font-size:15px;">*</b></label>
                              <input type="text" class="form-control" name="product_name" value="<?php echo $_POST["product_name"]?>" placeholder="กรอกข้อมูล">
                              <?php
                                 if($product_name==1){ ?>
                                    <p style="color:red;">** กรุณากรอกข้อมูล</p>
                               <?php
                                }
                              ?>
                            </div>
                            <div class="form-group col-md-2">
                              <label for="inputState">จำนวนสินค้า <b style="color:red;font-size:15px;">*</b></label>
                              <input type="number" class="form-control" name="product_amount" value="<?php echo $_POST["product_amount"]?>" placeholder="กรอกข้อมูล">
                              <?php
                                 if($product_amount==1){ ?>
                                    <p style="color:red;">** กรุณากรอกข้อมูล</p>
                               <?php
                                }
                              ?>
                            </div>
                            <div class="form-group col-md-2">
                              <label for="inputState">หน่วยนับ <b style="color:red;font-size:15px;">*</b></label>
                               <select name="unit_id" class="form-control">
                                <?php
                                 include('connect.php');
                                  $sqlunit = "SELECT * FROM units  ";
                                  if($resultunit = mysqli_query($con, $sqlunit)){
                                    while($rowunit = mysqli_fetch_array($resultunit)){ ?>
                                          <option value="<?php echo $rowunit['unit_id']?>"><?php echo $rowunit['unit_name']?></option>
                                  <?php  }}
                                ?>
                               </select>
                              <?php
                                 if($unit_id==1){ ?>
                                    <p style="color:red;">** กรุณากรอกข้อมูล</p>
                               <?php
                                }
                              ?>
                            </div>
                        </div>
                        <div class="form-row" style="margin-top:35px;">
                            <div class="form-group col-md-4">
                              <label for="inputState">ราคาทุน (บาท)/หน่วย:</label>
                              <input type="number" id="product_price" class="form-control" name="product_costprice" value="<?php echo $_POST["product_costprice"]?>" placeholder="กรอกข้อมูล">

                            </div>
                            <div class="form-group col-md-4">
                              <label for="inputState">ราคาขาย (บาท)/หน่วย :</label>
                              <input type="number" id="product_pricecost" class="form-control" name="product_saleprice" value="<?php echo $_POST["product_saleprice"]?>" placeholder="กรอกข้อมูล">
                              <small id="checkdata" style="color: red;font-weight: 900; padding: 4%;"></small>
                            </div>
                            <div class="form-group col-md-4">
                              <label for="inputState">ราคาส่ง (บาท)/หน่วย :</label>
                              <input type="number" id="wholesale_price"  class="form-control" name="product_wholesaleprice" value="<?php echo $_POST["product_wholesaleprice"]?>" placeholder="กรอกข้อมูล">
                              <small id="checkdata1" style="color: red;font-weight: 900; padding: 4%;"></small>
                            </div>
                        </div>
                        <label for="inputEmail4" style="margin-top:35px;"><h3>รูปภาพประกอบสินค้า </h3></label>
                      <hr>
                        <div class="form-row" style="margin-top:35px;">
                        <div class="col-md-3 imgUp">
                            <div class="imagePreview"></div>
                                <label class="btn btn-primary">เลือกรูปภาพ <b style="color:red;font-size:15px;">*</b><input type="file" class="uploadFile img" name="img[0]" value="Upload Photo" style="width:0px;height:0px;overflow:hidden;"></label>
                                <?php
                                 if($img==1){ ?>
                                    <p style="color:red;">** กรุณาเพื่มรูปภาพสินค้า </p>
                               <?php
                                }
                              ?>
                         </div>
                         <i class="fa fa-plus imgAdd"></i>
                        </div>
                        <div class="form-row" style="margin-top: 25px;">
                          <div class="form-group col-md-12">
                            <center>
                              <a href="./product.php" class="adddata btn btn-info text-center">กลับ</a>
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
                  <h4> เพิ่มข้อมูลสินค้า : <b><?php echo $_POST['product_name'];?></b> สำเร็จ</h4>
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
                  <h4> เพิ่มข้อมูลสินค้า : <b><?php echo $_POST['product_name'];?></b> ไม่สำเร็จ</h4>
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
                  มีข้อมูล <b><?php echo $product_namessssss; ?></b> อยู่แล้ว
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
        $('#product_price').change(function(){
            var iddd=  $(this).val();
            iddd = parseInt(iddd)
            var idddddd=  $('#product_pricecost').val();
            idddddd = parseInt(idddddd)
            var idddd=  $('#wholesale_price').val();
            idddd = parseInt(idddd)
            if(iddd >= idddddd){
              document.getElementById("checkdata").innerHTML = "ราคาขายต้องมากกว่าราคาทุน !!!";
            }
            if(iddd >= idddd){
              document.getElementById("checkdata1").innerHTML = "ราคาส่งต้องมากกว่าราคาทุน !!!";
            }
            else{
              document.getElementById("checkdata").innerHTML = "";
              document.getElementById("checkdata1").innerHTML = "";
            }
        });
        $('#product_pricecost').change(function(){
            var iddd=  $(this).val();
            iddd = parseInt(iddd)
            var idddddd=  $('#product_price').val();
            idddddd = parseInt(idddddd)
            if(iddd <= idddddd){
              document.getElementById("checkdata").innerHTML = "ราคาขายต้องมากกว่าราคาทุน !!!";
            }
            else{
              document.getElementById("checkdata").innerHTML = "";
            }
        });
        $('#wholesale_price').change(function(){
            var iddd=  $(this).val();
            iddd = parseInt(iddd)
            var idddddd=  $('#product_price').val();
            idddddd = parseInt(idddddd)
            if(iddd <= idddddd){
              document.getElementById("checkdata1").innerHTML = "ราคาส่งต้องมากกว่าราคาทุน !!!";
            }
            else{
              document.getElementById("checkdata1").innerHTML = "";
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
