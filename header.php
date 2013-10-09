<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="shortcut icon" href="../../assets/ico/favicon.png">

		<title>EITF05: Secure Web Shop</title>

		<!-- Bootstrap core CSS -->
		<link href="dist/css/bootstrap.css" rel="stylesheet">
		<link href="assets/css/custom.css" rel="stylesheet">

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
	</head>

	<body>
		<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="shop.php">EITF05: SWS</a>
				</div>

				<div class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
					<?php
						$active_shop = "";
						$active_cart = "";
						$active_checkout = "";
						if(isset($_SESSION['site'])){
							switch ($_SESSION['site']) {
								case 'shop':
									$active_shop = " class=\"active\"";
									break;
								case 'cart':
									$active_cart = " class=\"active\"";
									break;
								case 'checkout':
									$active_checkout = " class=\"active\"";
							}
						}else{
							$active_shop = " class=\"active\"";
						}

						echo "<li$active_shop><a href='shop.php'>1. Shop</a></li>";
						 
							if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) { 
								echo "<li$active_cart><a href='cart.php'>2. Cart</a></li>";
								echo "<li$active_checkout><a href='checkout.php'>3. Checkout</a></li>";
							}
					?>
						<li><a href="signup.php" style="padding: 10px 0 0 0 ;"><button type="submit" class="btn-sm btn-primary">Sign Up</button></a><li>
					</ul>

					<?php 
								/* Check if there has been any activity within the last 15 minutes, if not, logout */
							if (isset($_SESSION['timeout'])) {
								if ($_SESSION['timeout'] + 900 < time()) {
									header('Location: logout.php', true, 302);
									exit();
								} else {
									$_SESSION['timeout'] = time();
								}
							}
							if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {

								$username = $_SESSION['username'];
								echo <<<EOT
					
					<form class="navbar-form navbar-right" action="logout.php" method="post">
						<button type="submit" class="btn btn-error">Logout</button>
					</form>
					<div class="navbar-right"><h4><p style="color:white">$username</p></h4></div>
EOT;
							} else {
								echo <<<EOT
					<form class="navbar-form navbar-right" action="login.php" method="post">
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon" style="width:auto;">@</span>
								<input type="text" name="email" placeholder="Email" class="form-control">
							</div>
						</div>

						<div class="form-group">
							<input type="password" name="password" placeholder="Password" class="form-control">
						</div>

						<button type="submit" class="btn btn-success">Sign in</button>
					</form>
EOT;
							}
						?>					
				</div><!--/.navbar-collapse -->

			</div>

		</div>