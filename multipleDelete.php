<?php
require "dbconnect.php";
$id_arr = $_POST["idcheckbox"];
// array ทำให้เป็น String โดยมี , ขั้น
// $multiple_id = Implode(",", $id_arr);
foreach ($id_arr as $id):
  // loop ตามจำนวน array
  $sql = "SELECT fileupload FROM employees WHERE id = '$id'"; // ดึงข้อมูลจาก db เอาฃื่อไฟล์ของข้อมูล
  $result = mysqli_query($connect, $sql);
  $file = mysqli_fetch_assoc($result); //ดึงข้อมูลออกมาเป็น arrey
  $newname = $file["fileupload"]; //แปลงให้เป็น String
  $sqldel = "DELETE FROM employees WHERE id = '$id'";
  $resultdel = mysqli_query($connect, $sqldel);
  if ($resultdel):
    unlink("fileupload/$newname"); //ลบไฟล์ที่อยู่ในโฟลเดอร์
    header("location:index.php");
  else:
    echo "เกิดข้อผิพลาด";
  endif;
endforeach;

?>
