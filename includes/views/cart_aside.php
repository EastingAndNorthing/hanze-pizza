<?php

if(!empty($_SESSION['cart'])) {

  echo '<h2>Uw bestelling:</h2>';

  $index=0;

  foreach($_SESSION['cart'] as $cart_item){
    $price_format = money_format('%.2n', $cart_item->price);

    echo "<div class='card'>
      <p>Pizza $cart_item->type $cart_item->size $cart_item->bottom + $cart_item->topping</p>
      <p>&euro;$price_format</p>
      <form action='' method='post'><input type='submit' class='btn btn-red' name='cart_delete' value='X'></form>
    </div>";

    $index++;
  }

  $total_price_format = money_format('%.2n', $_SESSION['total_price']);

  echo "<form action='' method='post'>
    <input type='submit' class='btn btn-red' name='cart_clear' value='Winkelwagentje legen'>
    <input type='submit' class='btn btn-green' name='cart_buy' value='Kopen (&euro;$total_price_format)'>
  </form>";

} else {
  echo '<h2>Uw winkelwagentje is leeg.</h2>';
}
