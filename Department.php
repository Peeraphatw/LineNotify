<?php 
$page = "Department";
include('menu.inc.php');
if(!isset($_SESSION['Username']) || $_SESSION['Priority'] != 'Admin'){

    header("location:index.php");
}
 ?>
<div class="container">
    <div class="row">
        <div class="col-2"></div>
        <div class="col-sm-12 col-md-10 col-lg-8">
            <div class="card my-5 p-0">
                <div class="card-header text-center nav-bg text-light">
                    <h3><i class="fa fa-building-o" aria-hidden="true"></i> Department</h3>
                </div>
                <div class="card-body p-2 bg-info">
                    <form action="<?=$_SERVER['PHP_SELF']?>" method="GET">
                        <div class="input-group py-3 px-2">
                            <input type="text" class="form-control  shadow border-dark rounded" name="textsearch">
                            <input type="submit" value="Search" class="btn btn-info shadow border-dark  rounded">
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
                            <form action="department.bc.php" method="POST">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add Department</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <lable>Department</label>
                                            <input type="text" class="form-control rounded my-3" name="department">
                                    </div>
                                    <div class="modal-footer">
                                        <input type="submit" class="btn btn-success" name="adddepartment" value="Add">
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
                            <th>Department</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                    include('condb.php');
                                    if(isset($_GET['textsearch'])){
                                    $sql = "SELECT * FROM notify_department WHERE Department LIKE '%$_GET[textsearch]%';";
                                    }else{
                                    $sql = "SELECT * FROM notify_department";
                                    }
                                    $exc = $con->query($sql);
                                    $numrow = $exc->num_rows;
                                    $no=1;
                                    while($row = $exc->fetch_array()){
                                     ?>
                        <tr>
                            <td style="text-align:center" ;><?=$no?></td>
                            <td style="text-align:center" ;><?=$row['Department']?></td>
                            <td style="text-align:center" ;>
                                <form action="Delete_department.php" method="POST">
                                    <input type="hidden" value="<?= $row['ID']?>" name="Did">
                                    <input type="submit" class="btn btn-danger border-warning" value="Delete"
                                        name="DeleteDepartment">

                                </form>
                            </td>
                        </tr>
                        <?php $no++; } $con->close(); ?>
                        <?php if($numrow == 0){ ?>
                        <tr>
                            <td colspan="3" style="text-align:center" ;>
                                <div class="alert alert-danger" role="alert">
                                    NOT FOUND
                                </div>
                            </td>
                        </tr>
                        <?php }?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-2"></div>
</div>
</div>
<?php include('bottom.inc.php'); ?>