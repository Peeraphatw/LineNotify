<?php
    session_start();
    include('condb.php');

    if(isset($_POST['DeleteDepartment'])){
        $Did = $_POST['Did'];

        $sql = "DELETE FROM notify_department WHERE ID ='$Did'";
        $exc = $con->query($sql);

            if($exc){
                header("location:Department.php");
            }else{
                echo "<script type=\"text/javascript\">";
                echo "alert(\"Error\");";
                echo "window.history.back();";
                echo "</script>";
            }
    }
?>