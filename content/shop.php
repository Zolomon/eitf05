<?php

$loggedin = isset($_SESSION['loggedin']) && $_SESSION['loggedin'];

function display_items(&$stmt, $loggedin, $shop_page_items) 
{
	$extraFields = "";

	if ($loggedin) {
		$extraFields = <<<EOT
							<th>Count</th>
							<th>Add?</th>
EOT;
	}

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
							$extraFields
						</tr>
						</thead>
EOT;
	$items = array();
	$idx = 0;
	$id = 0;

	while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$name = htmlspecialchars($result['name']); // protect against XSS
		
		if(strlen($name) > 20){
			$name = substr($name, 0, 18) . "..."; // protect against XSS
		}

		$description = htmlspecialchars($result['description']);
		
		if(strlen($description) > 100){
			$description = substr($description, 0, 98) . "..."; // protect against XSS
		}

		$id = $result['id'];

		$extraFields = "";
		if ($loggedin) {
			$extraFields = <<<EOT
				<td><div class="col-sm-12"><input type="text" class="form-control input-sm" name="count[$idx]" value="0"></div></td>
				<td><input type="checkbox" name="add[$idx]" value="$id" /></td>
EOT;
		}

		echo <<<EOT
			<tr>
				<td>$id</td>
				<td>$name</td>
				<td>$description</td>
				<td>\$ {$result['price']}</td>
				$extraFields
			</tr>
EOT;
		//printf("<div class='col-md-4'>%s \$%s:<br><br>%s</div>", $result['name'], $result['price'], $result['description']);

		$items[$idx++] = $id;
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

/*
function UpdateCurrPageNbr(){
	
}
*/

if ($stmt = $db->prepare("SELECT id, name, description, price FROM items LIMIT :shop_page_items, 15;")) {
	
	/* bind parameters for markers */
	$shop_page = 1;
	$shop_page_items = ($shop_page-1)*15;
	$stmt->bindParam(':shop_page_items', $shop_page_items, PDO::PARAM_INT);

	 /* execute query */
	$stmt->execute();

	display_items($stmt, $loggedin, $shop_page_items);

	//echo "true";
} else {
	echo "false";
}
?>

<form role="form" action="additem.php" method="post">
  <div class="form-group">
	<label for="item_name" class="col-md-1 control-label">Item name:</label>
	<div class="col-md-2">
		<input type="text" class="form-control" id="item_name" name="item_name">
	</div>
  </div>
  <div class="form-group">
	<label for="item_desc" class="col-md-1 control-label">Item description</label>
	<div class="col-md-2">
		<input type="text" class="form-control" id="item_desc" name="item_desc">
	</div>
  </div>
  <div class="form-group">
	<label for="item_price" class="col-md-1 control-label">Item price:</label>
	<div class="col-md-2">
		<input type="text" class="form-control" id="item_price" name="item_price">
	</div>
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>