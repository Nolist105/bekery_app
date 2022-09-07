<?php 
    session_start();
    require_once "../config/config_sqli.php";
    $query = "SELECT * FROM product ORDER BY P_ID desc limit 1";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
    $lastid = $row["P_ID"];

    if (empty($lastid)) 
    {
        $productid = "P001";
    } 
    else
    {
        $idd = str_replace("P","",$lastid);
        $id = str_pad($idd + 1,3,0, STR_PAD_LEFT);
        $productid = 'P' .$id;
    }

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" >
    <title>เพิ่มสินค้า</title>

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
<div class="sidebar close" >
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
        <div class=" h4 text-center alert alert-info mb-4 mt-4" role="alert">เพิ่มข้อมูลสินค้า</div>
        <form action="insert_product.php" method="POST" enctype="multipart/form-data" >
            <div class="row py-2">
                <div class="col">
                   <label>รหัสสินค้า</label>
                   <input type="text" name="P_ID" id="P_ID" value="<?php echo $productid; ?>" class="form-control"  readonly>  
                </div>
                
                <div class="col">
                    <label>ชื่อสินค้า</label>
                    <input type="text" name="P_name" class="form-control" placeholder="ป้อนชื่อสินค้า"
                    maxlength="20" oninvalid="setCustomValidity('กรุณาป้อนชื่อสินค้า')" oninput="setCustomValidity('')" required>
                </div>
            </div>
            
            <div class="col">
                <label>รูปภาพ</label>
                <input type="file" name="P_image" class="form-control" id="imgInput" 
                maxlength="20" oninvalid="setCustomValidity('กรุณาเลือกรูปภาพ')" oninput="setCustomValidity('')" required>
                <img id="previewImg" alt=""  width="100 px" >
            </div>
            <divclass="col" >
                <label>ราคา</label>
                <input type="number" name="Price" class="form-control" placeholder="ป้อนราคา" 
                maxlength="5" oninvalid="setCustomValidity('กรุณาป้อนราคา')" oninput="setCustomValidity('')"required>
            </divclass=>

            <div class="row py-2">
            <div class="col">
                <label for="">หน่วยผลิต</label>
                <select name="P_unit_pro" class="form-select" require>
                    <option value="" selected hidden>--- เลือกหน่วยผลิต ---</option>
                    <option value="ถาด">ถาด</option>
                    <option value="ปอนด์">ปอนด์</option>
                </select>
            </div>
            

            <div class="col">
                <label>จำนวนต่อหน่วย</label>
                <input type="number" name="P_number" class="form-control" placeholder="ป้อนจำนวนต่อหน่วย" 
                maxlength="5" oninvalid="setCustomValidity('กรุณาป้อนจำนวนแปลงหน่วย')" oninput="setCustomValidity('')" required>
            </div>

            </div>
            
            <button type="submit" name="submit" class="btn btn-success my-3">บันทึก</button>
            <a href="index.php" class="btn btn-danger">กลับ</a>
        </form>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script>
            let imgInput = document.getElementById('imgInput');    
            let previewImg = document.getElementById('previewImg');
            
            imgInput.onchange = evt => {
                const [file] = imgInput.files;
                if (file) {
                    previewImg.src = URL.createObjectURL(file);
                }
            }
        </script>

  </section>


  <script src="../script.js"></script>

</body>
</html>