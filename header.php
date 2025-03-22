<?php session_start(); ?>  <!-- Start the session -->

<!DOCTYPE php>
<php lang="en">
  <head>
    <title>Pizza Shop</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nothing+You+Could+Do" rel="stylesheet">

    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/ionicons.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">

    
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
  	<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
		      <a class="navbar-brand" href="index.php"><span class="flaticon-pizza-1 mr-1"></span>Pizza<br><small>Delicous</small></a>
		      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
		        <span class="oi oi-menu"></span> Menu
		      </button>
	      <div class="collapse navbar-collapse" id="ftco-nav">
				<ul class="navbar-nav ml-auto align-items-center">
    <li class="nav-item active">
        <a href="index.php" class="nav-link">Home</a>
    </li>
    <li class="nav-item">
        <a href="menu.php" class="nav-link">Menu</a>
    </li>
    <li class="nav-item">
        <a href="services.php" class="nav-link">Services</a>
    </li>
    <li class="nav-item">
        <a href="blog.php" class="nav-link">Blog</a>
    </li>
    <li class="nav-item">
        <a href="about.php" class="nav-link">About</a>
    </li>
    <li class="nav-item">
        <a href="contact.php" class="nav-link">Contact</a>
    </li>

  <!-- Show buttons only when user is logged in -->
<?php if (isset($_SESSION['user_id'])) { ?>
    <li class="nav-item">
        <a href="user_orders.php" class="nav-link btn btn-primary btn-sm text-white ms-2 px-2 mr-1">View Orders</a>
    </li>
    <li class="nav-item">
        <a href="logout.php" class="nav-link btn btn-danger btn-sm text-white ms-2 px-2">Logout</a>
    </li>
<?php } else { ?>
    <!-- Show Login button when not logged in -->
    <li class="nav-item">
        <a href="login.php" class="nav-link btn btn-success btn-sm text-white ms-2 px-3">Login</a>
    </li>
<?php } ?>
</ul>

	      </div>
		  </div>
	  </nav>
    <!-- END nav -->