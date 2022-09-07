<?php
include '../config/config_sqli.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ผู้ใช้</title>
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
    <div class="container">
        <div class=" h4 text-center alert alert-info mb-4 mt-4" role="alert"> ข้อมูลผู้ใช้ (พนักงาน)</div>
        <a href="adduser.php" class="btn btn-success mb-4">เพิ่มผู้ใช้</a>
        <table class="table table-striped table-hover" style="border: 2px;">
        <tr>
            <th>#</th>
            <th>ชื่อผู้ใช้</th>
            <th>จัดการ</th>
        </tr>
    <?php
    $sql = "SELECT * FROM user WHERE urole='0'";
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_array($result)){
    ?>
        <tr>
            <td><?=$row["id"]?></td>
            <td><?=$row["username"]?></td>
            <td>
            <a href="delete_user.php?id=<?=$row["id"]?>" class="btn btn-danger" onclick="Delete(this.href);return false;">ลบ</a>
            </td>
        </tr>
        <?php
    }
    mysqli_close($conn); //ปิดการเชื่อมต่อฐานข้อมูล
    ?>
    </table>



<script src="../script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
      </script>

</div>
  </section>




</body>
</html>

<script language="JavaScript">
    function Delete(mypage){
        var agree=confirm("ยืนยันการลบข้อมูลหรือไม่");
        if(agree){
            window.location=mypage;
        }
        
    }
</script>