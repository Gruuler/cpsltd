<?php
	if(isset($_GET['pId'])) {
		$pId = $_GET['pId'];
		$cart = array();
		$found = false;
		if(isset($_COOKIE['cart'])){
			$cart = json_decode($_COOKIE['cart'], true);
			if(count($cart) > 0) {
				foreach ($cart as $key => $value) {
					if($key == $pId){
						$cart[$key] = $value+1;
						$found = true;
					}
				}	
			}
			if(!$found){
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