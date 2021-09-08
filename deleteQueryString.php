<?php
require "dbconnect.php";
$id = $_GET["idemp"];
$sql = "SELECT fileupload FROM employees WHERE id=$id "; // ดึงข้อมูลจาก db เอาฃื่อไฟล์ของข้อมูล
$result = mysqli_query($connect, $sql);
$file = mysqli_fetch_assoc($result); //ดึงข้อมูลออกมาเป็น arrey
$newname = $file["fileupload"]; //แปลงให้เป็น String
$sql = "DELETE FROM employees WHERE id = $id";
$result = mysqli_query($connect, $sql);
if ($result):
  unlink("fileupload/$newname"); //ลบไฟล์ที่อยู่ในโฟลเดอร์
  header("location:index.php");
  exit(0);
else:
  echo "เกิดข้อผิดพลาด";
endif;
?>
 
  ?>