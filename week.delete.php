<?php
    session_start();
    include('condb.php');
    
        if(isset($_POST['deleteweek'])){
            
            $Dwid = $_POST['Dwid'];

            $sql = "DELETE FROM notify_weekly WHERE ID = '$Dwid'";
            $exc = $con->query($sql);
            
            if($exc){
                header("location:NotifyWeekly.php");
            }else{
                echo"UNSuccess";
            }
        }else{
            echo"Unisset";
        }
?>