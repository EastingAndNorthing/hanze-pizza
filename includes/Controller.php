<?php

// Main logic for the Pizza app

class Controller {

  public $cart_view = 'empty';

  public function __construct() {
    $this->init_session();


    if(!empty($_SESSION['cart'])) {
      $this->cart_view = 'list';
    } else {
      $this->cart_view = 'empty';
    }

    // Invoke methods based on post variables when instantiating the controller class
    if(isset($_POST['pizza_submit'])) {
      $this->add_to_cart();
      $this->update_total_price();
      $this->post_redirect_get();
    }
    if(isset($_POST['cart_clear'])) {
      $this->empty_cart();
      $this->cart_view = 'empty';
    }
    if(isset($_POST['cart_buy'])) {
      $this->cart_view = 'thankyou';
      $this->end_session();
      $this->init_session();
    }
    if(isset($_POST['cart_delete'])){
      $this->remove_from_cart($_POST['cart_delete']);
      $this->update_total_price();
      $this->post_redirect_get();
    }
  }

  public function init_session(){
    // Set the cart session variable, so we can add pizza's to to it
    session_start();
    if(!isset($_SESSION['cart'])) {
      $_SESSION['cart'] = [];
    }
  }

  public function end_session(){
    $_SESSION = [];
    session_destroy();
  }

  public function post_redirect_get() {
    // Makes sure we don't re-post anything
    header("Location: ".$_SERVER['REQUEST_URI']);
    exit();
  }

  public function create_dropdown($array, $name){
    // "Don't repeat yourself" -> Create dropdowns for all our data (Config.php)
    echo "<select name='$name'>";
    foreach($array as $key => $price) {
      $price_format = money_format('%.2n', $price);
      echo "<option value='$key'>$key (&euro;$price_format)</option>";
    }
    echo '</select>';
  }

  public function add_to_cart() {
    // Add the pizza to the cart array (times the amount set by 'pizza_quantity')
    for($i = 0; $i < $_POST['pizza_quantity']; $i++) {

      // Instantiate a new Pizza and set it's data using the 'create' method
      $pizza = new Pizza;
      $pizza->create(
        $_POST['pizza_type'],
        $_POST['pizza_size'],
        $_POST['pizza_bottom'],
        $_POST['pizza_topping']
      );

      // Store the created pizza in the session
      array_push($_SESSION['cart'], $pizza);
    }
  }

  public function remove_from_cart($id){
    array_splice($_SESSION['cart'], $id, 1);
  }

  public function update_total_price(){
    // Go through all cart items and sum their prices
    $total = 0;
    foreach($_SESSION['cart'] as $cart_item) {
      $total += $cart_item->price;
    }
    $_SESSION['total_price'] = $total;
  }

  public function empty_cart() {
    $_SESSION['cart'] = [];
  }

  public function render_cart() {
    // Render HTML based on the requested layout
    $view = new View();

    switch ($this->cart_view) {
      case 'list':
        $view->render('views/cart_list.php', $_SESSION['cart']);
      break;

      case 'empty':
        $view->render('views/cart_empty.php', $_SESSION['cart']);
      break;

      case 'thankyou':
        $view->render('views/cart_thankyou.php', $_SESSION['cart']);
      break;

      default:
        echo "The layout '$this->cart_view' is not supported.";
      break;
    }

  }

}
