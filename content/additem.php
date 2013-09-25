<?php
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
	// TODO: move this into a function.

	include 'session.php';

	$_SESSION['site'] = 'shop';
	$name = $_POST["item_name"];
	$description = $_POST["item_desc"];
	$price = $_POST["item_price"];

	add_item($name, $description, $price);

	session_write_close();

	header('Location: index.php', true, 302);
	exit();

?>