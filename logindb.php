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
            $query = "SELECT * FROM user WHERE username = '$username' AND password = '$password' ";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) == 1) {
                if ($result['urole'] == 'admin') {
                    $_SESSION['username'] = $username;
                    $_SESSION['success'] = "Your are now logged in";
                    header("location: index.php");
                } elseif ($result['urole'] == 'user') {
                    $_SESSION['username'] = $username;
                    $_SESSION['success'] = "Your are now logged in";
                    header("location: dashboard.php");
                } else {
                array_push($errors, "Wrong Username or Password");
                $_SESSION['error'] = "Wrong Username or Password!";
                header("location: loginform.php");
                }
            } else {
                array_push($errors, "Username & Password is required");
                $_SESSION['error'] = "Username & Password is required";
                header("location: loginform.php");
            }
        }
    }
?>