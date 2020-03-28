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
    
        if(($_POST["product_name"]!=null && $_POST["product_amount"]!=null) && ($_POST["unit_id"]!=null && $_POST["product_costprice"]!=null) && ($_POST["product_saleprice"]!=null && $_POST["product_wholesaleprice"]!=null)){

                   
                            for($i=0;$i<count($_FILES["img"]["name"]);$i++){
                                 if($_FILES["img"]["name"][0]!=null){
                                    $sqledit = "UPDATE product SET product_name='".$_POST["product_name"]."',product_amount='".$_POST["product_amount"]."',
                                    unit_id='".$_POST["unit_id"]."',product_costprice='".$_POST["product_costprice"]."',product_saleprice='".$_POST["product_saleprice"]."',
                                    product_wholesaleprice='".$_POST["product_wholesaleprice"]."',product_img1='".$_FILES["img"]["name"][0]."'
                                     WHERE product_id='".$_GET['id']."'"; 
                                    if(mysqli_query($con, $sqledit)){ 
                                      
                                        if(move_uploaded_file($_FILES["img"]["tmp_name"][0],"./imageproduct/".$_FILES["img"]["name"][0])){
                                          echo '<script>
                                          $(document).ready(function(){
                                            $("#modalsuccess").modal("show");
                                          });
                                        </script>';
                                        }
                                    } else { 
                                      echo '<script>
                                      $(document).ready(function(){
                                        $("#modalerror").modal("show");
                                      });
                                    </script>';
                                    } 
                                 }
                                 if($_FILES["img"]["name"][1]!=null){
                                    $sqledit = "UPDATE product SET product_name='".$_POST["product_name"]."',product_amount='".$_POST["product_amount"]."',
                                    unit_id='".$_POST["unit_id"]."',product_costprice='".$_POST["product_costprice"]."',product_saleprice='".$_POST["product_saleprice"]."',
                                    product_wholesaleprice='".$_POST["product_wholesaleprice"]."',product_img2='".$_FILES["img"]["name"][1]."'
                                     WHERE product_id='".$_GET['id']."'"; 
                                    if(mysqli_query($con, $sqledit)){ 
                                        
                                        if(move_uploaded_file($_FILES["img"]["tmp_name"][1],"./imageproduct/".$_FILES["img"]["name"][1])){
                                          echo '<script>
                                          $(document).ready(function(){
                                            $("#modalsuccess").modal("show");
                                          });
                                        </script>';
                                        }
                                    } else { 
                                      echo '<script>
                                      $(document).ready(function(){
                                        $("#modalerror").modal("show");
                                      });
                                    </script>';
                                    } 
                                }
                                if($_FILES["img"]["name"][2]!=null){
                                    $sqledit = "UPDATE product SET product_name='".$_POST["product_name"]."',product_amount='".$_POST["product_amount"]."',
                                    unit_id='".$_POST["unit_id"]."',product_costprice='".$_POST["product_costprice"]."',product_saleprice='".$_POST["product_saleprice"]."',
                                    product_wholesaleprice='".$_POST["product_wholesaleprice"]."',product_img3='".$_FILES["img"]["name"][2]."'
                                     WHERE product_id='".$_GET['id']."'"; 
                                    if(mysqli_query($con, $sqledit)){ 
                                        if(move_uploaded_file($_FILES["img"]["tmp_name"][2],"./imageproduct/".$_FILES["img"]["name"][2])){
                                          echo '<script>
                                          $(document).ready(function(){
                                            $("#modalsuccess").modal("show");
                                          });
                                        </script>';
                                        }
                                    } else { 
                                      echo '<script>
                                      $(document).ready(function(){
                                        $("#modalerror").modal("show");
                                      });
                                    </script>';
                                    } 
                                }
                                if($_FILES["img"]["name"][3]!=null){
                                    $sqledit = "UPDATE product SET product_name='".$_POST["product_name"]."',product_amount='".$_POST["product_amount"]."',
                                    unit_id='".$_POST["unit_id"]."',product_costprice='".$_POST["product_costprice"]."',product_saleprice='".$_POST["product_saleprice"]."',
                                    product_wholesaleprice='".$_POST["product_wholesaleprice"]."',product_img4='".$_FILES["img"]["name"][3]."'
                                     WHERE product_id='".$_GET['id']."'"; 
                                    if(mysqli_query($con, $sqledit)){ 
                                        if(move_uploaded_file($_FILES["img"]["tmp_name"][3],"./imageproduct/".$_FILES["img"]["name"][3])){
                                          echo '<script>
                                          $(document).ready(function(){
                                            $("#modalsuccess").modal("show");
                                          });
                                        </script>';
                                        }
                                    } else { 
                                      echo '<script>
                                      $(document).ready(function(){
                                        $("#modalerror").modal("show");
                                      });
                                    </script>';
                                    } 
                                }
                                else{
                                    $sqledit = "UPDATE product SET product_name='".$_POST["product_name"]."',product_amount='".$_POST["product_amount"]."',
                                    unit_id='".$_POST["unit_id"]."',product_costprice='".$_POST["product_costprice"]."',product_saleprice='".$_POST["product_saleprice"]."',
                                    product_wholesaleprice='".$_POST["product_wholesaleprice"]."' WHERE product_id='".$_GET['id']."'"; 
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
              <h2 class="no-margin-bottom">แก้ไขข้อมูลสินค้า</h2>
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
                      <form action="" name="myform" method="post" enctype="multipart/form-data">
                      <label for="inputEmail4"><h3>ข้อมูลสินค้า</h3></label>
                      <hr>
                      <?php 
                                include('connect.php');
                                $sql = "SELECT * FROM product where product_id='".$_GET['id']."' ";
                                if($result = mysqli_query($con, $sql)){
                                    while($row = mysqli_fetch_array($result)){
                              ?>
                        <div class="form-row" style="margin-top:35px;">
                            <div class="form-group col-md-3">
                            <label for="inputEmail4">รหัสสินค้า :</label>
                            <input type="text" class="form-control" name="product_id" value="<?php echo $row['product_id'];?>" readonly>
                            </div>
                            <div class="form-group col-md-5">
                              <label for="inputState">ชื่อสินค้า :</label>
                              <input type="text" class="form-control" name="product_name" value="<?php echo $row["product_name"]?>" placeholder="กรอกข้อมูล">
                              <?php
                                 if($product_name==1){ ?>
                                    <p style="color:red;">** กรุณากรอกข้อมูล</p>
                               <?php
                                }
                              ?>
                            </div>
                            <div class="form-group col-md-2">
                              <label for="inputState">จำนวนสินค้า :</label>
                              <input type="number" class="form-control" name="product_amount" value="<?php echo $row["product_amount"]?>" placeholder="กรอกข้อมูล">
                              <?php
                                 if($product_amount==1){ ?>
                                    <p style="color:red;">** กรุณากรอกข้อมูล</p>
                               <?php
                                }
                              ?>
                            </div>
                            <div class="form-group col-md-2">
                              <label for="inputState">หน่วยนับ :</label>
                               <select name="unit_id" class="form-control">
                                <?php 
                                 include('connect.php');
                                  $sqlunit = "SELECT * FROM units ";
                                  if($resultunit = mysqli_query($con, $sqlunit)){
                                    while($rowunit = mysqli_fetch_array($resultunit)){ ?>
                                          <option value="<?php echo $rowunit['unit_id']?>" <?php if($row['unit_id']==$rowunit['unit_id']){ echo "selected";}?>><?php echo $rowunit['unit_name']?></option>
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
                              <label for="inputState">ราคาทุน (บาท)/หน่วย</label>
                              <input id="product_price" type="number" class="form-control" name="product_costprice" value="<?php echo $row["product_costprice"]?>" placeholder="กรอกข้อมูล">
                              <?php
                                 if($product_costprice==1){ ?>
                                    <p style="color:red;">** กรุณากรอกข้อมูล</p>
                               <?php
                                }
                              ?>
                            </div>
                            <div class="form-group col-md-4">
                              <label for="inputState">ราคาขาย (บาท)/หน่วย</label>
                              <input id="product_pricecost" type="number" class="form-control" name="product_saleprice" value="<?php echo $row["product_saleprice"]?>" placeholder="กรอกข้อมูล">
                              <small id="checkdata" style="color: red;font-weight: 900; padding: 4%;"></small>
                              <?php
                                 if($product_saleprice==1){ ?>
                                    <p style="color:red;">** กรุณากรอกข้อมูล</p>
                               <?php
                                }
                              ?>
                            </div>
                            <div class="form-group col-md-4">
                              <label for="inputState">ราคาส่ง (บาท)/หน่วย</label>
                              <input type="number" class="form-control" name="product_wholesaleprice" value="<?php echo $row["product_wholesaleprice"]?>" placeholder="กรอกข้อมูล">
                              <?php
                                 if($product_wholesaleprice==1){ ?>
                                    <p style="color:red;">** กรุณากรอกข้อมูล</p>
                               <?php
                                }
                              ?>
                            </div>
                        </div>
                        <label for="inputEmail4" style="margin-top:35px;"><h3>รูปภาพประกอบสินค้า</h3></label>
                      <hr>
                        <div class="form-row" style="margin-top:35px;">
                        <div class="col-md-3 imgUp">
                            <div class="imagePreview" style="width: 100%; height: 180px; background-position: center center;background:url(./imageproduct/<?php echo $row['product_img1'];?>);
                                background-color:#fff;background-size: cover; background-repeat:no-repeat; display: inline-block; box-shadow:0px -3px 6px 2px rgba(0,0,0,0.2);"></div>
                                <label class="btn btn-primary">แก้ไขรูปภาพ<input type="file" class="uploadFile img" name="img[0]" value="Upload Photo" style="width:0px;height:0px;overflow:hidden;"></label>
                            
                         </div>
                         <div class="col-md-3 imgUp">
                            <div class="imagePreview" style="width: 100%; height: 180px; background-position: center center;background:url(./imageproduct/<?php echo $row['product_img2'];?>);
                                background-color:#fff;background-size: cover; background-repeat:no-repeat; display: inline-block; box-shadow:0px -3px 6px 2px rgba(0,0,0,0.2);"></div>
                                <label class="btn btn-primary">แก้ไขรูปภาพ<input type="file" class="uploadFile img" name="img[1]" value="Upload Photo" style="width:0px;height:0px;overflow:hidden;"></label>
                                <i class="fa fa-times del"  value="2<?php echo $row['product_img2'];?>"></i>
                         </div>
                         <div class="col-md-3 imgUp">
                            <div class="imagePreview" style="width: 100%; height: 180px; background-position: center center;background:url(./imageproduct/<?php echo $row['product_img3'];?>);
                                background-color:#fff;background-size: cover; background-repeat:no-repeat; display: inline-block; box-shadow:0px -3px 6px 2px rgba(0,0,0,0.2);"></div>
                                <label class="btn btn-primary">แก้ไขรูปภาพ<input type="file" class="uploadFile img" name="img[2]" value="Upload Photo" style="width:0px;height:0px;overflow:hidden;"></label>
                                <i class="fa fa-times del"  value="3<?php echo $row['product_img3'];?>"></i>
                         </div>
                         <div class="col-md-3 imgUp">
                            <div class="imagePreview" style="width: 100%; height: 180px; background-position: center center;background:url(./imageproduct/<?php echo $row['product_img4'];?>);
                                background-color:#fff;background-size: cover; background-repeat:no-repeat; display: inline-block; box-shadow:0px -3px 6px 2px rgba(0,0,0,0.2);"></div>
                                <label class="btn btn-primary">แก้ไขรูปภาพ<input type="file" class="uploadFile img" name="img[3]" value="Upload Photo" style="width:0px;height:0px;overflow:hidden;"></label>
                                <i class="fa fa-times del" value="4<?php echo $row['product_img4'];?>"></i>
                         </div>
                        </div>
                        <div class="form-row" style="margin-top: 25px;">
                          <div class="form-group col-md-12">
                            <center>
                              <a href="./product.php" class="adddata btn btn-info text-center">ย้อนกลับกลับ</a>
                              <a id="editdata" class="btn btn-success text-center" value="<?php echo $row["product_name"]?>">แก้ไขข้อมูล</a>
                              <input type="hidden" name="add">
                            </center>
                          </div>
                        </div>
                            <?php }} ?>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
            <!-- Modal -->
       <div class="modal fade" id="modalsuccess" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">การแจ้งเตือน</h5>
                </div>
                <div class="modal-body">
                  <center>
                  <h4> แก้ไขข้อมูลสินค้า : <b><?php echo $_POST['product_name'];?></b> สำเร็จ</h4>
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
                  <h4> แก้ไขข้อมูลสินค้า : <b><?php echo $_POST['product_name'];?></b> ไม่สำเร็จ</h4>
                  </center>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-success" data-dismiss="modal">ตกลง</button>
                </div>
              </div>
            </div>
          </div>
          <!-- <div class="modal fade" id="modaledit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                  มีข้อมูล <b><?php echo $_POST["product_name"]; ?></b> อยู่แล้ว
                  </center>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-success" data-dismiss="modal">ตกลง</button>
                </div>
              </div>
            </div>
          </div> -->
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
                  <input type="hidden" id="idpd" value="<?php echo $_GET['id']?>">
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
    		window.location.href="./product.php"
    });  
    $(document).on('click', '#editdata', function(){   
       
       var at_id = document.getElementById("editdata").getAttribute("value");
       document.getElementById("checkedata").innerHTML = at_id;
       $('#modaledits').modal('show');
       $(document).on('click', '#submit', function(event){  
         document.myform.submit();
      });  
     });  
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
            var idimg= $(this).attr("value")
            var id= $("#idpd").attr("value")
            $('#deletedataperfix').modal('show');

            $(document).on('click', '#submit', function(){  
                $('#deletedataperfix').modal('hide');
                 event.preventDefault();  
                $.ajax({  
                url:"./product-delete.php",  
                method:"post",  
                data:{idimg:idimg,id:id},  
                dataType:"json",  
                success:function(data){ 
                    idimg='';
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
            var idddddd=  $('#product_pricecost').val();
            if(iddd >= idddddd){
              document.getElementById("checkdata").innerHTML = "ราคาขายต้องมากกว่าราคาทุน !!!";
            }
            else{
              document.getElementById("checkdata").innerHTML = "";
            }
        });
        $('#product_pricecost').change(function(){
            var iddd=  $(this).val();
          
            var idddddd=  $('#product_price').val();
          
            if(iddd <= idddddd){
              document.getElementById("checkdata").innerHTML = "ราคาขายต้องมากกว่าราคาทุน !!!";
            }
            else{
              document.getElementById("checkdata").innerHTML = "";
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