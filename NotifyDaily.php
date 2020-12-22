    <?php 
    $page ="Notify Daily";
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
                        <h4><i class="fa fa-bell-o" aria-hidden="true"></i> Notify Daily</h4>
                    </div>
                    <div class="card-body p-1  bg-info">
                        <form action="<?=$_SERVER['PHP_SELF']?>" method="GET">
                            <div class="input-group my-3 px-2">

                                <input type="text" class="form-control rounded shadow border-dark" name="txtsearch">
                                <input type="submit" class="btn btn-info shadow border-dark" value="search"
                                    name="search">
                                <button type="button" class="btn btn-success bg-primary shadow border-dark"
                                    data-toggle="modal" data-target="#AddNCH">
                                    Add
                                </button>
                        </form>
                    </div>
                    <!-- Button trigger modal -->


                    <!-- Modal -->
                    <div class="modal fade" id="AddNCH" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Notify Daily</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="NotifyDaily.bc.php" method="POST">
                                    <div class="modal-body">
                                        <lable>Start Date:</label>
                                            <input type="date" name="startdate" class="form-control my-3" required>
                                            <lable>End Date:</label>
                                                <input type="date" name="enddate" class="form-control my-3" required>
                                                <lable>Title:</label>
                                                    <input type="text" name="title" class="my-3 form-control" required>
                                                    <lable>Detail:</label>
                                                        <textarea class="form-control my-3" rows="5" name="detail"
                                                            required> </textarea>

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
                                                        <option value="<?=$person->Username;?>"><?=$person->Username;?>
                                                        </option>
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
                                                $sqlGrouplist = "SELECT GroupName FROM notify_token WHERE (GroupPriority ='Mid' OR GroupPriority ='Low') AND (Department ='$department') ";
                                            }elseif($_SESSION['Priority'] == 'Low'){                                               
                                                $sqlGrouplist = "SELECT GroupName FROM notify_token WHERE Department = '$department' AND (GroupPriority ='Low')";
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
                                                            <input type="submit" value="Add" name="Dailynew"
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
                                <th width="4%">No.</th>
                                <th width="10%">Strat Date</th>
                                <th width="10%">End Date</th>
                                <th width="10%">Title</th>
                                <th width="6%">Detail</th>
                                <th width="10%">Creator</th>
                                <th width="10%">Approve By</th>
                                <th width="10%">Approve Status</th>
                                <th width="15%">Group Post</th>
                                <th width="5%">NotifyDate</th>
                                <th width="6%">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                    include('condb.php');
                    $department = $_SESSION['Department'];
                    $Creator = $_SESSION['Institution']."-".$_SESSION['Username'];

                    if($_SESSION['Priority'] == 'Admin'){
                    $stmt = "SELECT * FROM notify_daily";
                    if(isset($_GET['search'])){
                        $stmt = "SELECT * FROM notify_daily WHERE Title  LIKE '%$_GET[txtsearch]%'  OR Detail LIKE '%$_GET[txtsearch]%' 
                        OR Start_Date LIKE '%$_GET[txtsearch]%'    OR End_Date LIKE '%$_GET[txtsearch]%'  OR Creator LIKE '%$_GET[txtsearch]%' OR SENT_Time LIKE '%$_GET[txtsearch]%'
                        OR Group_Post LIKE '%$_GET[txtsearch]%'  OR Approve_by LIKE '%$_GET[txtsearch]%' OR Approve_Status LIKE '%$_GET[txtsearch]%' OR SENT LIKE '%$_GET[txtsearch]%'
                         ";
                    }
                    }else{
                    $stmt = "SELECT * FROM notify_daily WHERE Creator = '$Creator' OR (Approve_by='$_SESSION[Username]') ";
                    if(isset($_GET['search'])){
                        $stmt = "SELECT * FROM notify_daily WHERE  (Title  LIKE '%$_GET[txtsearch]%'  OR Detail LIKE '%$_GET[txtsearch]%' 
                        OR Start_Date LIKE '%$_GET[txtsearch]%'    OR End_Date LIKE '%$_GET[txtsearch]%'  OR Creator LIKE '%$_GET[txtsearch]%' OR SENT_Time LIKE '%$_GET[txtsearch]%'
                        OR Group_Post LIKE '%$_GET[txtsearch]%'  OR Approve_by LIKE '%$_GET[txtsearch]%' OR SENT LIKE '%$_GET[txtsearch]%' OR Approve_Status LIKE '%$_GET[txtsearch]%'
                        ) AND (Creator = '$Creator' OR Approve_by='$_SESSION[Username]')";
                    }
                    }
                    $excdaily = $con->query($stmt);
                    $dailinumrow= $excdaily->num_rows;
                    $nodaily = 1;
                    while($datadaily = $excdaily->fetch_array()){
                    ?>
                            <tr>
                                <td style="text-align:center" ;><?=$nodaily?></td>
                                <td style="text-align:center" ;><?=$datadaily['Start_Date']?></td>
                                <td style="text-align:center" ;><?=$datadaily['End_Date']?></td>
                                <?php 
                        $today = date("d/m/y");
                        if($datadaily['Approve_Status'] == 'Approve' || $datadaily['Approve_Status'] == 'Approve By Admin' ){
                        if(($today >= $datadaily['Start_Date']) && ($today <= $datadaily['End_Date'])){
                            if($datadaily['SENT'] != $today){
                                include('class.linenotify.php');

                                $n = new notify_line();
                                $n->con_db();
                                $message = $n->set_message($datadaily['Title'],$datadaily['Detail'],$datadaily['Creator']);
                                $token_set = $n->token_set($datadaily['Group_Post']);

                                
                                foreach($token_set as $token_set){
                                $notify = $n->notify_message($message,$token_set);
                                }
                                
                                if($notify == TRUE){
                                    $n-> notify_date($datadaily['ID'],"notify_daily");
                                    $n-> notify_Time($datadaily['ID'],"notify_daily");
                                }
                            }
                        }
                    }
                        ?>
                                <td style="text-align:center" ;><?=$datadaily['Title']?></td>
                                <td style="text-align:center" ;><button class="btn btn-primary w-100 border-secondary"
                                        data-toggle="modal" data-target="#detailM<?=$nodaily?>">Detail</button></td>
                                <td style="text-align:center" ;><?=$datadaily['Creator']?></td>
                                <td style="text-align:center" ;><?=$datadaily['Approve_by']?></td>
                                <td style="text-align:center" ;>
                                    <?=$datadaily['Approve_Status']."<br>".$datadaily['Approve_Time']?></td>
                                <td style="text-align:center" ;><?=$datadaily['Group_Post']?></td>
                                <td style="text-align:left" ;><?=$datadaily['SENT']."<br> ".$datadaily['SENT_Time']?>
                                </td>
                                <td style="text-align:center" ;><button class="btn btn-danger w-100 border-warning"
                                        data-toggle="modal" data-target="#deleteM<?=$nodaily?>">Delete</button></td>
                                </td>
                            </tr>
                            <?php 
                                 include('md.dali.detail.php');
                                 include('md.deli.delete.php');
                                 ?>

                            <?php $nodaily++;} $con->close(); ?>

                            <?php 
                    if($dailinumrow == 0){?>
                            <tr>
                                <td colspan="11" style="text-align:center" ;>
                                    <div class="alert alert-danger" role="alert">
                                        NOT FOUND
                                    </div>
                                </td>
                            </tr>
                            <?php
                     }
                    ?>
                        </tbody> <!-- */ delete M */ -->
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-1"></div>
    </div>
    </div>

    <?php include('bottom.inc.php');?>