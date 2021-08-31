<?php
require('dbconnect.php');
$sql="SELECT * FROM employees";
$result=mysqli_query($connect,$sql);

while($row=mysqli_fetch_object($result)){
    echo $row->id."<br>";
    echo $row->fname."<br>";
    echo $row->lname."<br>";
    echo $row->gender."<br>";
    echo $row->skills."<br>";
    echo "<hr>";
}

?>