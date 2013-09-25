<?php 

if (!isset($_SESSION['site'])) {
	$_SESSION['site'] = 'index';
} else {
	switch ($_SESSION['site']) {
		case 'index':
			include 'content/index.php';
			break;

		case 'signup':
			include 'content/signup.php';
			break;

		case 'shop':
			include 'content/shop.php';
			break;

		case 'cart':
			include 'content/cart.php';
			break;

		case 'checkout':
			include 'content/checkout.php';
			break;

		default:
			include 'content/index.php';
			break;
	}
}

?>

	<hr>