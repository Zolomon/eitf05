<?php
function display_items(&$stmt, &$db, $user_id) 
{
	echo <<<EOT
	<div class='container'>
		<div class='row'>
			<form class="form-horizontal" role="form" action="pay.php" method="post">
				<table class='table table-striped' width='400'>
					<thead>
						<tr>
							<th>ID</th>
							<th>Item</th>
							<th>Description</th>
							<th>Price</th>
							<th>Sum</th>
							<th>Count</th>
						</tr>
					</thead>
EOT;
	$before_update = array();
	//$already_in_list = array();
	$total_sum = 0;
	while ($result = $stmt->fetch(PDO::FETCH_ASSOC)){
			$item_id = $result['item_id'];
			if ($stmt2 = $db->prepare("SELECT id, name, description, price FROM items WHERE id=:item_id;")) {
				$stmt2->bindParam(':item_id', $item_id, PDO::PARAM_INT);
				$stmt2->execute();

				if (!array_key_exists($item_id, $before_update)){
					//$already_in_list[$item_id] = 1;
					$count_s = $db->prepare("SELECT COUNT(id) AS count FROM cart WHERE item_id=:item_id AND user_id=:user_id;");
					$count_s->bindParam(':item_id', $item_id, PDO::PARAM_INT);
					$count_s->bindParam(':user_id', $user_id, PDO::PARAM_INT);
					$count_s->execute();
					$cres = $count_s->fetch(PDO::FETCH_ASSOC);
					$count = $cres['count'];
					$before_update[$item_id] = $count;
					while ($result = $stmt2->fetch(PDO::FETCH_ASSOC)) {
						$name = htmlspecialchars($result['name']); // protect against XSS
						
						if(strlen($name) > 30){
							$name = " title=\"" . $name . "\">" . substr($name, 0, 28) . "..."; // protect against XSS
						} else {
							$name = ">" . $name;
						}

						$description = htmlspecialchars($result['description']);
						
						if(strlen($description) > 100){
							$description = " title=\"" . $description . "\">" . substr($description, 0, 98) . "..."; // protect against XSS
						} else {
							$description = ">" . $description;
						}

								//<td><div class="col-sm-12"><input type="text" class="form-control input-sm" name="count_\${$result['id']}" value="1"></div></td>
								//<td><input type="checkbox" name="count[]" value="item_\${$result['id']}" /></td>
						$sum = $result['price'] * $count;
						$total_sum = $total_sum + $sum;
						$sum = number_format((float)$sum, 2, '.', '');
						echo <<<EOT
							<tr>
								<td>{$result['id']}</td>
								<td$name</td>
								<td$description</td>
								<td>\${$result['price']}</td>
								<td>\$$sum</td>
								<td>$count</td>
							</tr>
EOT;
						//printf("<div class='col-md-4'>%s \$%s:<br><br>%s</div>", $result['name'], $result['price'], $result['description']);
					}
				}
			}
		}
		$_SESSION['before_update'] = $before_update;
		$total_sum = number_format((float)$total_sum, 2, '.', '');

		$stmt = $db->prepare("SELECT firstname, surname, homeaddress, zipcode, city, country FROM users WHERE id=:user_id");
		$stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
		$stmt->execute();
		$result = $stmt->fetch();

		$email = $_SESSION['username'];
		$firstname = $result["firstname"];
		$surname = $result["surname"];
		$homeaddress = $result["homeaddress"];
		$zipcode = $result["zipcode"];
		$city = $result["city"];
		$country = $result["country"];
		echo <<<EOT
					<tfoot>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<th>Total:</th>
							<th>\$$total_sum</th>
							<td></td>
						</tr>
					</tfoot>
				</table>
				<div class="container">
				  <p><strong><h4>Delivery address</h4></strong></p>
				  <div class="form-group" style="max-width: 600px;">
				    <label for="inputEmail1" class="col-lg-2 control-label">Email</label>
				    <div class="col-lg-10">
				      <input type="email" class="form-control" id="inputEmail1" value="$email">
				    </div>
				  </div>
				  <div class="form-group" style="max-width: 600px;">
				    <label for="inputFirst" class="col-lg-2 control-label">First name</label>
				    <div class="col-lg-10">
				      <input type="text" class="form-control" id="inputFirst" value="$firstname">
				    </div>
				  </div>
				  <div class="form-group" style="max-width: 600px;">
				    <label for="inputSur" class="col-lg-2 control-label">Sur name</label>
				    <div class="col-lg-10">
				      <input type="text" class="form-control" id="inputSur" value="$surname">
				    </div>
				  </div>
				  <div class="form-group" style="max-width: 600px;">
				    <label for="inputStreet" class="col-lg-2 control-label">Street address</label>
				    <div class="col-lg-10">
				      <input type="text" class="form-control" id="inputStreet" value="$homeaddress">
				    </div>
				  </div>
				  <div class="form-group" style="max-width: 600px;">
				    <label for="inputZip" class="col-lg-2 control-label">Zipcode</label>
				    <div class="col-lg-10">
				      <input type="text" class="form-control" id="inputZip" value="$zipcode">
				    </div>
				  </div>
				  <div class="form-group" style="max-width: 600px;">
				    <label for="inputCity" class="col-lg-2 control-label">City</label>
				    <div class="col-lg-10">
				      <input type="text" class="form-control" id="inputCity" value="$city">
				    </div>
				  </div>
				  <div class="form-group" style="max-width: 600px;">
				    <label for="inputCountry" class="col-lg-2 control-label">Country</label>
				    <div class="col-lg-10">
				      <input type="text" class="form-control" id="inputCountry" value="$country">
				    </div>
				  </div>
  				</div>
				<div class="container"><br>
					<p><strong><h4>Payment method</h4></strong></p>
					<div class="radio">
						<label>
							<input type="radio" name="optionsRadios" id="optionsRadios1" value="card" checked>
					    	Credit card
						</label>
					</div>
					<div class="radio">
						<label>
					    	<input type="radio" name="optionsRadios" id="optionsRadios2" value="bill">
					    	Bill
					  	</label>
					</div>
					<div class="radio">
						<label>
					    	<input type="radio" name="optionsRadios" id="optionsRadios3" value="bank">
					    	Online bank
					  	</label>
					</div>
					<div class="form-group">
						<div class="col-lg-offset-10 col-lg-10">
							<button type="submit" class="btn-lg btn-success">Pay</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
EOT;

}



if (isset($_SESSION['user'])){
	$user_id = $_SESSION['user'];
	if ($stmt = $db->prepare("SELECT item_id FROM cart WHERE user_id=:user_id;")){
		$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
		$stmt->execute();
		display_items($stmt, $db, $user_id);
	}
} else {
	echo "Error, no user available";
}

?>