<?php
    session_start();
    if(isset($_POST['login'])){
        include('condb.php');
        $username = $_POST['Username'];
        $password = $_POST['Password'];

        $sql ="SELECT * FROM Notify_user WHERE Username='$username' AND Password='$password'";
        $query =$con->query($sql);
        $numrow=$query->num_rows;
        $row = $query->fetch_array();

        if($numrow == 1){
            $_SESSION['Institution'] = $row['Institution'];
            $_SESSION['Username'] = $row['Username'];
            $_SESSION['Password'] = $row['Password'];
            $_SESSION['Priority'] = $row['Priority'];
            $_SESSION['Department'] = $row['Department'];

            
            header("location:index.php");
        }else{
           echo" <script type='text/javascript'>alert('Worng Password');</script>";
           header("location:index.php");
            
        }
    }else{
        echo"Unset Login";
    }
?>