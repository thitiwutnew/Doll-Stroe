
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">

<style type="text/css">
<!--
@page rotated { size: landscape; }
.style1 {
	font-family: "TH SarabunPSK";
	font-size: 18pt;
	font-weight: bold;
}
.style2 {
	font-family: "TH SarabunPSK";
	font-size: 16pt;
	font-weight: bold;
}
.style3 {
	font-family: "TH SarabunPSK";
	font-size: 16pt;
	
}
.style5 {cursor: hand; font-weight: normal; color: #000000;}
.style9 {font-family: Tahoma; font-size: 12px; }
.style11 {font-size: 12px}
.style13 {font-size: 9}
.style16 {font-size: 9; font-weight: bold; }
.style17 {font-size: 12px; font-weight: bold; }

</style>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<html>
<head>

</head>
<body>
<?php 
   date_default_timezone_set("Asia/Bangkok");
function DateThai($strDate)
{
$strYear = date("Y",strtotime($strDate))+543;
$strMonth= date("n",strtotime($strDate));
$strDay= date("j",strtotime($strDate));
$strHour= date("H",strtotime($strDate))+7;
$strMinute= date("i",strtotime($strDate));
$strSeconds= date("s",strtotime($strDate));
$strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
$strMonthThai=$strMonthCut[$strMonth];
return "$strDay $strMonthThai $strYear เวลา $strHour:$strMinute น.";
}


function DateThaishow($strDate)
{
  $strYear = date("Y",strtotime($strDate))+543;
  $strMonth= date("n",strtotime($strDate));
  $strDay= date("j",strtotime($strDate));
  $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
  $strMonthThai=$strMonthCut[$strMonth];
  return "$strDay $strMonthThai $strYear";
}
?>
    <?php
    require_once('mpdf/mpdf.php'); //ที่อยู่ของไฟล์ mpdf.php ในเครื่องเรานะครับ
    ob_start(); // ทำการเก็บค่า html นะครับ
    ?>
   <?php session_start();
   $strDate=date("Y-m-d h:i:sa");
   ?>

     <?php 
                                        if($_POST["report"]==1){ ?>
                                                  <div  class="card-body">
                                    <div  class="form-row col-md-12">
                                     <h3>รายงานการขายสินค้า</h3>    
                                    <div class="form-row">
                                     
                                            <div class="form-row border" style="padding-top: 10px;padding-left: 2%;border: 4px solid #000000!important;">
                                            <div class="form-group col-md-5" style="margin-top: 5px;">
                                                    วันที่ออกรายงาน : <?php echo DateThai($strDate);?>
                                                </div>
                                            <div class="form-group col-md-7" style="margin-top: 5px;margin-bottom: 10px;">
                                                    ชื่อพนักงาน :  <?php echo $_SESSION['login_user'];?>
                                                </div>
                                              
                                            </div>
                                                <div  class="form-row col-md-12">
                                                   
                                                <table  width="100%"  class="table table-bordered" id="dataTable" cellspacing="0" role="grid" aria-describedby="dataTable_info" border="1">
                                                    <thead style="background-color: #3c3c3c; color: #fff;">
                                                        <tr>
                                                        <th style="padding: 2%;width:7%" >ลำดับ</th>
                                                        <th  style="width:10%;" >วันที่</th>
                                                        <th style="width:30%;" >ชื่อสินค้า</th>
                                                        <th style="width:10%;" >จำนวนที่ขายไป</th>
                                                        <th style="width:10%;" >ราคา</th>
                                                        <th style="width:10%;" >ราคารวม</th>
                                                        </tr>
                                                    </thead> 
                                                    <tbody>
                                                    <?php
                                                        $datestart = date("Y-m-d", strtotime($_POST["datestart"]) );
                                                        $dateend = date("Y-m-d", strtotime($_POST["dateend"]) );
                                                        $nocount =0;
                                                        include('connect.php');
                                                            
                                                        for($i=0;$i<count($_SESSION['product']);$i++){

                                                            $sqledit = "SELECT *,SUM(selling_detail.seld_amount) As Amount  FROM selling
                                                            JOIN product
                                                            JOIN selling_detail ON  (product.product_id = selling_detail.product_id AND selling.sell_id = selling_detail.sell_id)
                                                            WHERE product.product_id='".$_SESSION['product'][$i]."' AND selling.sell_date BETWEEN '". $datestart."' AND '".$dateend."' GROUP BY selling.sell_date"; 
                                                    
                                                            if($resultcounts = mysqli_query($con, $sqledit)){
                                                            while($rowcounts = mysqli_fetch_array($resultcounts)){    
                                                                $nocount+=1;                    
                                                            ?>
                                                            <tr>
                                                                <th scope="row"><?php echo $nocount;?></th>
                                                                <td><?php echo DateThai($rowcounts['sell_date']);?></td>
                                                                <td style="padding-left: 1%;padding:0.5%;"><?php echo $rowcounts['product_name']?></td>
                                                                <td style="text-align: right;"><?php echo number_format($rowcounts['Amount'])?></td>
                                                                <td   style="text-align: right;"><?php echo number_format($rowcounts['seld_price'])?></td>
                                                                <td   style="text-align: right;"><?php echo number_format($rowcounts['seld_price']*$rowcounts['Amount'])?></td>
                                                            </tr>
                                                    <?php   }
                                                        } }
                                            ?>
                                                    </tbody>
                                                </table>
                                                
                                            </div>
                                <?php }
                                else{ ?>
     <br>                           <div  class="card-body">
                                    <div  class="form-row col-md-12">
                                     <h3>รายงานการซื้อสินค้าจากตัวแทนจำหน่าย</h3>    
                                    <div class="form-row">
                                        <?php
                                                    include('connect.php');
                                           
                                                        $sqlagent = "SELECT * FROM agent where agent_id='".$_POST['agent']."' ";
                                                        if($resulagent = mysqli_query($con, $sqlagent)){
                                                            while($rowagent = mysqli_fetch_array($resulagent)){
                                                ?>
                                            <div class="form-row border" style="padding-top: 10px;padding-left: 2%;border: 4px solid #000000!important;">
                                            <div class="form-group col-md-5" style="margin-top: 5px;">
                                                    วันที่ออกรายงาน : <?php echo DateThai($strDate);?>
                                                </div>
                                            <div class="form-group col-md-7" style="margin-top: 5px;">
                                                    ชื่อตัวแทนจำหน่วย :  <?php echo $rowagent['agent_shopname'];?>
                                                </div>
                                                <div class="form-group col-md-5" style="margin-top: 5px;">
                                                ชื่อผู้ติดต่อ :  <?php echo $rowagent['agent_name'];?>
                                                </div>
                                                <div class="form-group col-md-7" style="margin-top: 5px;">
                                                โทรศัพท์ : <?php echo $rowagent['agent_tel'];?>
                                                </div>
                                                <div class="form-group col-md-7" style="margin-top: 5px;">
                                                    ที่อยู่ : <?php echo $rowagent['agent_address'];?>
                                                    ตำบล    <?php
                                                            $sqldistrict = "SELECT * FROM district where DISTRICT_ID='".$rowagent['agent_tambon']."'";
                                                            if($resultdistrict = mysqli_query($con, $sqldistrict)){
                                                                while($rowdistrict = mysqli_fetch_array($resultdistrict)){
                                                                ?>
                                                            <?php echo $rowdistrict['DISTRICT_NAME'];?>
                                                            <?php }}?>
                                                อำเภอ    <?php
                                                            $sqlamphur = "SELECT * FROM amphur where AMPHUR_ID='".$rowagent['agent_amphoe']."'";
                                                            if($resultamphur = mysqli_query($con, $sqlamphur)){
                                                                while($rowamphur = mysqli_fetch_array($resultamphur)){
                                                                ?>
                                                                <?php echo $rowamphur['AMPHUR_NAME'];?>
                                                            <?php }}?>
                                                จังหวัด        <?php
                                                            $sqlprovince = "SELECT * FROM province where PROVINCE_ID='".$rowagent['agent_province']."'";
                                                            if($resultprovince = mysqli_query($con, $sqlprovince)){
                                                                while($rowprovince = mysqli_fetch_array($resultprovince)){
                                                                ?>
                                                            <?php echo $rowprovince['PROVINCE_NAME'];?>
                                                            <?php }}?> <?php echo $rowagent['agent_postalcode'];?>
                                                </div>
                                              
                                                <div class="form-group col-md-7" style="margin-top: 5px;    margin-bottom: 10px;">

                                                </div>
                                            </div>
                                            <?php }} ?>
                                            
                                            <table  width="100%"  class="table table-bordered" id="dataTable" cellspacing="0" role="grid" aria-describedby="dataTable_info" border="1">
                                            <thead style="background-color: #3c3c3c; color: #fff;">
                                            <tr>
                                            <th style="padding: 2%;width:7%" >ลำดับ</th>
                                            <th  style="width:10%;" >วันที่</th>
                                            <th style="width:30%;" >ชื่อสินค้า</th>
                                            <th style="width:10%;" >จำนวนที่สั้งซื้อ</th>
                                            <th style="width:10%;" >ราคา</th>
                                            <th style="width:10%;" >ราคารวม</th>
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
                                                    <th  style="padding:0.5%;" ><?php echo $nocount;?></th>
                                                    <td><center><?php echo DateThaishow($rowcounts['order_date'])?></center></td>
                                                    <td><?php echo $rowcounts['product_name']?></td>
                                                    <td style="text-align: right;"><?php echo number_format($rowcounts['Amount'])?></td>
                                                    <td style="text-align: right;"><?php echo number_format($rowcounts['detail_price'])?></td>
                                                    <td style="text-align: right;"><?php echo number_format($rowcounts['detail_price']*$rowcounts['Amount'])?></td>
                                                </tr>
                                           <?php   }
                                            } 
                                ?>
                                        </tbody>
                                    </table>
                                    </div>
                                </div></div>
                              <?php  } ?>
                                
                           
                           
</body>
</html>
<?php
$html = ob_get_contents();        //เก็บค่า html ไว้ใน $html 
ob_end_clean();
$pdf = new mPDF('th', 'A4-L', '0', 'THSaraban');   
$pdf->SetAutoFont();
$pdf->SetDisplayMode('fullpage');
$pdf->WriteHTML($html, 2);
$pdf->Output();         // เก็บไฟล์ html ที่แปลงแล้วไว้ใน MyPDF/MyPDF.pdf ถ้าต้องการให้แสด
?>