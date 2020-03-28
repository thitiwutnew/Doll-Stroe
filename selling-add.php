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
    <link href='./css/select2.min.css' rel='stylesheet' type='text/css'>
  </head>
  <body>
    <?php
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
     include('connect.php');
     $sqldataqurry = "SELECT * FROM selling";
     if($resultdataqurry = mysqli_query($con, $sqldataqurry)){
         $count = mysqli_num_rows($resultdataqurry);
         while($row = mysqli_fetch_array($resultdataqurry)){
             if(substr($row['sell_id'],5)==$count){
               $count++;
             }
         }
         if($count==0){$count++;}
         $id = "Sell_".$count;
         date_default_timezone_set('UTC');
         $Y = date("Y");
         $M = date("m");
         $D = date("d");
         $H = date("G")+7;
         $MI = date(":i:s");
         $datessql = $Y."-".$M."-".$D;
     }
      if(isset($_POST["add"])){
        $checkstatus=0;
        $checktrue=0;
        if($_POST["sell_id"]!=null){
                    $sql = "INSERT INTO selling (sell_id,sell_date,emp_id,cus_id,sell_delivery)
                    VALUES ('".$_POST["sell_id"]."','".$_POST["order_date"]."','".$_POST["emp_id"]."','".$_POST["cus_id"]."','".$_POST["pricedeli"]."')";

                    if ($con->query($sql) === TRUE) {
                        $checknum=0;
                       
                        for($i=0;$i<count($_POST["product_id"]);$i++)
                        {
                           if($_POST["product_id"][$i]!=null){
                                $sqlorder = "INSERT INTO selling_detail (sell_id,product_id,seld_amount,seld_price,seld_freeamount)
                                VALUES ('".$_POST["sell_id"]."','".$_POST["product_id"][$i]."','".$_POST["detail_amount"][$i]."','".$_POST["detail_price"][$i]."','".$_POST["amountpricefree"][$i]."')";
                                if ($con->query($sqlorder) === TRUE) {

                                    $sqlupdate = "SELECT * FROM product  WHERE product_id='".$_POST["product_id"][$i]."'";
                                    if($resultupdate = mysqli_query($con, $sqlupdate)){
                                    
                                        while($rowupdate = mysqli_fetch_array($resultupdate)){
                                          $amounts = $rowupdate['product_amount']-$_POST["detail_amount"][$i];
                                         
                                          $sqledit = "UPDATE product SET product_amount='".$amounts."'
                                          WHERE product_id='".$_POST["product_id"][$i]."'"; 
                                      
                                          if(mysqli_query($con, $sqledit)){ 
                                            $checknum+=1;
                                          }
                                          else{
                                            $checknum-=1;
                                          }
                                        }
                                    }
                                }
                                else { 
                                  $checknum-=1;
                                }
                                $checktrue+=1;
                                $countamount =$_POST["detail_amount"][$i];
                               
                              for($j=0;$j<$countamount;$j++)
                              {
                                  $countfree = $i+$j;
                                
                                  if($_POST["productfree"][$countfree]!=null){
                                    $sqlpromo = "INSERT INTO sell_promotion (sell_id,pro_id,productfree_id,product_id)
                                    VALUES ('".$_POST["sell_id"]."','".$_POST["pro_id"][$i]."','".$_POST["productfree"][$countfree]."','".$_POST["product_id"][$i]."')";
                                    if ($con->query($sqlpromo) === TRUE) {$checknum+=1;}
                                    else { $checknum-=1;}
                                    $checktrue+=1;
                                }
                                $countfree=0;
                              }
                           }

                        }
                        if($checktrue==$checknum){
                          echo '<script>window.location.href="./selling-add.php"</script>';
                        }
                        else{
                          echo '<script>
                          $(document).ready(function(){
                            $("#modalerror").modal("show");
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
              <h2 class="no-margin-bottom">เพิ่มข้อมูลการขายสินค้า</h2>
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
                      <label for="inputEmail4"><h3>ข้อมูลการขายสินค้า</h3></label>
                      <hr>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                            <label for="inputEmail4">รหัสรายละเอียดการขายสินค้า<b style="color:red;font-size:15px;">*</b></label>
                            <input type="text" class="form-control" name="sell_id" value="<?php echo $id;?>" readonly>
                            </div>
                            <div class="form-group col-md-4">
                            <label for="inputEmail4">วันที่ขายสินค้า <b style="color:red;font-size:15px;">*</b></label>
                            <input type="text" class="form-control" value="<?echo DateThai($datessql);?>" readonly>
                            <input type="hidden" name="order_date" value="<?php echo $datessql;?>">
                            </div>
                            <div class="form-group col-md-4">
                            <label for="inputEmail4">พนักงาน <b style="color:red;font-size:15px;">*</b></label>
                            <input type="text" class="form-control" value="<?php echo $_SESSION['login_user'];?>" readonly>
                            <input type="hidden" name="emp_id" value="<?php echo $_SESSION['user_id'];?>">
                            </div>
                            <div class="form-group col-md-4">
                            <label for="inputEmail4">การจัดส่ง <b style="color:red;font-size:15px;">*</b></label>
                            <select name="" id="delivery" class="select form-control"  style="color:#000;    font-size: 20px;">
                              <option value="0"  style="color:#000;">จัดส่งฟรี</option>
                              <option value="1"  style="color:#000;">เสียค่าจัดส่ง</option>
                            </select>
                            </div>
                            <div class="form-group col-md-4">
                            <label for="inputEmail4">ราคาจัดส่ง (บาท)<b style="color:red;font-size:15px;"></b></label>
                              <input type="text" class="form-control" id="pricedeli" name="pricedeli">
                            </div>
                        </div>
                        <hr>
                        <label for="inputEmail4"><h3>เลือกลูกค้า <b style="color:red;font-size:15px;">*</b></h3></label>
                        <select id="agent" name="cus_id"  class="select form-control" style="margin-block-end: 35px;">
                                      <?php
                                      include('connect.php');
                                      $sql = "SELECT * FROM customer
                                      JOIN prefix ON  customer.prefix_id = prefix.prefix_id";
                                      if($result = mysqli_query($con, $sql)){
                                          while($row = mysqli_fetch_array($result)){
                                          ?>
                                          <option name="agent_id" value="<?php echo $row['cus_id']?>"><?php echo $row['prefix_name']." ".$row['cus_firstname']."  ".$row['cus_lastname']?></option>
                                      <?php }}?>
                              </select>
                              <hr>
                          <label for="inputEmail4"><h3>เลือกสินค้า ,สินค้าเซต <b style="color:red;font-size:15px;">*</b></h3></label>
                          <div class="form-row">
                            <div class="col-md-8" style="margin-top: 5px;">
                                <select id="product"   class="select form-control" style="margin-block-end: 35px;margin-Top: 35px;">
                                      <?php
                                      include('connect.php');
                                      $sql = "SELECT * FROM product";
                                      if($result = mysqli_query($con, $sql)){
                                          while($row = mysqli_fetch_array($result)){
                                          ?>
                                          <option  idpd="<?php echo $row['product_id']?>" value="<?php echo $row['product_id']?>" price="<?php echo $row['product_saleprice']?>"><?php echo $row['product_name']?></option>
                                      <?php }}?>
                                      <?php
                                      include('connect.php');
                                      $sql = "SELECT * FROM setproduct";
                                      if($result = mysqli_query($con, $sql)){
                                          while($row = mysqli_fetch_array($result)){
                                          ?>
                                          <option idpd="<?php echo $row['set_id']?>" name="agent_id" value="<?php echo $row['set_id']?>" price="<?php echo $row['set_price']?>"><?php echo $row['set_name']?></option>
                                      <?php }}?>
                              </select>
                            </div>
                            <div class="col-md-4">
                            <input type='button' value='เลือกสินค้า' class='btn btn-success' id='but_read'> <input type='button' value='ลบสินค้า' class='btn btn-danger' id='but_reset'>
                            </div>
                          </div>
                          <br>
                        <div class="form-row" style="    background-color: #525252; color: #fff;padding-top: 20px;">
                          <div class="form-group col-md-1 text-center">ลำดับ  </div>
                          <div class="form-group col-md-3 text-center">ชื่อสินค้า  </div>
                          <div class="form-group col-md-1">จำนวนสินค้า </div>
                          <div class="form-group col-md-1 text-right">ราคา (บาท)</div>
                          <div class="form-group col-md-1 text-right">ราคารวม (บาท)</div>
                          <div class="form-group col-md-1 text-center">ของแถม</div>
                          <div class="form-group col-md-2 text-center">เลือกสินค้าแถม</div>
                          <div class="form-group col-md-2">ชื่อโปรโมชั่น</div>
                        </div>
                        <p id='result'></p>
                        <div   class="form-row">
                        <div class="form-group col-md-8">  </div>
                          <div class="form-group col-md-2">จำนวนรวม (บาท) <input type="text" id="amounttotal" class="form-control" readonly></div>
                          <div class="form-group col-md-2">ราคารวมทั้งหมด (บาท)<input type="text" id="pricetotles" class="form-control" readonly></div>
                        </div>
                        </div>
                        <hr>
                        <div class="form-row" style="margin-top: 25px;">
                          <div class="form-group col-md-12">
                            <center>
                              <a href="selling.php" class="adddata btn btn-info text-center">ย้อนกลับ</a>
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
                  <h4> เพิ่มข้อมูลการสั่งซื้อ : <b><?php echo $_POST['prefix_name'];?></b> ไม่สำเร็จ</h4>
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
    <script type="text/javascript" src="./js/select2.min.js" ></script>
  </body>
  <script>
  $('#delivery').ready(function() {
    var username =$('#delivery option:selected').val();
    if(username==1){
      document.getElementById("pricedeli").removeAttribute("disabled");
    }
    else{
      document.getElementById("pricedeli").setAttribute("disabled","true");
    }
      
  });
  $('#delivery').change(function() {
    var username =$('#delivery option:selected').val();
    if(username==1){
      document.getElementById("pricedeli").removeAttribute("disabled");
     
    }
    else{
      document.getElementById("pricedeli").setAttribute("disabled","true");
    }
      
});
   let checkidpd =0;
   var totaldiscount=0;
   let amountpromotion =0;
   let countno=1;
   let pricetotal =[];
   $("#agent").select2();
   $("#product").select2();
   $("#promotion").select2();
   var data;
   var countpd=1;
   var proname="";
   var textshow="";
   var checkproname="0";
    $('#promotion').change(function() {
      var textshowsss="";
      let countnoss=0;
      var username =$('#promotion option:selected').val();
      var proname =$('#promotion option:selected').text();
      var price = $('#promotion option:selected').attr("price");
  
          if(username!=0){
            for(i=0;i<pricetotal.length;i++){
                if(pricetotal[i]==price){
                  countnoss+=1;
                }
            }
            if(countnoss!=0 && proname!=checkproname ){
              countnoss=0;
              for(i=1;i<=countno;i++){
                var idpd = '#pricepd'+i;
                var pricepd = $(idpd).val();
                var amountpd ='#amountpd'+i;
                var amountpds = $(amountpd).val();
                if(price==pricepd){
                  countnoss +=parseInt(amountpds);
              
                }
            }
              textshowsss="<div class='col-md-12' style='margin-top:10px;'><div class='form-group  text-center col-md-12' style='margin-bottom: -3px;    font-weight: 900;font-size: 20px;'>"+proname+"<hr></div>"
              textshowsss  +="<div class='form-row'><div class='col-md-4' ><b class='text-left'>เลือกสินค้าแถมฟรี</b><br><select id='productfree'   class='select form-control' name='productfree' style='margin-block-end: 35px;' multiple>"
              textshowsss    +=""+<?php include('connect.php'); $sql = 'SELECT * FROM product'; ?>"+"
              textshowsss      +=" "+<?php if($result = mysqli_query($con, $sql)){ ?>"+"
                textshowsss        +=""+          <?php while($row = mysqli_fetch_array($result)){ ?>"+"
                  textshowsss         +="<option  idpd='<?php echo $row['product_id']?>' value='<?php echo $row['product_id']?>' price='<?php echo $row['product_saleprice']?>'><?php echo $row['product_name']?></option>"
                  textshowsss             +=""+ <?php }}?>"+"
                  textshowsss      +="</select></div>"
                  textshowsss+="<div class='col-md-1'></div><div class='col-md-2 text-right'>"
                  textshowsss+="<b class='text-right'>จำนวนของแถม (ชิ้น)</b><input type='number' class='form-control text-right' id='amountpd"+countpd+"' name='amountfree' placeholder='กรอกข้อมูล' max='"+countnoss+"' value='"+countnoss+"' required onchange='updatepd("+countpd+")'></div> "
                  textshowsss+="</div>"
            }

            $('#resultss').html(textshowsss);
              $("#productfree").select2();
            checkproname =proname;
          }
   })
   var  checkarraydata =null
  $('#but_read').click(function(){
        var username =$('#product option:selected').text();
        var userid = $('#product').val();
        var price = $('#product option:selected').attr("price");
        pricetotal.push(price)
        var priceshow = $('#product option:selected').attr("price").toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
        var idpd = $('#product option:selected').attr("idpd");
        $.ajax({
			  url: "./getpromotion.php",
			  global: false,
			  type: "GET",
			  data: ({price : price}),
			  dataType: "JSON", 
			  async:false,
			  success: function(jd) { 
              checkarraydata =jd;
              if(jd!=0){
                $.each(jd, function(key, val){
              if(idpd != checkidpd){
              textshow+="<div  class='form-row' style='margin-top:10px;margin-block-end: -15px;'><div class='form-group  text-center col-md-1'>"+countno+"</div>"
              textshow+="<div class='form-group  text-center col-md-3'>"
              textshow+=""+username+" <input type='hidden' class='form-control' name='product_id[]' value='"+userid+"' >"
              textshow+="</div><div class='form-group col-md-1'>"
              textshow+="<input type='number' class='form-control text-right' id='amountpd"+countpd+"' name='detail_amount[]' placeholder='กรอกข้อมูล' value='0' required onchange='updatepd("+countpd+")'></div> "
              textshow+="<div class='form-group col-md-1 text-right'>"
              textshow+=""+priceshow+" <input type='hidden' id='pricepd"+countpd+"' class='form-control ' name='detail_price[]' value='"+price+"' ></div>"
              textshow+="<div class='form-group col-md-1'>"
              textshow+="<input type='text' class='form-control text-right' id='topd"+countpd+"' name='totalprice[]' placeholder='กรอกข้อมูล' value='0' readonly></div>"

              textshow+="<div class='form-group col-md-1'>"
              textshow+="<input type='text' class='form-control text-right' id='amountfree"+countpd+"' name='amountpricefree[]' placeholder='กรอกข้อมูล' value='0' readonly></div>"
              textshow+="<div class='form-group col-md-2 text-center' style='margin-top: 6px;'><select id='productfree"+countpd+"'  class='select form-group' name='productfree[]' multiple>"
              textshow+=""+<?php include('connect.php'); $sql = 'SELECT * FROM product WHERE product_name LIKE "%20_เซนติเมตร%" OR product_name LIKE "%20 ซม%" '; ?>"+"
              textshow+=" "+<?php if($result = mysqli_query($con, $sql)){ ?>"+"
              textshow+=""+<?php while($row = mysqli_fetch_array($result)){ ?>"+"
              textshow+="<option  idpd='<?php echo $row['product_id']?>' value='<?php echo $row['product_id']?>' price='<?php echo $row['product_saleprice']?>'><?php echo $row['product_name']?></option>"
              textshow+=""+ <?php }}?>"+"
              textshow+="</select></div>"
              textshow+="<div class='form-group col-md-2'>"
              textshow+="<input type='hidden' class='form-control' name='pro_id[]' placeholder='กรอกข้อมูล' value='"+val['pro_id']+"' readonly>"
              textshow+="<input type='text' class='form-control' id='nameprofree"+countpd+"' name='pro_name[]' placeholder='กรอกข้อมูล' value='"+val['pro_name']+"' readonly></div></div><hr>"
           
              $('#product option:selected').prop('disabled', ! $('#product option:selected').prop('disabled'));
              $('#product').select2();
              $('#result').html(textshow);
              countpd+=1;
              checkidpd=idpd;
              countno+=1;
              }
            });
            }
            else{
              if(idpd != checkidpd){
              textshow+="<div  class='form-row' style='margin-top:10px;margin-block-end: -15px;'><div class='form-group  text-center col-md-1'>"+countno+"</div>"
              textshow+="<div class='form-group  text-center col-md-3'>"
              textshow+=""+username+" <input type='hidden' class='form-control' name='product_id[]' value='"+userid+"' >"
              textshow+="</div><div class='form-group col-md-1'>"
              textshow+="<input type='number' class='form-control text-right' id='amountpd"+countpd+"' name='detail_amount[]' placeholder='กรอกข้อมูล' value='0' required onchange='updatepd("+countpd+")'></div> "
              textshow+="<div class='form-group col-md-1 text-right'>"
              textshow+=""+priceshow+" <input type='hidden' id='pricepd"+countpd+"' class='form-control ' name='detail_price[]' value='"+price+"' ></div>"
              textshow+="<div class='form-group col-md-1'>"
              textshow+="<input type='text' class='form-control text-right' id='topd"+countpd+"' name='totalprice[]' placeholder='กรอกข้อมูล' value='0' readonly></div>"

              textshow+="<div class='form-group col-md-1'>"
              textshow+="<input type='text' class='form-control text-right' id='amountfree"+countpd+"' placeholder='กรอกข้อมูล' value='-' readonly></div>"
              textshow+="<div class='form-group col-md-2'>"
              textshow+="<input type='text' class='form-control'  placeholder='กรอกข้อมูล' value='-' readonly></div>"
              textshow+="<div class='form-group col-md-2'>"
              textshow+="<input type='text' class='form-control' placeholder='กรอกข้อมูล' value='-' readonly></div></div><hr>"
              countpd+=1;
              $('#product option:selected').prop('disabled', ! $('#product option:selected').prop('disabled'));
              $('product').select2();
              $('#result').html(textshow);
              checkidpd=idpd;
              countno+=1;
              }
            }
          }
        });
        for(i=1;i<=countpd;i++){
          var productfree = "#productfree"+i;
              
              $(productfree).select2();
      }
    });
    $('#but_reset').click(function(){
         window.location.href="./selling-add.php"
    });
var pricetotalpd=0;
function updatepd(a){
    if(a==0){
        if(data.length==0){
            totaldiscount=0;
        }
        else{
             totaldiscount=0;
            for(i=0;i<data.length;i++){
                
            var prices = data[i].value
            prices =parseInt(prices);
            totaldiscount+=prices;
            
        }
        }
        var numamount=0;
                var totalanumamount=0;
                var numprice=0;
                var totalnumprice=0;
        for(i=1;i<=(countpd-1);i++){
            
            numamount='#amountpd'+i;
            numprice='#topd'+i;
            totalanumamount += parseInt($( numamount ).val(), 10);
            textnumprice = $( numprice ).val();
                                        for(u=0;u<textnumprice.length;u++){
                                            let font=0;
                                            let end=0;
                                            if(textnumprice[u] == ","){
                                            font=textnumprice.substring(0,u);
                                            end=textnumprice.substring(u+1);
                                            textnumprice = font+end;
                                            }
                                        }
                                        totalnumprice += parseInt(textnumprice);

            }
            totalnumprice = totalnumprice-totaldiscount;
           
        totalanumamount= totalanumamount.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
        totalnumprice= totalnumprice.toString().toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
        document.getElementById("amounttotal").value = totalanumamount;
        document.getElementById("pricetotles").value = totalnumprice;
      
    }
    else{
        var idpd = '#pricepd'+a;
        var pricepd = $(idpd).val();
        var amountpd ='#amountpd'+a;
        var amountpds = $(amountpd).val();
        var nameprofree ='#nameprofree'+a;
        var nameprofree = $(nameprofree).val();
        var pricetotle = 'topd'+a;
        var amountfree = 'amountfree'+a;
        pricetotalpd = amountpds*pricepd;
        pricetotalpd = pricetotalpd.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
        var textnumprice=0;
            document.getElementById(pricetotle).value = pricetotalpd;
           
            if(nameprofree!=undefined){
              document.getElementById(amountfree).value = amountpds;
            }
           
            var numamount=0;
                var totalanumamount=0;
                var numprice=0;
                var totalnumprice=0;
            for(i=1;i<=(countpd-1);i++){
            
                numamount='#amountpd'+i;
                numprice='#topd'+i;
                totalanumamount += parseInt($( numamount ).val(), 10);
                textnumprice = $( numprice ).val();
                                            for(u=0;u<textnumprice.length;u++){
                                                let font=0;
                                                let end=0;
                                                if(textnumprice[u] == ","){
                                                font=textnumprice.substring(0,u);
                                                end=textnumprice.substring(u+1);
                                                textnumprice = font+end;
                                                }
                                            }
                                            totalnumprice += parseInt(textnumprice);

                }
            totalnumprice = totalnumprice-totaldiscount;
        totalanumamount= totalanumamount.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
        totalnumprice= totalnumprice.toString().toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
        document.getElementById("amounttotal").value = totalanumamount;
        document.getElementById("pricetotles").value = totalnumprice;
            }
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
