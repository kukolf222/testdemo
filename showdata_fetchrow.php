<?php
    require('dbconnect.php');
    $sql="SELECT * FROM employees";
    $result=mysqli_query($connect,$sql);

    $row=mysqli_fetch_row($result);

    echo $row[0];

?>