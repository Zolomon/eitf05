<?php

function display_items($stmt) 
{
	echo <<<EOT
	<div class='container'>
	<div class='row'>
		<table class='table table-striped' width='400'>";
			<thead>
          		<tr>
            		<th>Item</th>
            		<th>Description</th>
            		<th>Price</th>
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
  				<td>$name</td>
  				<td>$description</td>
  				<td>\${$result['price']}</td>
			</tr>
EOT;
		//printf("<div class='col-md-4'>%s \$%s:<br><br>%s</div>", $result['name'], $result['price'], $result['description']);
	}
	echo "</table></div></div>";
}

function add_item($name, $description, $price) {
	if ($stmt = $db->prepare("INSERT into items (name, description, price) VALUES (:name, :description, :price)")) {
		$stmt->bindParam(':name', $name, PDO::PARAM_STR);
		$stmt->bindParam(':description', $description, PDO::PARAM_STR);
		$stmt->bindParam(':price', $price, PDO::PARAM_STR);
	
    	 /* execute query */
    	$stmt->execute();
	} else {
		echo "Failed to add item!";
	}
}

/*
function UpdateCurrPageNbr(){
	
}
*/

//$stmta = mysqli_prepare($link, "SELECT name,decription,price FROM items --LIMIT ((?-1)*15),15");
//mysqli_stmt_bind_param($stmta, 'i', $shop_page);



if ($stmt = $db->prepare("SELECT name, description, price FROM items LIMIT :shop_page_items, 15;")) {
	
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

//mysqli_stmt_bind_param($stmt, 'i', $shop_page);

/*mysqli_stmt_execute($stmta);
mysqli_stmt_bind_result($stmta, $name, $description, $price);*/


//DisplayItems($items)



//'($_GET['shop_page']-1)*15'
?>


<form role="form" action="additem.php" method="post">
  <div class="form-group">
    <label for="item_name">Item name:</label>
    <input type="text" class="form-control" id="item_name" name="item_name">
  </div>
  <div class="form-group">
    <label for="item_desc">Item description</label>
    <input type="text" class="form-control" id="item_desc" name="item_desc">
  </div>
  <div class="form-group">
    <label for="item_price">Item price:</label>
    <input type="text" class="form-control" id="item_price" name="item_price">
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>