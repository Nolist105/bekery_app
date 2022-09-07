<?php
include '../config/config_sqli.php';

$u_username = $_POST['username'];
$p_password = $_POST['password'];

$sql="INSERT INTO user(username,password) VALUES('$u_username','$p_password')";
$result=mysqli_query($conn,$sql);
if($result){
    echo "<script>alert('บันทึกข้อมูลเรียบร้อยแล้ว');</script>";
    echo "<script>window.location='user.php.';</script>";
}else{
    echo "<script>alert('ไม่สามารถบันทึกข้อมูลได้');</script>";

}

mysqli_close($conn);
?>