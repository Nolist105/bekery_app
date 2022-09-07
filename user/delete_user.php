<?php
include 'config/config_sqli.php';

$ids=$_GET['id'];
$sql="DELETE FROM user WHERE id='$ids' ";
if(mysqli_query($conn,$sql)){
    echo "<script>alert('ลบข้อมูลเรียบร้อยแล้ว');</script>";
    echo "<script>window.location='user.php.';</script>";
}else{
        echo "Error : " . $sql . "<br>" . mysqli_error($conn);
        echo "<script>alert('ไม่สามารถลบข้อมูลได้');</script>";
}
mysqli_close($conn);
?>