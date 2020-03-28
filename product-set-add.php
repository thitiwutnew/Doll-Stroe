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
    <link href='./css/select2.min.css' rel='stylesheet' type='text/css'>
  </head>
  <body onload="Add();">
    <?php
     include('connect.php');
     $sqldataqurry = "SELECT * FROM setproduct";
     if($resultdataqurry = mysqli_query($con, $sqldataqurry)){
         $count = mysqli_num_rows($resultdataqurry);
         while($row = mysqli_fetch_array($resultdataqurry)){
             if(substr($row['set_id'],2)==$count){
               $count++;
             }
         }
         if($count==0){$count++;}
         $id = "SP".$count;
     }
      if(isset($_POST["add"])){
        $checkstatus=0;

        if($_POST["set_name"]!=null){

          $sqlposition = "SELECT * FROM setproduct where set_name='".$_POST['set_name']."'";
          if($resultposition = mysqli_query($con, $sqlposition)){
              $count = mysqli_num_rows ( $resultposition );
              if($count>0){
                $set_namesss=$_POST['set_name'];
                $_POST['set_name']=null;
                echo '<script>
                        $(document).ready(function(){
                          $("#modaledit").modal("show");
                        });
                      </script>';
              }
              else{
                    $sql = "INSERT INTO setproduct (set_id,set_name,set_price)
                    VALUES ('".$_POST["set_id"]."','".$_POST["set_name"]."','".$_POST["set_price"]."')";

                    if ($con->query($sql) === TRUE) {
                      $numcount=0;
                      for($i=0;$i<count($_POST["product_id"]);$i++){
                        $sqldetail = "INSERT INTO setproduct_descirption (set_id,product_id)
                        VALUES ('".$_POST["set_id"]."','".$_POST["product_id"][$i]."')";

                        if ($con->query($sqldetail) === TRUE) {
                          $numcount+=1;
                        } else { }
                       }

                      if( $numcount==count($_POST["product_id"])){
                        echo '<script>window.location.href="./product-set.php"</script>';
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
                    } else {

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
              <h2 class="no-margin-bottom">เพิ่มข้อมูลสินค้าเซต</h2>
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
                      <label for="inputEmail4"><h3>ข้อมูลสินค้าเซต</h3></label>
                      <hr>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                            <label for="inputEmail4">รหัสสินค้าเซต <b style="color:red;font-size:15px;">*</b></label>
                            <input type="text" class="form-control" name="set_id" value="<?php echo $id;?>" readonly>
                            </div>
                            <div class="form-group col-md-4">
                              <label for="inputState">ชื่อสินค้าเซต <b style="color:red;font-size:15px;">*</b></label>
                              <input type="text" class="form-control" name="set_name" value="<?php echo $_POST["set_name"];?>" placeholder="กรอกข้อมูล" required>
                            </div>
                            <div class="form-group col-md-5">
                              <label for="inputState">ราคา (บาท)/เซต <b style="color:red;font-size:15px;">*</b></label>
                              <input type="number" class="form-control" name="set_price" value="<?php echo $_POST["set_price"];?>" placeholder="กรอกข้อมูล">
                            </div>
                        </div>
                        <hr>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                            <select id='selUser' class="select" style="width:50%;">
                                      <?php
                                      include('connect.php');
                                      $sql = "SELECT * FROM product";
                                      if($result = mysqli_query($con, $sql)){
                                          while($row = mysqli_fetch_array($result)){
                                          ?>
                                          <option value="<?php echo $row['product_id']?>">
                                            <?php echo $row['product_name']?>
                                          </option>
                                      <?php }}?>
                              </select>
                              <input type='button' value='เลือกสินค้า' class="btn btn-success" id='but_read'>
                              <input type='button' value='ลบสินค้า' class="btn btn-danger " id='but_reset'>
                            </div>
                            <div class="form-group col-md-12">
                            <label for="inputEmail4"><h3>ข้อมูลสินค้าเซต</h3></label>
                            <table class="table table-bordered">
                              <thead class="thead-dark">
                                <th>ลำดับ</th>
                                <th> ชื่อสินค้า</th>
                              </thead>
                              <?php if($_POST["product_id"]!=null){
                                 $countnumip=1;
                                  for($countidpd=0;$countidpd<=count($_POST["product_id"]);$countidpd++){
                                    $sqlidpd = "SELECT * FROM product where product_id='".$_POST["product_id"][$countidpd]."'";
                                    if($resultidpd = mysqli_query($con, $sqlidpd)){
                                        while($rowidpd = mysqli_fetch_array($resultidpd)){
                                        ?>
                                      <tr>
                                          <th><?php echo  $countnumip;?></th>
                                          <th> <?php echo $rowidpd['product_name']?></th>
                                          <input type='hidden' class='form-control' name='product_id[]' value="<?php echo $rowidpd['product_id']?>">
                                      </tr>
                                    <?php }$countnumip+=1;}
                                  }
                              }else{?>
                              <tbody id='result'> 
                              <?php }?>
                              </tbody>
                            </table>
                            </div>
                        </div>
                        <hr>
                        <div class="form-row" style="margin-top: 25px;">
                          <div class="form-group col-md-12">
                            <center>
                              <a href="./product-set.php" class="adddata btn btn-info text-center">กลับ</a>
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
                  <h4> เพิ่มข้อมูลสินค้าเซต : <b><?php echo $_POST['set_name'];?></b> สำเร็จ</h4>
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
                  <h4> เพิ่มข้อมูลสินค้าเซต: <b><?php echo $_POST['set_name'];?></b> ไม่สำเร็จ</h4>
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
                  มีข้อมูล <b><?php echo $set_namesss; ?></b> อยู่แล้ว
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
            text+="<div class='form-group col-md-6'><label for='inputZip'>ราคา :<b style='color:red;font-size:20px;'></b></label><input type='text' id='price"+noselect+"' class='form-control' name='detail_price[]' placeholder='กรอกข้อมูล' required readonly></div>"

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
   <script type="text/javascript" src="./js/select2.min.js" ></script>
  <script>
 $(document).ready(function(){
  var textshow="";
  let countnumber =1;
 // Initialize select2
 $("#selUser").select2();

 // Read selected option
 $('#but_read').click(function(){
   var username =$('#selUser option:selected').text();
   var userid = $('#selUser').val();
    textshow +="<tr><th>"+countnumber+"</th><th><input type='hidden' class='form-control' name='product_id[]' value="+userid+" readonly>"+username+"</th></tr>";
   $('#result').html(textshow);
   countnumber+=1;
   document.getElementById("but_read").disabled = true;
   $('#selUser option:selected').prop('disabled', ! $('#selUser option:selected').prop('disabled'));
 });
 $('#selUser').change(function () {
          document.getElementById("but_read").disabled = false;
        });
 $('#but_reset').click(function(){
   var username = $('#selUser option:selected').text();
   var userid = $('#selUser').val();
    textshow ="";
   $('#result').html(textshow);
   countnumber=1;
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
