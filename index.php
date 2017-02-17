<?php
/*
Todo:
- while
*/

// Enable debugging messages
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Require our files
require_once(__DIR__.'/includes/Config.php');
require_once(__DIR__.'/includes/Pizza.php');
require_once(__DIR__.'/includes/Controller.php');
require_once(__DIR__.'/includes/View.php');

$controller = new Controller;

?>

<!doctype html>
<html lang="nl">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/main.css">

  <title>Pizza Meneer - Pizza bestellen</title>
  <meta name="author" content="Mark Oosting">
  <meta name="description" content="Bestel uw pizza's online">
  <meta name="keywords" content="Pizza">
</head>

<body>

  <header>
    <div class="maxwidth">
      <h1>Pizza Meneer</h1>
    </div>
  </header>

  <main>
    <div class="maxwidth">
      <div class="flex">
        <div class="shop">
          <h2>Selecteer je pizza</h2>
          <form action="" method="post">
            <?php $controller->create_dropdown(Config::$pizza_types, 'pizza_type'); ?>
            <?php $controller->create_dropdown(Config::$pizza_sizes, 'pizza_size'); ?>
            <?php $controller->create_dropdown(Config::$pizza_bottoms, 'pizza_bottom'); ?>
            <?php $controller->create_dropdown(Config::$pizza_toppings, 'pizza_topping'); ?>
            <p>Hoeveelheid:</p>
            <input type="number" name="pizza_quantity" value="1" min="1" max="20" required>
            <input type="submit" class="btn btn-green" name="pizza_submit" value="Toevoegen">
          </form>
        </div>

        <aside class="shoppingcart">
          <?php $controller->render_cart(); ?>
        </aside>
      </div>
    </div>
  </main>

</body>

</html>
