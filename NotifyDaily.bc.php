<?php
    session_start(); //get session for login
    include('condb.php'); //conectdatabase
        if(isset($_POST['Dailynew'])){
            $dateS=date_create($_POST['startdate']);
            $start = date_format($dateS,"d/m/y");
            $dateE=date_create($_POST['enddate']);
            $end = date_format($dateE,"d/m/y");
            $title = $_POST['title'];
            $detail = $_POST['detail'];
            $garray = $_POST['check_list'];
            if($_SESSION['Priority'] == 'Admin'){
                $approve_by = "ByAdmin ".$_SESSION['Username'];
            }else{
                $approve_by = $_POST['approve_by'];
            }
            if($_SESSION['Priority'] == 'Admin'){
                $status = "Approve By Admin";
            }else{
                $status = "Unapprove";
            }
            
            $groupcheck = implode(",",$garray);
            
            $creator = $_SESSION['Institution']."-".$_SESSION['Username'];

            $sql = "INSERT INTO notify_daily (Start_Date,End_Date,Title,Detail,Creator,Group_Post,Approve_BY,SENT,Approve_Status)
            VALUES ('$start','$end','$title','$detail','$creator','$groupcheck','$approve_by','Unsent','$status')";
            $exc = $con->query($sql);
                if($exc){
                    header("location:NotifyDaily.php");
                }else{
                    echo"Unsuccess";
                }
        }else{
            echo"Unisset";
        }
?>