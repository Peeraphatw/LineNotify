<?php
    session_start();
    include('condb.php');
        if(isset($_POST['Dml'])){
            $Dmlid = $_POST['Dmlid'];
            $sql = "DELETE FROM notify_monthly WHERE ID = '$Dmlid'";
            $exc = $con->query($sql);
            
            if($exc){
                header("location:NotifyMonthly.php");
            }else{
                echo"UNSuccess";
            }
        }else{
            echo"Unisset";
        }
?>