<?php
function display_items(&$stmt, &$db) 
{
	echo <<<EOT
	<div class='container'>
		<div class='row'>
			<form class="form-horizontal" role="form" action="modify_cart.php" method="post">
				<table class='table table-striped' width='400'>
					<thead>
						<tr>
							<th>ID</th>
							<th>Item</th>
							<th>Description</th>
							<th>Price</th>
							<th>Sum</th>
							<th>Count</th>
							<th>Remove</th>
						</tr>
						</thead>
EOT;
	while ($result = $stmt->fetch(PDO::FETCH_ASSOC)){
			$item_id = $result['item_id'];
			if ($stmt2 = $db->prepare("SELECT id, name, description, price FROM items WHERE id=:item_id;")) {
				$stmt2->bindParam(':item_id', $item_id, PDO::PARAM_INT);
				$stmt2->execute();

				while ($result = $stmt2	->fetch(PDO::FETCH_ASSOC)) {
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
					$count = 1; //FIXA!!
					$sum = $result['price'] * $count; //Make float!

					echo <<<EOT
						<tr>
							<td>{$result['id']}</td>
							<td$name</td>
							<td$description</td>
							<td>\${$result['price']}</td>
							<td>$sum</td>
							<td><div class="col-sm-12"><input type="text" class="form-control input-sm" name="count_\${$result['id']}" value="$count"></div></td>
							<td><button type="submit" class="btn-sm btn-danger">X</button></td>
						</tr>
EOT;
					//printf("<div class='col-md-4'>%s \$%s:<br><br>%s</div>", $result['name'], $result['price'], $result['description']);
				}
			}
		}
		echo <<<EOT
				</table>
				<div class="form-group">
					<div class="col-lg-offset-10 col-lg-10">
						<button type="submit" class="btn-lg btn-success">Update</button>
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
		display_items($stmt, $db);
	}
} else {
	echo "Error, no user available";
}



?>