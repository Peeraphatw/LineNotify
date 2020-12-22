<?php
    session_start();
    include('condb.php');

        if(isset($_POST['Weeklynew'])){
            $dayselect = implode(",",$_POST['day']);
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


            $sql = "INSERT INTO notify_weekly (Day_select,Title,Detail,Creator,Group_Post,Approve_BY,SENT,Approve_Status)
            VALUES ('$dayselect','$title','$detail','$creator','$grouppost','$approve_by','Unsent','$status')";
            $exc = $con->query($sql);
                if($exc){
                    header("location:NotifyWeekly.php");
                }else{
                    echo"Unsuccess";
                }
        }else{
            echo"unset";
        }
?>