<?php
    session_start();
    include('condb.php');

    if(isset($_POST['adddepartment'])){
        $department=$_POST['department'];

        $sql = "INSERT INTO notify_department(Department) VALUES ('$department')";
        $exc = $con->query($sql);

            if($exc){
                header("location:department.php");
            }else{
                echo"Unseccess";
            }
        }else{
            echo"Unset";
        }
?>