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
    <link href='./css/select2.min.css' rel='stylesheet' type='text/css'>
    <link href='./css/datepicker.css' rel='stylesheet' type='text/css'>
    <script src="./js/jquery-3.1.1.min.js"></script>
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
  <?php
  session_start();
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
  ?>
    <div class="page">
      <!-- Main Navbar-->
		<?php include ('./menubar.php');?>
        <div class="content-inner">
          <!-- Page Header-->
          <header class="page-header">
            <div class="container-fluid">
              <h2 class="no-margin-bottom">การออกรายงาน</h2>
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
                    <form action="" method="post">
                        <label for="inputEmail4"><h3>เลือกการออกรายงาน <b style="color:red;font-size:15px;">*</b></h3></label>
                        <select id="agent" name="report"  class="form-control" style="width: 40%; color:#000;" >              
                            <option  value="1" style=" color:#000; font-size:21px;" >ออกรายงานสินค้า</option>
                            <option  value="2" style=" color:#000; font-size:21px;" >ออกรายงานการซื้อสินค้าจากตัวแทนจำหน่าย</option>
                        </select>
                        <hr>
                            <div class="form-row col-md-12" style="background-color: #e4e4e4;padding: 20px;">
                                 <div class="col-md-12" id="showproduct">
                                </div>
                                <div class="form-group col-md-6" >
                                    <br>
                                    <label for="inputEmail4"><h3>เริ่มจากวันที่</h3></label>
                                    <br>
                                    <div class="input-group mb-2">
                                        <input  id="datepicker" type="text" name="datestart" data-provide="datepicker" required class="form-control" data-date-language="th-th" autocomplete="off">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>    
                                <div class="form-group col-md-6">
                                    <br>
                                    <label for="inputEmail4"><h3>ถึงวันที่</h3></label>
                                    <br>
                                    <div class="input-group mb-2">
                                        <input id="datepicker2" type="text" name="dateend" data-provide="datepicker" required class="form-control" data-date-language="th-th" autocomplete="off">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>      
                                <div class="form-group col-md-12">
                                        <center>
                                            <button type="submit" class="btn btn-success" name="submit">ออกรายงาน</button>
                                        </center>
                                    </div>
                                </div>
                                </form>
                                <?php 
                                    if(isset($_POST["submit"])){ 
                                        if($_POST["report"]==1){ ?>
                                                <br>
                                                <div  class="form-row col-md-12">
                                                <label for="inputEmail4"><h3>แสดงข้อมูลรายงาน</h3></label>            
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                        <th scope="col">ลำดับ</th>
                                                        <th scope="col">วันที่</th>
                                                        <th scope="col">ชื่อสินค้า</th>
                                                        <th class="text-center" scope="col">จำนวนที่ขายไป</th>
                                                        <th class="text-center" scope="col">ราคา</th>
                                                        <th class="text-center" scope="col">ราคารวม</th>
                                                        </tr>
                                                    </thead> 
                                                    <tbody>
                                                    <?php
                                                        $datestart = date("Y-m-d", strtotime($_POST["datestart"]) );
                                                        $dateend = date("Y-m-d", strtotime($_POST["dateend"]) );
                                                        $nocount =0;
                                                        include('connect.php');
                                                        $_SESSION['product']=[];
                                                        for($i=0;$i<count($_POST["product"]);$i++){
                                                            $_SESSION['product'][] = $_POST["product"][$i];
                                                            
                                                            $sqledit = "SELECT *,SUM(selling_detail.seld_amount) As Amount FROM selling
                                                            JOIN product
                                                            JOIN selling_detail ON  (product.product_id = selling_detail.product_id AND selling.sell_id = selling_detail.sell_id)
                                                            WHERE product.product_id='".$_POST["product"][$i]."' AND selling.sell_date BETWEEN '". $datestart."' AND '".$dateend."'  GROUP BY selling.sell_date"; 
                                                    
                                                            if($resultcounts = mysqli_query($con, $sqledit)){
                                                            while($rowcounts = mysqli_fetch_array($resultcounts)){    
                                                                $nocount+=1;                    
                                                            ?>
                                                            <tr>
                                                                <th scope="row"><?php echo $nocount;?></th>
                                                                <td><?php echo DateThai($rowcounts['sell_date']);?></td>
                                                                <td><?php echo $rowcounts['product_name']?></td>
                                                                <td class="text-center"><?php echo number_format($rowcounts['Amount'])?></td>
                                                                <td  class="text-center"><?php echo number_format($rowcounts['seld_price'])?></td>
                                                                <td  class="text-center"><?php echo number_format($rowcounts['seld_price']*$rowcounts['Amount'])?></td>
                                                            </tr>
                                                    <?php   }
                                                        } }
                                            ?>
                                                    </tbody>
                                                </table>
                                                <div class="form-group col-md-12">
                                                    <center>
                                                    <?php if( $_POST['report']==1){?>
                                            <form action="./printreport.php" method="post">
                                                <input type="hidden" name="report" value="<?php echo $_POST['report']?>">
                                                <input type="hidden" name="product[]" value="<?php echo $_POST['product']?>">
                                                <input type="hidden" name="datestart" value="<?php echo $_POST['datestart']?>">
                                                <input type="hidden" name="dateend" value="<?php echo $_POST['dateend']?>">
                                                <button type="submit" class="btn btn-primary" name="submit">ปริ้นรายงาน</button>
                                            </form>
                                        <?php }?>
                                        <?php if( $_POST['report']==2){?>
                                            <form action="./printreport.php" method="post">
                                                <input type="hidden" name="report" value="<?php echo $_POST['report']?>">
                                                <input type="hidden" name="agent" value="<?php echo $_POST['agent']?>">
                                                <input type="hidden" name="datestart" value="<?php echo $_POST['datestart']?>">
                                                <input type="hidden" name="dateend" value="<?php echo $_POST['dateend']?>">
                                                <button type="submit" class="btn btn-primary" name="submit">ปริ้นรายงาน</button>
                                            </form>
                                        <?php }?>
                                                    </center>
                                                   
                                                </div>
                                            </div>
                                <?php }
                                else{ ?>
     <br>
                                     <div  class="form-row col-md-12">
                                    <label for="inputEmail4"><h3>แสดงข้อมูลรายงาน</h3></label>            
                                    <table class="table">
                                        <thead>
                                            <tr>
                                            <th scope="col">ลำดับ</th>
                                            <th scope="col">วันที่</th>
                                            <th scope="col">ชื่อสินค้า</th>
                                            <th class="text-right" scope="col">จำนวนที่สั้งซื้อ</th>
                                            <th class="text-right" scope="col">ราคา</th>
                                            <th class="text-right" scope="col">ราคารวม</th>
                                            </tr>
                                        </thead> 
                                        <tbody>
                                        <?php
                                            $datestart = date("Y-m-d", strtotime($_POST["datestart"]) );
                                            $dateend = date("Y-m-d", strtotime($_POST["dateend"]) );
                                            $nocount =0;
                                            include('connect.php');


                                                $sqledit = "SELECT *,SUM(order_detail.detail_amount) As Amount FROM ordering
                                                JOIN order_detail ON ordering.order_id = order_detail.order_id 
                                                JOIN product ON order_detail.product_id = product.product_id 
                                                WHERE ordering.agent_id='".$_POST["agent"]."' AND ordering.order_date BETWEEN '". $datestart."' AND '".$dateend."' GROUP BY ordering.order_date"; 
                                               
                                                if($resultcounts = mysqli_query($con, $sqledit)){
                                                 while($rowcounts = mysqli_fetch_array($resultcounts)){    
                                                    $nocount+=1;                    
                                                  ?>
                                                  <tr>
                                                    <th scope="row"><?php echo $nocount;?></th>
                                                    <td><?php echo DateThai($rowcounts['order_date'])?></td>
                                                    <td><?php echo $rowcounts['product_name']?></td>
                                                    <td class="text-right"><?php echo number_format($rowcounts['Amount'])?></td>
                                                    <td class="text-right"><?php echo number_format($rowcounts['detail_price'])?></td>
                                                    <td class="text-right"><?php echo number_format($rowcounts['detail_price']*$rowcounts['Amount'])?></td>
                                                </tr>
                                           <?php   }
                                            } 
                                ?>
                                        </tbody>
                                    </table>
                                    <div class="form-group col-md-12">
                                        <center>
                                        <?php if( $_POST['report']==1){?>
                                            <form action="./printreport.php" method="post">
                                                <input type="hidden" name="report" value="<?php echo $_POST['report']?>">
                                                <input type="hidden" name="product[]" value="<?php echo $_POST['product']?>">
                                                <input type="hidden" name="datestart" value="<?php echo $_POST['datestart']?>">
                                                <input type="hidden" name="dateend" value="<?php echo $_POST['dateend']?>">
                                                <button type="submit" class="btn btn-primary" name="submit">ปริ้นรายงาน</button>
                                            </form>
                                        <?php }?>
                                        <?php if( $_POST['report']==2){?>
                                            <form action="./printreport.php" method="post">
                                                <input type="hidden" name="report" value="<?php echo$_POST['report']?>">
                                                <input type="hidden" name="agent" value="<?php echo $_POST['agent']?>">
                                                <input type="hidden" name="datestart" value="<?php echo $_POST['datestart']?>">
                                                <input type="hidden" name="dateend" value="<?php echo $_POST['dateend']?>">
                                                <button type="submit" class="btn btn-primary" name="submit">ปริ้นรายงาน</button>
                                            </form>
                                        <?php }?>
                                        </center>
                                        <hr>
                                    </div>
                                </div>
                              <?php  }
                            } ?>
                                
                            </div>
                   </div>
                </div>
              </div>
            </div>
          </section>
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
                  <b><h4> คุณแน่ใจที่จะยกเลิกการสั่งสินค้า  : <b id="checkdata"></b></h4></b>
                  </center>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                  <button id="submit" type="button" class="btn btn-danger">ยกเลิกการสั่งสินค้า</button>
                </div>
              </div>
            </div>
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
                  <h4> ไม่สามารถลบข้อมูล : <b id="errorname"></b> ข้อมูลนี้ถูกใช้อยู่ !!</h4>
                  </center>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-success" data-dismiss="modal">ตกลง</button>
                </div>
              </div>
            </div>
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
        </div>
      </div>
    </div>
        </div>
      </div>
    </div>
  
    <!-- JavaScript files-->
    <script src="./vendor/jquery/jquery.min.js"></script>
    <script src="./js/bootstrap-datepicker.js"></script>
    <script src="./js/bootstrap-datepicker.th.js"></script>
    <script src="./vendor/popper.js/umd/popper.min.js"> </script>
    <script src="./vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="./vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="./vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="./js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="./js/select2.min.js" ></script>
    <!-- Main File-->
    <script src="./js/front.js"></script>
  </body>
  <script>
      $("#prdountlist").select2();
  </script>
