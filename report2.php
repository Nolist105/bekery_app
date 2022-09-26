<?php

require_once __DIR__ . '/vendor/autoload.php';
include ('config/config_sqli.php');

$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];	
$mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8', 
            'format' => 'A4',
            'margin_left' => 15,
            'margin_right' => 15,
            'margin_top' => 10,
            'margin_bottom' => 16,
            'margin_header' => 9,
            'margin_footer' => 9,
            'mirrorMargins' => true,

            'fontDir' => array_merge($fontDirs, [
                __DIR__ . 'vendor/mpdf/mpdf/custom/font/directory',
            ]),
            'fontdata' => $fontData + [
                'thsarabun' => [
                    'R' => 'THSarabunNew.ttf',
                    'I' => 'THSarabunNew Italic.ttf',
                    'B' => 'THSarabunNew Bold.ttf',
                    'U' => 'THSarabunNew BoldItalic.ttf'
                ]
            ],
            'default_font' => 'thsarabun',
            'defaultPageNumStyle' => 1
        ]);

        ?>
        

<?php
$mpdf->setFooter('{PAGENO}');//ตัวรันหน้า

	$tableh1 = '
	
</div>

            

	<table class="table table-striped">
	    <tr style="border:1px solid #000;padding:4px; ">
	        <td  style="font-size: 22px; font-weight: bold;border-right:1px solid #000;padding:4px;text-align:center;"   width="10%">รหัสวัตถุดิบ</td>
	        <td  style="font-size: 22px; font-weight: bold;border-right:1px solid #000;padding:4px;text-align:center;"  width="15%">ชื่อวัตถุดิบ</td>
	        <td  width="15%" style="font-size: 22px; font-weight: bold; border-right:1px solid #000;padding:4px;text-align:center;">&nbsp; จำนวนคงเหลือ </td>
	        <td  style="font-size: 22px;font-weight: bold;border-right:1px solid #000;padding:4px;text-align:center;"  width="15%">หน่วยซื้อ </td>
	    </tr>

	</thead>
		<tbody>';
		//คำสั่งให้เลือกข้อมูลจาก TABLE ชื่อ tbl_member โดยเรียงจาก member_id และให้เรียงลำดับจากมากไปน้อยคือ DESC และ เปิดดู error เวลามีปัญหา
    $query = "SELECT * FROM material " ; 
	$result = mysqli_query($conn, $query);
	$content = "";
		foreach ($result as $rs) {
            if($rs['M_balane'] <= $rs['M_point']){
            
			// $tablebody .= '<tr style="border:1px solid #000;">
			// 	<td style="border-right:1px solid #000;padding:3px;text-align:center;"  >'.$rs['M_ID'].'</td>
			// 	<td style="border-right:1px solid #000;padding:3px;text-align:center;"  >'.$rs['M_name'].'</td>
            //     <td style="border-right:1px solid #000;padding:3px;text-align:center;"  >'.number_format($rs['M_balane'],2).'</td>
            //     <td style="border-right:1px solid #000;padding:3px;text-align:center;"  >'.$rs['M_unit_pack'].'</td>
            //     </tr>';
		}
    }

$tableend1 = "</tbody>
</table>";

$body_1='
	<style>
		body{
			  font-family: "thsarabun"; 
		}
	</style>';
$fordev22 ='
<style>

.img {
    text-align: center;
   
}
div{
       
    }
table {
  border-collapse: collapse;
  width: 100%;
}

td, th {
    font-size: 20px;
  border: 1px solid #AED6F1;
  padding: 5px;
}

tr:nth-child(even) {
  background-color: #AED6F1;
}

</style>
<div class="img">
    <img width="200" src="image/logo2.png" style="vertical-align: middle;
    width: 200px;   
    ">

';
	


$mpdf->WriteHTML($fordev22);
  
$mpdf->WriteHTML($tableh1);

// $mpdf->WriteHTML($tablebody);

$mpdf->WriteHTML($tableend1);
$mpdf->WriteHTML($body_1);

$mpdf->Output($output, 'I');