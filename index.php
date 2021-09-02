<?php
require "dbconnect.php";
$sql = "SELECT * FROM employees ORDER BY fname ASC"; //เชื่อม db เพื่อเอาข้อมูลใน DB มาแสดงในตาราง
$result = mysqli_query($connect, $sql);
$count = mysqli_num_rows($result); //นับจำนวนแถวเพื่อแสดงข้อมูลเมื่อมีข้อมูลใน DB
// $count = $result ? mysqli_num_rows($result) : 0; //นับจำนวนแถวเพื่อแสดงข้อมูลเมื่อมีข้อมูลใน DB
$order = 1;

//เรียงลำดับที่เป็นตัวเลข 1-n
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลพนักงาน</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1 class="text-center">ข้อมูลพนักงานในฐานข้อมูล</h1>
        <hr>
        <!-- ถ้ามีข้อมูลก็จะให้แสดง -->
        <?php if ($count > 0): ?>
            <!-- ค้นหาข้อมูล ด้วยตัวอักษร-->
            <form action="searchData.php" class="form-group" method="POST">
            <label for="">ค้นหาพนักงาน</label>
            <input type="text" placeholder="ป้อนชื่อพนักงาน" name="empname" class="form-control">
            <input type="submit" value="ค้นหา" class="btb btn-dark my-2">
            </form>
        <?php endif; ?>

        <form action="multipleDelete.php" method="post">
            <!-- ถ้ามีข้อมูลก็จะให้แสดง -->
            <?php if ($count > 0): ?>
            <!-- เริ่มตาราง -->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ลำดับที่</th>
                            <th>ชื่อ</th>
                            <th>นามสกุล</th>
                            <th>เพศ</th>
                            <th>ทักษะ</th>
                            <th>แก้ไขข้อมูล</th>
                            <th>ลบข้อมูล</th>
                            <th>ลบข้อมูล (Checkbox)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- นับจำนวนแถวเพื่อแสดงข้อมูลเมื่อมีข้อมูลใน DB -->
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo $order++; ?></td>
                            <td><?php echo $row["fname"]; ?></td>
                            <td><?php echo $row["lname"]; ?></td>
                            <td>
                            <?php if ($row["gender"] == "male"): ?>
                                    ชาย
                            <?php elseif ($row["gender"] == "female"): ?>
                                    หญิง
                            <?php else: ?>
                                    อื่นๆ
                            <?php endif; ?>
                            </td>
                            <td><?php echo $row["skills"]; ?></td>
                            <!-- แก้ไขข้อมูล -->
                            <td>
                                <a href="editForm.php?id=<?php echo "{$row["id"]}"; ?>" class="btn btn-primary">แก้ไข</a>
                            </td>
                            <!-- ลบข้อมูลแบบ Querystring -->
                            <td>
                                <a href="deleteQueryString.php?idemp=<?php echo "{$row["id"]}"; ?>" 
                                class= "btn btn-danger"
                                onclick="return confirm('ต้องการลบข้อมูลหรือไม่')"
                                >ลบข้อมูล</a>
                            </td>
                            <!-- ฟอร์มลบข้อมูลแบบ checkbox -->
                            <td>
                            <input type="checkbox" name="idcheckbox[]" value="<?php echo "{$row["id"]}"; ?>">
                            </td>              
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <!-- ถ้าไม่มีข้อมูลก็ไม่แสดง -->
            <?php else: ?>
                <div class="alert alert-danger">
                    <b>ไม่มีข้อมูลพนักงาน !!!<b>
                </div>
            <?php endif; ?>

            <!-- เพิ่มข้อมูล -->
            <a href="insertForm.php" class="btn btn-success">บันทึกข้อมูลพนักงาน</a>
            <?php if ($count > 0): ?>
                <input type="submit" value="ลบข้อมูล (Checkbox)" class="btn btn-danger">
                
            <?php endif; ?>
        </form>
        <!-- เลือกทั้งหมด javascript -->
        <button class="btn btn-info" onclick="toggleCheckAll()">เลือกทั้งหมด</button>
        <button class="btn btn-warning" onclick="toggleCheckAll(false)">ยกเลิก</button>
    </div>
    <script>
    // function checkAll(){
    //     var form_element=document.forms[1].length;
    //     for(i=0;i<form_element-1;i++){
    //         document.forms[1].elements[i].checked=true;
    //     }
    // }
    // function uncheckAll(){
    //     var form_element=document.forms[1].length;
    //     for(i=0;i<form_element-1;i++){
    //         document.forms[1].elements[i].checked=false;
    //     }
    // }

    function toggleCheckAll(checked = true) {
        const cbs = document.querySelectorAll('input[name="idcheckbox[]"]');
        cbs.forEach((cb) => {
            cb.checked = checked;
        });
    }
    </script>
</body>
</html>