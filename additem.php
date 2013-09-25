<?php
	include 'config.php';
	function add_item($name, $description, $price, $db) {
		if ($stmt = $db->prepare("INSERT into items (name, description, price) VALUES (:name, :description, CAST(:price AS DECIMAL))")) {
			$stmt->bindParam(':name', $name, PDO::PARAM_STR);
			$stmt->bindParam(':description', $description, PDO::PARAM_STR);
			$stmt->bindValue(':price', strval($price), PDO::PARAM_STR);

			var_dump($price);
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

	add_item($name, $description, $price, $db);

	session_write_close();

	header('Location: index.php', true, 302);
	exit();

?>