<?php
    session_start();
    include('condb.php');
        if(isset($_POST['DeleteToken'])){
            $dkid = $_POST['dkid'];
            $sql = "DELETE FROM notify_token WHERE ID='$dkid'";
            $exc = $con->query($sql);
                if($exc){
                    header("location:token.php");
                }else{
                    echo"Unsuccess";
                }
        }else{
            echo"Unset";
        }
?>