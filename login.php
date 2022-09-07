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
                    $_SESSION['password'] = $row["password"];
                    header("location: index.php");
                    session_destroy();
                }else if ($_SESSION["urole"]=="0"){
                    $_SESSION['username'] = $row["username"];
                    $_SESSION['password'] = $row["password"];
                    header("location: indexuser.php");
                    session_destroy();
                }else if($_SESSION["urole"]!="0" && $_SESSION["urole"]!= "1"){
                    $_SESSION['username'] = $row["username"];
                    $_SESSION['password'] = $row["password"];
                    header("location: loginform.php");
                    session_destroy();
                }    
        } 
    }

?>