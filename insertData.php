<?php
//เชื่อมต่อซานข้อมูล
require "dbconnect.php";
//รับค่าที่ส่งมาจากฟอร์มลงในตัวแปร
// $fileupload = $_post["fileupload"];
$fileupload = isset($_POST["fileupload"]) ? $_POST["fileupload"] : ""; //จะมีการ upload file หรือไม่ก็ตามจะปิดการแจ้ง error
$fname = $_POST["fname"];
$lname = $_POST["lname"];
$gender = $_POST["gender"];
$emskill = Implode(",", $_POST["skills"]); //array > string
// ฟังชั่นวันที่
date_default_timezone_set("Asia/Bangkok");
$date = date("Ymd");
// ฟังชั่นสุ่มตัวเลข
$numrand = mt_rand();
// เพิ่มไฟล์
$upload = $_FILES["fileupload"];
if (isset($upload) && $upload["size"] > 0):
  // ถ้าการ uploadไม่เท่ากับค่าว่าง คือเมื่อมีการ upload
  //โฟลเดอร์ที่จะ Upload file เข้าไป
  $path = "fileupload/";
  //เอาชื่อไฟล์เก่าออกให้เหลือแต่นามสกุล
  $type = strrchr($_FILES["fileupload"]["name"], ".");
  //ตั้งชื่อไฟล์ไหม่โดยเอาเวลาไว้หน้าชื่อไฟล์เดิม
  $newname = $date . $numrand . $type;
  $path_copy = $path . $newname; //สำหรับคนอยากจะเก็บ Path หรือ โฟลเดอที่เก็บไฟล์ในColum ใน DB
  // $path_link="fileuploa/".$newname;//สำหรับคนอยากจะเก็บ Path หรือ โฟลเดอที่เก็บไฟล์ในColum ใน DB
  //คัดลอกไฟล์ไปเก็บที่เว็บเซิฟเวอ
  move_uploaded_file($_FILES["fileupload"]["tmp_name"], $path_copy);
endif;
//บันทึกข้อมูล
$sql = "INSERT INTO employees(fileupload,fname,lname,gender,skills) VALUES('$newname','$fname','$lname','$gender','$emskill')";
$result = mysqli_query($connect, $sql); //สั่งรันคำสั่ง sql
if ($result):
  header("location:index.php");
  exit(0);
else:
  echo mysqli_errors($connect);
endif;
?>
