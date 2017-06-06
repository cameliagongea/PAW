<?php
session_start();
var_dump($_SESSION);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Request - I Was There </title>

    <!-- Bootstrap Core CSS -->
    <link href="../../../public/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../../public/css/iwastheremanagement.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">

</head>

<body>

<div class="brand"> I Was There </div>

<!-- Navigation -->
<nav class="navbar navbar-default" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- navbar-brand is hidden on larger screens, but visible when the menu is collapsed -->
            <a class="navbar-brand" href="http://127.0.0.1:122/IWasThere/public/home/index/">I Was There</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            </li>
            <ul class="nav navbar-nav">
                <li>
                    <a href="http://127.0.0.1:122/IWasThere/public/home/index/">Home</a>
                </li>
                <li>
                    <a href="http://127.0.0.1:122/IWasThere/public/about/index/">About</a>
                </li>
                <li>
                    <a href="http://127.0.0.1:122/IWasThere/public/restaurants/index/">List of Restaurants</a>
                <li>
                    <a href="http://127.0.0.1:122/IWasThere/public/requests/index/">Request</a>
                </li>
                <?php
                if($_SESSION['email'] != NULL)
                    echo '<li>
                                         <a href="http://127.0.0.1:122/IWasThere/public/login/logout/">Logout</a>
                           </li>';
                ?>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>

<!-- /.container -->

<div class="row">
    <div class="box">
        <div class="col-lg-12">
            <hr>
            <h2 class="intro-text text-center"><strong>Login</strong></h2>
            <hr>
            <?php
            if($_SESSION['email'] != NULL)
                echo '<strong>You are already logged in</strong>';
            else
                echo '
                <form role="form" method="post" action="" accept-charset="UTF-8">
                <div class="row">
                    <div class="form-group row-lg-4">
                        <label style=" width: 426px; padding-left: 10px; margin-left: 5px;">Email Address</label>
                        <input type="text" placeholder="Email" id="loginEmail" name="loginEmail" class="form-control" style=" width: 426px; padding-left: 20px; margin-left: 10px;">
                    </div>
                    <div class="form-group row-lg-4">
                        <label style=" width: 426px; padding-left: 10px; margin-left: 5px;">Password</label>
                        <input type="password" placeholder="Password" id="loginPassword" name="loginPassword" class="form-control" style=" width: 426px; padding-left: 20px; margin-left: 10px;">
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group col-lg-12">
                        <input type="hidden" name="Login" value="contact">
                        <button type="submit" name="submit" id="sign-in" value="Login" class="btn btn-default">Login</button>
                    </div>
                </div>
            </form>';
            ?>
        </div>
    </div>
</div>

</div>
<!-- /.container -->
<!-- jQuery -->
<script src="../../../public/js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../../../public/js/bootstrap.min.js"></script>

</body>

</html>
