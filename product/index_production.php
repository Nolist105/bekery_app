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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สั่งผลิตสินค้า</title>
    <!--Bootstap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!--font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
        integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
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
      <a href="index_production.php?logout='1'"> <i class='bx bx-log-out'  id="logout" ></i> </a>
    </div>
  </li>
</ul>
  </div>
  <section class="home-section">
    <div class="home-content">
      <i class='bx bx-menu' ></i>
    </div>

    <div class="container">
        <div class=" h4 text-center alert alert-info mb-4 mt-4" role="alert">รายการสินค้าที่สั่งผลิต</div>
        <hr>
          <a href="production_order.php" class="btn btn-success mb-4" ><i class="fa-solid fa-circle-plus"></i> สั่งผลิต</a>
        <table id="datatableid" class="table table-striped table-hover table-bordered" style="width:100%">
            <thead class="table-danger">
                <tr align="center">
                    <th scope="col">วันที่สั่งผลิต</th>
                    <th scope="col">รหัสสินค้า</th>
                    <th scope="col">ชื่อสินค้า</th>
                    <th scope="col">จำนวนที่ผลิต</th>
                    <th scope="col">หน่วยผลิต</th>
                    <th scope="col">ต้นทุนในการผลิต</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                 
                  require_once "../config/config_sqli.php";
                  
                  $sql = "SELECT * FROM production_order JOIN product ON production_order.P_ID = product.id" ;   
                  $in_order=mysqli_query($conn,$sql);

              
                  if (!$in_order) {
                      echo "<p><td colspan='8' class='text-center'>ไม่มีข้อมูล</td></p>";
                  } else {
                  foreach($in_order as $in_order)  {  
              ?>
                <tr align="center">
                    <td><?php echo $in_order['Pro_date']; ?></td>
                    <td><?php echo $in_order['P_ID']; ?></td>
                    <td><?php echo $in_order['P_name']; ?></td>
                    <td><?php echo $in_order['Pro_amount']; ?></td>
                    <td><?php echo $in_order['P_unit_pro']; ?></td>
                    <td></td>
                </tr>
                <?php } 
                } ?>

            </tbody>
        </table>
    </div>
  </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>


    <script>
    $(document).ready(function() {

        $('#datatableid').DataTable({
            language: {
                "decimal": "",
                "emptyTable": "ไม่มีข้อมูลในตาราง",
                "info": "แสดง _START_ - _END_ จาก _TOTAL_ รายการ",
                "infoEmpty": "แสดง 0 - 0 จาก 0 รายการ",
                "infoFiltered": "(กรอง จาก _MAX_ รายการทั้งหมด)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "แสดง _MENU_ รายการ",
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
    <script src="../script.js"></script>
</body>

</html>