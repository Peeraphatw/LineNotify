<?php
    session_start();
    include('condb.php');
    if(isset($_POST['EditeUser'])){
        $Eid = $_POST['Eid'];
        $institution = $_POST['institution'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $department = $_POST['department'];
        $priority = $_POST['priority'];

        $sql = "UPDATE notify_user SET Institution='$institution', Username='$username', Password='$password', Department='$department', Priority='$priority' WHERE ID = '$Eid'";
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