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
     $sqldataqurry = "SELECT * FROM customer";
     if($resultdataqurry = mysqli_query($con, $sqldataqurry)){
         $count = mysqli_num_rows($resultdataqurry);
         while($row = mysqli_fetch_array($resultdataqurry)){
             if(substr($row['cus_id'],3)==$count){
               $count++;
             }
         }
         if($count==0){$count++;}
         $id = "CUS".$count;
     }
      if(isset($_POST["add"])){
        $checkstatus=0;
        if($_POST["cus_id"]!=null){

          $sqlposition = "SELECT * FROM customer where cus_firstname='".$_POST['cus_firstname']."' AND cus_lastname ='".$_POST['cus_lastname']."'";
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
                    $sql = "INSERT INTO customer (cus_id,prefix_id,cus_firstname,cus_lastname,cus_address,cus_tambon,cus_amphoe,cus_province,cus_postalcode,cus_tell)
                    VALUES ('".$_POST["cus_id"]."','".$_POST["prefix_id"]."','".$_POST["cus_firstname"]."','".$_POST["cus_lastname"]."','".$_POST["cus_address"]."',
                    '".$_POST["Subdistrict"]."','".$_POST["District"]."','".$_POST["Proviance"]."','".$_POST["Postcode"]."','".$_POST['cus_tell']."')";

                    if ($con->query($sql) === TRUE) {
                        echo '<script>window.location.href="./customer.php"</script>';
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
    ?>
    <div class="page">
      <!-- Main Navbar-->
		<?php include ('./menubar.php');?>
        <div class="content-inner">
          <!-- Page Header-->
          <header class="page-header">
            <div class="container-fluid">
              <h2 class="no-margin-bottom">เพิ่มข้อมูลลูกค้า</h2>
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
                      <label for="inputEmail4"><h3>ข้อมูลลูกค้า</h3></label>
                      <hr>
                        <div class="form-row">
                            <div class="form-group col-md-2">
                            <label for="inputEmail4">รหัสลูกค้า <b style="color:red;font-size:15px;">*</b></label>
                            <input type="text" class="form-control" name="cus_id" value="<?php echo $id;?>" readonly>
                            </div>
                            <div class="form-group col-md-2">
                              <label for="inputState">คำนำหน้า <b style="color:red;font-size:15px;">*</b></label>
                              <select name="prefix_id" class="form-control">
                                <?php
                                        include('connect.php');
                                        $sql = "SELECT * FROM prefix ";
                                        if($result = mysqli_query($con, $sql)){
                                            while($row = mysqli_fetch_array($result)){
                                ?>
                                <option value="<?php echo $row ['prefix_id'];?>"> <?php echo $row ['prefix_name'];?></option>
                                            <?php }}?>
                              </select>
                            </div>
                            <div class="form-group col-md-4">
                              <label for="inputState">ชื่อลูกค้า <b style="color:red;font-size:15px;">*</b></label>
                              <input type="text" class="form-control" name="cus_firstname" value="<?php echo $_POST["agent_shopname"];?>" placeholder="กรอกข้อมูล">
                            </div>
                            <div class="form-group col-md-4">
                              <label for="inputState">นามสกุล <b style="color:red;font-size:15px;">*</b></label>
                              <input type="text" class="form-control" name="cus_lastname" value="<?php echo $_POST["agent_shopname"];?>" placeholder="กรอกข้อมูล">
                            </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-7">
                            <label for="inputCity">ที่อยู่ <b style="color:red;font-size:15px;">*</b></label>
                            <input type="text" class="form-control" name="cus_address" value="<?php echo $_POST["no"];?>" placeholder="กรอกข้อมูล">
                          </div>
                          <div class="form-group col-md-5">
                              <label for="inputState">เบอร์โทรศัพท์ <b style="color:red;font-size:15px;">*</b></label>
                              <input type="text" class="form-control" name="cus_tell" value="<?php echo $_POST["agent_tel"];?>" placeholder="กรอกข้อมูล">
                            </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="Proviance">จังหวัด <b style="color:red;font-size:15px;">*</b></label>
                            <select name="Proviance" id="Proviance" class="form-control"> </select>
                          </div>
                          <div class="form-group col-md-6">
                            <label for="District">อำเภอ <b style="color:red;font-size:15px;">*</b></label>
                            <select name="District" id="District" class="form-control"></select>
                          </div>
                          <div class="form-group col-md-6">
                            <label for="Subdistrict">ตำบล <b style="color:red;font-size:15px;">*</b></label>
                            <select name="Subdistrict" id="Subdistrict" class="form-control"></select>
                          </div>
                          <div class="form-group col-md-6">
                              <label for="Postcode">รหัสไปรษณีย์ <b style="color:red;font-size:15px;">*</b></label>
                              <select name="Postcode" id="Postcode"  class="form-control">
                              </select>
                              </div>
                        </div>
                        <div class="form-row" style="margin-top: 25px;">
                          <div class="form-group col-md-12">
                            <center>
                              <a href="./customer.php" class="adddata btn btn-info text-center">กลับ</a>
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
                  <h4> เพิ่มข้อมูลลูกค้า : <b><?php echo $_POST['cus_id'];?></b> สำเร็จ</h4>
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
                  <h4> เพิ่มข้อมูลลูกค้า : <b><?php echo $_POST['cus_id'];?></b> ไม่สำเร็จ</h4>
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
                  มีข้อมูล <b><?php echo $_POST['cus_firstname']." ".$_POST['cus_lastname']; ?></b> อยู่แล้ว
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
