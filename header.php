
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

		<!-- Custom styles for this template -->
		<!-- <link href="jumbotron.css" rel="stylesheet"> -->

		<style type="text/css">
			/*
			 * Style twaks
			 * --------------------------------------------------
			 */
			body {
				padding-top: 70px;
			}
			footer {
				padding-left: 15px;
				padding-right: 15px;
			}

			/*
			 * Off Canvas
			 * --------------------------------------------------
			 */
			@media screen and (max-width: 768px) {
				.row-offcanvas {
					position: relative;
					-webkit-transition: all 0.25s ease-out;
					-moz-transition: all 0.25s ease-out;
					transition: all 0.25s ease-out;
				}

				.row-offcanvas-right
				.sidebar-offcanvas {
					right: -50%; /* 6 columns */
				}

				.row-offcanvas-left
				.sidebar-offcanvas {
					left: -50%; /* 6 columns */
				}

				.row-offcanvas-right.active {
					right: 50%; /* 6 columns */
				}

				.row-offcanvas-left.active {
					left: 50%; /* 6 columns */
				}

				.sidebar-offcanvas {
					position: absolute;
					top: 0;
					width: 50%; /* 6 columns */
				}
			}
		</style>

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
					<a class="navbar-brand" href="#">EITF05: SWS</a>
				</div>

				<div class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<li class="active"><a href="shop.php">1. Shop</a></li>
						<li><a href="cart.php">2. Cart</a></li>
						<li><a href="checkout.php">3. Checkout</a></li>
						<li><a href="signup.php" style="padding: 10px 0 0 0 ;"><button type="submit" class="btn-sm btn-primary">Sign Up</button></a><li>
					</ul>

					<form class="navbar-form navbar-right" action="login.php" method="post">
						<div class="form-group">
							<input type="text" placeholder="Email" class="form-control">
						</div>

						<div class="form-group">
							<input type="password" placeholder="Password" class="form-control">
						</div>

						<button type="submit" class="btn btn-success">Sign in</button>
					</form>

					<ul class="nav navbar-nav">
						
					</ul>
					
				</div><!--/.navbar-collapse -->

			</div>

		</div>