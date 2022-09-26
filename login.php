<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php 
    session_start();
    require_once("config/config_sqli.php");

    $errors = array();

    if (isset($_POST['login_state'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        if (count($errors) == 0) {
            $sql = "SELECT * FROM user WHERE username = '".$username."' AND password = '".$password."' ";
            $result = mysqli_query($conn,$sql);

            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_array($result);
                $_SESSION['username'] = $row["username"];
                $_SESSION['password'] = $row["password"];
                $_SESSION['urole'] = $row["urole"];
                } if ($_SESSION["urole"]=="1"){
                    $_SESSION['username'] = $row["username"];
                    $_SESSION['success'] = "เข้าสู่ระบบแล้ว";
                            echo "<script>
                        $(document).ready(function () {
                            Swal.fire ({
                                icon: 'success',
                                title: 'ช้อมูลถูกต้อง',
                                text: 'เจ้าของร้านเข้าสู่ระบบสำเร็จ',
                                timer: 2000,
                                showConfirmButton: true
                            });
                        });
                    </script>";
                    
                    header("location: index.php");
                    // session_destroy();

                }else if ($_SESSION["urole"]=="0"){
                    $_SESSION['username'] = $row["username"];
                    $_SESSION['password'] = $row["password"];
                    echo "<script>
                        $(document).ready(function () {
                            Swal.fire ({
                                icon: 'success',
                                title: 'ช้อมูลถูกต้อง',
                                text: 'พนักงานเข้าสู่ระบบสำเร็จ',
                                timer: 2000,
                                showConfirmButton: true
                            });
                        });
                    </script>";
                    header("location: indexuser.php");
                    // session_destroy();

                }else if($_SESSION["urole"]!="0" && $_SESSION["urole"]!= "1"){
                    $_SESSION['username'] = $row["username"];
                    $_SESSION['password'] = $row["password"];
                    echo "<script>
                    $(document).ready(function () {
                        Swal.fire ({
                            icon: 'error',
                            title: 'ช้อมูลไม่ถูกต้อง',
                            text: 'ไม่สามารถเข้าสู่ระบบ',
                            timer: 2000,
                            showConfirmButton: true
                            });
                        });
                    </script>";
                    header("location: loginform.php");
                    // session_destroy();
                }    
        } 
    }

?>