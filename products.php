<html>
<?php

// Main product page.  This will have lists of the products that are currently offered in the
// store, with options to narrow down product selection.

$title = 'Products';
include_once 'header.php';
?>

<script type="text/javascript">

var createXMLHttp = function() {

  if(window.XMLHttpRequest) {
    xHttp = new XMLHttpRequest();
  }else{
    xHttp = new ActiveXObject("Microsoft/XMLHttp");
  }
  return xHttp;
}

var $ = function(x) {
  return document.getElementById(x);
}


var callProducts = function() {
  var url = "filterProducts.php"; 
  var xmlHttp = createXMLHttp();
  xmlHttp.open("GET",url);
  xmlHttp.send();
  var results = "";
  xmlHttp.onreadystatechange = function() {
    if(xmlHttp.readyState == 4) {
      var rows = JSON.parse(xmlHttp.responseText); 
      var products = document.createElement("div");
      products.setAttribute("id","products");
      for(i=0; i<rows.length; i++) {
        var temp = createDiv(rows[i]["pId"],rows[i]["name"],rows[i]["description"],rows[i]["price"],rows[i]["picture"]);
        products.appendChild(temp);
      }
      $("productList").appendChild(products);
    }

  }
}

var createDiv = function(pId,name,description,price,picture) {
  var div = document.createElement("div");
  div.setAttribute("id","product"+pId);
  div.setAttribute("class","product");

  var image = document.createElement("label");
  image.setAttribute("for",name);
  image.innerHTML = "<img src='images/"+picture+"' height='50' width='40'>";
  div.appendChild(image);

  var text = document.createElement("p");
  text.setAttribute("id","pname");
  text.innerHTML = name;
  div.appendChild(text);

  text = document.createElement("p");
  text.innerHTML = description;
  div.appendChild(text);

  text = document.createElement("p");
  text.innerHTML = "$"+price;
  div.appendChild(text);

  var button = document.createElement("a");
  var url = "addCart.php?pId=" + pId;
  button.setAttribute("href", url);

  var buy = document.createElement("div");
  buy.setAttribute("class","buy");
  buy.innerHTML = "Add to Cart";
  
  button.appendChild(buy);

  div.appendChild(button);

  return div;
}

var search = function() {
  if($('search').value != "") {
    $('productList').removeChild($('products'));
    var url = "filterProducts.php?term=" + $('search').value;
    if($('sCat') > 0) {
      url = url + "&catId=" + $('sCat');
    }
    var xmlHttp = createXMLHttp();
    xmlHttp.open("GET",url);
    xmlHttp.send();
    var results = "";
    xmlHttp.onreadystatechange = function() {
      if(xmlHttp.readyState == 4) {
        var rows = JSON.parse(xmlHttp.responseText); 
        var products = document.createElement("div");
        products.setAttribute("id","products");
        for(i=0; i<rows.length; i++) {
          var temp = createDiv(rows[i]["pId"],rows[i]["name"],rows[i]["description"],rows[i]["price"],rows[i]["picture"]);
          products.appendChild(temp);
        }
        $("productList").appendChild(products);
      }
    }
  }else{
    $('productList').removeChild($('products'));
    callProducts();
  }
}

window.onload = function() {
	callProducts();
  $('bSearch').onclick = search;
  $('sCat').onchange = search;
}

</script>

<div class="title"><h2>Products</h2></div>

<div class = "product-center">
	<div class = "inline">
		<div class = "col-md-3">
			<div class="search">	
				<form>
					Search In Products:<br>
					<input type="text" name="search" id="search">
          <input type="button" value="Search" id="bSearch">
				</form>
			</div><br>
			<div class = "search">
				<form>
					Filter Products:<br><br>
				<div class = "filter">
					Category:
					<select name="sCat" id="sCat">
						<option value=0>All</option>
						<option value=1>Electronics</option>
						<option value=2>Auto</option>
						<option value=3>Cosmetics</option>
					</select><br>
					<br>
					
				</div>
				</form>
			</div>
		</div>
	</div>
	<div class="inline">
		<div class = "col-md-9" id = "productList">
      <?php
        if(isset($_GET['update'])) {
          if($_GET['update']) {
            echo "Product Added Successfully.";
          }
        }
      ?>
		</div>
	</div>
</div>

<?php
include 'footer.php';
?>
</html>