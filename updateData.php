<?php
require "dbconnect.php";
$id = $_POST["id"];
// $fileupload = isset($_POST["fileupload"]) ? $_POST["fileupload"] : "";
$fname = $_POST["fname"];
$lname = $_POST["lname"];
$gender = $_POST["gender"];
$emskill = Implode(",", $_POST["skills"]);
date_default_timezone_set("Asia/Bangkok");
$date = date("Ymd");
$numrand = mt_rand();
// เพิ่มไฟล์
$upload = $_FILES["fileupload"];
if (isset($upload) && $upload["size"] > 0):
  $sql = "SELECT fileupload FROM employees WHERE id=$id ";
  $result = mysqli_query($connect, $sql);
  $file = mysqli_fetch_assoc($result);
  $newname = $file["fileupload"];
  unlink("fileupload/$newname");
  // ถ้าการมีไฟล์ Upload ขนาดมากกว่า0 และชื่อไฟล์ไม่เท่ากับค่าว่าง
  //โฟลเดอร์ที่จะ Upload file เข้าไป
  $path = "fileupload/";
  //เอาชื่อไฟล์เก่าออกให้เหลือแต่นามสกุล
  $type = strrchr($_FILES["fileupload"]["name"], ".");
  //ตั้งชื่อไฟล์ไหม่โดยเอาเวลาไว้หน้าชื่อไฟล์เดิม
  $newname = $date . $numrand . $type;
  $path_copy = $path . $newname; //สำหรับคนอยากจะเก็บ Path หรือ โฟลเดอที่เก็บไฟล์ในColum ใน DB
  // $path_link="fileupload/".$newname;//สำหรับคนอยากจะเก็บ Path หรือ โฟลเดอที่เก็บไฟล์ในColum ใน DB
  //คัดลอกไฟล์ไปเก็บที่เว็บเซิฟเวอ
  move_uploaded_file($_FILES["fileupload"]["tmp_name"], $path_copy); //เลือกฃื่อไฟล์ จากตาราง ที่ id ที่แก้ไข // fetch ออกมาได้แค่ fileupload เอาไปเก็บใน $file เป็นแบบ array //arrey
else:
  $sql = "SELECT fileupload FROM employees WHERE id=$id ";
  $result = mysqli_query($connect, $sql);
  $file = mysqli_fetch_assoc($result);
  $newname = $file["fileupload"]; // เอาค่าที่เป็นสตริงเอาไปใช้
endif;
$sql = "UPDATE employees SET fileupload = '$newname',fname = '$fname',lname='$lname',gender='$gender',skills='$emskill' WHERE id=$id ";
$result = mysqli_query($connect, $sql);
if ($result):
  header("location:index.php");
  exit(0);
else:
  echo mysqli_errors($connect);
endif;
?>
