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
    width:140px;
    height:30px;
    background-color:#ffc107;
    color:#000;
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
  <?php 
                        include('connect.php');
                        $sqldataqurry = "SELECT * FROM customer where cus_id='".$_GET['id']."'";
                        if($resultdataqurry = mysqli_query($con, $sqldataqurry)){
                            $count = mysqli_num_rows($resultdataqurry);
                            while($row = mysqli_fetch_array($resultdataqurry)){ 
                              $selectpv=$row['cus_province'];
                              $selectdr=$row['cus_amphoe'];
                              $selectsub=$row['cus_tambon'];
                              $selectcode=$row['cus_postalcode'];
                              }} 

                              if(isset($_POST["add"])){
                                $checkstatus=0;
                                if($_POST["cus_id"]!=null){
                                            $sqledit = "UPDATE customer SET prefix_id='".$_POST["prefix_id"]."',cus_firstname='".$_POST["cus_firstname"]."',cus_lastname='".$_POST["cus_lastname"]."'
                                            ,cus_address='".$_POST["cus_address"]."',cus_tambon='".$_POST["Subdistrict"]."',cus_amphoe='".$_POST["District"]."',cus_province='".$_POST["Proviance"]."'
                                            ,cus_postalcode='".$_POST["Postcode"]."',cus_tell='".$_POST["cus_tell"]."'  WHERE cus_id='".$_GET['id']."'"; 
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
                                else{
                                  echo '<script>
                                  $(document).ready(function(){
                                    $("#modalerror").modal("show");
                                  });
                                </script>';
                                  }
                              } 
                         
                              
  ?>
  <body onload="EditeProviance('<?php echo $selectpv;?>'),EditeDistrict('<?php echo $selectdr;?>'),EditeSubdistrict('<?php echo $selectsub;?>'),Editecode('<?php echo $selectcode;?>')">
    <div class="page">
      <!-- Main Navbar-->
		<?php include ('./menubar.php');?>
        <div class="content-inner">
          <!-- Page Header-->
          <header class="page-header">
            <div class="container-fluid">
              <h2 class="no-margin-bottom">รายละเอียดข้อมูลตัวแทนจำหน่วย</h2>
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
                      <form name="myform" action="" method="post" enctype="multipart/form-data">
                      <label for="inputEmail4"><h3>ข้อมูลลูกค้า</h3></label>
                      <hr>
                      <?php 
                        include('connect.php');
                        $sqldataqurry = "SELECT * FROM customer where cus_id='".$_GET['id']."'";
                        if($resultdataqurry = mysqli_query($con, $sqldataqurry)){
                            $count = mysqli_num_rows($resultdataqurry);
                            while($row = mysqli_fetch_array($resultdataqurry)){ ?>
                        <div class="form-row">
                            <div class="form-group col-md-2">
                            <label for="inputEmail4">รหัสลูกค้า :</label>
                            <input type="text" class="form-control" name="cus_id" value="<?php echo $row['cus_id'];?>" readonly>
                            </div>
                            <div class="form-group col-md-2">
                              <label for="inputState">คำนำหน้า <b style="color:red;font-size:15px;">*</b></label>
                              <select name="prefix_id" class="form-control">
                                <?php
                                        include('connect.php');
                                        $sql = "SELECT * FROM prefix ";
                                        if($result = mysqli_query($con, $sql)){
                                            while($rows = mysqli_fetch_array($result)){
                                ?>
                                <option value="<?php echo $rows ['prefix_id'];?>" <?php if($rows ['prefix_id']==$row ['prefix_id']){echo "selected";}?>> <?php echo $rows ['prefix_name'];?></option>
                                            <?php }}?>
                              </select>
                            </div>
                            <div class="form-group col-md-4">
                              <label for="inputState">ชื่อลูกค้า :</label>
                              <input type="text" class="form-control" name="cus_firstname" value="<?php echo $row['cus_firstname']; $agent_shopname=$row['cus_firstname'];?>">
                            </div>
                            <div class="form-group col-md-4">
                              <label for="inputState">นามสกุล :</label>
                              <input type="text" class="form-control" name="cus_lastname" value="<?php echo $row['cus_lastname'];?>">
                            </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-7">
                            <label for="inputCity">ที่อยู่ :</label>
                            <input type="text" class="form-control" name="cus_address" value="<?php echo $row['cus_address'];?>">
                          </div>
                          <div class="form-group col-md-5">
                              <label for="inputZip">เบอร์โทรศัพท์ผู้ติดต่อ :</label>
                              <input type="text" class="form-control" name="cus_tell" value="<?php echo $row['cus_tell'];?>">
                            </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="Proviance">จังหวัด :</label>
                            <select name="Proviance" id="Proviance" class="form-control"> </select>
                          </div>
                          <div class="form-group col-md-6">
                            <label for="District">อำเภอ :</label>
                            <select name="District" id="District" class="form-control"></select>
                          </div>
                          <div class="form-group col-md-6">
                            <label for="Subdistrict">ตำบล :</label>
                            <select name="Subdistrict" id="Subdistrict" class="form-control"></select>
                          </div>
                          <div class="form-group col-md-6">
                              <label for="Postcode">รหัสไปรษณีย์ :</label>
                              <select name="Postcode" id="Postcode"  class="form-control">
                              </select>
                              </div>
                          </div>
                        </div>
                        <div class="form-row" style="margin-top: 25px;">
                          <div class="form-group col-md-12">
                            <center>
                              <a href="./customer.php" class="adddata btn btn-info text-center">กลับ</a>
                              <a id="editdata" class="btn btn-success text-center" value="<?php echo $row['cus_firstname']." ".$row['cus_lastname'];?>">แก้ไขข้อมูล</a>
                              <input type="hidden" name="add">
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
      <!-- Modal -->
      <div class="modal fade" id="modalsuccess" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">การแจ้งเตือน</h5>
                </div>
                <div class="modal-body">
                  <center>
                  <h4> แก้ไขข้อมูลตัวแทนจำหน่วย : <b><?php echo $_POST['agent_shopname'];?></b> สำเร็จ</h4>
                  </center>
                </div>
                <div class="modal-footer">
                  <button id="successs" type="button" class="btn btn-success" data-dismiss="modal">ตกลง</button>
                </div>
              </div>
            </div>
          </div>
      <!-- Modal -->
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
                  <h4> แก้ไขข้อมูลตัวแทนจำหน่วย : <b><?php echo $_POST['agent_shopname'];?></b> ไม่สำเร็จ</h4>
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
                  มีข้อมูล <b><?php echo $_POST["agent_shopname"]; ?></b> อยู่แล้ว
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
       $(document).on('click', '#successs', function(){   
    		window.location.href="./customer.php"
    });  
      var str =document.getElementById("Postcode").text;
      console.log(str)
      var countimg=0;
      noselect=1;
     $(".imgAdd").click(function(){
        var text="";
            text=" <div class='form-group col-md-12'> <label for='inputState'></label><select id='select"+noselect+"' name='products_id[]'  class='form-control' value='"+noselect+"' onclick='updatepd("+noselect+")' > ";
            text+="<?php $sql ='SELECT * FROM product'; if($result = mysqli_query($con, $sql)){  while($row = mysqli_fetch_array($result)){ ?>"  
            text+="<option value='<?php echo $row['product_id']?>' price='<?php echo $row['product_wholesaleprice']?>'><?php echo $row['product_name']?></option> <?php }}?> </select> </div>"                       
                     
            $(this).closest(".row").find('.imgAdd').before(text);
            noselect+=1;
           
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
        

     $(document).on('click', '#editdata', function(){   
       
       var at_id = document.getElementById("editdata").getAttribute("value"); 
      document.getElementById("checkedata").innerHTML = at_id;
      $('#modaledits').modal('show');
      $(document).on('click', '#submit', function(event){  
         document.myform.submit();
     });  
    });  
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
  var textshow1="";
  var textshow2="";
 // Initialize select2
 $("#selUser").select2();

 // Read selected option
 $('#but_read').click(function(){
   var username =$('#selUser option:selected').text();
   console.log(username);
   var userid = $('#selUser').val();
   var price = $('#selUser option:selected').attr("price");
    textshow1 +="<input type='hidden' class='form-control' name='products_id[]' value="+userid+" readonly>";
    textshow1 +="<div class='form-control col-md-12'>"+username+"</div><br>";
    textshow2 +="<div class='form-control col-md-12 readonly' style='background-color: #e9ecef;'>"+price+"</div><br>";
   $('#result1').html(textshow1);
   $('#result2').html(textshow2);

 });
 $('#but_reset').click(function(){
   var username = $('#selUser option:selected').text();
   var userid = $('#selUser').val();
    textshow1 ="";
    textshow2 ="";
   $('#result1').html(textshow1);
   $('#result2').html(textshow2);

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