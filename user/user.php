<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
    session_start();
    require_once "../config/config_sqli.php";
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

    if (isset($_GET['delete'])) {
        $delete_id = $_GET['delete'];
        $stmt = "UPDATE user SET u_delete='0' WHERE id = $delete_id";
        $stmt = mysqli_query($conn, $stmt);

        if ($stmt) {
            $_SESSION['success'] = "ลบข้อมูลเรียบร้อยแล้ว";
            header("refresh:2; url=../user/user.php");
        } 
  }

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <!--boxicon-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <!--flaticon-->
    <link href="https://registry.npmjs.org/@flaticon/flaticon-uicons/-/flaticon-uicons-1.7.0.tgz" rel="stylesheet"> 
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Bai+Jamjuree:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600;1,700&family=Chakra+Petch:ital,wght@0,300;0,400;0,600;0,700;1,300;1,500;1,600;1,700&display=swap">
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
                    <a href="user.php?logout='1'"> <i class='bx bx-log-out'  id="log_out" ></i> </a>
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
        <table id="datatableid" class="table table-striped table-hover table-bordered">
        <thead class="table-primary">
                <tr align="center">
                    <th scope="col">ชื่อผู้ใช้</th>
                    <th scope="col">จัดการ</th>
                </tr>
            </thead>
            <tbody>
    <?php
    $sql = "SELECT * FROM user WHERE urole='0' and u_delete = '1'";
    $result=mysqli_query($conn,$sql);
    if (!$result) {
        echo "<p><td colspan='8' class='text-center'>ไม่มีข้อมูล</td></p>";
    } else {
    foreach($result as $result)  {  
        ?>
        <tr align="center">
            <td><?php echo $result['username']; ?></td>
            <td>
                <a data-id="<?php echo $result['id']; ?>" href=" ?delete=<?php echo $result['id']; ?>"
                    class="delete-btn icon-de"><i class="btn btn-outline-danger bi bi-trash3-fill"></i></a>
            </td>
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
                            url: 'user.php',
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
                                    'user.php';
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
      </script>

</body>
</html>

<!-- <script language="JavaScript">
    function Delete(mypage){
        var agree=confirm("ยืนยันการลบข้อมูลหรือไม่");
        if(agree){
            window.location=mypage;
        }
        
    }
</script> -->