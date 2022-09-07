<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<?php
session_start();
require_once '../config/config_sqli.php';

if(isset($_POST['save_order']))
{
    
    if(isset($_POST['name']) ) {
        echo "<script>
        $(document).ready(function () {
            Swal.fire ({
                icon: 'error',
                title: 'เกิดข้อผิดพลาด',
                text: 'เพิ่มข้อมูลไม่สำเร็จ',
                timer: 2000,
                showConfirmButton: true
            });
        });
    </script>";
    // header("refresh:2; url=../product/index.php");
        $inglist = $_POST['inglist'];
        $ing_num = $_POST['ing_num'];
        $ing_use = $_POST['ing_use'];
        $P_ID = $_POST['P_ID'];
        $P_quantity = $_POST['P_quantity'];

            for ($x=0 ; $x<count($_POST['inglist']) ; $x++) {
               
                $inglist = $_POST['inglist'][$x];
                $ing_num = $_POST['ing_num'][$x];
                $ing_use = $_POST['ing_use'][$x];
                $P_ID = $_POST['P_ID'][$x];
                $P_quantity = $_POST['P_quantity'][$x];
                

                if (!empty($ing_num) and isset($_POST['name']) ) {
                    $query = "INSERT INTO ing (M_ID,ing_num,ing_use,P_ID,P_quantity) VALUES ('$inglist','$ing_num','$ing_use','$P_ID','$P_quantity')";
                    $query_run = mysqli_query($conn, $query);

                    if ($query_run) {
                        echo "<script>
                        $(document).ready(function () {
                            Swal.fire ({
                                icon: 'success',
                                title: 'ช้อมูลถูกต้อง',
                                text: 'เพิ่มข้อมูลสำเร็จ',
                                timer: 2000,
                                showConfirmButton: true
                            });
                        });
                    </script>";
                        // header("location: ../product/index.php");
                        header("refresh:2; url=../product/index.php");
                    } 
                 }
                 
                    
            }
                
    }if(!isset($_POST['name'])) {
        echo "<script>
        $(document).ready(function () {
            Swal.fire ({
                icon: 'error',
                title: 'เกิดข้อผิดพลาด',
                text: 'เพิ่มข้อมูลไม่สำเร็จ',
                timer: 2000,
                showConfirmButton: true
            });
        });
    </script>";
     header("refresh:2; url=../product/index.php");
    }

}
else{
    echo "<script>
        $(document).ready(function () {
            Swal.fire ({
                icon: 'error',
                title: 'เกิดข้อผิดพลาด',
                text: 'เพิ่มข้อมูลไม่สำเร็จ',
                timer: 2000,
                showConfirmButton: true
            });
        });
    </script>";
     header("refresh:2; url=../product/index.php");
    }


?>