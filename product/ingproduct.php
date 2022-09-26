<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
    session_start();
    require_once "../config/configpdo.php";
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สูตรการผลิต</title>

    <!--Bootstap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css%22%3E">
    <!--boxicon-->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <!--flaticon-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link href="https://registry.npmjs.org/@flaticon/flaticon-uicons/-/flaticon-uicons-1.7.0.tgz" rel="stylesheet"> 
    <!--load all Font Awesome styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <!--css-->
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Bai+Jamjuree:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600;1,700&family=Chakra+Petch:ital,wght@0,300;0,400;0,600;0,700;1,300;1,500;1,600;1,700&display=swap">

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
    <div class="profile-details">
      <div class="profile-content">
        <img src="../image/bekery.jpg" alt="profileImg">
      </div>
      <div class="name-job">
        <div class="profile_name">เจ้าของร้าน</div>
        <div class="job">BEKERY STORE</div>
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
<!-- เพิม -->
      
<div class="container">
        <div class=" h4 text-center alert alert-info mb-4 mt-4" role="alert"> สูตรการผลิต</div>
        <hr>
        <form action="" method="GET" enctype="multipart/form-data" >
        <?php
                require_once "../config/configpdo.php";
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $stml = $conn->query("SELECT * FROM product WHERE id = $id");
                    $stml->execute();
                    $data = $stml->fetch();
                }
            ?>
            <div class="card" style="width: fit-content;">
                  <div class="card-body">
                    <h5 class="card-title"><?= $data['P_ID']; ?> <?= $data['P_name']; ?> <?= $data['P_quantity']; ?> <?= $data['P_unit_pro']; ?></h5>
                  </div>
              </div>
  
        <?php
        ?>
       
        <table id="datatableid" class="table table-striped table-hover table-bordered mt-2">

          <thead>
            <tr align="center">
              <th scope="col" style="width: 200px;">รหัสวัตถุดิบ</th>
              <th scope="col" style="width: 200px;">ชื่อวัตถุดิบ</th>
              <th scope="col" style="width: 200px;">จำนวน</th>
              <th scope="col" style="width: 200px;">หน่วยใช้</th>

            </tr>
          </thead>

          <tbody>

          <?php 
          
                    $stmt = $conn -> query("SELECT * FROM ing INNER JOIN material ON ing.M_ID = material.id WHERE P_ID = $id");
                    $stmt -> execute();
                    $ing = $stmt -> fetchAll();

                    if (!$ing) {
                        echo "<p><td colspan='8' class='text-center'>ไม่มีข้อมูล</td></p>";
                    } else {
                    foreach($ing as $ing)  {  
                ?>
                <tr align="center">
                  <td> <?= $ing['M_ID']; ?></td>
                  <td> <?= $ing['M_name']; ?></td>
                  <td><?= $ing['ing_num']; ?></td>
                  <td><?= $ing['M_unit_use']; ?></td>                            
                </tr>
                <?php } 
                } ?>
          </tbody>

        </table>

        
        <a href="editingredient.php"
        class="icon-cog fs-5 me-3 btn btn-outline-warning"><i class="bi bi-pencil-fill"></i></a>
        <a href="index.php" class="btn btn-danger">กลับ</a>
      </form>
    </div>
  
    
    </section>
    
    <script src="../script.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js%22%3E"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js%22%3E"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js%22%3E"></script>

    <script>
    $(document).ready(function() {

        $('#datatableid').DataTable({
            language: {
                "decimal": "",
                "emptyTable": "ไม่มีข้อมูลในตาราง",
                "info": "แสดง START - END จาก TOTAL รายการ",
                "infoEmpty": "แสดง 0 - 0 จาก 0 รายการ",
                "infoFiltered": "(กรอง จาก MAX รายการทั้งหมด)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "แสดง MENU รายการ",
                "loadingRecords": "กำลังโหลด...",
                "processing": "",
                "search": "ค้นหา:",
                "zeroRecords": "ไม่พบบันทึกที่ตรงกัน",
                "paginate": {
                    "first": "First",
                    "last": "Last",
                    "next": "หน้าถัดไป",
                    "previous": "ก่อนหน้า"
                },
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                }
            },
            "searching": false,

        });
    });
    </script>
</body>
</html>