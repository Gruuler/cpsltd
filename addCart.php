<?php
	if(isset($_GET['pId'])) {
		$pId = $_GET['pId'];
		if(isset($_COOKIE['cart'])){
			$cart = json_decode($_COOKIE['cart']);
			if(isset($cart[$pId])){
				$value = $cart[$pId];
				$value = $value+1;
				$cart[$pId] = $value;
			}else{
				$cart[$pId] = 1;
			}
			setcookie('cart',json_encode($cart),time()+1000*60*60*24*5);
			header ("location:products.php?update=true");
		}else{
			header ("location:products.php");
		}
	}else{
		header ("location:products.php");
	}
?>