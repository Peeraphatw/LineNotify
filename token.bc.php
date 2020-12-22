<?php
    include('condb.php');
     if(isset($_POST['addtoken'])){
         $token = $_POST['token'];
         $department = $_POST['department'];
         $grouppriority = $_POST['grouppriority'];
         $groupname = $_POST['groupname'];
         

         $sql = "INSERT INTO notify_token (Token,Department,GroupPriority,GroupName) VALUES ('$token','$department','$grouppriority','$groupname')";
         $exc = $con->query($sql);

            if($exc){
                header("location:token.php");
            }else{
                echo"Error";
            }
     }
?>