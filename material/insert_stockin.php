<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
    session_start();
    require_once "../config/config_sqli.php";

    if (isset($_POST['submit'])) {
        $M_ID = $_POST['M_ID'];
        $M_name = $_POST['M_name'];
        $S_date = $_POST['S_date'];
        $S_in = $_POST['S_in'];
        $S_unit_pack = $_POST['S_unit_pack'];
        $S_cost = $_POST['S_cost'];
        
        //เพิ่มข้อมูลลงใน ตาราง material คอลัมน์ M_balane
        $sql3 = $conn->query("SELECT * FROM material WHERE id = $M_name");
        $row3 = mysqli_fetch_array($sql3);
        $tu_balance = $row3["M_number"]*$S_in;
        

        $check = $conn->query("SELECT * FROM stockin WHERE M_ID = '$M_ID'");
        $numrow = mysqli_num_rows($check);
        $s_num = $numrow + 1;
        
        $sql = "INSERT INTO stockin(M_ID, M_name, S_date, S_in, S_unit_pack, S_total, S_balance, S_cost , S_num) VALUES('$M_ID', '$M_name', '$S_date', '$S_in','$S_unit_pack','$S_in','$tu_balance','$S_cost','$s_num')"; 
        $result = mysqli_query($conn, $sql);


        $sql2 = $conn->prepare("UPDATE material SET M_balane = M_balane+$S_in,U_balance= U_balance+'$tu_balance' WHERE id = $M_name");
        
        //เพิ่มข้อมูลลงใน ตาราง stockin คอลัมน์ S_balance

        if ($sql && $sql2->execute()) {

            $select_y = $conn->query("SELECT * FROM material WHERE id = $M_name"); 
            $y_select = $select_y->fetch_array(); 
            $m_yield = $y_select['M_Yield'];
                
            $select = $conn->query("SELECT * FROM stockin WHERE M_name = $M_name");
            $chk_select = mysqli_num_rows($select);
            $total_y = ($S_cost/$m_yield)*100;

            if($chk_select == '1'){
                $up_mcost = $conn->prepare("UPDATE material SET M_cost = $total_y WHERE id = $M_name");
            }else{
                $select2 = $conn->query("SELECT * FROM stockin WHERE M_name = $M_name");
                $numrow_select2 = mysqli_num_rows($select2);
                while($row_select2 = $select2->fetch_array()){
                    $S_cost = $row_select2['S_cost'];
                    $total_y1 = ($S_cost/$m_yield)*100;
                    $total_cost +=  $total_y1 / $numrow_select2;
                }
                $up_mcost = $conn->prepare("UPDATE material SET M_cost = $total_cost WHERE id = $M_name");
            }
            if($up_mcost->execute()){
                $select3 = $conn->query("SELECT * FROM material WHERE id = $M_name");
                $row_select3 = $select3->fetch_array();
                $m_cost = $row_select3['M_cost'];
                $m_number = $row_select3['M_number'];
                $up_msale = $conn->prepare("UPDATE material SET M_sale = $m_cost/$m_number WHERE id = $M_name");
                $up_msale->execute();
            }
            $_SESSION['success'] = '<script>
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "รับเข้าวัตถุดิบเรียบร้อยแล้ว",
                        showConfirmButton: false,
                        timer: 1500
                      })
                </script>';
                    
                    header("location: ../material/index_stockin.php");
        } else {
            $_SESSION['error'] = '<script>
                    Swal.fire({
                        position: "center",
                        icon: "error",
                        title: "รับเข้าวัตถุดิบไม่สำเร็จ",
                        showConfirmButton: false,
                        timer: 1500
                      })
                </script>';
                    
                    header("location: ../material/index_stockin.php");
            
        }
    }
?>