<script>
    $('#datepicker').datepicker({
        language:'th-th',
        format:'dd-mm-yyyy',
        max: '+5D',
        
    })
    $('#datepicker2').datepicker({
        language:'th-th',
        format:'dd-mm-yyyy',
        maxDate: '+5D',
        
    })
    $('#agent').ready(function(){
        
        var select =$('#agent option:selected').val();
        if(select==1){
            $.ajax({
			  url: "./getproduct.php",
			  global: false,
			  type: "GET",
                data: ({ID : 1}),
			  dataType: "JSON", 
			  async:false,
			  success: function(jd) { 
                textshow ="";
                textshow +=" <label for='inputEmail4'><h3>เลือกสินค้า <b style='color:red;font-size:15px;'>*</b></h3></label><br>"
                textshow +="<select id='prdountlist' name='product[]'  class='form-control' style='color:#000;' required multiple>"  
                
                    $.each(jd, function(key, val){
                            
                            textshow +="<option  value='"+val['product_id']+"' style=' color:#000; font-size:21px;' >"+val['product_name']+"</option>"
                            });
                textshow +="</select>"            
		   	  }
               
		});
        }
        if(select==2){
            $.ajax({
			  url: "./getproduct.php",
			  global: false,
			  type: "GET",
                data: ({ID : 2}),
			  dataType: "JSON", 
			  async:false,
			  success: function(jd) { 
                textshow ="";
                textshow +=" <label for='inputEmail4'><h3>เลือกตัวแทนจำหน่าย<b style='color:red;font-size:15px;'>*</b></h3></label><br>"
                textshow +="<select id='prdountlist' name='agent'  class='form-control' required  style='color:#000;' >"  
                
                    $.each(jd, function(key, val){
                            textshow +="<option  value='"+val['agent_id']+"' style=' color:#000; font-size:21px;' >"+val['agent_shopname']+"</option>"
                            });
                textshow +="</select>"            
		   	  }
               
		});
        }
        $('#showproduct').html(textshow);
        $("#prdountlist").select2();
      });
    $('#agent').change(function(){
        var select =$('#agent option:selected').val();
        if(select==1){
            $.ajax({
			  url: "./getproduct.php",
			  global: false,
			  type: "GET",
                data: ({ID : 1}),
			  dataType: "JSON", 
			  async:false,
			  success: function(jd) { 
                textshow ="";
                textshow +=" <label for='inputEmail4'><h3>เลือกสินค้า <b style='color:red;font-size:15px;'>*</b></h3></label><br>"
                textshow +="<select id='prdountlist' name='product[]' required  class='form-control' style='color:#000;' multiple>"  
                
                    $.each(jd, function(key, val){
                            textshow +="<option  value='"+val['product_id']+"' style=' color:#000; font-size:21px;' >"+val['product_name']+"</option>"
                            });
                textshow +="</select>"            
		   	  }
               
		});
        }
        if(select==2){
            $.ajax({
			  url: "./getproduct.php",
			  global: false,
			  type: "GET",
                data: ({ID : 2}),
			  dataType: "JSON", 
			  async:false,
			  success: function(jd) { 
                textshow ="";
                textshow +=" <label for='inputEmail4'><h3>เลือกตัวแทนจำหน่าย<b style='color:red;font-size:15px;'>*</b></h3></label><br>"
                textshow +="<select id='prdountlist' name='agent' required  class='form-control' style='color:#000;' >"  
                
                    $.each(jd, function(key, val){
                            textshow +="<option  value='"+val['agent_id']+"' style=' color:#000; font-size:21px;' >"+val['agent_shopname']+"</option>"
                            });
                textshow +="</select>"            
		   	  }
               
		});
        }
        $('#showproduct').html(textshow);
        $("#prdountlist").select2();
    });
</script>
</html>
