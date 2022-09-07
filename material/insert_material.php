<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
    session_start();
    require_once "../config/configpdo.php";

    if (isset($_POST['submit'])) {
        $M_ID = $_POST['M_ID'];
        $M_name = $_POST['M_name'];
        $M_unit_pack = $_POST['M_unit_pack'];
        $M_unit_use = $_POST['M_unit_use'];
        $M_number = $_POST['M_number'];
        $M_Yield = $_POST['M_Yield'];

        $check_name = $conn -> prepare("SELECT material.M_name FROM material WHERE M_name = :M_name");
            $check_name -> bindParam(":M_name", $M_name);
            $check_name -> execute();
            $row = $check_name -> fetch(PDO::FETCH_ASSOC);
            if ($check_name -> rowCount() > 0) {
                if ($M_name == $row['M_name']) {
                    $_SESSION['error'] = "มีข้อมูล <b>".$M_name."</b> อยู่แล้ว ไม่สามารถเพิ่มข้อมูลซ้ำได้";
                        echo "<script>
                            $(document).ready(function () {
                                Swal.fire ({
                                    icon: 'error',
                                    title: 'ผิดพลาด',
                                    text: 'มีข้อมูล $M_name อยู่แล้ว กรุณาเพิ่มข้อมูลอื่น',
                                    timer: 2000,
                                    showConfirmButton: true
                                });
                            });
                        </script>";
                        header("refresh:2; url=index.php");
                }
            }else{
                $sql = $conn->prepare("INSERT INTO material(M_ID, M_name, M_unit_pack, M_unit_use, M_number, M_Yield) VALUES(:M_ID, :M_name, :M_unit_pack, :M_unit_use, :M_number, :M_Yield)");
        $sql->bindParam(":M_ID", $M_ID);
        $sql->bindParam(":M_name", $M_name);
        $sql->bindParam(":M_unit_pack", $M_unit_pack);
        $sql->bindParam(":M_unit_use", $M_unit_use);
        $sql->bindParam(":M_number", $M_number);
        $sql->bindParam(":M_Yield", $M_Yield);
        $sql->execute();

        if ($sql) {
            $_SESSION['success'] = "เพิ่มข้อมูลเรียบร้อยแล้ว";
            echo "<script>
                $(document).ready(function () {
                    Swal.fire ({
                        icon: 'success',
                        title: 'สำเร็จ',
                        text: 'เพิ่มข้อมูลเรียบร้อยแล้ว',
                        timer: 2000,
                        showConfirmButton: true
                    });
                });
            </>";
            header("refresh:2; url=../material/index.php");
        } else {
            $_SESSION['error'] = "เพิ่มข้อมูลไม่สำเร็จ";
            echo "<script>
                $(document).ready(function () {
                    Swal.fire ({
                        icon: error',
                        title: 'เกิดข้อผิดพลาด',
                        text: 'เพิ่มข้อมูลไม่สำเร็จ',
                        timer: 2000,
                        showConfirmButton: true
                    });
                });
            </script>";
            header("refresh:2; url=../material/index.php");
        }
            }


        
    }


?>