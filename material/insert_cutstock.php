<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
    session_start();
    require_once "../config/config_sqli.php";

    if (isset($_POST['submit'])) {
        $id = $_POST['id'];
        $M_ID = $_POST['M_ID'];
        $M_name = $_POST['M_name'];
        $M_num = $_POST['M_num'];
        
        $s_cutstock = $conn->query("SELECT * FROM stockin WHERE id = $id ");
        $row_cut = $s_cutstock->fetch_array();
        $S_balance = $row_cut['S_balance'];

        if($S_balance >= $M_num){

        $sql = $conn->prepare("UPDATE stockin SET S_balance = S_balance - '$M_num' WHERE id = $id");
        if ($sql->execute()) {
            $sql3 = $conn->prepare("UPDATE material SET U_balance = U_balance - '$M_num' WHERE M_ID = '$M_ID'");
            if ($sql3->execute()) {
                $sql2 = $conn->query("SELECT * FROM material WHERE M_ID = '$M_ID'");
                $row_sql2 = $sql2->fetch_array();
                
                /* -------------อัปเดท S_total ----------------------------------- */
                /* ----------------------------------------------------------------------------------- */
                $s_cutstock1 = $conn->query("SELECT * FROM stockin WHERE id = $id ");
                $row_cut1 = $s_cutstock1->fetch_array();
                $S_balance1 = $row_cut1['S_balance'];

                $S_total = $S_balance1 / $row_sql2['M_number'] ;
                $update_stotal = $conn->prepare("UPDATE stockin SET S_total = '$S_total' WHERE id = '$id'");
                $update_stotal->execute();
                /* ----------------------------------------------------------------------------------- */
                /* ----------------------------------------------------------------------------------- */

                $total = $row_sql2['U_balance']/$row_sql2['M_number'];
                $update = $conn->prepare("UPDATE material SET M_balane = '$total' WHERE M_ID = '$M_ID'");
                if ($update->execute()) {
                    $_SESSION['success'] = '<script>
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "ตัดสต็อกข้อมูลวัตถุดิบเรียบร้อยแล้ว",
                            showConfirmButton: false,
                            timer: 1500
                            })
                        </script>';
                        
                        header("location: ../material/cutstock_material.php");
        
                        } else {
                            $_SESSION['error'] = "ตัดสต็อกข้อมูลวัตถุดิบไม่สำเร็จ";
                            echo "<script>
                                $(document).ready(function () {
                                    Swal.fire ({
                                        icon: error',
                                        title: 'เกิดข้อผิดพลาด',
                                        text: 'ตัดสต็อกข้อมูลวัตถุดิบไม่สำเร็จ',
                                        timer: 2000,
                                        showConfirmButton: true
                                    });
                                });
                            </script>";
                            header("refresh:2; url=../material/cutstock_material.php");
                        }
            }
        }

    } else {
        $_SESSION['success'] = '<script>
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "วัตถุดิบในล็อตนี้ไม่เพียงพอ",
                    showConfirmButton: false,
                    timer: 1500
                    })
                </script>';
                
                header("location: ../material/cutstock_material.php");
    }
                    
} 
       
    
?>