<?php
    session_start();
    include('condb.php');
    if(isset($_POST['adduser'])){
        $institution = $_POST['institution'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $department = $_POST['department'];
        $priority = $_POST['priority'];

        $sql = "INSERT INTO Notify_user(Institution,Username,Password,Department,Priority) VALUES ('$institution','$username','$password','$department','$priority')";
        $query = $con->query($sql);

        if($query){
            header("location:user.php");
        }else{
            echo"Error";
        }
    }else{
        echo"Unset";
    }
?>