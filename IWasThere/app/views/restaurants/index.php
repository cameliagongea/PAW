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

    <title>I Was There</title>

    <!-- Bootstrap Core CSS -->
    <link href="../../../public/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../../public/css/iwastheremanagement.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../../../public/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
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
</body>

    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li><a href="http://127.0.0.1:122/IWasThere/public/home/index/">Home</a>
                    </li>
                    <li class="active">Restaurants</li>
                    <div class="pull-right">
                        <i class="fa fa-fw fa-plus" data-toggle="modal" data-target="#add_new_record_modal"></i>

                    </div>
                </ol>

                <input type="text" id="search_restaurantName" placeholder="Search restaurant" onkeyup="readRestaurants()"  style="margin-bottom: 20px;margin-left: 966px"/>
                <div class="records_content"></div>
        </div>
    </div>
    </div>
<div class="modal fade" id="add_new_record_modal" tabindex="1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Restaurant</h4>
            </div>
            <div id ="error_div">
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="restaurantName">Restaurant Name</label>
                    <input type="text" id="restaurantName" placeholder="Restaurant Name" class="form-control" />
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" id="description" placeholder="Description" class="form-control" />
                </div>

                <div class="form-group">
                    <label for="rating">Rating</label>
                    <input type="text" id="rating" placeholder="Rating" class="form-control" />
                </div>

                <div class="form-group">
                    <label for="link">Link</label>
                    <input type="text" id="link" placeholder="Link" class="form-control" />
                </div>

                <div class="form-group">
                    <label>File: </label>
                    <input type="file" name="image" id="image" />
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="addRestaurant()">Add Restaurant</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="update_restaurant_modal" tabindex="1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Update</h4>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="update_restaurantName">Restaurant Name</label>
                    <input type="text" id="update_restaurantName" placeholder="Restaurant Name" class="form-control"/>
                </div>

                <div class="form-group">
                    <label for="update_category">Description</label>
                    <input type="text" id="update_category" placeholder="Description" class="form-control"/>
                </div>

                <div class="form-group">
                    <label for="update_rating"> Rating </label>
                    <input type="text" id="update_rating" placeholder="Rating" class="form-control" />
                </div>

                <div class="form-group">
                    <label for="update_link"> Link </label>
                    <input type="text" id="update_link" placeholder="Link" class="form-control" />
                </div>

            </div>
            <div id = "error-message"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="UpdateRestaurantDetails()">Save Changes</button>
                <input type="hidden" id="hidden_restaurant_id">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="restaurants_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Restaurants</h4>
            </div>
            <div class="modal-body">
                <div class="restaurants_content"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="addRestaurant()">Add Restaurant</button>
            </div>
        </div>
    </div>
</div>
</div>

    <!-- jQuery -->
    <script src="../../../public/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../../public/js/bootstrap.min.js"></script>
    <script src="../../../public/js/restaurants.js"></script>
    <script>

    </script>

</body>

</html>
