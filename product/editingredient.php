<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
    session_start();
    require_once "../config/configpdo.php";

    if (!isset($_SESSION['admin'])) {
      $_SESSION['msg'] = "Please Login";
      header("location:../loginform.php");
  }

    if (isset($_GET['logout'])) {
      
      unset($_SESSION['admin']);
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
    <title>แก้ไขสูตรวัตถุดิบ</title>

    <!--Bootstap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!--boxicon-->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <!--flaticon-->
    <link href="https://registry.npmjs.org/@flaticon/flaticon-uicons/-/flaticon-uicons-1.7.0.tgz" rel="stylesheet"> 
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">

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
        <div class="profile_name">เจ้าของร้าน</div>
        <div class="job">BAKERY STORE</div>
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

    <div class="container ">
        <div class=" h4 text-center alert alert-info mb-4 mt-4" role="alert">แก้ไขสูตรวัตถุดิบ</div>
        <form action="updateing.php" method="POST" enctype="multipart/form-data" >
        <?php
                require_once "../config/configpdo.php";
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $stml = $conn->query("SELECT * FROM product WHERE id = $id");
                    $stml->execute();
                    $data = $stml->fetch();
                    
                }
            ?>
            <div class="row mb-2">
                <div class="col">
                    <input hidden type="text" name="id" value="<?= $data['id']; ?>" class="form-control" > 
                    <input readonly type="text" name="" value="<?= $data['P_ID']; ?>" class="form-control" > 
                </div>
                <div class="col">
                    <input readonly type="text" name="" value="<?= $data['P_name']; ?>" class="form-control" > 
                </div>
                <div class="col">
                    <input readonly type="text" name="" value="<?= $data['P_quantity']; ?>" class="form-control" > 
                </div>
                <div class="col">
                    <input readonly type="text" name="" value="<?= $data['P_unit_pro']; ?>" class="form-control" > 
                </div>
            </div>
                    
        <!-- สูตรการผลิตเดิม --> 
        <!-- ??? -->
        <table id="datatableid" class="table table-striped table-hover table-bordered mt-4 mb-4 ">

          <thead class="table-danger" >
            <tr align="center">
              <th scope="col" style="width: 200px;">รหัสวัตถุดิบ</th>
              <th scope="col" style="width: 200px;">ชื่อวัตถุดิบ</th>
              <th scope="col" style="width: 200px;">จำนวน</th>
              <th scope="col">หน่วยใช้</th>
            </tr>
          </thead>

          <tbody>
          
          <?php 
                    /*  */
                    
                    $stmt1 = $conn -> query("SELECT ing.*,material.M_name,material.M_ID,material.M_unit_use FROM ing INNER JOIN material WHERE ing.P_ID = $id AND ing.M_ID = material.id");
                    $stmt1 -> execute();
                    $ing = $stmt1 -> fetchAll();

                    if (!$ing) {
                        echo "<p><td colspan='8' class='text-center'>ไม่มีข้อมูล</td></p>";
                    } else {
                    foreach($ing as $key => $ing)  {  
                ?>
                <tr align="center">

                  <td width='20%'><input type="checkbox" name="edit_checkbox[<?= $key;?>]" checked value="<?= $ing['id']; ?>" /> <?= $ing['M_ID']; ?></td>
                  <td width='20%'><input type="hidden" name="edit_mat_name[<?= $key;?>]" value="<?= $ing['id']; ?>" /> <?= $ing['M_name']; ?></td>
                  <td width='20%'><input type="number" name="edit_ing_num[<?= $key;?>]" value="<?=$ing['ing_num']; ?>" class="form-control" min="0"></td>
                  <input type="hidden" name="edit_inglist[<?= $key;?>]" checked value="<?= $ing['id']; ?>" />
                  <td width='20%'><input type="hidden" name="edit_ing_use[<?= $key;?>]" value="<?= $ing['id']; ?>" /> <?= $ing['M_unit_use']; ?></td>
                  
                  <input type="hidden" name="edit_P_quantity[<?= $key;?>]" value="<?= $data['P_quantity']; ?>" />

                  <!--  Send ProductId, MaterialId to update, delete-->
                  <input type="hidden" name="edit_ing_id[<?= $key;?>]" value="<?= $ing['id']; ?>" />
                  <input type="hidden" name="edit_P_ID[<?= $key;?>]" value="<?= $data['id']; ?>" />
                  <input type="hidden" name="edit_material_ids[<?= $key;?>]" value="<?= $ing['id']; ?>">

                </tr>
                <?php } 
                } ?>
          </tbody>
          </table>

          <!-- เพิ่มสูตรการผลิตเพิ่ม -->
          <!-- ??? -->
          <div class=" h4 text-center alert alert-warning mb-4 mt-4" role="alert">เพิ่มสูตรวัตถุดิบเพิ่มเติม</div>
          <table id="datatableid1" class="table table-striped table-hover table-bordered mt-4">
              <thead class="table-danger" >
                <tr align="center">
                  <th scope="col" style="width: 200px;">รหัสวัตถุดิบ</th>
                  <th scope="col" style="width: 200px;">ชื่อวัตถุดิบ</th>
                  <th scope="col" style="width: 200px;">จำนวน</th>
                  <th scope="col">หน่วยใช้</th>
                </tr>
              </thead>
              <tbody>
                  <?php 
                  /* ("SELECT * FROM material WHERE M_status= '1' AND id != '".$ing['M_ID']."'") */
                      $stmt = $conn -> query("SELECT * FROM material WHERE M_status= '1'");
                      $stmt -> execute();
                      $material = $stmt -> fetchAll();

                      $show_ing2 = $conn -> query("SELECT * FROM ing");
                      $check_ing = $show_ing2 ->rowCount();

                      if (!$material) {
                          echo "<p><td colspan='8' class='text-center'>ไม่มีข้อมูล</td></p>";
                      } else {
                      foreach($material as $key => $material)  
                      {  
                        $m_id ="";
                        
                        
                        $check_ing  = $conn->query("SELECT * FROM ing WHERE M_ID = '".$material['id']."' AND P_ID = '".$data['id']."' ORDER BY id ASC");
                        $check_ing -> execute();

                        while($row1= $check_ing->fetch()) {
                          $m_id = $row1['M_ID'];
                          
                        } 
                        
                        if($m_id != $material['id'] ){
                  ?>
                  <tr align="center">
                      
                      <td width='20%'><input type="checkbox" name="add_checkbox[<?= $key;?>]" value="<?= $material['id']; ?>" /> <?= $material['M_ID']; ?></td>
                      
                      <!-- M_name -->
                      <td width='20%'><input type="hidden" name="add_mat_name[<?= $key;?>]" value="<?= $material['id']; ?>" /> <?= $material['M_name']; ?></td>
                      <!-- ing_num -->
                      <td width='20%'><input type="number" name="add_ing_num[<?= $key;?>]" class="form-control" min="0"></td>
                      <input type="hidden" name="add_inglist[<?= $key;?>]" value="<?= $material['id']; ?>" />
                      
                      <!-- ing_use -->
                      <td width='20%'><input type="hidden" name="add_ing_use[<?= $key;?>]" value="<?= $material['id']; ?>" /> <?= $material['M_unit_use']; ?></td>
                      
                      <!-- P_quantity -->
                      <input type="hidden" name="add_P_quantity[<?= $key;?>]" value="<?= $data['P_quantity']; ?>" />

                        <!--  Send ProductId, MaterialId to update, delete-->
                        <!-- P_ID -->
                      <input type="hidden" name="add_P_ID[<?= $key;?>]" value="<?= $data['id']; ?>" />

                      <!-- M_ID -->
                      <input type="hidden" name="add_material_ids[<?= $key;?>]" value="<?= $material['id']; ?>">
                  </tr>
                    <?php } }
                    } ?>
              </tbody>
          </table>

          <div>
              <button type="submit" name="update" class="btn btn-success my-3">บันทึก</button>
              <a href="index.php" class="btn btn-danger">กลับ</a>
          </div>

        </form>
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
          

        });
    });
    
    </script>
    <script>
    $(document).ready(function() {

        $('#datatableid1').DataTable({
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
            

        });
    });
    
    </script>

  

  <script src="../script.js"></script>

</body>
</html>