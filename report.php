<?php
require_once "config/config_sqli.php";
require_once __DIR__ . '/vendor/autoload.php';
session_start();
//custom font
require_once __DIR__ . '/vendor/autoload.php';

// เพิ่ม Font ให้กับ mPDF
$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];
$mpdf = new \Mpdf\Mpdf(['tempDir' => __DIR__ . '/tmp',
        'mode' => 'utf-8', 
        'format' => 'A4',
        'margin_left' => 15,
        'margin_right' => 15,
        'margin_top' => 10,
        'margin_bottom' => 16,
        'margin_header' => 9,
        'margin_footer' => 9,
        'mirrorMargins' => true,
    'fontdata' => $fontData + [
            'sarabun' => [ // ส่วนที่ต้องเป็น lower case 
                'R' => 'THSarabunNew.ttf',
                'I' => 'THSarabunNew Italic.ttf',
                'B' =>  'THSarabunNew Bold.ttf',
                'BI' => "THSarabunNew BoldItalic.ttf",
            ]
        ],
]);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายงาน</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Sarabun&display=swap" rel="stylesheet">
    <!--boxicon-->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
<style>
    body{
        font-family: 'Sarabun', sans-serif;
    }
</style>
</head>

<?php
ob_start();
?>

<div class="container">
 <div class="card" style="width: 100%;">
    
        <div class="card-body">
        <img src="image/bekery.jpg" style="width: 20%;" >
            
                
                    <?php
                     $date = date('d/m/Y');
                    ?>
                 <p align="left"  style="font-size: 24px; ">ร้านเบเกอรี</p>
                 <p  style="font-size: 18px; ">รายงานวัตถุดิบที่ต้องสั่งซื้อ</p>
                 <p  style="font-size: 18px; ">วันที่ <?php echo $date; ?></p>

            
        </div>
            <hr width=100%  style="border-color: #000; size: 10px;">
        </div>

 <table class="table table-borderless" >

            <thead>
                <tr>
                    <th scope="col">รหัสวัตถุดิบ</th>
                    <th scope="col">ชื่อวัตถุดิบ</th>
                    <th scope="col">หน่วยซื้อ</th>
                    <th scope="col">หน่วยใช้</th>
                    <th scope="col">แปลงหน่วย</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php 
                   
                    $result = ("SELECT * FROM material WHERE M_status='1' ");
                    $material = mysqli_query($conn, $result);

                    if (!$material) {
                        echo "<p><td colspan='8' class='text-center'>ไม่มีข้อมูล</td></p>";
                    } else {
                    foreach($material as $material)  {  
                ?>
                <tr>
                    <td><?php echo $material['M_ID']; ?></td>
                    <td><?php echo $material['M_name']; ?></td>
                    <td><?php echo $material['M_unit_pack']; ?></td>
                    <td><?php echo $material['M_unit_use']; ?></td>
                    <td><?php echo $material['M_number']; ?></td>
                    
                </tr>
            </tbody>
            <?php } } ?>
        </table>
        <!-- เส้นคั่นปิด -->
        <div class="card" style="width: 100%; text-align: center;">
            <hr width=100%  style="border-color: #000; size: 10px;">
        </div>


   
<?php






    $html=ob_get_contents();
    $mpdf->WriteHTML($html);
    $mpdf->Output("MyReport.pdf");
    ob_end_flush();
?>
<a href="material/index.php" class="btn btn-primary">กลับ</a>
<a href="MyReport.pdf" class="btn btn-primary">ดาวโหลด (pdf)</a>
 </div>
