<html>
<?php
$title = 'Shopping Cart';
include 'header.php';

?>

<script type="text/javascript">

var $ = function(x) {
  return document.getElementById(x);
}

var reset = function(){
	var cart = new Array();
	var d = new Date();
	d.setTime(d.getTime() + (1000*60*60*24*5));
	var expires = "expires="+d.toUTCString();
	var sCart = "cart=";
	document.cookie=sCart + ";" + expires;
	location.reload(true);
}

window.onload = function(){
	$('reset').onclick = reset;
}

</script>

<div class='title'>
	<h2>Shopping Cart</h2>
</div>

<div id='cart'>

<?php

	$array = json_decode($_COOKIE['cart'],true);
	$count = count($array);

	if($count < 1) {
		echo "Your cart is empty.  <a href='products.php'>Click here</a> to start shopping.";
	}else{
		$total = 0;
		$shipping = 5.99;
		echo"<div class='title'><h3>Your cart contains the following items:</h3></div>";
		echo "<div class='title'><table style='width:100%'><tr><td><b>Product Name:</b></td><td><b>Category:</b></td><td>
		<b>Price Per:</b></td><td><b>Quantity Ordered:</b></td><td><b>Total Item Cost:</b></td></tr>";
		foreach ($array as $key => $value) {
			$sql = "SELECT ProductName, CategoryID, UnitPrice, UnitsInStock FROM products WHERE ProductID = '$key'";
			$results = mysqli_query($link, $sql);
			echo (!$results?die(mysqli_error($link)."<br>".$sql):"");

			if(mysqli_num_rows($results) > 0){
				list($name, $cat, $price, $inStock) = mysqli_fetch_array($results);
				$category = array(1=>"Electrionics",2=>"Auto", 3=>"Cosmetics");
				$lineValue = $value * $price;
				$total += $lineValue;
				echo "<tr><td>$name</td><td>$category[$cat]</td><td>\$$price</td><td>$value</td><td>\$$lineValue</td>";
			}
			
		}
		echo"<tr><td></td><td></td><td></td><td>Price:</td><td>\$$total</td></tr>";
		echo"<tr><td></td><td></td><td></td><td>Shipping:</td><td>\$$shipping</td></tr>";
		$total += $shipping; 
		echo"<tr><td></td><td></td><td></td><td>Total Price:</td><td>\$$total</td></tr>";
		echo "</table></div>";
		echo"
		<div class = 'title'>
			<form>
			<input type='button' value='Empty Cart' id='reset'>
			</form>
		</div>
		";
	}

echo "</div>";
?>



<?php
include 'footer.php';
?>
</html>