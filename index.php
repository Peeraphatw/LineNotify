<?php 
$page = "Home";
include('menu.inc.php'); 
?>
<div class="container">
    <div class="row">
        <div class="col-4"></div>
        <div class="col-sm-12 col-lg-4">
            <div class="card my-5 text-center shadow">
                <div class="card-header nav-bg text-light">
                    <h4><i class="fa fa-sign-in" aria-hidden="true"></i> Login</h4>
                </div>
                <div class="card-body bg-info">
                    <?php if(!isset($_SESSION['Username'])){ ?>
                    <form action="log.bc.php" method="POST">
                        <h6 class="card-title">Username</h6>
                        <input type="text" class="form-control mb-3" name="Username" autocomplete="off">
                        <h6 class="card-title">Password</h6>
                        <input type="password" class="form-control mb-3" name="Password">
                        <input type="submit" name="login" value="Login" class="btn btn-success border-light text-light">
                    </form>
                    <?php }else{ ?>
                    <h3 class="card-title pt-3 my-2"><?=$_SESSION['Institution']."-".$_SESSION['Username']?></h3>

                    <!-- <h4><a href="logout.php" class="text-decoration-none text-light">Logout</a></h4> -->
                    <h4 class="text-light">Welcome to Line Notify Schedule<h4>


                            <?php } ?>
                </div>
            </div>
        </div>
        <div class="col-4"></div>
    </div>
</div>
<?php include('bottom.inc.php');?>