<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
    session_start();

    if (!isset($_SESSION['user'])) {
      $_SESSION['msg'] = "Please Login";
      header("location:../loginform.php");
    }

    if (isset($_GET['logout'])) {
      
      unset($_SESSION['user']);
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
    <title>รับวัตถุดิบเข้าคลัง</title>
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


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Bai+Jamjuree:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600;1,700&family=Chakra+Petch:ital,wght@0,300;0,400;0,600;0,700;1,300;1,500;1,600;1,700&display=swap">

        <!--Bootstap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!--boxicon-->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <!--flaticon-->
    <link href="https://registry.npmjs.org/@flaticon/flaticon-uicons/-/flaticon-uicons-1.7.0.tgz" rel="stylesheet"> 

    <!--css-->
    <link rel="stylesheet" href="../sidebars.css">
    <style>
        body{
            font-family: Bai Jamjuree;
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
      <a href="stockin_material.php?logout='1'"> <i class='bx bx-log-out'  id="logout" ></i> </a>
    </div>
  </li>
</ul>
  </div>
  <section class="home-section">
    <div class="home-content">
      <i class='bx bx-menu' ></i>
    </div>

    <div class="container my-5">
        
            <div class=" h4 text-center alert alert-info mb-4 mt-2" role="alert">รับเข้าวัตถุดิบ</div>
            <form action="insert_stockin.php" method="POST" enctype="multipart/form-data">
                <div class="row form-group">
                    <label>วันที่รับเข้า</label>
                    <div class="input-group flex-nowrap">
                        <span class="input-group-text"><i class="fa-solid fa-calendar-days"></i></span>
                        <input type="text" name="S_date" id="datepicker" class="form-control"
                            value="<?=date("d-m-Y", strtotime(date('Y-m-d'))) ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label>รหัสวัตถุดิบ</label>
                        <input readonly type="text" name="M_ID" id="M_ID" class="form-control">
                    </div>

                    <div class="col ">
                        <label>ชื่อวัตถุดิบ</label>

                        <select name="M_name" id="material_name" class="form-select" onchange="fetchemp()">
                            <option value="" selected hidden>----เลือก----</option>
                            <?php 

                            while($rows = mysqli_fetch_array($result)){
                            ?>
                            <option value="<?=$rows['id'];?>"><?=$rows['M_name'];?></option>
                            <?php
                            }
                            mysqli_close($conn); //ปิดการเชื่อมต่อฐานข้อมูล
                        ?>
                        </select>

                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label>หน่วยซื้อ</label>
                        <input readonly type="text"  name="S_unit_pack" id="M_unit_pack" class="form-control" required>
                    </div>

                    <div class="col">
                        <label>ต้นทุนต่อหน่วยซื้อ</label>
                        <input type="number" name="S_cost" class="form-control" placeholder="ป้อนต้นทุนต่อหน่วยซื้อ" oninvalid="setCustomValidity('กรุณาป้อนต้นทุนต่อหน่วยซื้อ')"
                            required>
                    </div>
                </div>

                <div>
                    <label>จำนวนที่รับเข้า</label>
                    <input type="number" name="S_in" class="form-control" placeholder="ป้อนจำนวนที่รับเข้า" oninvalid="setCustomValidity('กรุณาป้อนจำนวนที่รับเข้า')" required>
                </div>
                <button type="submit" name="submit" class="btn btn-success my-3">บันทึก</button>
                <a href="index_stockin.php" class="btn btn-danger">กลับ</a>
            </form>


    </div>
  </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"
        integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.th.min.js"
        integrity="sha512-cp+S0Bkyv7xKBSbmjJR0K7va0cor7vHYhETzm2Jy//ZTQDUvugH/byC4eWuTii9o5HN9msulx2zqhEXWau20Dg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script type="text/javascript">
    $('#datepicker').datepicker({
        format: 'dd-mm-yyyy',
        language: 'th',
    })

    function fetchemp() {
        var id = document.getElementById("material_name").value;

        $.ajax({
            url: "../material/fetchMat.php",
            method: "POST",
            data: {
                x: id
            },
            dataType: "JSON",
            success: function(data) {
                document.getElementById("M_ID").value = data.M_ID;
                document.getElementById("M_unit_pack").value = data.M_unit_pack;
                console.log(data);
            }
        });
    }
    </script>
<script src="../script.js"></script>
</body>

</html>