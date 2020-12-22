<?php
    session_start();
    include('condb.php');
        if(isset($_POST['Editetoken'])){
            $TEid = $_POST['TEid'];
            $token = $_POST['token'];
            $department = $_POST['department'];
            $grouppriority = $_POST['grouppriority'];
            $groupname = $_POST['groupname'];

                $sql = "UPDATE notify_token SET Token ='$token', Department = '$department',GroupPriority = '$grouppriority',GroupName = '$groupname' WHERE ID = '$TEid'";
                $exc = $con->query($sql);

                    if($exc){
                        header("location:token.php");
                    }else{
                        echo"unsuccsess";
                    }
        }else{
            echo"Unset";
        }
?>