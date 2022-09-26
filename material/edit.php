
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไข้วัตถุดิบ</title>

    <!--Bootstap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!--boxicon-->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <!--flaticon-->
    <link href="https://registry.npmjs.org/@flaticon/flaticon-uicons/-/flaticon-uicons-1.7.0.tgz" rel="stylesheet"> 

    <!--css-->
    <link rel="stylesheet" href="../style.css">

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
        <div class="profile_name">Bekery</div>
        <div class="job">Web Desginer</div>
      </div>
      <a href="../index.php?logout='1'"> <i class='bx bx-log-out'  id="log_out" ></i> </a>
    </div>
  </li>
</ul>
  </div>

  <section class="home-section">
    <div class="home-content">
      <i class='bx bx-menu' ></i>
    </div>

    <div class="container my-5">
        <div class=" h4 text-center alert alert-info mb-4 mt-4" role="alert">แก้ไขข้อมูลวัตถุดิบ</div>
        <form action="update.php" method="post" enctype="multipart/form-data" >
            <?php
                require_once "../config/configpdo.php";
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $stml = $conn->query("SELECT * FROM material WHERE id = $id");
                    $stml->execute();
                    $data = $stml->fetch();
                }
            ?>
            <div class="row py-2">
                
                <div class="col">
                    <input hidden type="text" value="<?= $data['id']; ?>" name="id" class="form-control" >
                    <label>รหัสวัตถุดิบ</label>
                    <input readonly type="text" value="<?= $data['M_ID']; ?>" name="M_ID" class="form-control" placeholder="ป้อนรหัสวัตถุดิบ" maxlength="4">
                </div>
                <div class="col">
                    <label>ชื่อวัตถุดิบ</label>
                    <input type="text" value="<?= $data['M_name']; ?>" name="M_name" class="form-control" placeholder="ป้อนชื่อวัตถุดิบ" required>
                </div>
            </div>
            
            <div class="row py-2">
                <div class="col">
                    <label>หน่วยซื้อ</label>
                    <select name="M_unit_pack" class="form-select" id="" >
                        <option value="<?= $data['M_unit_pack']; ?>" selected hidden><?= $data['M_unit_pack']; ?></option>
                        <option value="กิโลกรัม">กิโลกรัม</option>
                        <option value="กรัม">กรัม</option>
                        <option value="แผง">แผง</option>
                        <option value="มิลลิลิตร">มิลลิลิตร</option>
                        <option value="ลิตร">ลิตร</option>
                    </select>
                </div>
                <div class="col">
                    <label>หน่วยใช้</label>
                    <select name="M_unit_use" class="form-select" id="">
                        <option value="<?= $data['M_unit_use']; ?>" selected hidden><?= $data['M_unit_use']; ?></option>
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
                    <input type="number" value="<?= $data['M_number']; ?>" name="M_number" class="form-control" placeholder="ป้อนค่าจำนวนแปลงหน่วย" autocomplete="off" required>
                </div>
                <div class="col">
                    <label>ค่า yield</label>
                    <input type="number" value="<?= $data['M_Yield']; ?>" name="M_Yield" class="form-control" placeholder="ป้อนค่า yield" autocomplete="off" required>
                </div>
                
            </div> 
            
            <button type="submit" class="btn btn-primary" name="update">บันทึก</button>
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