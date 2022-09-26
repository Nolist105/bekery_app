<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<?php
session_start();
require_once '../config/config_sqli.php';

if(isset($_POST['save_order']))
{

    $prolist = $_POST['prolist'];
    $pro_name = $_POST['pro_name'];
    $pro_num = $_POST['pro_num'];
    $pro_use = $_POST['pro_use'];
    $Pro_date = $_POST['Pro_date'];
    
        for ($x=0 ; $x<count($_REQUEST['prolist']) ; $x++) {
            /* if (isset($prolist)) { */
                $prolist = $_REQUEST['prolist'][$x];
                $pro_name = $_REQUEST['pro_name'][$x];
                $pro_num = $_REQUEST['pro_num'][$x];
                $pro_use = $_REQUEST['pro_use'][$x];

                    if (!empty($pro_num)) {
                        $p_id ="";
                        $show_ing  = "SELECT * FROM ing  WHERE P_ID = '$prolist' ORDER BY id ASC";
                        $query_run1 = mysqli_query($conn, $show_ing);
                        while($row1=mysqli_fetch_array($query_run1)){
                            $m_id = $row1['M_ID'];
                            $p_id = $row1['P_ID'];
                            $ing_num = $row1['ing_num']; 
                            
                            if($p_id === $prolist){
                                $up_m = $conn->prepare("UPDATE material SET U_balance = U_balance - '$ing_num'*'$pro_num' WHERE id = '$m_id'");
                                $up_m->execute();
                                $up_m2 = $conn->prepare("UPDATE material SET M_balane = U_balance/M_number WHERE id = '$m_id'");
                                $up_m2->execute(); 

                                /* อัปเดทลง stockin column S_balance */
                                $s_stockin = $conn->query("SELECT * FROM stockin WHERE S_balance != 0 AND M_name = $m_id ORDER BY id ASC LIMIT 1");
                                $row_s = $s_stockin->fetch_array();
                                $S_balance = $row_s['S_balance'];
                                
                                if($S_balance < $row1['ing_num']){
                                    $total_sb = $row1['ing_num'] - $S_balance;
                                    $up_si = $conn->prepare("UPDATE stockin SET S_balance = 0 WHERE id = '".$row_s['id']."'");
                                    if($up_si->execute()) {
                                        $s_cutstock2 = $conn->query("SELECT * FROM stockin WHERE S_balance != 0 AND M_name = $m_id ORDER BY id ASC LIMIT 1");
                                        $row_s_cutstock2 = $s_cutstock2->fetch_array();
                                        $s_cutstock3 = $conn->prepare("UPDATE stockin SET S_balance = S_balance - $total_sb WHERE id = '".$row_s_cutstock2['id']."'");
                                        $s_cutstock3->execute();
                                    }    
                                } else {
                                    $up_sbalance = $conn->prepare("UPDATE stockin SET S_balance = S_balance - '$ing_num'*'$pro_num' WHERE id = '".$row_s['id']."'");
                                    $up_sbalance->execute(); 
                                }
                                
                            }
                        }
                        if($p_id === $prolist){
                            $query = "INSERT INTO production_order (P_ID,P_name,Pro_amount,P_use,Pro_date) VALUES ('$prolist','$pro_name','$pro_num','$pro_use','$Pro_date')";
                            $query_run = mysqli_query($conn, $query);
                            
                            if ($query_run) {
                                $_SESSION['success'] = '<script>
                                Swal.fire({
                                    position: "center",
                                    icon: "success",
                                    title: "สั่งผลิตเรียบร้อยแล้ว",
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                                </script>';
                            
                                header("location: ../product/production_order.php");
                            } else {
                                $_SESSION['success'] = '<script>
                                Swal.fire({
                                    position: "center",
                                    icon: "error",
                                    title: "ไม่สามารถสั่งผลิตได้",
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            </script>';
                                
                                header("location: ../product/index_production.php");
                            }
                        }
                        if($p_id !== $prolist){
                            $_SESSION['error'] = '<script>
                            Swal.fire({
                                position: "center",
                                icon: "error",
                                title: "ไม่มีสูตรการผลิต",
                                showConfirmButton: false,
                                timer: 1500
                            })
                        </script>';
                            
                            header("location: ../product/production_order.php");
                        }
                        
                        
                    }
                }
       /*  } */
    
        
    
}
