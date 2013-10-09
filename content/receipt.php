<?php
$total = 0;
echo <<<EOT
<div class="container">
EOT;
if (isset($_SESSION['before_update']) && (count($_SESSION['before_update']) > 0)) {
	$items = $_SESSION['before_update'];
	echo <<<EOT
		<h4>Thank you for purchasing!</h4><br>	
		<p>You have bought:</p>
		<table width="60%">
			<thead>
				<th>Name</th>
				<th>Amount</th>
				<th>Price</th>
				<th>Sum</th>
			</thead>
EOT;
	foreach ($items as $item_id => $amount) {
		if ($stmt = $db->prepare("SELECT name, price FROM items WHERE id=:item_id;")) {
			$stmt->bindParam(':item_id', $item_id, PDO::PARAM_INT);
			$stmt->execute();
			$res = $stmt->fetch();
			$sum = number_format((float)$res['price']*$amount, 2, '.', '');
			$total = number_format($total + $sum, 2, '.', '');
			echo <<<EOT
				<tr>
					<td>{$res['name']}</td>
					<td>$amount</td>
					<td>\${$res['price']}</td>
					<td>\$$sum</td>
				</tr>
EOT;
			
		}

	}
	echo <<<EOT
		<tr><td></td></tr>
		<tr>
			<td><strong>Total:</strong></td>
			<td></td>
			<td></td>
			<td><strong>\$$total<strong></td>
		</tr>
	</table>
	<br><p>Your items will be shipped to:
	<table>
		<tr><td>{$_SESSION['inputFirst']} {$_SESSION['inputSur']}</td></tr>
		<tr><td>{$_SESSION['inputStreet']}</td></tr>
		<tr><td>{$_SESSION['inputZip']} {$_SESSION['inputCity']}</td></tr>
		<tr><td>{$_SESSION['inputCountry']}</td></tr>
	</table>
	<br><p>A copy of this receipt has been sent to <strong>{$_SESSION['username']}</strong></p></br>
EOT;
} else {
	echo <<<EOT
	<p><h4>Something went wrong!</h4></p>
EOT;
}
echo <<<EOT
</div>
EOT;
?>