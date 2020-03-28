<?php
  session_start();
  if($_SESSION["login_user"]==null){
    header("location: ./index.php");
  }
?>
<header class="header">
        <nav class="navbar">
          <!-- Search Box-->
          <div class="search-box">
            <button class="dismiss"><i class="icon-close"></i></button>
            <form id="searchForm" action="#" role="search">
              <input type="search" placeholder="What are you looking for..." class="form-control">
            </form>
          </div>
          <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
              <!-- Navbar Header-->
              <div class="navbar-header">
                <!-- Navbar Brand --><a href="./main.php" class="navbar-brand d-none d-sm-inline-block">
                  <div class="brand-text d-none d-lg-inline-block"><span>ระบบจัดการร้านตุ๊กตา </span></div>
                  <div class="brand-text d-none d-sm-inline-block d-lg-none"><strong>BD</strong></div></a>
                <!-- Toggle Button--><a id="toggle-btn" href="#" class="menu-btn active"><span></span><span></span><span></span></a>
              </div>
              <!-- Navbar Menu -->
              <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                <li class="nav-item"><a href="./index.php" class="nav-link logout"> <span class="d-none d-sm-inline">ออกจากระบบ</span><i class="fa fa-sign-out"></i></a></li>
              </ul>
            </div>
          </div>
        </nav>
      </header>
      <div class="page-content d-flex align-items-stretch">
        <!-- Side Navbar -->
        <nav class="side-navbar">
          <!-- Sidebar Header-->
          <div class="sidebar-header d-flex align-items-center" style="background-color: #d8d8d8;margin-block-end: 17px;">
            <div class="title">
            <h1 class="h4"> ผู้ใช้งาน : <? echo $_SESSION["login_user"];?></h1>
              <p style="color: #000;">สถานะ : <? echo $_SESSION["user_status"];?></p>
            </div>
          </div>
          <span class="heading"><h3>ข้อมูลระบบ</h3></span>
          <ul class="list-unstyled">
            <li> <a href="./main.php"> <i class="fa fa-home"></i>หน้าแรก </a></li>
            <?if($_SESSION["user_status"]=="Admin"){  ?>
              <li> <a href="employee.php"> <i class="fa fa-id-card-o"></i>จัดการข้อมูลพนักงาน </a></li>
           <?php  }?>
            <li> <a href="./product.php"> <i class="fa fa-cubes"></i>จัดการข้อมูลสินค้า </a></li>
            <li> <a href="./product-set.php"> <i class="fa fa-product-hunt"></i>จัดการข้อมูลสินค้าเซต </a></li>
            <li> <a href="./agent.php"> <i class="fa fa-users"></i>จัดการข้อมูลตัวแทนจำหน่าย </a></li>
            <li> <a href="./customer.php"> <i class="fa fa-id-badge"></i>จัดการข้อมูลลูกค้า </a></li>
            <li> <a href="./order.php"> <i class="fa fa-server"></i>จัดการข้อมูลการสั่งซื้อสินค้า </a></li>
            <li> <a href="./product-receipt.php"> <i class="fa fa-tasks"></i>จัดการข้อมูลการรับสินค้า  </a></li>
            <li> <a href="./selling.php"> <i class="fa fa-folder-open"></i>จัดการข้อมูลการขาย</a></li>
            <li> <a href="./promotion.php"> <i class="fa fa-bullhorn"></i>จัดการข้อมูลโปรโมชั่น </a></li>
            <li> <a href="./report.php"> <i class="fa fa-fax"></i>การออกรายงาน  </a></li>
          </ul>
          <span class="heading"><h3>ข้อมูลพื้นฐาน</h3></span>
          <ul class="list-unstyled">
            <li ><a href="./perfix.php"> <i class="fa fa-minus"></i>จัดการข้อมูลคำนำหน้าชื่อ </a></li>
            <li><a href="./position.php"> <i class="fa fa-minus"></i>จัดการข้อมูลตำแหน่ง </a></li>
            <li><a href="./measure.php"> <i class="fa fa-minus"></i>จัดการข้อมูลหน่วยนับ </a></li>
          </ul>
        </nav>
