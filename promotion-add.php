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
    <script type="text/javascript" src="./js/jquery-3.1.1.min.js" ></script>
  </head>
  <body>
    <?php
     include('connect.php');
     date_default_timezone_set("Asia/Bangkok");
     $sqldataqurry = "SELECT * FROM promotion";
     if($resultdataqurry = mysqli_query($con, $sqldataqurry)){
         $count = mysqli_num_rows($resultdataqurry);
         while($row = mysqli_fetch_array($resultdataqurry)){
             if(substr($row['pro_id'],3)==$count){
               $count++;
             }
         }
         if($count==0){$count++;}
         $id = "Pro".$count;
     }
      if(isset($_POST["add"])){
        $checkstatus=0;
        if($_POST["pro_id"]!=null){
          $sqlposition = "SELECT * FROM promotion where pro_name='".$_POST['pro_name']."'";
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

                    $sql = "INSERT INTO promotion (pro_id,pro_name,pro_startdate,pro_enddate,pro_price,pro_freegift)
                    VALUES ('".$_POST["pro_id"]."','".$_POST["pro_name"]."','".$_POST["pro_startdate"]."','".$_POST["pro_enddate"]."','".$_POST["pro_price"]."',
                    '".$_POST["pro_freegift"]."')";
                    echo $sql ;
                    if ($con->query($sql) === TRUE) {
                        echo '<script>window.location.href="./promotion.php"</script>';
                    }
                    else{
                        echo '<script>
                              $(document).ready(function(){
                                $("#modalerror").modal("show");
                              });
                            </script>';
                    }
                }
            } 
        else {
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
      $Y = date("Y");
      $M = date("m");
      $D = date("d");
      $H = date("G")+7;
      $MI = date(":i:s");
      $datessql = $Y."-".$M."-".$D;
    ?>
    <div class="page">
      <!-- Main Navbar-->
		<?php include ('./menubar.php');?>
        <div class="content-inner">
          <!-- Page Header-->
          <header class="page-header">
            <div class="container-fluid">
              <h2 class="no-margin-bottom">เพิ่มข้อมูลโปรโมชั่น</h2>
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
                      <label for="inputEmail4"><h3>ข้อมูลโปรโมชั่น</h3></label>
                      <hr>
                        <div class="form-row">
                            <div class="form-group col-md-2">
                            <label for="inputEmail4">รหัสโปรโมชั่น	 <b style="color:red;font-size:15px;">*</b></label>
                            <input type="text" class="form-control" name="pro_id" value="<?php echo $id;?>" readonly>
                            </div>
                            <div class="form-group col-md-4">
                              <label for="inputState">ชื่อโปรโมชั่น	 <b style="color:red;font-size:15px;">*</b></label>
                              <input type="text" class="form-control" name="pro_name" value="<?php echo $_POST["pro_name"];?>" placeholder="กรอกข้อมูล">
                            </div>
                            <div class="form-group col-md-3">
                              <label for="inputState">วันที่เริ่มโปรโมชั่น<b style="color:red;font-size:15px;">*</b></label>
                              <input type="date" class="form-control" name="pro_startdate" value="<?php echo $_POST["pro_startdate"];?>" min="<?php echo $datessql;?>" placeholder="กรอกข้อมูล">
                            </div>
                            <div class="form-group col-md-3">
                              <label for="inputState">วันที่สิ้นสุดโปรโมชั่น <b style="color:red;font-size:15px;">*</b></label>
                              <input type="date" class="form-control" name="pro_enddate" value="<?php echo $_POST["pro_enddate"];?>" min="<?php echo $datessql;?>" placeholder="กรอกข้อมูล">
                            </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-4">
                            <label for="inputCity">ราคาโปรโมชั่น <b style="color:red;font-size:15px;">*</b></label>
                            <input type="text" class="form-control" name="pro_price" value="<?php echo $_POST["pro_price"];?>" placeholder="กรอกข้อมูล">
                          </div>
                         
                        <div class="form-group col-md-4">
                            <label for="Proviance">จำนวนของแถม / ชิ้น <b style="color:red;font-size:15px;">*</b></label>
                            <input type="text" class="form-control" name="pro_freegift" value="<?php echo $_POST["pro_freegift"];?>" placeholder="กรอกข้อมูล">
                          </div>
                        </div>
                        <div class="form-row" style="margin-top: 25px;">
                          <div class="form-group col-md-12">
                            <center>
                              <a href="./promotion.php" class="adddata btn btn-info text-center">กลับ</a>
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
                  <h4> เพิ่มข้อมูลโปรโมชั่น : <b><?php echo $_POST['pro_id'];?></b> สำเร็จ</h4>
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
                  <h4> เพิ่มข้อมูลโปรโมชั่น : <b><?php echo $_POST['pro_id'];?></b> ไม่สำเร็จ</h4>
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
                  มีข้อมูลโปรโมชั่น <b><?php echo $_POST['pro_name']; ?></b> อยู่แล้ว
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
    noselect=1;
     $(".imgAdd").click(function(){
        var text="";
            text=" <div class='form-group col-md-6'> <label for='inputState'>ชื่อสินค้า <b style='color:red;font-size:20px;'>*</b></label><select id='select"+noselect+"' name='product_id[]'  class='form-control' value='"+noselect+"' onclick='updatepd("+noselect+")' > ";
            text+="<?php $sql ='SELECT * FROM product'; if($result = mysqli_query($con, $sql)){  while($row = mysqli_fetch_array($result)){ ?>"
            text+="<option value='<?php echo $row['product_id']?>' price='<?php echo $row['product_wholesaleprice']?>'><?php echo $row['product_name']?></option> <?php }}?> </select> </div>"
            text+="<div class='form-group col-md-6'><label for='inputZip'>ราคาทุน (บาท)</label><input type='text' id='price"+noselect+"' class='form-control' name='detail_price[]' placeholder='กรอกข้อมูล' required readonly></div>"

            $(this).closest(".row").find('.imgAdd').before(text);
            noselect+=1;

        });
        $(document).on("click", "i.del" , function() {
            $(this).parent().remove();
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
        var x=0;
    var xxx=0;
    var no='';
    var selectss='';

 function updatepd(a){
  var totalamount=0;
  selectss='#select'+a;
     $(selectss).children('option:selected').each( function() {
        x = $( this ).attr("price");
        var price = 'price'+a;
        document.getElementById(price).value = x;
        var amountpd='#amountpd'+a;
        xxx = $( amountpd ).val();
    });

          var amountpd='#amountpd'+a;
        var pricetotle = 'pricetotle'+a;
        $( amountpd ).change(function () {
          xxx = $( amountpd ).val();
          xxx =x*xxx;3
          document.getElementById(pricetotle).value = xxx;
          var price = 'price'+a;
        document.getElementById(price).value = x;
        var numamount=0;
        var totalanumamount=0;
        var numprice=0;
        var totalnumprice=0;
        for(i=0;i<=a;i++){
           numamount='#amountpd'+i;
           numprice='#pricetotle'+i;
           totalanumamount += parseInt($( numamount ).val(), 10);
           totalnumprice += parseInt($( numprice ).val(), 10);

        }
        totalanumamount= totalanumamount.toString();
        totalnumprice= totalnumprice.toString();
        document.getElementById("amounttotal").value = totalanumamount;
        document.getElementById("pricetotle").value = totalnumprice;

        });

 }
  </script>
  <script>
    $(document).ready(function() {
        $('#perfixTables').DataTable({
            responsive: true
        });
    });
    </script>
</html>
