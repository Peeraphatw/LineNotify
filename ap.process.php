<?php
session_start();
include('condb.php');
 if(isset($_POST['AP'])){
                                            
    include('class.linenotify.php');

                                            
    $a = new notify_line();
                                           
    $a->con_db();
                                           
    $apro = $a->approve($_POST['APID'],$_POST['tbname']);

                                           
    if($apro == TRUE){
         if($_POST['tbname'] == 'notify_monthly'){
            header("location:notify_approve.monthly.php");
         }elseif($_POST['tbname'] == 'notify_weekly'){
            header("location:notify_approve.weekly.php");
         }elseif($_POST['tbname'] == 'notify_daily'){
            header("location:notify_approve.daily.php");
         }                                     
        
                                             
                                           
    }
                                               
}else{
    echo"Unset";
}                                      
?>