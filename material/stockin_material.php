<?php
    ini_set('display_errors',1);
    require_once '../config/config_sqli.php';
    $sql = "SELECT * FROM material" ;
    $result=mysqli_query($conn,$sql);
    /* session_start();
    require_once "../config/configpdo.php";

    $stmt = $conn->prepare("SELECT * FROM material");
    $stmt->execute();
    $rs = $stmt->fetchAll(); */

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รับเข้าวัตถุดิบ</title>
    <!--Bootstap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!--font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
        integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--datepicker-->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
        integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--datepicker js-->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="../js/mat.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>

<body>
    <div class="container my-5">
        <div class=" h4 text-center alert alert-info mb-4 mt-4" role="alert">รับเข้าวัตถุดิบ</div>
        <form action="insert_stockin.php" method="POST" enctype="multipart/form-data">
            <div class="row form-group">
                <label>วันที่รับเข้า</label>
                <div class="input-group flex-nowrap">
                    <span class="input-group-text"><i class="fa-solid fa-calendar-days"></i></span>
                    <input type="text" name="S_date" id="datepicker" class="form-control"
                        value="<?=date("d-m-Y", strtotime(date('Y-m-d'))) ?>">
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label>รหัสวัตถุดิบ</label>
                    <input readonly type="text"  name="M_ID" id="M_ID" class="form-control" required>
                </div>

                <div class="col ">
                    <label>ชื่อวัตถุดิบ</label>
                    <select name="M_name"  id="material_name" class="form-select" onchange="fetchemp()">
                        <option value="" selected hidden>----เลือก----</option>
                        <?php 

                            while($rows = mysqli_fetch_array($result)){
                            ?>
                        <option value="<?=$rows['id'];?>"><?=$rows['M_name'];?></option>
                        <?php
                            }
                            mysqli_close($conn); //ปิดการเชื่อมต่อฐานข้อมูล
                        ?>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label>หน่วยซื้อ</label>
                    <input readonly type="text"  name="S_unit_pack" id="M_unit_pack" class="form-control" required>
                </div>

                <div class="col">
                    <label>ต้นทุนต่อหน่วยซื้อ</label>
                    <input type="number" name="S_cost" class="form-control" placeholder="ป้อนต้นทุนต่อหน่วยซื้อ"
                        required>
                </div>
            </div>

            <div>
                <label>จำนวนที่รับเข้า</label>
                <input type="number" name="S_in" class="form-control" placeholder="ป้อนจำนวนที่รับเข้า" required>
            </div>
            <button type="submit" name="submit" class="btn btn-success my-3">บันทึก</button>
            <a href="../stockin/index.php" class="btn btn-danger">กลับ</a>
        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"
        integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.th.min.js"
        integrity="sha512-cp+S0Bkyv7xKBSbmjJR0K7va0cor7vHYhETzm2Jy//ZTQDUvugH/byC4eWuTii9o5HN9msulx2zqhEXWau20Dg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script type="text/javascript">
    $('#datepicker').datepicker({
        format: 'dd-mm-yyyy',
        language: 'th',
    });
    </script>

</body>

</html>