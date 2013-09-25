<?php

function display_items(&$stmt) 
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
							<th>Count</th>
							<th>Add?</th>
						</tr>
						</thead>
EOT;
	while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$name = $result['name'];
		
		if(strlen($name) > 20){
			$name = substr($name, 0, 18) . "...";
		}

		$description = $result['description'];
		
		if(strlen($description) > 100){
			$description = substr($description, 0, 98) . "...";
		}

		echo <<<EOT
			<tr>
				<td>\${$result['id']}</td>
				<td>$name</td>
				<td>$description</td>
				<td>\${$result['price']}</td>
				<td><div class="col-sm-12"><input type="text" class="form-control input-sm" name="count_\${$result['id']}" value="0"></div></td>
				<td><input type="checkbox" name="count[]" value="item_\${$result['id']}" /></td>
			</tr>
EOT;
		//printf("<div class='col-md-4'>%s \$%s:<br><br>%s</div>", $result['name'], $result['price'], $result['description']);
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

	display_items($stmt);

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