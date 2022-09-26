<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
    session_start();
    require_once "../config/config_sqli.php";

    if (isset($_POST['submit'])) {
        $M_ID = $_POST['M_ID'];
        $M_name = $_POST['M_name'];
        $D = $_POST['D'];
        $LT = $_POST['LT'];

        //เช็คข้อมูลซ้ำ
        $check_name = "SELECT M_name FROM orderpoint WHERE M_name='$M_name'";
        $result1 = mysqli_query($conn, $check_name);
        if(mysqli_num_rows($result1) >0){
                        echo "<script>
                            $(document).ready(function () {
                                Swal.fire ({
                                    icon: 'error',
                                    title: 'ผิดพลาด',
                                    text: 'มีข้อมูลอยู่แล้ว กรุณาเพิ่มข้อมูลอื่น',
                                    timer: 2000,
                                    showConfirmButton: true
                                });
                            });
                        </script>";
                        header("refresh:2; url=../material/orderpoint.php");
        }else{
            $sql = "INSERT INTO orderpoint(M_ID, M_name, D, LT) VALUES('$M_ID', '$M_name', '$D',' $LT')"; 
            $result = mysqli_query($conn, $sql);

            $totaldlt = $D * $LT ;
            $sql2 = $conn->prepare("UPDATE material SET M_point = $totaldlt WHERE id = $M_name");
        
            if ($sql && $sql2->execute()) {
                $_SESSION['success'] = '<script>
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "เพิ่มข้อมูลเรียบร้อยแล้ว",
                    showConfirmButton: false,
                    timer: 1500
                    })
                </script>';
                
                header("location: ../material/orderpoint.php");
            } else {
                $_SESSION['success'] = '<script>
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "เพิ่มข้อมูลไม่สำเร็จ",
                    showConfirmButton: false,
                    timer: 1500
                    })
                </script>';
                
                header("location: ../material/orderpoint.php");
            }
        }

        
    }
?>

