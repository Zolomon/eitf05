<?php
	include 'config.php';
	
	function add_item(&$db, $name, $description, $price) {
		if ($stmt = $db->prepare("INSERT into items (name, description, price) VALUES (:name, :description, :price)")) {
			$stmt->bindParam(':name', $name, PDO::PARAM_STR);
			$stmt->bindParam(':description', $description, PDO::PARAM_STR);
			$stmt->bindValue(':price', strval($price), PDO::PARAM_STR);

			$stmt->execute();
		} else {
			echo "Failed to add item!";
		}
	}

	include 'session.php';

	$_SESSION['site'] = 'shop';
	$name = $_POST["item_name"];
	$description = $_POST["item_desc"];
	$price = $_POST["item_price"];

	add_item($db, $name, $description, $price);

	session_write_close();

	header('Location: index.php', true, 302);
	exit();

?>