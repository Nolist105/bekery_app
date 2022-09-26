<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<?php
session_start();
require_once '../config/config_sqli.php';

if(isset($_POST['save_order']))

{
    $id = $_POST['id'];
    $inglist = $_POST['inglist'];
    $mat_name = $_POST['mat_name'];
    $ing_num = $_POST['ing_num'];
    $ing_use = $_POST['ing_use'];
    $P_ID = $_POST['P_ID'];
    $P_quantity = $_POST['P_quantity'];
    
        for ($x=0 ; $x<count($_REQUEST['inglist']) ; $x++) {

            $inglist = $_REQUEST['inglist'][$x];
            $mat_name = $_POST['mat_name'][$x];
            $ing_num = $_REQUEST['ing_num'][$x];
            $ing_use = $_REQUEST['ing_use'][$x];
            $P_ID = $_REQUEST['P_ID'][$x];
            $P_quantity = $_REQUEST['P_quantity'][$x];
            

            if (!empty($ing_num)) {
                $query = "INSERT INTO ing (M_ID,M_name,ing_num,ing_use,P_ID,P_quantity) VALUES ('$inglist','$mat_name','$ing_num','$ing_use','$P_ID','$P_quantity')";
                $query_run = mysqli_query($conn, $query);
                }

                if ($query_run) {
                    $_SESSION['success'] = '<script>
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "เพิ่มข้อมูลเรียบร้อยแล้ว",
                            showConfirmButton: false,
                            timer: 1500
                          })
                    </script>';
                        
                    header("location: ../product/index.php");
                } else {
                    $_SESSION['success'] = '<script>
                        Swal.fire({
                            position: "center",
                            icon: "error",
                            title: "เพิ่มข้อมูลไม่สำเร็จ",
                            showConfirmButton: false,
                            timer: 1500
                          })
                    </script>';
                    
                    header("location: ../product/index.php");
                }
        }
            
           

}

?>