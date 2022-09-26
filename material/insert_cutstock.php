<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
    session_start();
    require_once "../config/config_sqli.php";

    if (isset($_POST['submit'])) {
        $M_ID = $_POST['M_ID'];
        $M_name = $_POST['M_name'];
        $M_num = $_POST['M_num'];
        
        $sql2 = "SELECT * FROM material WHERE id = $M_name";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_array($result2);
        
        
        $total_cut = $row2['U_balance'];
        $t_balane = $row2["U_balance"]-$M_num;
        $t_number = $t_balane/$row2["M_number"];
        $ts_number = number_format($t_number,2);

        
        if($total_cut >= $M_num){
            $sql = "UPDATE material SET U_balance = '$t_balane',M_balane = '$ts_number' WHERE id = $M_name";
            $result = mysqli_query($conn, $sql);
            
            $s_cutstock = $conn->query("SELECT * FROM stockin WHERE S_balance != 0 AND M_name = $M_name ORDER BY id ASC LIMIT 1");
            $row_cut = $s_cutstock->fetch_array();
            $S_balance = $row_cut['S_balance'];

            if($S_balance < $M_num){
                $total_sb = $M_num - $S_balance;
                $up_si = $conn->prepare("UPDATE stockin SET S_balance = 0 WHERE id = '".$row_cut['id']."'");
                if($up_si->execute()) {
                    $s_cutstock2 = $conn->query("SELECT * FROM stockin WHERE S_balance != 0 AND M_name = $M_name ORDER BY id ASC LIMIT 3");
                    $row_s_cutstock2 = $s_cutstock2->fetch_array();

                    $s_cutstock3 = $conn->prepare("UPDATE stockin SET S_balance = S_balance - $total_sb WHERE id = '".$row_s_cutstock2['id']."'");
                    $s_cutstock3->execute();
                }    
            } else {
                $s_cutstock2 = $conn->prepare("UPDATE stockin SET S_balance = S_balance - '$M_num' WHERE id = '".$row_cut['id']."'");
                $s_cutstock2->execute();
            }

        if ($sql ) {
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
                    
        } else {
            $_SESSION['error'] = '<script>
                    Swal.fire({
                        position: "center",
                        icon: "error",
                        title: "วัตถุดิบไม่เพียงพอ",
                        showConfirmButton: false,
                        timer: 1500
                      })
                </script>';
                    
                    header("location: ../material/cutstock_material.php");
            
        }
       
    }
?>