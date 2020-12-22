<?php
    $con=mysqli_connect('localhost','root','','Notify_db')or die("Error:".mysqli_errno($con));
    mysqli_query($con,"SET NAMES 'utf8'");
?>