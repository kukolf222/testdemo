<?php
    require('dbconnect.php');
    $sql="SELECT * FROM employees";
    $result=mysqli_query($connect,$sql);

    $row=mysqli_fetch_object($result);

    echo $row->id."<br>";
    echo $row->fname."<br>";

?>