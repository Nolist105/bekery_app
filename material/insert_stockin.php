<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
    session_start();
    require_once "../config/configpdo.php";

    if (isset($_POST['submit'])) {
        $M_ID = $_POST['M_ID'];
        $M_name = $_POST['M_name'];
        $S_date = $_POST['S_date'];
        $S_in = $_POST['S_in'];
        $S_unit_pack = $_POST['S_unit_pack'];
        $S_cost = $_POST['S_cost'];
        

        $sql = $conn->prepare("INSERT INTO stockin(M_ID, M_name, S_date, S_in, S_unit_pack, S_cost) VALUES(:M_ID, :M_name, :S_date, :S_in, :S_unit_pack, :S_cost)"); 
        $sql->bindParam(":M_ID", $M_ID);
        $sql->bindParam(":M_name", $M_name);
        $sql->bindParam(":S_date", $S_date);
        $sql->bindParam(":S_in", $S_in);
        $sql->bindParam(":S_unit_pack", $S_unit_pack);
        $sql->bindParam(":S_cost", $S_cost);
        $sql->execute();


        $sql1 = $conn->prepare("UPDATE material SET M_balane = (:S_in)"); 
        $sql1->bindParam(":S_in", $S_in);
        $sql1->execute();

        if ($sql) {
            $_SESSION['success'] = "รับเข้าวัตถุดิบเรียบร้อยแล้ว";
            echo "<script>
                $(document).ready(function () {
                    Swal.fire ({
                        icon: 'success',
                        title: 'สำเร็จ',
                        text: 'รับเข้าวัตถุดิบเรียบร้อยแล้ว',
                        timer: 2000,
                        showConfirmButton: true
                    });
                });
            </script>";
            header("refresh:2; url=../material/stockin_material.php");
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
            header("refresh:2; url=../material/stockin_material.php");
        }
    }

    
?>