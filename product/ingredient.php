<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มสูตรการผลิต</title>
    <!--Bootstap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <style>
        body{
            font-family: Bai Jamjuree;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class=" h4 text-center alert alert-info mb-4 mt-4" role="alert"> เพิ่มสูตรการผลิต</div>
        <hr>
        <form action="inserting.php" method="POST" enctype="multipart/form-data" >
        <?php
                require_once "../config/configpdo.php";
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $stml = $conn->query("SELECT * FROM product WHERE id = $id");
                    $stml->execute();
                    $data = $stml->fetch();
                }
            ?>
            <div class="row">
                <div class="col">
                    <input hidden type="text" name="id" value="<?= $data['id']; ?>" class="form-control" > 
                    <input readonly type="text" name="" value="<?= $data['P_ID']; ?>" class="form-control" > 
                </div>
                <div class="col">
                    <input readonly type="text" name="" value="<?= $data['P_name']; ?>" class="form-control" > 
                </div>
                <div class="col">
                    <input readonly type="text" name="" value="<?= $data['P_quantity']; ?>" class="form-control" > 
                </div>
                <div class="col">
                    <input readonly type="text" name="" value="<?= $data['P_unit_pro']; ?>" class="form-control" > 
                </div>
            </div>
                    
        <?php
        ?>
       
        <table class="table table-striped table-hover py-2">

          <thead>
            <tr align="center">
              <th scope="col" style="width: 200px;">รหัสวัตถุดิบ</th>
              <th scope="col" style="width: 200px;">ชื่อวัตถุดิบ</th>
              <th scope="col" style="width: 200px;">จำนวน</th>
              <th scope="col">หน่วยใช้</th>
            </tr>
          </thead>

          <tbody>

          <?php 
                    $stmt = $conn -> query("SELECT * FROM material ");
                    $stmt -> execute();
                    $material = $stmt -> fetchAll();

                    if (!$material) {
                        echo "<p><td colspan='8' class='text-center'>ไม่มีข้อมูล</td></p>";
                    } else {
                    foreach($material as $material)  {  
                ?>
                <tr align="center">
                  <td><input type="checkbox" name=name[]"" value="<?= $material['id']; ?>" /> <?= $material['M_ID']; ?></td>
                  <td><input type="hidden" name="mat_name[]" value="<?= $material['id']; ?>" /> <?= $material['M_name']; ?></td>
                  <td width='10%'><input type="number" name="ing_num[]" class="form-control" min="0"></td>
                  <input type="hidden" name="inglist[]" value="<?= $material['id']; ?>" />
                  <td><input type="hidden" name="ing_use[]" value="<?= $material['id']; ?>" /> <?= $material['M_unit_use']; ?></td>
                  <input type="hidden" name="P_ID[]" value="<?= $data['id']; ?>" />
                  <input type="hidden" name="P_quantity[]" value="<?= $data['P_quantity']; ?>" />
                </tr>
                <?php } 
                } ?>
          </tbody>

        </table>
        <button name="save_order" class="btn btn-primary">บันทึก</button>
        <a href="index.php" class="btn btn-danger">กลับ</a>
      </form>
    </div>
</body>

</html>