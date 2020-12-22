<?php 
$page ="User";
include('menu.inc.php');
if(!isset($_SESSION['Username']) || $_SESSION['Priority'] != 'Admin'){

    header("location:index.php");
}
 ?>
<div class="container">
    <div class="row">
        <div class="col-md-2 col-lg-1"></div>
        <div class="col-sm-12 col-md-10 col-lg-10">
            <div class="card my-5 p-0">
                <div class="card-header text-center nav-bg text-light">
                    <h3><i class="fa fa-user-o" aria-hidden="true"></i> User</h3>
                </div>
                <div class="card-body p-2 bg-info">
                    <form action="<?=$_SERVER['PHP_SELF']?>" method="GET">
                        <div class="input-group py-3 px-2">
                            <input type="text" class="form-control  shadow border-dark rounded" name="textsearch">
                            <input type="submit" value="Seach" class="btn btn-info shadow border-dark w-25 rounded">
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
                            <form action="user.bc.php" method="POST">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <lable>Institution:</lable>
                                        <select class="form-control my-3" name="institution" required>
                                            <option value="">Select</option>
                                            <option value="EPG">EPG</option>
                                            <option value="ARKR">ARKR</option>
                                        </select>
                                        <lable>Username:</label>
                                            <input type="text" name="username" class="form-control my-3" required>
                                            <lable>Password:</label>
                                                <input type="text" name="password" class="form-control my-3" required>
                                                <lable>Department</label>
                                                    <select class="form-control my-3" name="department" required>
                                                        <option value="">Select</option>
                                                        <?php 
                                            include('condb.php');
                                            $sql = "SELECT * FROM notify_department";
                                            $exc = $con->query($sql);
                                            while($row = $exc->fetch_array()){
                                        ?>
                                                        <option value="<?=$row['Department']?>"><?=$row['Department']?>
                                                        </option>
                                                        <?php } $con->close(); ?>
                                                    </select>
                                                    <lable>Priority</label>
                                                        <select class="form-control my-3" name="priority" required>
                                                            <option value="">Select</option>
                                                            <option value="Admin">Admin</option>
                                                            <option value="Hight">Hight</option>
                                                            <option value="Mid">Mid</option>
                                                            <option value="Low">Low</option>
                                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="submit" value="Add" name="adduser" class="btn btn-success">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
                <table class="table table-bordered table-primary table-responsive table-hover" id="dtBasicExample">
                    <thead>
                        <tr>
                            <th width="5%">No.</th>
                            <th>Institution</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Department</th>
                            <th>Priority</th>
                            <th>Edite</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                include('condb.php');
                                if(isset($_GET['textsearch'])){
                                    $sqlTB = "SELECT * FROM notify_user WHERE Institution LIKE '%$_GET[textsearch]%' OR 
                                    Username LIKE '%$_GET[textsearch]%' OR Department LIKE '%$_GET[textsearch]%'
                                    OR Priority LIKE '%$_GET[textsearch]%'";
                                }else{
                                    $sqlTB = "SELECT * FROM notify_user";
                                }
                                $excTB = $con->query($sqlTB);
                                $numrowTB = $excTB->num_rows;
                                $no=1;
                                while($rowTB = $excTB->fetch_array()){
                                 ?>
                        <tr>
                            <td style="text-align:center" ;><?=$no?></td>
                            <td><?=$rowTB['Institution']?></td>
                            <td><?=$rowTB['Username']?></td>
                            <td><?=$rowTB['Password']?></td>
                            <td style="text-align:center" ;><?=$rowTB['Department']?></td>
                            <td style="text-align:center" ;><?=$rowTB['Priority']?></td>
                            <td style="text-align:center" ;>
                                <!-- model Euser -->
                                <button type="button" class="btn btn-primary border-light" data-toggle="modal"
                                    data-target="#ModalEdite<?=$no?>">
                                    Edite
                                </button>
                                <!-- model EditeUser -->
                                <div class="modal fade" id="ModalEdite<?=$no?>" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <form action="EditeUser.bc.php" method="POST">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edite User</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <lable>institution:</lable>
                                                    <select class="form-control my-3" name="institution" required>
                                                        <option value="<?=$rowTB['Institution']?>">
                                                            <?=$rowTB['Institution']?></option>
                                                        <?php if($rowTB['Institution'] == 'ARKR'){?><option value="EPG">
                                                            EPG</option>> <?php }else{ ?>
                                                        <option value="ARKR">ARKR</option><?php } ?>
                                                    </select>
                                                    <lable>Username:</label>
                                                        <input type="text" name="username" class="form-control my-3"
                                                            required value="<?=$rowTB['Username']?>">
                                                        <lable>Password:</label>
                                                            <input type="text" name="password" class="form-control my-3"
                                                                required value="<?=$rowTB['Password']?>">
                                                            <lable>Department</label>
                                                                <select class="form-control my-3" name="department"
                                                                    required>
                                                                    <option value="<?=$rowTB['Department']?>">
                                                                        <?=$rowTB['Department']?></option>
                                                                    <?php 
                                                 include('condb.php');
                                                
                                                $sql = "SELECT * FROM notify_department WHERE NOT Department='$rowTB[Department]'";
                                                $exc = $con->query($sql);
                                                while($row = $exc->fetch_array()){
                                                 ?>
                                                                    <option value="<?=$row['Department']?>">
                                                                        <?=$row['Department']?></option>
                                                                    <?php }  ?>
                                                                </select>
                                                                <lable>Priority</label>
                                                                    <select class="form-control my-3" name="priority"
                                                                        required>
                                                                        <option value="<?=$rowTB['Priority']?>">
                                                                            <?=$rowTB['Priority']?></option>
                                                                        <?php $PRI = array("Admin","Hight","Mid","Low");
                                                    foreach($PRI as $values){
                                                    if($values != $rowTB['Priority']){?>
                                                                        <option value="<?=$values?>"><?=$values?>
                                                                        </option>
                                                                        <?php }
                                                     } ?>
                                                                    </select>
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="hidden" value="<?=$rowTB['ID']?>" name="Eid">
                                                    <input type="submit" name="EditeUser" class="btn btn-success"
                                                        value="Accept">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <!-- // -->
                            </td>
                            <td style="text-align:center" ;>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                    data-target="#exampleModalLong<?=$no?>">
                                    Delete
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModalLong<?=$no?>" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Delete User</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Do you Want To Delete: <?=$rowTB['Username']?> ?
                                            </div>
                                            <div class="modal-footer">
                                                <form action="DeleteUser.bc.php" method="POST">
                                                    <input type="hidden" name="Did" value="<?=$rowTB['ID']?>">
                                                    <input type="submit" value="Delete" class="btn btn-danger"
                                                        name="DeleteUser">
                                                </form>
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">No</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php $no++; }  ?>
                        <?php if($numrowTB == 0){ ?>
                        <tr>
                            <td colspan="8" style="text-align:center" ;>
                                <div class="alert alert-danger" role="alert">
                                    NOT FOUND
                                </div>
                            </td>
                        </tr>
                        <?php  } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-2 col-lg-1"></div>
</div>
</div>
<?php include('bottom.inc.php'); ?>