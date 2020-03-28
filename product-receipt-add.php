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
     $sqldataqurry = "SELECT * FROM receive";
     if($resultdataqurry = mysqli_query($con, $sqldataqurry)){
         $count = mysqli_num_rows($resultdataqurry);
         while($row = mysqli_fetch_array($resultdataqurry)){
             if(substr($row['receive_id'],2)==$count){
               $count++;
             }
         }
         if($count==0){$count++;}
         $id = "RE".$count;
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
        if($_POST["order_id"]!=null){
                    $sql = "INSERT INTO receive (receive_id,received_date,emp_id,order_id)
                    VALUES ('".$_POST["order_id"]."','".$_POST["order_date"]."','".$_POST["emp_id"]."','".$_POST["agent_id"]."')";

                    if ($con->query($sql) === TRUE) {
                        $checknum=0;
                        for($i=0;$i<count($_POST["product_id"]);$i++)
                        {
                         
                            $sqlorder = "INSERT INTO details_receive (receive_id,product_id,detail_receive_amount)
                            VALUES ('".$_POST["order_id"]."','".$_POST["product_id"][$i]."','".$_POST["detail_amount"][$i]."')";
                            if ($con->query($sqlorder) === TRUE) {

                              $sqlupdate = "SELECT * FROM product  WHERE product_id='".$_POST["product_id"][$i]."'";
                              if($resultupdate = mysqli_query($con, $sqlupdate)){
                                  while($rowupdate = mysqli_fetch_array($resultupdate)){
                                    $amounts = $rowupdate['product_amount']+$_POST["detail_amount"][$i];
                                    $sqledit = "UPDATE product SET product_amount='".$amounts."' WHERE product_id='".$_POST["product_id"][$i]."'"; 
                                    if(mysqli_query($con, $sqledit)){ 
                                      $checknum+=1;
                                    }
                                    else{
                                      $checknum-=1;
                                    }
                                  }
                              }
                             
                            }
                            else { $checknum-=1;}
                            $checktrue+=1;
                           

                        }
                        if($checktrue==$checknum){
                          echo '<script>window.location.href="./product-receipt.php"</script>';
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
              <h2 class="no-margin-bottom">เพิ่มข้อมูลการรับสินค้า</h2>
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
                      <label for="inputEmail4"><h3>ข้อมูลการรับสินค้า</h3></label>
                      <hr>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                            <label for="inputEmail4">รหัสการรับสินค้า <b style="color:red;font-size:15px;">*</b></label>
                            <input type="text" class="form-control" name="order_id" value="<?php echo $id;?>" readonly>
                            </div>
                            <div class="form-group col-md-4">
                            <label for="inputEmail4">วันที่การรับสินค้า <b style="color:red;font-size:15px;">*</b></label>
                            <input type="text" class="form-control" value="<?echo DateThai($datessql);?>" readonly>
                            <input type="hidden" name="order_date" value="<?php echo $datessql;?>">
                            </div>
                            <div class="form-group col-md-4">
                            <label for="inputEmail4">พนักงาน <b style="color:red;font-size:15px;">*</b></label>
                            <input type="text" class="form-control" value="<?php echo $_SESSION['login_user'];?>" readonly>
                            <input type="hidden" name="emp_id" value="<?php echo $_SESSION['user_id'];?>">
                            </div>
                        </div>
                        <hr>
                        <label for="inputEmail4"><h3>รหัสการสั่งซื้อสินค้า <b style="color:red;font-size:15px;">*</b></h3></label>
                        <br>
                              <select id="agent" name="agent_id"  class="form-control" style="width: 40%;" >
                                      <?php 
                                      include('connect.php');
                                      $sql = "SELECT * FROM ordering Where order_status!=1 && order_status!=2 && order_status!=2";
                                      $order_product=[];
                                      $order_products=[];
                                      $pick_up_order_product=[];
                                      if($result = mysqli_query($con, $sql)){
                                          while($row = mysqli_fetch_array($result)){
                                            array_push($order_product, $row['order_id']);
                                           
                                          }}
                                         
                                          for($i=0;$i<=count($order_product);$i++){
                                            if($order_product[$i] !=null){ 
                                          ?>
                                          <option id="<?php echo $order_product[$i] ?>"  value="<?php echo $order_product[$i] ?>" ><?php  echo $order_product[$i]?></option>
                                                <?php }} ?>
                              </select>
                              <hr>
                        <div class="form-row" style="    background-color: #525252; color: #fff;padding-top: 20px;">
                          <div class="form-group col-md-1 text-center">ลำดับ  </div>
                          <div class="form-group col-md-5 text-center">ชื่อสินค้า  </div>
                          <div class="form-group col-md-2 text-center">จำนวนการสั่งซื้อ </div>
                          <div class="form-group col-md-2 text-right">จำนวนที่รับสินค้าแล้ว</div>
                          <div class="form-group col-md-2 text-center">จำนวนการรับสินค้า </div>
                        </div>
                        <p id="result"></p>
                       
                        </div>
                      
                        <div class="form-row" style="margin-top: 25px;">
                          <div class="form-group col-md-12">
                            <center>
                              <a href="product-receipt.php" class="adddata btn btn-info text-center">ย้อนกลับ</a>
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
   let checkidpd =1;
   $("#agent").select2();
  var countpd=0;
$('#agent').ready(function(){
  var id=$('#agent').val();
		$("#result").empty();//ล้างข้อมูล
        textshow="";
		$.ajax({
			  url: "./getorder.php",//ที่อยู่ของไฟล์เป้าหมาย
			  global: false,
			  type: "GET",//รูปแบบข้อมูลที่จะส่ง
        data: ({ID : id}),
			  dataType: "JSON", //รูปแบบข้อมูลที่ส่งกลับ xml,script,json,jsonp,text
			  async:false,
			  success: function(jd) { //แสดงข้อมูลเมื่อทำงานเสร็จ โดยใช้ each ของ jQuery
				var opt="";
        var  productorder =[];
        var displaytext=[];
        var checkidpd =1;
		$.each(jd, function(key, val){
      let Amount=0;
              
              if(val['Amount']==undefined){
                Amount=0;
              }
              else{
                Amount=val['Amount'];
              }
             
                  let sumamount =0;
                if(val['detail_amount']==Amount){
                  textshow="";
                  sumamount = val['detail_amount']-Amount
                          textshow+="<div  class='form-row' style='margin-top:10px;'><div class='form-group  text-center col-md-1'>"+checkidpd+"</div>"
                          textshow+="<div class='form-group  text-center col-md-5'>"
                          textshow+=""+val['product_name']+" <input type='hidden' class='form-control' name='product_id[]' value='"+val['product_id']+"' >"
                          textshow+="</div><div class='form-group col-md-2 text-center'>"
                          textshow+="<input type='number' class='form-control text-right' id='pricepd"+checkidpd+"'  placeholder='กรอกข้อมูล' value='"+val['detail_amount']+"' readonly > "
                          textshow+="</div><div class='form-group col-md-2 text-right'><input type='number' class='form-control text-right' id='pricepd"+checkidpd+"'  placeholder='กรอกข้อมูล' value='"+Amount+"' readonly > </div><div class='form-group col-md-2 text-right'>"
                          textshow+="<input type='text' class='form-control text-right' id='amountpd"+checkidpd+"' name='detail_amount[]' placeholder='กรอกข้อมูล' value='รับสินค้าครบแล้ว ' readonly></div> "
                          textshow+="</div><hr>"
                          checkidpd+=1;
                          countpd+=1;
                          productorder.push(val['product_id']);
                          displaytext.push(textshow);
                }
                else{
                  textshow="";
                  sumamount = val['detail_amount']-Amount
                  textshow+="<div  class='form-row' style='margin-top:10px;'><div class='form-group  text-center col-md-1'>"+checkidpd+"</div>"
                          textshow+="<div class='form-group  text-center col-md-5'>"
                          textshow+=""+val['product_name']+" <input type='hidden' class='form-control' name='product_id[]' value='"+val['product_id']+"' >"
                          textshow+="</div><div class='form-group col-md-2 text-center'>"
                          textshow+="<input type='number' class='form-control text-right'  placeholder='กรอกข้อมูล' value='"+val['detail_amount']+"' readonly ><input type='hidden' class='form-control text-right' id='pricepd"+checkidpd+"'  placeholder='กรอกข้อมูล' value='"+sumamount+"' readonly > "
                          textshow+="</div><div class='form-group col-md-2 text-right'><input type='number' class='form-control text-right' id='pricepd"+checkidpd+"'  placeholder='กรอกข้อมูล' value='"+Amount+"' readonly > </div><div class='form-group col-md-2 text-right'>"
                          textshow+="<input type='text' class='form-control text-right' id='amountpd"+checkidpd+"' name='detail_amount[]' placeholder='กรอกข้อมูล' value='"+sumamount+"' required onkeyup='updatepd("+checkidpd+")'></div> "
                          textshow+="</div><hr>"
                          checkidpd+=1;
                          countpd+=1;
                          productorder.push(val['product_id']);
                          displaytext.push(textshow);
                }
               	});
               
                  var textdistext="";
                    for(i=0;i< displaytext.length;i++){
                      textdistext+=displaytext[i]
                    }
                    $('#result').html(textdistext);
		   	  }
		});
      });
      $('#agent').change(function(){
        var id=$('#agent').val();
		$("#result").empty();//ล้างข้อมูล
        textshow="";
		$.ajax({
			  url: "./getorder.php",//ที่อยู่ของไฟล์เป้าหมาย
			  global: false,
			  type: "GET",//รูปแบบข้อมูลที่จะส่ง
        data: ({ID : id}),
			  dataType: "JSON", //รูปแบบข้อมูลที่ส่งกลับ xml,script,json,jsonp,text
			  async:false,
			  success: function(jd) { //แสดงข้อมูลเมื่อทำงานเสร็จ โดยใช้ each ของ jQuery
				var opt="";
        var  productorder =[];
        var displaytext=[];
        var checkidpd =1;
		$.each(jd, function(key, val){
              let Amount=0;
              
              if(val['Amount']==undefined){
                Amount=0;
              }
              else{
                Amount=val['Amount'];
              }
             
                  let sumamount =0;
                if(val['detail_amount']==Amount){
                  textshow="";
                  sumamount = val['detail_amount']-Amount
                          textshow+="<div  class='form-row' style='margin-top:10px;'><div class='form-group  text-center col-md-1'>"+checkidpd+"</div>"
                          textshow+="<div class='form-group  text-center col-md-5'>"
                          textshow+=""+val['product_name']+" <input type='hidden' class='form-control' name='product_id[]' value='"+val['product_id']+"' >"
                          textshow+="</div><div class='form-group col-md-2 text-center'>"
                          textshow+="<input type='number' class='form-control text-right' id='pricepd"+checkidpd+"'  placeholder='กรอกข้อมูล' value='"+val['detail_amount']+"' readonly > "
                          textshow+="</div><div class='form-group col-md-2 text-right'><input type='number' class='form-control text-right' id='pricepd"+checkidpd+"'  placeholder='กรอกข้อมูล' value='"+Amount+"' readonly > </div><div class='form-group col-md-2 text-right'>"
                          textshow+="<input type='text' class='form-control text-right' id='amountpd"+checkidpd+"' name='detail_amount[]' placeholder='กรอกข้อมูล' value='รับสินค้าครบแล้ว ' readonly></div> "
                          textshow+="</div><hr>"
                          checkidpd+=1;
                          countpd+=1;
                          productorder.push(val['product_id']);
                          displaytext.push(textshow);
                }
                else{
                  textshow="";
                  sumamount = val['detail_amount']-Amount
                  textshow+="<div  class='form-row' style='margin-top:10px;'><div class='form-group  text-center col-md-1'>"+checkidpd+"</div>"
                          textshow+="<div class='form-group  text-center col-md-5'>"
                          textshow+=""+val['product_name']+" <input type='hidden' class='form-control' name='product_id[]' value='"+val['product_id']+"' >"
                          textshow+="</div><div class='form-group col-md-2 text-center'>"
                          textshow+="<input type='number' class='form-control text-right'  placeholder='กรอกข้อมูล' value='"+val['detail_amount']+"' readonly ><input type='hidden' class='form-control text-right' id='pricepd"+checkidpd+"'  placeholder='กรอกข้อมูล' value='"+sumamount+"' readonly > "
                          textshow+="</div><div class='form-group col-md-2 text-right'><input type='number' class='form-control text-right' id='pricepd"+checkidpd+"'  placeholder='กรอกข้อมูล' value='"+Amount+"' readonly > </div><div class='form-group col-md-2 text-right'>"
                          textshow+="<input type='text' class='form-control text-right' id='amountpd"+checkidpd+"' name='detail_amount[]' placeholder='กรอกข้อมูล' value='"+sumamount+"' required onkeyup='updatepd("+checkidpd+")'></div> "
                          textshow+="</div><hr>"
                          checkidpd+=1;
                          countpd+=1;
                          productorder.push(val['product_id']);
                          displaytext.push(textshow);
                }
               	});
               
                  var textdistext="";
                    for(i=0;i< displaytext.length;i++){
                      textdistext+=displaytext[i]
                    }
                    $('#result').html(textdistext);
		   	  }
		});
      });
  </script>
  <script>
    function updatepd(i){
        amount = "#pricepd"+i;
        amountpd = "#amountpd"+i;
        var valueamount=$(amount).val();
        valueamount = parseInt(valueamount)
        var valueamountpd=$(amountpd).val();
        valueamountpd = parseInt(valueamountpd)
        if(valueamountpd>valueamount){
         
            document.getElementById('amountpd'+i).value = valueamount;
        }
        else if(valueamountpd<0){
          
            document.getElementById('amountpd'+i).value = 0;
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
