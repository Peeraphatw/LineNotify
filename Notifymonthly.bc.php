<?php
    session_start();
    include('condb.php');

        if(isset($_POST['newmonthly'])){
            
            $Monthselect = implode(",",$_POST['Month']);
            $dateselect = implode(",",$_POST['date']);
            $title = $_POST['title'];
            $detail = $_POST['detail'];
            if($_SESSION['Priority'] == 'Admin'){
                $approve_by = "ByAdmin ".$_SESSION['Username'];
            }else{
                $approve_by = $_POST['approve_by'];
            }
            $grouppost = implode(",",$_POST['check_list']);
            $creator = $_SESSION['Institution']."-".$_SESSION['Username'];
            if($_SESSION['Priority'] == 'Admin'){
                $status = "Approve By Admin";
            }else{
                $status = "Unapprove";
            }
            

            $sql = "INSERT INTO notify_monthly(Month_select,Date_select,Title,Detail,Creator,Group_Post,Approve_BY,SENT,Approve_Status)
            VALUES ('$Monthselect','$dateselect','$title','$detail','$creator','$grouppost','$approve_by','Unsent','$status')";
            $exc = $con->query($sql);
                if($exc){
                    header("location:Notifymonthly.php");
                }else{
                    echo"Unsuccess";
                }
        }else{
            echo"unset";
        }
?>