<?php
$page = "Notify Approve";
include('menu.inc.php');
if((!isset($_SESSION['Username'])) || ($_SESSION['Priority'] != 'Hight')){

    header("location:index.php");
    
}
?>
<div class="container-fluid px-5">
    <div class="row">
        <div class="col-12">
            <div class="card my-5">
                <div class="card-header text-center nav-bg text-light py-3">
                    <h4><i class="fa fa-check-circle-o" aria-hidden="true"></i> Approve Notify Monthly</h4>
                </div>
                <div class="card-body bg-info">
                    <form action="<?=$_SERVER['PHP_SELF']?>" method="GET">
                        <div class="input-group">
                            <input type="text" class='form-control rounded' name="txtsearch">
                            <input type="submit" class="btn btn-success border-light" value="Search" name="search">
                    </form>
                </div>
                <table class="table table-bordered table-primary table-hover table-responsive text-dark my-3">
                    <thead class="text-dark">
                        <tr>
                            <th width="2%">No.</th>
                            <th width="10%">Month Select</th>
                            <th width="10%">Date Select</th>
                            <th width="15%">Title</th>
                            <th width="20%">Detail</th>
                            <th width="10%">Creator</th>
                            <th width="16%">Group Post</th>
                            <th width="7%">Approve</th>
                            <th width="6%">Abort</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                    include('condb.php');
                    $sql = "SELECT * FROM notify_monthly WHERE Approve_BY = '$_SESSION[Username]' AND (Approve_Status = 'Unapprove') ";
                    if(isset($_GET['search'])){
                        $sql .= "AND(Title  LIKE '%$_GET[txtsearch]%'  OR Detail LIKE '%$_GET[txtsearch]%'
                        OR Month_select LIKE '%$_GET[txtsearch]%'    OR Date_select LIKE '%$_GET[txtsearch]%' OR Creator LIKE '%$_GET[txtsearch]%'
                        OR Group_Post LIKE '%$_GET[txtsearch]%'  OR Approve_by LIKE '%$_GET[txtsearch]%' 
                        ) ";
                    }
                    $exc = $con->query($sql);
                    $noMonthly=1;
                    while($row = $exc->fetch_array()){                 
                    ?>
                        <td style="text-align:center" ;><?=$noMonthly?></td>
                        <td style="text-align:center" ;><?=$row['Month_select']?></td>
                        <td style="text-align:center" ;><?=$row['Date_select']?></td>
                        <td style="text-align:center" ;><?=$row['Title']?></td>
                        <td style="text-align:left" ;><?=$row['Detail']?></td>
                        <td style="text-align:center" ;><?=$row['Creator']?></td>
                        <td style="text-align:center" ;><?=$row['Group_Post']?></td>
                        <td style="text-align:center" ;>
                            <!-- Trigger the modal with a button -->
                            <button type="button" class="btn btn-success" data-toggle="modal"
                                data-target="#myModal<?=$noMonthly?>">Approve</button>

                            <!-- Modal -->
                            <div id="myModal<?=$noMonthly?>" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Approve</h4>
                                        </div>
                                        <div class="modal-body">
                                            Approve <?=$row['Title']?>
                                        </div>
                                        <div class="modal-footer">
                                            <form action="ap.process.php" method="POST">
                                                <input type="hidden" value="notify_monthly" name="tbname">
                                                <input type="hidden" value="<?=$row['ID']?>" name="APID">
                                                <input type="submit" class="btn btn-success" value="Approve" name="AP">
                                            </form>

                                            <button type="button" class="btn btn-default"
                                                data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td style="text-align:center" ;>
                            <!-- Trigger the modal with a button -->
                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                data-target="#AB<?=$noMonthly?>">Abort</button>

                            <!-- Modal -->
                            <div id="AB<?=$noMonthly?>" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">

                                            <h4 class="modal-title">Abort</h4>
                                        </div>
                                        <div class="modal-body">
                                            Abort: <?=$row['Title']?> ?
                                        </div>
                                        <div class="modal-footer">
                                            <form action="ab.process.php" method="POST">
                                                <input type="hidden" value="notify_monthly" name="tbname">
                                                <input type="hidden" value="<?=$row['ID']?>" name="ABID">
                                                <input type="submit" value="Abort" name="AB" class="btn btn-danger">
                                            </form>
                                            <button type="button" class="btn btn-default"
                                                data-dismiss="modal">Close</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </td>
                        </tr>
                        <?php $noMonthly++;} ?>
                        <?php if($exc->num_rows == 0){?>
                        <tr>
                            <td colspan="9" style="text-align:center" ;>
                                <div class="alert alert-danger" role="alert">
                                    NOT FOUND
                                </div>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
<?php
include('bottom.inc.php');
?>