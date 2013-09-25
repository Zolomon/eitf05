<?php
/*
function DisplayItems($stmt) 
{
	$i = 0;
	while (mysqli_stmt_fetch($stmt)) {
		if (i%3 == 0) {
			echo "<div class='row'>";
		}
		echo "<div class='col-md-4'>$name \$$price[3]:<br><br>$description[2]</div>";
			
		if (i%3 == 2) {
			echo "</div>";
		}
		$i = $i + 1;
	}
}

function UpdateCurrPageNbr(){
	
}
*/
$shop_page = 1;
$stmta = mysqli_prepare($link, "SELECT name,decription,price FROM items --LIMIT ((?-1)*15),15");
mysqli_stmt_bind_param($stmta, 'i', $shop_page);
/*mysqli_stmt_execute($stmta);
mysqli_stmt_bind_result($stmta, $name, $description, $price);*/


//DisplayItems($items)



//'($_GET['shop_page']-1)*15'
?>
