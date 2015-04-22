<?php
	include 'connect.php';
	if(isset($_GET['term'])){
		$sTerm = $_GET['term'];
		$sql = "SELECT ProductID, ProductName, ProductDescription, UnitPrice, Picture FROM products WHERE UnitsInStock > 0 AND ProductDescription LIKE '%$sTerm%'";
	}else{
		$sql = "SELECT ProductID, ProductName, ProductDescription, UnitPrice, Picture FROM products WHERE UnitsInStock > 0";
	}
	$results = mysqli_query($link,$sql);
	echo (!$results?die(mysqli_error($link)."<br>".$sql):"");

	$count = mysqli_num_rows($results);

	for($i=0;$i<$count;$i++) {
		list($pId,$name,$description,$price,$picture) = mysqli_fetch_array($results);
		$rows[$i]["pId"] = $pId;
		$rows[$i]["name"] = $name;
		$rows[$i]["description"] = $description;
		$rows[$i]["price"] = $price;
		$rows[$i]["picture"] = $picture;
	}

	echo json_encode($rows);
?>