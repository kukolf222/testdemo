<?php
require "dbconnect.php";
$id = $_GET["id"];
$sql = "SELECT * FROM employees WHERE id = $id";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($result);
$skill_arr = ["Java", "PHP", "Python", "HTML"];

//เตรียมตัวเลือกในแบบฟอร์ม
?>
<!-- copy จาก insertform และแก้ไขเล็กน้อย -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลพนักงาน</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
</head>
<body>
    <div class="container my-3">
        <h2 class="text-center">แบบฟอร์มแก้ไขข้อมูล</h2>
        <!-- ส่งข้อมูลไป updatedata ต่อ -->
        <form action="updateData.php" method="POST" enctype="multipart/form-data">
            <!-- hiddenเพื่อไม่ให้แก้ไข id -->
          <input type="hidden" value="<?php echo $row["id"]; ?>" name="id"> 
          <!-- textbox นำ value จาก DB มาใส่ -->
          <div class="form-group">
                <label for="firstname">ชื่อ</label>
                <input type="text" name="fname" id="" class="form-control" value="<?php echo "{$row["fname"]}"; ?>">
          </div>
          <div class="form-group">
                <label for="lastname">นามสกุล</label>
                <input type="text" name="lname" id="" class="form-control" value="<?php echo "{$row["lname"]}"; ?>">
          </div>
          <!-- radio ทำเงื่อนไข check เฉพาะเพศที่เลือก -->
          <div class="form-group">
                <label for="gender">เพศ</label>
                <?php if ($row["gender"] == "male"):
                  echo "<input type='radio' name='gender' value='male' checked>ชาย";
                  echo "<input type='radio' name='gender' value='female'>หญิง";
                  echo "<input type='radio' name='gender' value='other'>อื่นๆ";
                elseif ($row["gender"] == "female"):
                  echo "<input type='radio' name='gender' value='male'>ชาย";
                  echo "<input type='radio' name='gender' value='female' checked>หญิง";
                  echo "<input type='radio' name='gender' value='other'>อื่นๆ";
                else:
                  echo "<input type='radio' name='gender' value='male'>ชาย";
                  echo "<input type='radio' name='gender' value='female'>หญิง";
                  echo "<input type='radio' name='gender' value='other' checked>อื่นๆ";
                endif; ?>
          </div>
          <div class="form-group">
                <label for="">ทักษะ</label>
                <?php
                $skill = explode(",", $row["skills"]); //แปลง string array ทักษะของพนักงาน
                foreach ($skill_arr as $value):
                  if (in_array($value, $skill)):
                    echo "<input type='checkbox' name='skills[]' value='$value' checked> $value";
                  else:
                    echo "<input type='checkbox' name='skills[]' value='$value'> $value";
                  endif;
                endforeach;
                ?> 
          </div>
          <?php echo "<img src='fileupload/" .
            $row["fileupload"] .
            "' width='50'>"; ?>
          <div class="form-group">
                <label for="image">รูปถ่าย ถ้าใช้รูปภาพเดิมไม่ต้องใส่รูปภาพเพิ่ม</label>
                <input type="file" name="fileupload" class="form-control">
          </div>
          <input type="submit" value="อัปเดตข้อมูล" class="btn btn-success">
          <input type="reset" value="ล้างข้อมูล" class="btn btn-danger">
          <a href="index.php" class="btn btn-primary">กลับหน้าแรก</a>
        </form>  
    </div>
</body>
</html>