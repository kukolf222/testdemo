<?php
require "dbconnect.php";

$id_arr = $_POST["idcheckbox"];
// array ทำให้เป็น String โดยมี , ขั้น
$multiple_id = Implode(",", $id_arr);

$sql = "DELETE FROM employees WHERE id in ($multiple_id)";
$result = mysqli_query($connect, $sql);
if ($result):
  header("location:index.php");
  exit(0);
else:
  echo "เกิดข้อผิพลาด";
endif;
?>