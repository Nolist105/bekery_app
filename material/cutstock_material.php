<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
    session_start();
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
      header("refresh:2; url=../loginform.php");
      // header("location: loginform.php");
      
    }

    ini_set('display_errors',1);
    require_once '../config/config_sqli.php';
    $sql = "SELECT * FROM material" ;
    $result=mysqli_query($conn,$sql);
    /* session_start();
    require_once "../config/configpdo.php";

    $stmt = $conn->prepare("SELECT * FROM material");
    $stmt->execute();
    $rs = $stmt->fetchAll(); */

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ตัดสต็อกวัตถุดิบ</title>
    <!--Bootstap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!--font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
        integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--datepicker-->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
        integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--datepicker js-->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="../js/mat.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Bai+Jamjuree:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600;1,700&family=Chakra+Petch:ital,wght@0,300;0,400;0,600;0,700;1,300;1,500;1,600;1,700&display=swap">

    <!--boxicon-->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <!--flaticon-->
    <link href="https://registry.npmjs.org/@flaticon/flaticon-uicons/-/flaticon-uicons-1.7.0.tgz" rel="stylesheet"> 

    <!--css-->
    <link rel="stylesheet" href="../sidebars.css">

    <style>
    body {
        font-family: Bai Jamjuree;
    }
    </style>
</head>

<body>
<?php
        if(isset($_SESSION['error'])){
            echo $_SESSION['error'];
            unset($_SESSION['error']);
        }elseif(isset($_SESSION['success'])){
            echo $_SESSION['success'];
            unset($_SESSION['success']);
        }
    ?>

<div class="sidebar close">
    <div class="logo-details">
    <i class='bx bxs-cake'></i>
      <span class="logo_name">Bekery</span>
    </div>

    <ul class="nav-links">
      <li>
        <a href="../indexuser.php">
          <i class='bx bxs-home-smile'></i>
          <span class="link_name">หน้าหลัก</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="../indexuser.php">หน้าหลัก</a></li>
        </ul>
      </li>

      <li>
        <div class="iocn-link">
          <a href="../product/index_production.php">
          <i class='bx bxs-store-alt' ></i>
            <span class="link_name">สั่งผลิตสินค้า</span>
          </a>
        </div>
        <ul class="sub-menu">
          <li><a href="../product/index_production.php">สั่งผลิตสินค้า</a></li>
        </ul>
      </li>
      
      <li>
        <div class="iocn-link">
          <a href="../material/index_stockin.php">
            <i class='bx bxs-bookmark-alt'></i>
            <span class="link_name">รับวัตถุดิบเข้าคลัง</span>
          </a>
        </div>
        <ul class="sub-menu">
          <li><a href="../material/index_stockin.php">รับวัตถุดิบเข้าคลัง</a></li>
        </ul>
      </li>
      
      <li>
        <div class="iocn-link">
          <a href="../material/cutstock_material.php">
          <i class='bx bx-cut'></i>
            <span class="link_name">ตัดสต็อก</span>
          </a>
          <!-- <i class='bx bxs-chevron-down arrow' ></i> -->
        </div>
        <ul class="sub-menu">
          <li><a href="../material/cutstock_material.php">ตัดสต็อก</a></li>
        </ul>
      </li>
     
      <li>
        <div class="iocn-link">
          <a href="../material/index_orderpoint.php">
          <i class='bx bxs-analyse'></i>
            <span class="link_name">จัดการข้อมูลความต้องการใช้สินค้า</span>
          </a>
          <!-- <i class='bx bxs-chevron-down arrow' ></i> -->
        </div>
        <ul class="sub-menu">
          <li><a href="../material/index_orderpoint.php">จัดการข้อมูลความต้องการใช้สินค้า</a></li>
        </ul>
     </li>

     <li>
        <div class="iocn-link">
          <a href="../material/manage_material.php">
          <i class='bx bxs-basket'></i>
            <span class="link_name">วัตถุดิบคงเหลือ</span>
          </a>
          <!-- <i class='bx bxs-chevron-down arrow' ></i> -->
        </div>
        <ul class="sub-menu">
          <li><a href="../material/manage_material.php">วัตถุดิบคงเหลือ</a></li>
        </ul>
     </li>

      <li>
    <div class="profile-details">
      <div class="profile-content">
        <img src="../image/bekery.jpg" alt="profileImg">
      </div>
      <div class="name-job">
        <div class="profile_name">พนักงาน</div>
        <div class="job">BEKERY STORE</div>
      </div>
      <a href="cutstock_material.php?logout='1'"> <i class='bx bx-log-out'  id="logout" ></i> </a>
    </div>
  </li>
</ul>
  </div>
  <section class="home-section">
    <div class="home-content">
      <i class='bx bx-menu' ></i>
    </div>

    <div class="container">
        <div class=" h4 text-center alert alert-info mb-4 mt-4" role="alert">ตัดสต็อกวัตถุดิบ</div>
        <form action="insert_cutstock.php" method="post" enctype="multipart/form-data">
            <div class="row py-2">
                <div class="col">
                    <label>รหัสวัตถุดิบ</label>
                    <input readonly type="text" name="M_ID" id="M_ID" class="form-control" required>
                </div>
                <div class="col ">
                    <label>ชื่อวัตถุดิบ</label>

                    <select name="M_name" id="cut_mat" class="form-select" onchange="fetchemp1()">
                        <option value="" selected hidden>----เลือก----</option>
                        <?php 

                            while($rows = mysqli_fetch_array($result)){
                            ?>
                        <option value="<?=$rows['id'];?>" ><?=$rows['M_name'];?></option>
                        <?php
                            }
                            mysqli_close($conn); //ปิดการเชื่อมต่อฐานข้อมูล
                        ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label>หน่วยใช้</label>
                    <input readonly type="text" name="M_unit_use" id="M_unit_use" class="form-control" >
                </div>

                <div class="col">
                    <label>จำนวนที่ต้องการตัด</label>
                    <input type="number" min="1" name="M_num" class="form-control" oninvalid="setCustomValidity('กรุณาป้อนค่าจำนวน')" placeholder="ป้อนค่าจำนวน"
                        required>
                </div>
            </div>
            <div>
            <button type="submit" name="submit" class="btn btn-success my-3">ตัดสต็อก</button>
            <!-- <a href="#" class="btn btn-danger">กลับ</a> -->
            </div>
        </form>

    </div>
    </div>

  </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script>
    function fetchemp1() {
        var id = document.getElementById("cut_mat").value;

        $.ajax({
            url: "../material/fetchMat1.php",
            method: "POST",
            data: {
                x: id
            },
            dataType: "JSON",
            success: function(data) {
                document.getElementById("M_ID").value = data.M_ID;
                document.getElementById("M_unit_use").value = data.M_unit_use;
                console.log(data);
            }
        });
    }
    </script>
    <script src="../script.js"></script>
</body>

</html>
