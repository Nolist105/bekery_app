<?php
session_start();
?>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php 
    
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
    require_once "../config/config_sqli.php";
    $query = "SELECT * FROM material ORDER BY M_ID desc limit 1";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
    $lastid = $row["M_ID"];

    if (empty($lastid)) 
    {
        $materialid = "M001";
    } 
    else
    {
        $idd = str_replace("M","",$lastid);
        $id = str_pad($idd + 1,3,0, STR_PAD_LEFT);
        $materialid = 'M' .$id;
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มวัตถุดิบ</title>

    <!--Bootstap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!--boxicon-->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <!--flaticon-->
    <link href="https://registry.npmjs.org/@flaticon/flaticon-uicons/-/flaticon-uicons-1.7.0.tgz" rel="stylesheet"> 
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Bai+Jamjuree:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600;1,700&family=Chakra+Petch:ital,wght@0,300;0,400;0,600;0,700;1,300;1,500;1,600;1,700&display=swap">
    <!--css-->
    <link rel="stylesheet" href="../style.css">

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
        <a href="../index.php">
          <i class='bx bxs-home-smile'></i>
          <span class="link_name">หน้าหลัก</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="../index.php">หน้าหลัก</a></li>
        </ul>
      </li>

      <li>
        <div class="iocn-link">
          <a href="../user/user.php">
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
          <a href="../product/index.php">
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
          <a href="../material/index.php">
            <i class='bx bxs-calendar-heart'></i>
            <span class="link_name">วัตถุดิบ</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a href="../material/index.php">รายการวัตถุดิบ</a></li>
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
      <a href="add_material.php?logout='1'"> <i class='bx bx-log-out'  id="log_out" ></i> </a>
    </div>
  </li>
</ul>
  </div>

  <section class="home-section">
    <div class="home-content">
      <i class='bx bx-menu' ></i>
    </div>

    <div class="container my-5">
        <div class=" h4 text-center alert alert-info mb-4 mt-4" role="alert">เพิ่มข้อมูลวัตถุดิบ</div>
        <form action="insert_material.php" method="post" enctype="multipart/form-data" >
            <div class="row py-2">
                <div class="col">
                    <label>รหัสวัตถุดิบ</label>
                    <input type="text" name="M_ID" id="M_ID" class="form-control" value="<?php echo $materialid; ?>" readonly>
                </div>
                <div class="col">
                    <label>ชื่อวัตถุดิบ</label>
                    <input type="text" name="M_name" class="form-control" placeholder="ป้อนชื่อวัตถุดิบ" 
                     oninvalid="setCustomValidity('กรุณาป้อนชื่อวัตถุดิบ')" oninput="setCustomValidity('')"  required>
                    
                </div>
            </div>
            
            <div class="row py-2">
                <div class="col">
                    <label>หน่วยซื้อ</label>
                    <select name="M_unit_pack" class="form-select" id="" required >
                        <option value="" selected hidden>--- เลือกหน่วยซื้อ---</option >
                        <option value="กิโลกรัม">กิโลกรัม</option>
                        <option value="กรัม">กรัม</option>
                        <option value="แผง">แผง</option>
                        <option value="ลิตร">ลิตร</option>
                        <option value="มิลลิลิตร">มิลลิลิตร</option>
                    </select>
                </div>
                <div class="col">
                <label>หน่วยใช้</label>
                    <select name="M_unit_use" class="form-select" id="" required>
                        <option value="" selected hidden>--- เลือกหน่วยใช้ ---</option>
                        <option value="กรัม">กรัม</option>
                        <option value="ฟอง">ฟอง</option>
                        <option value="ช้อนโต๊ะ">ช้อนโต๊ะ</option>
                        <option value="ช้อนชา">ช้อนชา</option>
                    </select>
                </div>
            </div> 
            
            <div class="row py-2">
                <div class="col">
                    <label>จำนวนแปลงหน่วย</label>
                    <input type="text" name="M_number" class="form-control" placeholder="ป้อนค่าจำนวนแปลงหน่วย"  
                    maxlength="10" oninvalid="setCustomValidity('กรุณาป้อนจำนวนแปลงหน่วย')" oninput="setCustomValidity('')" required>
                </div>
                <div class="col">
                    <label>ค่า yield</label>
                    <input type="number" name="M_Yield" class="form-control" placeholder="ป้อนค่า yield"  
                    maxlength="2" oninvalid="setCustomValidity('กรุณาป้อนค่า yield')" oninput="setCustomValidity('')" required>
                </div>
                
            </div> 
            
            <button type="submit" class="btn btn-primary" name="submit">บันทึก</button>
            <!-- <input type="submit" name="submit" class="btn btn-success my-3" value="บันทึก"> -->
            <a href="index.php" class="btn btn-danger">กลับ</a>
        </form>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

  </section>

  <script src="../script.js"></script>

</body>
</html>