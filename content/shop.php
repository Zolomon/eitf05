<?php

$loggedin = isset($_SESSION['loggedin']) && $_SESSION['loggedin'];
function display_pagination($shop_page, $nbr_pages) 
{
	echo <<<EOT
	<div class='container'>
			<div class='row' align="center">
				<ul class="pagination">
EOT;
	if ($shop_page == 1) {
		echo "<li class='disabled'><span>&laquo;</span></li>";
	} else {
		$next_page = $shop_page - 1;
		if ($next_page == 1) {
			echo "<li><a href='index.php'>&laquo;</a></li>";
		} else {
			echo "<li><a href='index.php?page_nbr=$next_page'>&laquo;</a></li>";
		}
	}
	if($shop_page == 1){
		echo "<li class='active'><a href='index.php'>1</a></li>";
	} else {
		echo "<li><a href='index.php'>1</a></li>";
	}
	for ($pindex = 2; $pindex <= $nbr_pages; $pindex++) {
		if ($shop_page == $pindex){
			echo "<li class='active'><a href='index.php?page_nbr=$pindex'>$pindex</a></li>";
		} else {
			echo "<li><a href='index.php?page_nbr=$pindex'>$pindex</a></li>";
		}
	}
	if ($shop_page == $nbr_pages){
		echo "<li class='disabled'><span>&raquo;</span></li>";
	}else{
		$next_page = $shop_page + 1;
		echo "<li><a href='index.php?page_nbr=$next_page'>&raquo;</a></li>";
	}
	echo <<<EOT
			</ul>
		</div>
	</div>
EOT;
}

function display_items(&$stmt, $loggedin) 
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
	while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
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

		$extraFields = "";
		if ($loggedin) {
			$extraFields = <<<EOT
				<td><div class="col-sm-12"><input type="text" class="form-control input-sm" name="count_\${$result['id']}" value="1"></div></td>
				<td><input type="checkbox" name="count[]" value="item_\${$result['id']}" /></td>
EOT;
		}

		echo <<<EOT
			<tr>
				<td>{$result['id']}</td>
				<td$name</td>
				<td$description</td>
				<td>\${$result['price']}</td>
				$extraFields
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

/* Get the current page number */
if (isset($_GET["page_nbr"])){
	$shop_page = $_GET["page_nbr"];
} else {
	$shop_page = 1;
}

/* Make the list of items */
if ($stmt = $db->prepare("SELECT id, name, description, price FROM items LIMIT :shop_page_items, 15;")) {
	/* bind parameters for markers */
	$shop_page_items = ($shop_page-1)*15;
	$stmt->bindParam(':shop_page_items', $shop_page_items, PDO::PARAM_INT);

	/* execute query */
	$stmt->execute();

	display_items($stmt, $loggedin);
} else {
	echo "Database error when getting items";
}

/* Make the pagination at the bottom */
if ($counter = $db->prepare("SELECT COUNT(*) FROM items")) {
	/* execute query */
	$counter->execute();

	$nbr_pages = (int)(($counter->fetchColumn()-1) / 15) + 1;
	display_pagination($shop_page, $nbr_pages);
} else {
		echo "Database error when getting number of items";
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