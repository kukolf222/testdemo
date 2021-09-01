<?php
//เชื่อมต่อซานข้อมูล
require "dbconnect.php";
//รับค่าที่ส่งมาจากฟอร์มลงในตัวแปร
$fname = $_POST["fname"];
$lname = $_POST["lname"];
$gender = $_POST["gender"];
$emskill = Implode(",", $_POST["skills"]); //array > string

//บันทึกข้อมูล
$sql = "INSERT INTO employees(fname,lname,gender,skills) VALUES('$fname','$lname','$gender','$emskill')";
$result = mysqli_query($connect, $sql); //สั่งรันคำสั่ง sql
if ($result):
  header("location:index.php");
  exit(0);
else:
  echo mysqli_errors($connect);
endif;
?>
