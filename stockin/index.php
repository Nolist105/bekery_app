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
    <title>รายการวัตถุดิบที่รับเข้า</title>

    <!--Bootstap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!--boxicon-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
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
        <div class=" h4 text-center alert alert-info mb-4 mt-4" role="alert"> รายการวัตถุดิบที่รับเข้า</div>
        <hr>
        <a href="../material/stockin_material.php" class="btn btn-success mb-4"><i class="bi bi-plus-circle-fill"></i> รับเข้าวัตถุดิบ</a>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">วันที่รับเข้า</th>
                    <th scope="col">รหัสวัตถุดิบ</th>
                    <th scope="col">ชื่อวัตถุดิบ</th>
                    <th scope="col">จำนวนที่รับเข้า</th>
                    <th scope="col">หน่วยใช้</th>
                    <th scope="col">ต้นทุนที่รับเข้า</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php 
                    
                    $stmt = $conn -> query("SELECT * FROM stockin");
                    $stmt -> execute();
                    $stockin = $stmt -> fetchAll();

                    if (!$stockin) {
                        echo "<p><td colspan='8' class='text-center'>ไม่มีข้อมูล</td></p>";
                    } else {
                    foreach($stockin as $stockin)  {  
                ?>
                <tr>
                    <td><?php echo $stockin['S_date']; ?></td>
                    <td><?php echo $stockin['M_ID']; ?></td>
                    <td><?php echo $stockin['M_name']; ?></td>
                    <td><?php echo $stockin['S_in']; ?></td>
                    <td><?php echo $stockin['S_unit_pack']; ?></td>
                    <td><?php echo $stockin['S_cost']; ?></td>
                    
                </tr>
            </tbody>
            <?php } } ?>
        </table>

    </div>

    </section>
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

  <script src="../script.js"></script>

</body>
</html>