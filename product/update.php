<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
    session_start();
    require_once "../config/configpdo.php";

    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $P_name = $_POST['P_name'];
        $Price = $_POST['Price'];
        $P_unit_pro = $_POST['P_unit_pro'];
        $P_number = $_POST['P_number'];
        $P_image = $_FILES['P_image'];
        $P_image2 = $_POST['P_image2'];
        $upload = $_FILES['P_image']['name'];

        if ($upload != '') {
            $allow = array('jpg', 'jpeg', 'png');
            $extention = explode(".", $P_image['name']);
            $fileActExt = strtolower(end($extention));
            $fileNew = rand() . "." . $fileActExt;
            $filePath = "../uploads/".$fileNew;

            if (in_array($fileActExt, $allow)) {
                if ($P_image['size'] > 0 && $P_image['error'] == 0){
                    move_uploaded_file($P_image['tmp_name'], $filePath);
                }
            }
        } else {
            $fileNew = $P_image2;
        }

        $sql  = $conn->prepare("UPDATE product  SET P_name = :P_name, Price = :Price, P_unit_pro = :P_unit_pro, P_number = :P_number, P_image = :P_image WHERE id = :id");
        $sql->bindParam(":id", $id);
        $sql->bindParam(":P_name", $P_name);
        $sql->bindParam(":Price", $Price);
        $sql->bindParam(":P_unit_pro", $P_unit_pro);
        $sql->bindParam(":P_number", $P_number);
        $sql->bindParam(":P_image", $fileNew);
        $sql->execute();

        if ($sql) {
            $_SESSION['success'] = "แก้ไขข้อมูลเรียบร้อยแล้ว";
            echo "<script>
                $(document).ready(function () {
                    Swal.fire ({
                        icon: 'success',
                        title: 'สำเร็จ',
                        text: 'แก้ไขข้อมูลเรียบร้อยแล้ว',
                        timer: 2000,
                        showConfirmButton: true
                    });
                });
            </script>";
            header("refresh:2; url=../product/index.php");
        } else {
            $_SESSION['error'] = "แก้ไขข้อมูลไม่สำเร็จ";
            echo "<script>
                $(document).ready(function () {
                    Swal.fire ({
                        icon: error',
                        title: 'เกิดข้อผิดพลาด',
                        text: 'แก้ไขข้อมูลไม่สำเร็จ',
                        timer: 2000,
                        showConfirmButton: true
                    });
                });
            </script>";
            header("refresh:2; url=../product/index.php");
        }
    }
?>