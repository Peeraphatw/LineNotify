<?php
    session_start();
    include('condb.php');
        if(isset($_POST['DeleteUser'])){
            $Did = $_POST['Did'];
            $sql = "DELETE FROM notify_user WHERE ID='$Did'";
            $exc = $con->query($sql);
            if($exc){
                header("location:user.php");
            }else{
                echo"Unssccess";
            }
        }else{
            echo"unset";
        }
?>