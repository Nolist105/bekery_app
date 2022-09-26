<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php 
    session_start();
    require_once("config/config_sqli.php");
    if (isset($_GET['logout'])) {
  
      unset($_SESSION['username']);
      session_destroy();
      echo "<script>
            $(document).ready(function () {
            Swal.fire ({
                  icon: 'success',
                  title: 'ออกจากระบบแล้ว',
                  text: 'กำลังกลับไปยังหน้าล็อคอิน',
                  timer: 3000,
                  showConfirmButton: false,
            });
            });
      </script>";
      header("refresh:2; url=loginform.php");
      // header("location: loginform.php");
      
    }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>พนักงาน</title>

    <!--Bootstap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!--boxicon-->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <!--flaticon-->
    <link href="https://registry.npmjs.org/@flaticon/flaticon-uicons/-/flaticon-uicons-1.7.0.tgz" rel="stylesheet"> 

    <!--css-->
    <link rel="stylesheet" href="sidebars.css">

</head>
<body>
  <div class="sidebar close">
    <div class="logo-details">
    <i class='bx bxs-cake'></i>
      <span class="logo_name">Bekery</span>
    </div>

    <ul class="nav-links">
      <li>
        <a href="indexuser.php">
          <i class='bx bxs-home-smile'></i>
          <span class="link_name">หน้าหลัก</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="indexuser.php">หน้าหลัก</a></li>
        </ul>
      </li>

      <li>
        <div class="iocn-link">
          <a href="product/index_production.php">
          <i class='bx bxs-store-alt' ></i>
            <span class="link_name">สั่งผลิตสินค้า</span>
          </a>
        </div>
        <ul class="sub-menu">
          <li><a href="product/index_production.php">สั่งผลิตสินค้า</a></li>
        </ul>
      </li>

      
      <li>
        <div class="iocn-link">
          <a href="material/index_stockin.php">
            <i class='bx bxs-bookmark-alt'></i>
            <span class="link_name">รับวัตถุดิบเข้าคลัง</span>
          </a>
        </div>
        <ul class="sub-menu">
          <li><a href="material/index_stockin.php">รับวัตถุดิบเข้าคลัง</a></li>
        </ul>
      </li>
      
      <li>
        <div class="iocn-link">
          <a href="material/cutstock_material.php">
          <i class='bx bx-cut'></i>
            <span class="link_name">ตัดสต็อก</span>
          </a>
        </div>
        <ul class="sub-menu">
          <li><a href="material/cutstock_material.php">ตัดสต็อก</a></li>
        </ul>
      </li>
     
      <li>
        <div class="iocn-link">
          <a href="material/index_orderpoint.php">
          <i class='bx bxs-analyse'></i>
            <span class="link_name">จัดการข้อมูลความต้องการใช้สินค้า</span>
          </a>
          <!-- <i class='bx bxs-chevron-down arrow' ></i> -->
        </div>
        <ul class="sub-menu">
          <li><a href="material/index_orderpoint.php">จัดการข้อมูลความต้องการใช้สินค้า</a></li>
        </ul>
     </li>

     <li>
        <div class="iocn-link">
          <a href="material/manage_material.php">
          <i class='bx bxs-basket'></i>
            <span class="link_name">วัตถุดิบคงเหลือ</span>
          </a>
        </div>
        <ul class="sub-menu">
          <li><a href="material/manage_material.php">วัตถุดิบคงเหลือ</a></li>
        </ul>
     </li>

      <li>
    <div class="profile-details">
      <div class="profile-content">
        <img src="image/bekery.jpg" alt="profileImg">
      </div>
      <div class="name-job">
        <div class="profile_name">พนักงาน</div>
        <div class="job">BEKERY STORE</div>
      </div>
      <a href="indexuser.php?logout='1'"> <i class='bx bx-log-out'  id="logout" ></i> </a>
      
    </div>
  </li>
</ul>
  </div>
  <section class="home-section">
    <div class="home-content">
      <i class='bx bx-menu' ></i>
    </div>
    <img src="image/bekery.jpg" alt="profileImg" width="1175" height="500">
  </section>





  <script src="script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
      </script>
</body>



</html>