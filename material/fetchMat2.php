<?php
    ini_set('display_errors',1);
    require_once '../config/config_sqli.php';
    $k = $_POST["x"];
    $sql = "SELECT M_ID FROM material WHERE id={$k}" ;
    $result= mysqli_query($conn,$sql);
    while($rows = mysqli_fetch_array($result)){
        $data['M_ID'] = $rows["M_ID"];

    }

    echo json_encode($data);
?>