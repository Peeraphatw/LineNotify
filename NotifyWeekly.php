<?php 
    $page ="Notify Weekly";
    include('menu.inc.php');
    if(!isset($_SESSION['Username'])){

        header("location:index.php");
        
    }
    define('LINE_API',"https://notify-api.line.me/api/notify");
    date_default_timezone_set("Asia/Bangkok");
    ?>
<div class="container-fluid px-5">
    <div class="row">
        <div class="col-lg-1"></div>
        <div class="col-sm-12 col-lg-12">
            <div class="card my-5">
                <div class="card-header text-center nav-bg text-light py-3">
                    <h4><i class="fa fa-bell-o" aria-hidden="true"></i> Notify Weekly</h4>
                </div>
                <div class="card-body p-1  bg-info">

                    <form action="<?=$_SERVER['PHP_SELF']?>" method="GET">
                        <div class="input-group my-3 px-2">
                            <input type="text" class="form-control rounded shadow border-dark" name="txtsearch">
                            <input type="submit" class="btn btn-info shadow border-dark" value="search" name="search">
                    </form>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-success bg-primary shadow border-dark" data-toggle="modal"
                        data-target="#AddNCH">
                        Add
                    </button>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="AddNCH" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Notify Weekly</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="NotifyWeekly.bc.php" method="POST">
                                <div class="modal-body">
                                    <lable>Day Select:</label>

                                        <div class="input-group my-2">
                                            <?php 
                                            $day = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
                                            $noday=1;
                                            foreach($day as $day){
                                        ?>
                                            <div class="custom-control custom-checkbox mx-3">
                                                <input type="checkbox" class="custom-control-input"
                                                    id="Selectday<?=$noday?>" name="day[]"
                                                    value="<?=substr($day,0,3); ?>">
                                                <label class="custom-control-label"
                                                    for="Selectday<?=$noday?>"><?=$day?></label>
                                            </div>
                                            <?php $noday++; } ?>
                                        </div>
                                        <lable>Title:</label>
                                            <input type="text" name="title" class="my-3 form-control">
                                            <lable>Detail:</label>
                                                <textarea class="form-control my-3" rows="5" name="detail"> </textarea>
                                                <?php if($_SESSION['Priority'] != 'Admin'){?>
                                                <label>Approve BY:
                                            </lable>
                                            <select class="form-control my-3" name="approve_by" required>
                                                <option value="">
                                                    Select
                                                </option>
                                                <?php
                                        include('condb.php');
                                        $apsql = "SELECT Username FROM `notify_user` WHERE Priority ='Hight' AND Department = '$_SESSION[Department]'";
                                        $apexc = $con->query($apsql);
                                        if($apexc->num_rows >= 1){?>

                                                <?php while($person = $apexc->fetch_object()){?>
                                                <option value="<?=$person->Username;?>"><?=$person->Username;?></option>
                                                <?php } ?>

                                                <?php }else{ ?>
                                                <option value="">Not found</option>
                                                <?php } ?>

                                            </select>
                                            <?php  }?>
                                            <lable>Group Post:</label>
                                                <div class="input-group my-2">
                                                    <?php 
                                            include('condb.php');
                                            $department = $_SESSION['Department'];
                                            if($_SESSION['Priority'] == 'Admin'){                                              
                                                $sqlGrouplist = "SELECT GroupName FROM notify_token";
                                            }elseif($_SESSION['Priority'] == 'Hight'){                                              
                                                $sqlGrouplist = "SELECT GroupName FROM notify_token WHERE (GroupPriority ='Hight' OR GroupPriority ='Mid' OR GroupPriority ='Low') AND (Department ='$department')";
                                            }elseif($_SESSION['Priority'] == 'Mid'){
                                                $sqlGrouplist = "SELECT GroupName FROM notify_token WHERE (GroupPriority ='Mid' OR GroupPriority ='Low') AND (Department ='$department')";
                                            }elseif($_SESSION['Priority'] == 'Low'){                                               
                                                $sqlGrouplist = "SELECT GroupName FROM notify_token WHERE Department = '$department' AND GroupPriority ='Low'";
                                            }                                                                                       
                                            $excGrouplist = $con->query($sqlGrouplist);
                                            $no=1;
                                            while($rowGrouplist = $excGrouplist->fetch_array()){                                             
                                                $valuecheck = $rowGrouplist['GroupName'];                                              
                                         ?>
                                                    <div class="custom-control custom-checkbox mx-3">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="SelectGroup<?=$no?>" name="check_list[]"
                                                            value="<?=$valuecheck?>">
                                                        <label class="custom-control-label"
                                                            for="SelectGroup<?=$no?>"><?=$valuecheck?></label>
                                                    </div>
                                                    <?php $no++; }
                                          ?>
                                                </div>

                                                <div class="modal-footer">
                                                    <input type="submit" value="Add" name="Weeklynew"
                                                        class="btn btn-success">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-primary table-hover table-responsive text-dark my-3">
                    <thead class="text-dark">
                        <tr>
                            <th width="2%">No.</th>
                            <th width="10%">Day Select</th>
                            <th width="10%">Title</th>
                            <th width="5%">Detail</th>
                            <th width="5%">Creator</th>
                            <th width="5%">Approve By</th>
                            <th width="10%">Approve Status</th>
                            <th width="10%">Group Post</th>
                            <th width="5%">NotifyDate</th>
                            <th width="5%">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                    include('condb.php');
                    $department = $_SESSION['Department'];
                    $Creator = $_SESSION['Institution']."-".$_SESSION['Username'];
                    if($_SESSION['Priority'] == 'Admin'){
                    $stmt = "SELECT * FROM notify_weekly";
                    if(isset($_GET['search'])){
                        $stmt = "SELECT * FROM notify_weekly WHERE Title  LIKE '%$_GET[txtsearch]%'  OR Detail LIKE '%$_GET[txtsearch]%'  
                        OR Day_select LIKE '%$_GET[txtsearch]%'  OR Creator LIKE '%$_GET[txtsearch]%'
                        OR Group_Post LIKE '%$_GET[txtsearch]%'  OR Approve_by LIKE '%$_GET[txtsearch]%' OR SENT LIKE '%$_GET[txtsearch]%' OR Approve_Status LIKE '%$_GET[txtsearch]%' OR SENT_Time LIKE '%$_GET[txtsearch]%'
                         ";
                    }
                    }else{
                        $stmt = "SELECT * FROM notify_weekly WHERE Creator = '$Creator' OR (Approve_by='$_SESSION[Username]') ";
                        if(isset($_GET['search'])){
                        $stmt = "SELECT * FROM notify_weekly WHERE  (Title  LIKE '%$_GET[txtsearch]%'  OR Detail LIKE '%$_GET[txtsearch]%' 
                        OR Day_select LIKE '%$_GET[txtsearch]%'   OR Creator LIKE '%$_GET[txtsearch]%'
                        OR Group_Post LIKE '%$_GET[txtsearch]%'  OR Approve_by LIKE '%$_GET[txtsearch]%' OR SENT LIKE '%$_GET[txtsearch]%' OR Approve_Status LIKE '%$_GET[txtsearch]%' OR SENT_Time LIKE '%$_GET[txtsearch]%'
                        ) AND (Creator = '$Creator' OR Approve_by='$_SESSION[Username]')";
                        }
                    }
                    $excweekly = $con->query($stmt);
                    $weeklynumrow= $excweekly->num_rows;
                    $noweekly = 1;
                    include('class.linenotify.php');
                    while($dataweekly = $excweekly->fetch_array()){
                    ?>
                        <tr>
                            <td style="text-align:center" ;><?=$noweekly?></td>
                            <td style="text-align:center" ;><?=$dataweekly['Day_select']?></td>
                            <?php
                        if($dataweekly['Approve_Status'] == 'Approve' || $dataweekly['Approve_Status'] == 'Approve By Admin'){
                            $thisdate = date("d/m/y");
                            if($dataweekly['SENT'] != $thisdate ){
                                $dayselect = explode(",",$dataweekly['Day_select']);                                      
                                foreach($dayselect as $day){

                                    $today = date("D");
                                    if($day == $today){
                                        
                                        $n = new notify_line();
                                        $n->con_db();
                                        $message = $n->set_message($dataweekly['Title'],$dataweekly['Detail'],$dataweekly['Creator']);
                                        $token_set = $n->token_set($dataweekly['Group_Post']);

                                        foreach($token_set as $token_set){
                                            $notify = $n->notify_message($message,$token_set);
                                            }

                                            if($notify == TRUE){
                                                $n-> notify_date($dataweekly['ID'],"notify_weekly");
                                                $n-> notify_Time($dataweekly['ID'],"notify_weekly");
                                            }
                                    }

                                }
                            }
                        }
                         ?>
                            <td style="text-align:center" ;><?=$dataweekly['Title']?></td>
                            <td style="text-align:center" ;><button class="btn btn-primary w-100 border-secondary"
                                    data-toggle="modal" data-target="#detailM<?=$noweekly?>">Detail</button></td>
                            <td style="text-align:center" ;><?=$dataweekly['Creator']?></td>
                            <td style="text-align:center" ;><?=$dataweekly['Approve_BY']?></td>
                            <td style="text-align:center" ;>
                                <?=$dataweekly['Approve_Status']."<br>".$dataweekly['Approve_Time']?></td>
                            <td style="text-align:left" ;><?=$dataweekly['Group_Post']?></td>
                            <td style="text-align:center" ;><?=$dataweekly['SENT']."<br>".$dataweekly['SENT_Time']?>
                            </td>

                            <td style="text-align:center" ;><button class="btn btn-danger w-100 border-warning"
                                    data-toggle="modal" data-target="#deleteM<?=$noweekly?>">Delete</button></td>
                            </td>
                        </tr>
                        <!-- */ detail M */ -->
                        <div class="modal fade" id="detailM<?=$noweekly?>" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Schedule Detail</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body text-left">
                                        <?=$dataweekly['Detail']?>
                                    </div>
                                    <div class="modal-footer align-items-center">
                                        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- */ detail M */ -->

                        <!-- */ delete M */ -->
                        <div class="modal fade" id="deleteM<?=$noweekly?>" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Delete Schedule</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Do you Want to Delete <?=$dataweekly['Title']?> ?
                                    </div>
                                    <div class="modal-footer align-items-center">
                                        <form action="week.delete.php" method="POST">
                                            <input type="hidden" name="Dwid" value="<?=$dataweekly['ID']?>">
                                            <input type="submit" name="deleteweek" value="detete"
                                                class="btn btn-danger">
                                        </form>
                                        <button type="button" class="btn btn-info" data-dismiss="modal">No</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- */ delete M */ -->
                        <?php $noweekly++; } ?>
                        <?php if($weeklynumrow == 0){?>
                        <tr>
                            <td colspan="11" style="text-align:center" ;>
                                <div class="alert alert-danger" role="alert">
                                    NOT FOUND
                                </div>
                            </td>
                        </tr>
                        <?php } ?>

                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-1"></div>
</div>
</div>

<?php include('bottom.inc.php');?>