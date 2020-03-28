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
     $sqldataqurry = "SELECT * FROM Ordering";
     if($resultdataqurry = mysqli_query($con, $sqldataqurry)){
         $count = mysqli_num_rows($resultdataqurry);
         while($row = mysqli_fetch_array($resultdataqurry)){
             if(substr($row['order_id'],2)==$count){
               $count++;
             }
         }
         if($count==0){$count++;}
         $id = "OD".$count;
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
        if($_POST["order_id"]!=null){
                    $sql = "INSERT INTO ordering (order_id,order_date,emp_id,agent_id)
                    VALUES ('".$_POST["order_id"]."','".$_POST["order_date"]."','".$_POST["emp_id"]."','".$_POST["agent_id"]."')";

                    if ($con->query($sql) === TRUE) {
                        $checknum=0;
                        for($i=0;$i<count($_POST["product_id"]);$i++)
                        {
                           if($_POST["detail_amount"][$i]!=0){
                            $sqlorder = "INSERT INTO order_detail (order_id,product_id,detail_amount,detail_price)
                            VALUES ('".$_POST["order_id"]."','".$_POST["product_id"][$i]."','".$_POST["detail_amount"][$i]."','".$_POST["detail_price"][$i]."')";
                            if ($con->query($sqlorder) === TRUE) {$checknum+=1;}
                            else { $checknum-=1;}
                            $checktrue+=1;
                           }

                        }
                        if($checktrue==$checknum){
                          echo '<script>window.location.href="./order.php"</script>';
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
              <h2 class="no-margin-bottom">เพิ่มข้อมูลการสั่งซื้อสินค้า</h2>
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
                      <label for="inputEmail4"><h3>ข้อมูลการสั่งซื้อสินค้า</h3></label>
                      <hr>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                            <label for="inputEmail4">รหัสสั่งซื้อสินค้า <b style="color:red;font-size:15px;">*</b></label>
                            <input type="text" class="form-control" name="order_id" value="<?php echo $id;?>" readonly>
                            </div>
                            <div class="form-group col-md-4">
                            <label for="inputEmail4">วันที่สั่งซื้อสินค้า <b style="color:red;font-size:15px;">*</b></label>
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
                        <label for="inputEmail4"><h3>เลือกตัวแทนจำหน่าย <b style="color:red;font-size:15px;">*</b></h3></label>
                        <select id="agent" name="agent_id"  class="select form-control" style="margin-block-end: 35px;">
                                      <?php
                                      include('connect.php');
                                      $sql = "SELECT * FROM agent";
                                      if($result = mysqli_query($con, $sql)){
                                          while($row = mysqli_fetch_array($result)){
                                          ?>
                                          <option name="agent_id" value="<?php echo $row['agent_id']?>"><?php echo $row['agent_shopname']?></option>
                                      <?php }}?>
                              </select>
                              <hr>
                          <label for="inputEmail4"><h3>สินค้าตัวแทนจำหน่าย <b style="color:red;font-size:15px;">*</b></h3></label>
                            <div id="selectpdagant" style="margin-top:15px;"></div>
                        <div class="form-row" style="    background-color: #525252; color: #fff;padding-top: 20px;">
                          <div class="form-group col-md-1 text-center">ลำดับ  </div>
                          <div class="form-group col-md-5 text-center">ชื่อสินค้า  </div>
                          <div class="form-group col-md-2">ราคา (บาท)</div>
                          <div class="form-group col-md-2">จำนวนการสั่งซื้อ </div>
                          <div class="form-group col-md-2">ราคารวม (บาท)</div>
                        </div>
                        <p id='result'></p>
                        <div   class="form-row">
                          <div class="form-group col-md-6"></div>
                          <div class="form-group col-md-2">  </div>
                          <div class="form-group col-md-2">จำนวนรวม (บาท) <input type="text" id="amounttotal" class="form-control" readonly></div>
                          <div class="form-group col-md-2">ราคารวมทั้งหมด (บาท)<input type="text" id="pricetotles" class="form-control" readonly></div>
                        </div>
                        </div>
                        <hr>
                        <div class="form-row" style="margin-top: 25px;">
                          <div class="form-group col-md-12">
                            <center>
                              <a href="order.php" class="adddata btn btn-info text-center">ย้อนกลับ</a>
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
   let checkidpd =0;
   $("#agent").select2();
  var countpd=0;
    $('#agent').ready(function(){
      var id=$('#agent').val();
      $("#selectpdagant").empty();//ล้างข้อมูล
      $.ajax({
          url: "./getagant.php",//ที่อยู่ของไฟล์เป้าหมาย
          global: false,
          type: "GET",//รูปแบบข้อมูลที่จะส่ง
          data: ({ID : id}), //ข้อมูลที่ส่ง  { ชื่อตัวแปร : ค่าตัวแปร }
          dataType: "JSON", //รูปแบบข้อมูลที่ส่งกลับ xml,script,json,jsonp,text
          async:false,
          success: function(jd) { //แสดงข้อมูลเมื่อทำงานเสร็จ โดยใช้ each ของ jQuery
                var opt="";
                document.getElementById("amounttotal").value = 0;
          document.getElementById("pricetotles").value = 0;
            opt+="<div class='form-group col-md-12'> <select id='selUser' class='select' style='width:50%;'>"
                $.each(jd, function(key, val){
                    opt+="<option value='"+val['product_id']+"' price='"+val['product_saleprice']+"' idpd='"+val['product_id']+"'> "+val['product_name']+"</option>";
                  countpd+=1;
                  });
                  opt+="</select>";
                  opt+="<input type='button' value='เลือกสินค้า' class='btn btn-success' id='but_read'><input type='button' value='ลบสินค้า' class='btn btn-danger' id='but_reset'></div>";
                $("#selectpdagant").html( opt );//เพิ่มค่าลงใน Select ของอำเภอ
            }
      });
      let countno=1;
      var textshow="";
      countpd=0;
      $(document).ready(function(){
      // Initialize select2
      $("#selUser").select2();
      // Read selected option
          $('#but_read').click(function(){

            var username =$('#selUser option:selected').text();
            var userid = $('#selUser').val();
            var price = $('#selUser option:selected').attr("price");
            var priceshow = $('#selUser option:selected').attr("price").toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
            var idpd = $('#selUser option:selected').attr("idpd");
        if(idpd != checkidpd){
          textshow+="<div  class='form-row' style='margin-top:10px;'><div class='form-group  text-center col-md-1'>"+countno+"</div>"
          textshow+="<div class='form-group  text-center col-md-5'>"
        textshow+=""+username+" <input type='hidden' class='form-control' name='product_id[]' value='"+userid+"' >"
        textshow+="</div><div class='form-group col-md-2'>"
        textshow+=""+priceshow+" <input type='hidden' id='pricepd"+countpd+"' class='form-control' name='detail_price[]' value='"+price+"' >"
        textshow+="</div><div class='form-group col-md-2'>"
        textshow+="<input type='number' class='form-control' id='amountpd"+countpd+"' name='detail_amount[]' placeholder='กรอกข้อมูล' value='0' required onclick='updatepd("+countpd+")'></div> "
        textshow+="<div class='form-group col-md-2'>"
        textshow+="<input type='text' class='form-control' id='topd"+countpd+"' name='totalprice[]' placeholder='กรอกข้อมูล' value='0' readonly></div></div><hr>"
        countpd+=1;
        $('#selUser option:selected').prop('disabled', ! $('#selUser option:selected').prop('disabled'));
            $('selUser').select2();
          $('#result').html(textshow);
          checkidpd=idpd;
          countno+=1;
        }
          });
        $('#but_reset').click(function(){
          window.location.href="./order-add.php"
        });
      });
});
$('#agent').change(function(){
  var id=$('#agent').val();
		$("#selectpdagant").empty();//ล้างข้อมูล
		$.ajax({
			  url: "./getagant.php",//ที่อยู่ของไฟล์เป้าหมาย
			  global: false,
			  type: "GET",//รูปแบบข้อมูลที่จะส่ง
			  data: ({ID : id}), //ข้อมูลที่ส่ง  { ชื่อตัวแปร : ค่าตัวแปร }
			  dataType: "JSON", //รูปแบบข้อมูลที่ส่งกลับ xml,script,json,jsonp,text
			  async:false,
			  success: function(jd) { //แสดงข้อมูลเมื่อทำงานเสร็จ โดยใช้ each ของ jQuery
					var opt="";
              document.getElementById("amounttotal").value = 0;
        document.getElementById("pricetotles").value = 0;
          opt+="<div class='form-group col-md-12'> <select id='selUser' class='select' style='width:50%;'>"
							$.each(jd, function(key, val){
                  opt+="<option value='"+val['product_id']+"' price='"+val['product_wholesaleprice']+"'  idpd='"+val['product_id']+"'> "+val['product_name']+"</option>";
                countpd+=1;
    						});
                opt+="</select>";
                opt+="<input type='button' value='เลือกสินค้า' class='btn btn-success' id='but_read'><input type='button' value='ลบสินค้า' class='btn btn-danger' id='but_reset'></div>";
							$("#selectpdagant").html( opt );//เพิ่มค่าลงใน Select ของอำเภอ
		   	  }
		});
    countpd=0;
 $(document).ready(function(){
 // Initialize select2
 $("#selUser").select2();
 let countno=1;
 var textshow="";
 // Read selected option
 $('#but_read').click(function(){
   var username =$('#selUser option:selected').text();
   var userid = $('#selUser').val();
   var price = $('#selUser option:selected').attr("price");
   var idpd = $('#selUser option:selected').attr("idpd");
   if(idpd != checkidpd){
    textshow+="<div  class='form-row' style='margin-top:10px;'><div class='form-group  text-center col-md-1'>"+countno+"</div>"
    textshow+="<div class='form-group  text-center col-md-5'>"
   textshow+=""+username+" <input type='hidden' class='form-control' name='product_id[]' value='"+userid+"' >"
   textshow+="</div><div class='form-group col-md-2'>"
   textshow+=""+price+" <input type='hidden' id='pricepd"+countpd+"' class='form-control' name='detail_price[]' value='"+price+"' >"
   textshow+="</div><div class='form-group col-md-2'>"
   textshow+="<input type='number' class='form-control' id='amountpd"+countpd+"' name='detail_amount[]' placeholder='กรอกข้อมูล' value='0' required onclick='updatepd("+countpd+")'></div> "
   textshow+="<div class='form-group col-md-2'>"
   textshow+="<input type='text' class='form-control' id='topd"+countpd+"' name='totalprice[]' placeholder='กรอกข้อมูล' value='' readonly></div></div><hr>"
   countpd+=1;
   $('#selUser option:selected').prop('disabled', ! $('#selUser option:selected').prop('disabled'));
      $('selUser').select2();
     $('#result').html(textshow);
     checkidpd=idpd;
     countno+=1;
   }
 });
 $('#but_reset').click(function(){
  //  var username = $('#selUser option:selected').text();
  //  var userid = $('#selUser').val();
  //   textshow ="";
  //   document.getElementById("amounttotal").value = 0;
  //       document.getElementById("pricetotles").value = 0;
  //  $('#result').html(textshow);
  window.location.href="./order-add.php"

 });
});
});
var pricetotalpd=0;
function updatepd(a){
  var idpd = '#pricepd'+a;
  var pricepd = $(idpd).val();
  var amountpd ='#amountpd'+a;
  var amountpds = $(amountpd).val();
  var pricetotle = 'topd'+a;
   pricetotalpd = amountpds*pricepd;
  pricetotalpd = pricetotalpd.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
  console.log(pricetotalpd)
  var textnumprice=0;
    document.getElementById(pricetotle).value = pricetotalpd;
    var numamount=0;
        var totalanumamount=0;
        var numprice=0;
        var totalnumprice=0;
    for(i=0;i<countpd;i++){
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
        totalanumamount= totalanumamount.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
        console.log(totalanumamount)
        totalnumprice= totalnumprice.toString().toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
        document.getElementById("amounttotal").value = totalanumamount;
        document.getElementById("pricetotles").value = totalnumprice;
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
