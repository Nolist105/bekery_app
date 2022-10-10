<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
  session_start();
  include '../config/config_sqli.php';
  
  if (!isset($_SESSION['admin'])) {
    $_SESSION['msg'] = "Please Login";
    header("location:../loginform.php");
}
  if (isset($_GET['logout'])) {
    
    unset($_SESSION['admin']);
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
    header("refresh:2; url=../loginform.php");
    // header("location: loginform.php");
    
  }
  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มข้อมูลผู้ใช้</title>

    <!--Bootstap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!--boxicon-->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <!--flaticon-->
    <link href="https://registry.npmjs.org/@flaticon/flaticon-uicons/-/flaticon-uicons-1.7.0.tgz" rel="stylesheet"> 
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Bai+Jamjuree:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600;1,700&family=Chakra+Petch:ital,wght@0,300;0,400;0,600;0,700;1,300;1,500;1,600;1,700&display=swap">
    <!--css-->
    <link rel="stylesheet" href="../style.css">

    <style>
      .box{
          width: 500px;
          height: 8vh;
          position: relative;
          left: 30%;
        }
        .box input{
          width: 100%;
          height: 100%;
          border-radius: 7px;
          border: solid 1px #11101d;
          outline: none;
          padding: 15px;
          font-size: 16px;

        }
        .box i{
          position: absolute;
          right: 4%;
          top: 40%;
        }
        .box p{
          position: absolute;
          top: -10px;
          left: 4%;
          background: #fff;
          padding: 0 10px;
        }
        .boxx{
          width: 500px;
          height: 8vh;
          position: relative;
          left: 44%;
        }
        
    </style>

</head>
<body>
<div class="sidebar close">
    <div class="logo-details">
    <i class='bx bxs-cake'></i>
      <span class="logo_name">Bekery</span>
    </div>

    <ul class="nav-links">
      <li>
        <a href="index.php">
          <i class='bx bxs-home-smile'></i>
          <span class="link_name">หน้าหลัก</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="../index.php">หน้าหลัก</a></li>
        </ul>
      </li>

      <li>
        <div class="iocn-link">
          <a href="#">
            <i class='bx bxs-user'></i>
            <span class="link_name">ผู้ใช้</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a  href="../user/user.php">รายการผู้ใช้</a></li>
        </ul>
      </li>

      <li>
        <div class="iocn-link">
          <a href="#">
            <i class='bx bxl-product-hunt'></i>
            <span class="link_name">สินค้า</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a href="../product/index.php">รายการสินค้า</a></li>
        </ul>
      </li>

      <li>
        <div class="iocn-link">
          <a href="#">
            <i class='bx bxs-calendar-heart'></i>
            <span class="link_name">วัตถุดิบ</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">วัตถุดิบ</a></li>
          <li><a href="#">รายการวัตถุดิบ</a></li>
        </ul>
      </li>

      <li>
          <div class="iocn-link">
          <a href="../material/manage_report.php">
          <i class='bx bxs-receipt'></i>
              <span class="link_name">รายงาน</span>
          </a>
          <i class='bx bxs-chevron-down arrow'></i>
          </div>
          <ul class="sub-menu">
          <li><a href="../material/manage_report.php">รายงานวัตถุดิบคงเหลือ</a></li>
          </ul>
      </li>

      
     

      <li>
    <div class="profile-details">
      <div class="profile-content">
        <img src="../image/bekery.jpg" alt="profileImg">
      </div>
      <div class="name-job">
        <div class="profile_name">เจ้าของร้าน</div>
        <div class="job">BEKERY STORE</div>
      </div>
      <a href="adduser.php?logout='1'"> <i class='bx bx-log-out'  id="log_out" ></i> </a>
    </div>
  </li>
</ul>
  </div>

  <section class="home-section">
    <div class="home-content">
      <i class='bx bx-menu' ></i>
    </div>
    <div class="container" >
    <div class=" h4 text-center alert alert-info mb-4 mt-4" role="alert"> เพิ่มข้อมูลผู้ใช้</div>
        <form action="insert_user.php" method="POST" >
            <div class="box">
              <input type="text" name="username" class="form-control" placeholder="ชื่อผู้ใช้" maxlength="10" 
              oninvalid="setCustomValidity('กรุณาป้อนผู้ใช้')" oninput="setCustomValidity('')" required> 
              <p>ชื่อผู้ใช้</p>
            </div>
            <br>
            <div class="box">
              <input type="password" name="password" class="form-control" placeholder="รหัสผ่าน" maxlength="4" 
              oninvalid="setCustomValidity('กรุณาป้อนรหัสผ่าน')"  oninput="setCustomValidity('')"  required  id="id_password">
              <i class="far fa-eye" style=" margin-left: -20px; cursor: pointer;" id="togglePassword" ></i>
              <p>รหัสผ่าน</p>
            </div>
            <br>

            <div class="boxx">
            <input type="submit" value="บันทึก" class="btn btn-success">
            <a href="user.php" class="btn btn-danger">ยกเลิก</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
      </script>
  </section>

  <script>const togglePassword = document.querySelector('#togglePassword');
  const password = document.querySelector('#id_password');

    togglePassword.addEventListener('click', function (e) {
      // toggle the type attribute
      const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
      password.setAttribute('type', type);
      // toggle the eye slash icon
      this.classList.toggle('fa-eye-slash');
  });</script>



  <script src="../script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
      </script>

</body>
</html>