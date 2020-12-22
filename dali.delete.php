<?php
    session_start();
    include('condb.php');
        if(isset($_POST['ddaily'])){
            $ddaiid = $_POST['ddaiid'];
            $sql = "DELETE FROM notify_daily WHERE ID = '$ddaiid'";
            $exc = $con->query($sql);
            
            if($exc){
                header("location:NotifyDaily.php");
            }else{
                echo"UNSuccess";
            }
        }else{
            echo"Unisset";
        }
?>