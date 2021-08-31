<?php
    require('dbconnect.php');
    $sql="SELECT * FROM employees";
    $result=mysqli_query($connect,$sql);

    $count=mysqli_num_rows($result);//จำนวนแถวที่ดึงจาก DB
    
    for($i=0;$i<$count;$i++){
        $row=mysqli_fetch_object($result);
        echo $row->id."<br>";
        echo $row->fname."<br>";
        echo $row->lname."<br>";
        echo $row->gender."<br>";
        echo $row->skills."<br>";
    }
?>
