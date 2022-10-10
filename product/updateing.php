<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
    session_start();
    require_once '../config/config_sqli.php';

    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $inglist = $_POST['inglist'];
        $mat_name = $_POST['mat_name'];
        $ing_num = $_POST['ing_num'];
        $ing_use = $_POST['ing_use'];
        $P_ID = $_POST['P_ID'];
        $P_quantity = $_POST['P_quantity'];

        //วนลูปตามจำนวนที่มีในส่วนของแก้ไข
        for ($x=0; $x<count($_POST['edit_material_ids']); $x++) {
            //ตรวจสอบว่ามีการติ้กหรือเปล่าถ้ามีการติ้กเข้า if ถ้าไม่มีเข้า else
            if (isset($_POST['edit_checkbox'][$x])) {
                $sql = $conn->prepare("UPDATE ing SET ing_num = ".$_POST['edit_ing_num'][$x]." where id = ".$_POST['edit_ing_id'][$x]);
                $sql->execute(); 
                if ($sql ) {
                    $_SESSION['success'] = '<script>
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "แก้ไขข้อมูลเรียบร้อยแล้ว",
                        showConfirmButton: false,
                        timer: 1500
                    })
                    </script>';
                
                    header("location: ../product/index.php");
                }
            } else {
                $sql_d = $conn->prepare("DELETE FROM ing WHERE id = ".$_POST['edit_ing_id'][$x]);
                $sql_d->execute(); 
            }
            if ($sql_d ) {
                $_SESSION['success'] = '<script>
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "แก้ไขข้อมูลเรียบร้อยแล้ว",
                    showConfirmButton: false,
                    timer: 1500
                })
                </script>';
            
                header("location: ../product/index.php");
            }
        }
        
         //วนลูปตามจำนวนที่มีในส่วนของเพิ่ม
         for ($x=0; $x<count($_POST['add_material_ids']); $x++) {
            //ตรวจสอบว่ามีการติ้กหรือเปล่าถ้ามีการติ้กเข้า if ถ้าไม่มีเข้า else
            if (isset($_POST['add_checkbox'][$x])) {
                $add_mat_name = $_POST['add_mat_name'][$x];
                $add_ing_num = $_POST['add_ing_num'][$x];
                $add_ing_use = $_POST['add_ing_use'][$x];
                $add_P_ID = $_POST['add_P_ID'][$x];
                $add_P_quantity = $_POST['add_P_quantity'][$x];
                $add_material_ids = $_POST['add_material_ids'][$x];
                $sql_add = "INSERT INTO ing (M_ID,M_name,ing_num,ing_use,P_ID,P_quantity) VALUES ('$add_material_ids','$add_mat_name','$add_ing_num','$add_ing_use','$add_P_ID','$add_P_quantity')";
                $query_add = mysqli_query($conn, $sql_add); 

                if ($query_add ) {
                    $_SESSION['success'] = '<script>
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "แก้ไขข้อมูลเรียบร้อยแล้ว",
                        showConfirmButton: false,
                        timer: 1500
                    })
                    </script>';
                
                    header("location: ../product/index.php");
                }
            }
        }
      
    }  
?>