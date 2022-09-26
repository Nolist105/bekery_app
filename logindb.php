<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php 
    session_start();
    require_once ("config/config_sqli.php");

    $errors = array();

    if (isset($_POST['login_state'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        if (empty($username)) {
            array_push($errors, "Username is required");
        }

        if (empty($password)) {
            array_push($errors, "Password is required");
        }

        if (count($errors) == 0) {
            $query = "SELECT * FROM user WHERE username = '".$username."' AND password = '".$password."' ";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_array($result);
                $_SESSION['username'] = $row["username"];
                $_SESSION['password'] = $row["password"];
                $_SESSION['urole'] = $row["urole"];
                if ($_SESSION['urole'] == "1") {
                    $_SESSION['username'] = $username;
                    // $_SESSION['success'] = "เข้าสู่ระบบแล้ว";
                    echo "<script>
                        $(document).ready(function () {
                            Swal.fire ({
                                icon: 'success',
                                title: 'เข้าสู่ระบบแล้ว',
                                text: 'ยินดีต้อนรับเจ้าของร้าน',
                                timer: 2000,
                                showConfirmButton: true
                            });
                        });
                    </script>";
                    header("refresh:2; url=index.php");
                    // header("location: index.php");
                } 
                elseif ($_SESSION['urole'] == '0') {
                    $_SESSION['username'] = $username;
                    // $_SESSION['success'] = "เข้าสู่ระบบแล้ว";
                    echo "<script>
                        $(document).ready(function () {
                            Swal.fire ({
                                icon: 'success',
                                title: 'เข้าสู่ระบบแล้ว',
                                text: 'ยินดีต้อนรับพนักงาน',
                                timer: 2000,
                                showConfirmButton: true
                            });
                        });
                    </script>";
                    header("refresh:2; url=indexuser.php");
                } else {
                array_push($errors, "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง");
                $_SESSION['error'] = "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง";
                header("location: loginform.php");
                }
            } else {
                array_push($errors, "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง");
                $_SESSION['error'] = "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง";
                header("location: loginform.php");
            }
        }
    }
?>