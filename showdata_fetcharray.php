<?php
    require('dbconnect.php');
    $sql="SELECT * FROM employees";
    $result=mysqli_query($connect,$sql);

    $row=mysqli_fetch_array($result,MYSQLI_BOTH);

    print_r($row);

?>