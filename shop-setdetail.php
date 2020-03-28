<!DOCTYPE html>
<html lang="en">
  <head>
    <title>ตุ๊กตาจากโรงงาน &mdash; รายละเอียดสินค้าเซต</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700"> 
    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">


    <link rel="stylesheet" href="css/aos.css">
    <link rel="stylesheet" href="css/style.css">
    <script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
  </head>
  <body>
  
  <div class="site-wrap">
    

    <div class="site-navbar bg-white py-2">

      <div class="search-wrap">
        <div class="container">
          <a href="#" class="search-close js-search-close"><span class="icon-close2"></span></a>
          <form action="#" method="post">
            <input type="text" class="form-control" placeholder="Search keyword and hit enter...">
          </form>  
        </div>
      </div>

      <div class="container">
        <?php include('./manu.php');?>
      </div>
    </div>
    <div class="site-blocks-cover inner-page" data-aos="fade">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
          <img src="images/image1.jpg" alt="Image" class="img-fluid">
          </div>
        </div>
      </div>
    </div>
    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0" ><a href="index.php">หน้าแรก</a> <span class="mx-2 mb-0">/</span> <a href="shop-set.php">สินค้าเซตทั้งหมด</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">รายละเอียดสินค้าเซต</strong></div>
        </div>
      </div>
    </div>  

    <div class="site-section" style="padding: 1em 0;">
      <div class="container" style="background-color: #f8f9fa;padding: 20px;">
        <div class="row">
          <?php 
                include('connect.php');
                    $idproduct=0;
                    $sqlpd = "SELECT  *  FROM setproduct where set_id='".$_GET['id']."'";
                                    if($resultpd = mysqli_query($con, $sqlpd)){
                                      while($rowpd = mysqli_fetch_array($resultpd)){  
                                        $idsetpd=$rowpd["set_id"];
                                        $sqlpds = "SELECT  *  FROM setproduct_descirption join product on setproduct_descirption.product_id=product.product_id  where set_id='".$rowpd['set_id']."'";
                                        $countno=0;
                                           if($resultpds = mysqli_query($con, $sqlpds)){
                                             $count = mysqli_num_rows($resultpds);
                                             while($rowpds = mysqli_fetch_array($resultpds)){
                                                    $img[$countno] = $rowpds['product_img1'];
                                                    $countno+=1;
                                              }}                         
          ?>
        <div class="col-md-6">
            <div class="item-entry">
                <div id="demo" class="carousel slide" data-ride="carousel">
                <ul class="carousel-indicators">
                <li data-target="#demo" data-slide-to="0" class="active"></li>
                <?php 
                                for($i=1;$i<count($img);$i++){
                                    ?><li data-target="#demo" data-slide-to="<?php echo $i;?>"></li><?php 
                                }
                            ?>
                </ul>

                <!-- The slideshow -->
                <div class="carousel-inner">
                <div class="carousel-item active">
                                <img src="./Store-shop/imageproduct/<?php echo $img[0];?>"  style="width:100%;height: 400px;">
                </div>
                <?php 
                                for($i=1;$i<count($img);$i++){
                                    ?> <div class="carousel-item">
                                    <img src="./Store-shop/imageproduct/<?php echo $img[$i];?>" style="width:100%;height: 400px;">
                                </div><?php 
                                }
                            ?>
                </div>

                <!-- Left and right controls -->
                <a class="carousel-control-prev" href="#demo" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#demo" data-slide="next">
                <span class="carousel-control-next-icon"></span>
                </a>
                </div>
            </div>
          </div>
          <div class="col-md-6">
            <h5 class="text-black">ชื่อสินค้าเซต : <?php echo $rowpd["set_name"];?></h5>
            <hr>
            <ul>
            <?php 
                 $sqlpd = "SELECT  *  FROM setproduct_descirption join product on setproduct_descirption.product_id=product.product_id where setproduct_descirption.set_id='".$idsetpd."'";
                            if($resultpd = mysqli_query($con, $sqlpd)){
                                $countpd = mysqli_num_rows($resultpd);
                                while($rowpds = mysqli_fetch_array($resultpd)){  
                                    $no+=1;
                        ?>
                        <li><?php echo $no;?>. สินค้า : <?php echo $rowpds['product_name'];?></li><br>
                        <?php }} ?>
                  </ul>
            <p><strong class="text-primary h5">ราคาสินค้า : <?php echo $rowpd["set_price"];?></strong></p> 
            <p>
            <a href="http://line.me/R/ti/p/%40firstcrasss" target="_black"  class="buy-now btn  height-auto  btn-success" style=" font-size:18px;">สั่งซื้อผ่านทางไลน์</a>
              <a href="https://www.messenger.com/t/firstcrasss" target="_black" class="buy-now btn height-auto  btn-success" style="font-size:18px;background-color:#2f7cff;">สั่งซื้อผ่านทางเฟสบุ๊ก</a>
            </p>
          </div>
          <?php }}?>
        </div>
      </div>
    </div>
<hr>
    <div class="site-section block-3 site-blocks-2">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-7 site-section-heading text-center pt-4">
            <h2>สินค้าเซตใกล้เคียง</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 block-3">
            <div class="nonloop-block-3 owl-carousel">
            <?php 
                include('connect.php');
                    $idproduct=0;
                    $sqlpd = "SELECT  *  FROM setproduct  where set_id!='".$_GET['id']."' limit 5";
                                    if($resultpd = mysqli_query($con, $sqlpd)){
                                      while($rowpd = mysqli_fetch_array($resultpd)){  
                                        $sqlpds = "SELECT  *  FROM setproduct_descirption join product on setproduct_descirption.product_id=product.product_id  where set_id='".$rowpd['set_id']."' limit 1";
                                        $countpd=0;
                                           if($resultpds = mysqli_query($con, $sqlpds)){
                                             $countpds = mysqli_num_rows($resultpds);
                                             while($rowpds = mysqli_fetch_array($resultpds)){
                                                    $img = $rowpds['product_img1'];
                                              }}
          ?>
              <div class="item">
                <div class="item-entry">
                <a href="./shop-setdetail.php?id=<?php echo $rowpd['set_id']?>" class="product-item md-height bg-gray d-block">
                <img src="./Store-shop/imageproduct/<?php echo $img;?>" alt="Image" class="img-fluid" style="max-width:100%;top:0%;height: 400px;">
                </a>
                <h2 class="item-title" style="font-size:25px;">ชื่อสินค้าเซต : <a href="./shop-setdetail.php?id=<?php echo $rowpd['set_id']?>"><?php echo $rowpd['set_name']?></a></h2>
                <strong class="item-price" style="font-size:25px;">ราคา : <?php echo $rowpd['set_price']?> บาท.</strong>
                </div>
              </div>
              <?php }}?>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php include('./footer.php');?>
  </div>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>

  <script src="js/main.js"></script>
    
  </body>
</html>