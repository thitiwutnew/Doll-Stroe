<!DOCTYPE html>
<html lang="en">
  <head>
    <title>ตุ๊กตาจากโรงงาน &mdash; สินค้าเซตทั้งหมด</title>
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
      <?php include('./manu.php'); ?>
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

    <div class="custom-border-bottom py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="index.php">หน้าแรก</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">สินค้าเซตทั้งหมด</strong></div>
        </div>
      </div>
    </div>


    <div class="site-section" style="padding: 1em 0;">
      <div class="container">

        <div class="row mb-12">
          <div class="col-md-12 order-1">

            <div class="row align">
              <div class="col-md-12 mb-5">
                <div class="float-md-left"><h2 class="text-black h5" style="font-size:30px;"> สินค้าเซตทั้งหมด</h2></div>
              </div>
            </div>
            <?php
             include('connect.php');
              $perpage = 6;
              if (isset($_GET['page'])) {
              $page = $_GET['page'];
              } else {
              $page = 1;
              }
              
              $start = ($page - 1) * $perpage;
              
              $sql = "select * from setproduct limit {$start} , {$perpage} ";
              $query = mysqli_query($con, $sql);
              ?>
            <div class="row mb-12">
            <?php while ($result = mysqli_fetch_assoc($query)) { 
                   $sqlpds = "SELECT  *  FROM setproduct_descirption join product on setproduct_descirption.product_id=product.product_id  where set_id='".$result['set_id']."' limit 1";
                   $countpd=0;
                      if($resultpds = mysqli_query($con, $sqlpds)){
                        $countpds = mysqli_num_rows($resultpds);
                        while($rowpds = mysqli_fetch_array($resultpds)){
                               $img = $rowpds['product_img1'];
                         }}?>
            <div class="col-lg-4 col-md-4 item-entry mb-4">
              <a href="./shop-setdetail.php?id=<?php echo $result['set_id']?>" class="product-item md-height bg-gray d-block">
                <img src="./Store-shop/imageproduct/<?php echo $img;?>" alt="Image" class="img-fluid" style="max-width:100%;top:0%;height: 400px;">
              </a>
              <h2 class="item-title" style="font-size:25px;">สินค้า : <a href="./shop-setdetail.php?id=<?php echo $result['set_id']?>"><?php echo $result['set_name']?></a></h2>
              <strong class="item-price" style="font-size:25px;">ราคา : <?php echo $result['set_price']?> บาท.</strong>
            </div>
          <?php }?>
            </div>
            <div class="row">
              <div class="col-md-12 text-center">
                <div class="site-block-27">
                <?php
                  $sql2 = "select * from setproduct ";
                  $query2 = mysqli_query($con, $sql2);
                  $total_record = mysqli_num_rows($query2);
                  $total_page = ceil($total_record / $perpage);
                ?>
                <hr>
                 <ul>
                    <li>
                    <a href="shop-set.php?page=1" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    </a>
                    </li>
                    <?php for($i=1;$i<=$total_page;$i++){ ?>
                    <li><a href="shop-set.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                    <?php } ?>
                    <li>
                    <a href="shop-set.php?page=<?php echo $total_page;?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    </a>
                    </li>
                    </ul>
                  <ul>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
    <?php include('./footer.php');?>
  </div>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>

  <script src="js/main.js"></script>
    
  </body>
</html>