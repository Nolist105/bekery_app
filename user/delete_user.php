<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
include '../config/config_sqli.php';

$ids=$_GET['id'];
$sql="DELETE FROM user WHERE id='$ids' ";
if(mysqli_query($conn,$sql)){
    echo "<script>$(document).ready(function () {
        Swal.fire ({
            icon: 'success',
            title: 'ลบข้อมูล',
            text: 'ลบข้อมูลเรียบร้อยแล้ว',
            timer: 2000,
            showConfirmButton: true
        });
    });</script>";
    header("refresh:2; url=user.php");
    // echo "<script>window.location='user.php.';</script>";
}else{
        echo "Error : " . $sql . "<br>" . mysqli_error($conn);
        echo "<script>alert('ไม่สามารถลบข้อมูลได้');</script>";
}
mysqli_close($conn);
?>