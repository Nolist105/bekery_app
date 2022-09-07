<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
    session_start();
    require_once "../config/configpdo.php";

    if (isset($_GET['delete'])) {
        $delete_id = $_GET['delete'];
        $stmt = $conn -> query("DELETE FROM material WHERE id = $delete_id");
        $stmt -> execute();

        if ($stmt) {
            $_SESSION['success'] = "ลบข้อมูลเรียบร้อยแล้ว";
            echo "<script>
                $(document).ready(function () {
                    Swal.fire ({
                        icon: 'success',
                        title: 'สำเร็จ',
                        text: 'ลบข้อมูลเรียบร้อยแล้ว',
                        timer: 2000,
                        showConfirmButton: true
                    });
                });
            </script>";
            header("refresh:2; url=../material/restore_material.php");
        } else {
            $_SESSION['error'] = "ลบข้อมูลไม่สำเร็จ";
            echo "<script>
                $(document).ready(function () {
                    Swal.fire ({
                        icon: error',
                        title: 'เกิดข้อผิดพลาด',
                        text: 'ลบข้อมูลไม่สำเร็จ',
                        timer: 2000,
                        showConfirmButton: true
                    });
                });
            </script>";
            header("refresh:2; url=../material/restore_material.php");
        }
  }

  if (isset($_GET['restore'])) {
    $delete_id = $_GET['restore'];
    $stmt = $conn -> query("UPDATE material set M_status='1' WHERE id = $delete_id");
    $stmt -> execute();

    if ($stmt) {
        $_SESSION['success'] = "คืนค่าข้อมูลเรียบร้อยแล้ว";
        echo "<script>
            $(document).ready(function () {
                Swal.fire ({
                    icon: 'success',
                    title: 'สำเร็จ',
                    text: 'คืนค่าข้อมูลเรียบร้อยแล้ว',
                    timer: 2000,
                    showConfirmButton: true
                });
            });
        </script>";
        header("refresh:2; url=../material/restore_material.php");
    } else {
        $_SESSION['error'] = "คืนค่าข้อมูลไม่สำเร็จ";
        echo "<script>
            $(document).ready(function () {
                Swal.fire ({
                    icon: error',
                    title: 'เกิดข้อผิดพลาด',
                    text: 'คืนค่าข้อมูลไม่สำเร็จ',
                    timer: 2000,
                    showConfirmButton: true
                });
            });
        </script>";
        header("refresh:2; url=../material/restore_material.php");
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>วัตถุดิบ</title>

    <!--Bootstap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!--boxicon-->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
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
          <a href="#">
            <i class='bx bxs-bookmark-alt'></i>
            <span class="link_name">จัดการวัตถุดิบ</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">จัดการวัตถุดิบ</a></li>
          <li><a href="#">รายการจัดการวัตถุดิบ</a></li>
        </ul>
      </li>
      
      <li>
        <div class="iocn-link">
          <a href="#">
            <i class='bx bxs-message-square-edit'></i>
            <span class="link_name">สต็อกวัตถุดิบ</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">สต็อกวัตถุดิบ</a></li>
          <li><a href="#">รายการสต็อกวัตถุดิบ</a></li>
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
        <div class=" h4 text-center alert alert-info mb-4 mt-4" role="alert"> คืนค่าข้อมูลวัตถุดิบ</div>
        <hr>
        <a href="index.php" class="btn btn-danger mb-4">กลับ</a>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">ลำดับ</th>
                    <th scope="col">รหัสวัตถุดิบ</th>
                    <th scope="col">ชื่อวัตถุดิบ</th>
                    <th scope="col">หน่วยซื้อ</th>
                    <th scope="col">หน่วยใช้</th>
                    <th scope="col">แปลงหน่วย</th>
                    <th scope="col">จัดการ</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    
                    $stmt = $conn -> query("SELECT * FROM material WHERE M_status='0' ");
                    $stmt -> execute();
                    $material = $stmt -> fetchAll();

                    if (!$material) {
                        echo "<p><td colspan='8' class='text-center'>ไม่มีข้อมูล</td></p>";
                    } else {
                    foreach($material as $material)  {  
                ?>
                <tr>
                    <td><?php echo $material['id']; ?></td>
                    <td><?php echo $material['M_ID']; ?></td>
                    <td><?php echo $material['M_name']; ?></td>
                    <td><?php echo $material['M_unit_pack']; ?></td>
                    <td><?php echo $material['M_unit_use']; ?></td>
                    <td><?php echo $material['M_number']; ?></td>
                    <td>
                        
                        <a data-id="<?php echo $material['id']; ?>" href=" ?restore=<?php echo $material['id']; ?>"
                            class="btn btn-primary">คืนค่า</a>
                        <a data-id="<?php echo $material['id']; ?>" href=" ?delete=<?php echo $material['id']; ?>"
                            class="btn btn-danger">ลบ</a>
                    </td>
                    <!-- <td>
                        <a href="" class="btn btn-warning">แก้ไข</a>
                        <a href="" class="btn btn-danger">ลบ</a>
                    </td> -->
                </tr>
            </tbody>
            <?php } } ?>
        </table>

    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <script>
    $('.delete-btn').click(function(e) {
        var materialID = $(this).data('id');
        e.preventDefault();
        deleteConfirm(materialID);
    })

    function deleteConfirm(materialID) {
        Swal.fire({
            title: 'แจ้งเตือน',
            text: 'ต้องการลบรายการนี้หรือไม่',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#bebebe',
            confirmButtonText: "ตกลง",
            cancelButtonText: "ยกเลิก",
            preConfirm: function() {
                return new Promise(function(resolve) {
                    $.ajax({
                            url: 'index.php',
                            type: 'GET',
                            data: 'delete=' + materialID
                        })
                        .done(function() {
                            Swal.fire({
                                icon: 'success',
                                title: 'สำเร็จ',
                                text: 'ลบข้อมูลสำเร็จแล้ว',
                                timer: '2000'
                            }).then(() => {
                                document.location.href =
                                    'index.php';
                            })
                        })
                        .fail(function() {
                            Swal.fire('เกิดข้อผิดพลาด ',
                                'โปรดลองใหม่อีกครั้ง', 'error'
                            );
                            window.location.reload();
                        })
                })
            }
        })
    }
    </script>

  </section>

  <script src="../script.js"></script>

</body>
</html>