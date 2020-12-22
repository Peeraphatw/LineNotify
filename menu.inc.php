<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <link rel="shortcut icon" type="imge/png" href="img/aeroklas-logo.png"> -->
    <title><?=$page?></title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="node_modules/font-awesome/css/font-awesome.min.css">


</head>
<style>
@import url('https://fonts.googleapis.com/css?family=Roboto+Mono&display=swap');

html,
body {
    background-image: url('img/BG.png');
    font-family: 'Roboto Mono', monospace;
}

.nav-bg {
    background-color: #010b29;
}

.table-aero {
    background-color: #192857;
}

td {
    word-break: break-all;
}


.text-kmutnb {
    color: orange;
}
</style>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark nav-bg navbar-fixed-top sticky-top text-dark">
        <a class="navbar-brand" href="#">
            <img src="img/aeroklas-logo.png" width="130" height="30" class="d-inline-block align-top" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="./">Home</a>
                </li>
                <?php if(isset($_SESSION['Username'])){ ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        NotifySubscribe
                    </a>
                    <div class="dropdown-menu bg-info" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="NotifyDaily.php">Notify Daily</a>
                        <a class="dropdown-item" href="NotifyWeekly.php">Notify Weekly</a>
                        <a class="dropdown-item" href="NotifyMonthly.php">Notify Monthly</a>
                    </div>
                </li>
                <?php } ?>
                <?php if(isset($_SESSION['Username']) && ($_SESSION['Priority'] == 'Hight' || $_SESSION['Priority'] == 'Admin' )){ ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Managment
                    </a>
                    <div class="dropdown-menu bg-info" aria-labelledby="navbarDropdownMenuLink">
                        <?php if($_SESSION['Priority'] == 'Admin'){ ?>
                        <a class="dropdown-item" href="User.php">User</a>
                        <a class="dropdown-item" href="Token.php">Token</a>
                        <a class="dropdown-item" href="Department.php">Department</a>
                        <?php } ?>
                        <?php if($_SESSION['Priority'] == 'Hight'){?>
                        <a class="dropdown-item" href="notify_approve.daily.php">ApproveDaily</a>
                        <a class="dropdown-item" href="notify_approve.weekly.php">ApproveWeekly</a>
                        <a class="dropdown-item" href="notify_approve.monthly.php">ApproveMonthly</a>
                        <?php } ?>
                    </div>
                </li>
                <?php } ?>
            </ul>
        </div>
        <?php if(isset($_SESSION['Username'])){ ?>
        <div class="navbar-collapse collapse  order-3 dual-collapse2">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item text-light">
                    <i class="fa fa-user-o" aria-hidden="true"></i>
                    <?=$_SESSION['Institution']."-".$_SESSION['Username']?>
                </li>

                <a class="mx-3 text-decoration-none text-light" href="logout.php">Logout</a>

            </ul>

        </div>
        <?php } ?>
    </nav>