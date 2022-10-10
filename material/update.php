<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
    session_start();
    require_once "../config/configpdo.php";

    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $M_name = $_POST['M_name'];
        $M_unit_pack = $_POST['M_unit_pack'];
        $M_unit_use = $_POST['M_unit_use'];
        $M_number = $_POST['M_number'];
        $M_Yield = $_POST['M_Yield'];

        
        $sql = $conn->prepare("UPDATE material SET M_name = :M_name, M_unit_pack = :M_unit_pack, M_unit_use = :M_unit_use, M_number = :M_number, M_Yield = :M_Yield WHERE id = :id");
        $sql->bindParam(":id", $id);
        $sql->bindParam(":M_name", $M_name);
        $sql->bindParam(":M_unit_pack", $M_unit_pack);
        $sql->bindParam(":M_unit_use", $M_unit_use);
        $sql->bindParam(":M_number", $M_number);
        $sql->bindParam(":M_Yield", $M_Yield);
        $sql->execute();

        if ($sql) {
            $_SESSION['success'] = '<script>
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "แก้ไขข้อมูลวัตถุดิบเรียบร้อยแล้ว",
                    showConfirmButton: false,
                    timer: 1500
                    })
                </script>';
                
                header("location: ../material/index.php");
        } else {
            $_SESSION['success'] = '<script>
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "แก้ไขข้อมูลวัตถุดิบไม่สำเร็จ",
                    showConfirmButton: false,
                    timer: 1500
                    })
                </script>';
                
                header("location: ../material/index.php");
        }
    }
?>