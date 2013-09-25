<?php

function display_items($stmt) 
{
	$i = 0;
	while (mysqli_stmt_fetch($stmt)) {
		if (i%3 == 0) {
			echo "<div class='row'>";
		}
		echo "<div class='col-md-4'>$name \$$price:<br><br>$description</div>";
			
		if (i%3 == 2) {
			echo "</div>";
		}
		$i = $i + 1;
	}
}

function add_item($name, $description, $price) {
	if ($stmt = $db->prepare("INSERT into items (name, description, price) VALUES (:name, :description, :price)")) {
		$stmt->bindParam(':name', $name, PDO::PARAM_STR);
		$stmt->bindParam(':description', $description, PDO::PARAM_STR);
		$stmt->bindParam(':price', $price, PDO::PARAM_INT);
	
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
    $result = $stmt->fetch(PDO::FETCH_ASSOC);


    printf("%s %s %s\n", $result[0], $result[1], $result[2]);

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