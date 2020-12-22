<?php 
$page = "Token";
include('menu.inc.php');
if(!isset($_SESSION['Username']) || $_SESSION['Priority'] != 'Admin'){

    header("location:index.php");
}
 ?>
<div class="container">
    <div class="row">

        <div class="col-12">
            <div class="card my-5 p-0">
                <div class="card-header text-center nav-bg text-light">
                    <h3><i class="fa fa-puzzle-piece" aria-hidden="true"></i> Token</h3>
                </div>
                <div class="card-body p-2 bg-info">
                    <form action="<?=$_SERVER['PHP_SELF']?>" method="GET">
                        <div class="input-group py-3 px-2">
                            <input type="text" class="form-control rounded shadow border-dark" name="textsearch">
                            <input type="submit" value="Seach" class="btn btn-info shadow border-dark">
                    </form>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary shadow border-dark" data-toggle="modal"
                        data-target="#AddM">
                        Add
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="AddM" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="Token.bc.php" method="POST">
                                        <lable>Token:</label>
                                            <input type="text" class="form-control my-3" name="token" required>
                                            <lable>Department:</label>
                                                <select class="form-control my-3 rounded" name="department" required>
                                                    <option value="">Select</option>
                                                    <?php include('condb.php');
                                            $sql = "SELECT * FROM notify_department";
                                            $exc = $con->query($sql);
                                            while($row = $exc->fetch_array()){
                                         ?>
                                                    <option value="<?=$row['Department']?>"><?=$row['Department']?>
                                                    </option>
                                                    <?php } ?>
                                                </select>
                                                <lable>GroupPriority:</label>
                                                    <select class="form-control my-3 rounded" name="grouppriority"
                                                        required>
                                                        <option value="">Select</option>
                                                        <option value="Hight">Hight</option>
                                                        <option value="Mid">Mid</option>
                                                        <option value="Low">Low</option>
                                                    </select>
                                                    <lable>GroupName:</lable>
                                                    <input type="text" class="form-control my-3" name="groupname"
                                                        require>
                                </div>
                                <div class="modal-footer">
                                    <input type="submit" class="btn btn-success" name="addtoken" value="Add">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-primary table-responsive table-hover">
                    <thead>
                        <tr>
                            <th width="4%">No.</th>
                            <th width="44%">Token</th>
                            <th width="4%">Department</th>
                            <th width="10%">Priority</th>
                            <th width="9%">GroupName</th>
                            <th width="10%">Edite</th>
                            <th width="11%">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                                    include('condb.php');
                                    if(isset($_GET['textsearch'])){
                                        $sqlTB = "SELECT * FROM notify_token WHERE Token LIKE '%$_GET[textsearch]%' OR 
                                        Department LIKE '%$_GET[textsearch]%' OR GroupPriority LIKE '%$_GET[textsearch]%'
                                        OR GroupName LIKE '%$_GET[textsearch]%'";
                                    }else{
                                    $sqlTB = "SELECT * FROM notify_token";
                                    }
                                    $excTB = $con->query($sqlTB);
                                    $numrowTB = $excTB->num_rows;
                                    $no=1;
                                    while($rowTB = $excTB->fetch_array()){
                                     ?>
                        <tr>
                            <td style="text-align:center" ;><?=$no?></td>
                            <td style="text-align:left" ;><?=$rowTB['Token']?></td>
                            <td style="text-align:center" ;><?=$rowTB['Department']?></td>
                            <td style="text-align:center" ;><?=$rowTB['GroupPriority']?></td>
                            <td style="text-align:center" ;><?=$rowTB['GroupName']?></td>
                            <td style="text-align:center" ;>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary border-info" data-toggle="modal"
                                    data-target="#exampleModalLong<?=$no?>">
                                    Edite
                                </button>
                                <!-- ModalEDITETOKEN -->
                                <div class="modal fade" id="exampleModalLong<?=$no?>" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Edite Token</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="EditeToken.bc.php" method="POST">
                                                <div class="modal-body">
                                                    <label>Token:</label>
                                                    <input type="text" value="<?=$rowTB['Token']?>" class="form-control"
                                                        name="token" required>
                                                    <label>Department:</label>
                                                    <select class="form-control" name="department" required>
                                                        <option value="<?=$rowTB['Department'];?>">
                                                            <?=$rowTB['Department']?></option>
                                                        <?php 
                                                include('condb.php');
                                                $sqlDP = "SELECT * FROM notify_department WHERE NOT Department='$rowTB[Department]'";
                                                $excDP = $con->query($sqlDP);
                                                while($rowDP = $excDP->fetch_array()){
                                                 ?>
                                                        <option value="<?=$rowDP['Department']?>">
                                                            <?=$rowDP['Department']?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <label>GroupPriority:</label>
                                                    <select class="form-control" name="grouppriority" required>
                                                        <option value="<?=$rowTB['GroupPriority']?>">
                                                            <?=$rowTB['GroupPriority']?></option>
                                                        <?php $PRI = array("Hight","Mid","Low");
                                                    foreach($PRI as $values){
                                                    if($values != $rowTB['GroupPriority']){?>
                                                        <option value="<?=$values?>"><?=$values?></option>
                                                        <?php }
                                                     } ?>
                                                    </select>
                                                    <leble>GroupName:</leble>
                                                    <input type="text" class="form-control my-3" name="groupname"
                                                        value="<?=$rowTB['GroupName']?>">
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="hidden" name="TEid" value="<?=$rowTB['ID']?>">
                                                    <input type="submit" value="Accept" name="Editetoken"
                                                        class="btn btn-success">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </td>
                            <td style="text-align:center" ;>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                    data-target="#Delete<?=$no?>">
                                    Delete
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="Delete<?=$no?>" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Delete Token</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Do You Want To Delete:<?=$rowTB['GroupName']?> ?
                                            </div>
                                            <div class="modal-footer">
                                                <form action="DeleteToken.bc.php" method="POST">
                                                    <input type="hidden" name="dkid" value="<?=$rowTB['ID']?>">
                                                    <input type="submit" value="Delete" class="btn btn-danger"
                                                        name="DeleteToken">
                                                </form>
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php $no++;} $con->close(); ?>
                        <?php if($numrowTB == 0){ ?>
                        <tr>
                            <td colspan="8" style="text-align:center" ;>
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
<?php include('bottom.inc.php'); ?>