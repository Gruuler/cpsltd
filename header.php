<head>

  <link type="text/css" rel="stylesheet" href="bootstrap.css">
  <link type="text/css" rel="stylesheet" href="stylesheet.css">
<?php
  include 'authenticate.php';
  include 'connect.php';
?>

  <title>CPS ltd | <?php echo $title; ?></title>

<script text="rel/stylesheet">

var $ = function(x) {
  return document.getElementById(x);
}

window.onload = function() {


}

</script>

</head>

<body>

  <!-- Header for each web page -->

  <div class="header">

    <div class="col-md-2">
    </div>

    <div class="col-md-8">
      <div class="menu">
       <div class="pull-left">
        <div class="cart" id="cart">
          <?php
            if(!isset($_COOKIE['cart'])) {
              $cart = array();
              $value = json_encode($cart);
              setcookie('cart',$value,time()+1000*60*60*24*5);
            }
            $array = json_decode($_COOKIE['cart'], true);
            $numProducts = 0;
            if(count($array) > 0){
              foreach ($array as $key => $value){
                $numProducts = $numProducts + $value;
              }
            }
            echo "<a href='cart.php'>You have " . $numProducts . " item(s) in your cart";
            ?>
        </div>
       </div>
       <ul class="pull-right">
        <?php
         $pages = array("Main" => "main.php","Products" => "products.php");
         if($logIn) {
          $pages["Log Out"] ="logout.php";
          $pages["Account"] = "account.php";
         } else {
          $pages["Log In"] = "login.html";
         }
         foreach ($pages as $key => $value)
         {
          echo "<li><a href=".$value.">".$key."</a></li>";
         }

        ?>
       </ul>
      </div>
    </div>
   
    <div class="col-md-2">
    </div>
  </div>

<!-- Body -->

<div class="body">
<div class="col-md-2">
</div>
<div class="col-md-8">