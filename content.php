<?php 

if (!isset($_SESSION['site'])) {
	$_SESSION['site'] = 'shop';
} else {
	switch ($_SESSION['site']) {
		case 'index':
			include 'content/shop.php';
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

		case 'receipt':
			include 'content/receipt.php';
			break;

		default:
			include 'content/shop.php';
			break;
	}
}

?>

	<hr>