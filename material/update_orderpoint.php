<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
    session_start();
    require_once "../config/config_sqli.php";
    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $M_ID = $_POST['M_ID'];
        $M_name = $_POST['M_name'];
        $D = $_POST['D'];
        $LT = $_POST['LT'];
        echo $D;

        $sql = $conn->prepare("UPDATE orderpoint SET D = '$D', LT = '$LT' WHERE id = '$id'");
        $sql->execute();
        
        $totaldlt = $D * $LT ;
        $sql2 = $conn->prepare("UPDATE material SET M_point = '$totaldlt' WHERE id = '$id'");

        if ($sql && $sql2->execute()) {
            $_SESSION['success'] = '<script>
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "แก้ไขข้อมูลเรียบร้อยแล้ว",
                        showConfirmButton: false,
                        timer: 1500
                      })
                </script>';

                    header("location: ../material/index_orderpoint.php");
        } else {
            $_SESSION['error'] = '<script>
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "แก้ไขข้อมูลไม่สำเร็จ",
                        showConfirmButton: false,
                        timer: 1500
                      })
                </script>';

                    header("location: ../material/index_orderpoint.php");
        }
    }
?>