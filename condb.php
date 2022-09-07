<?php
$condb= mysqli_connect("localhost","root","","bekeryapp") or die("Error: " . mysqli_error($condb));
mysqli_query($condb, "SET NAMES 'utf8' ");

?>