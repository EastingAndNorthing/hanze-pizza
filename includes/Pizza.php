<?php

class Pizza {

  public $type;
  public $size;
  public $bottom;
  public $topping;
  public $price;

  public static function getInstance(){
    return new Pizza();
  }

  public function create($type, $size, $bottom, $topping){
    $this->type = $type;
    $this->size = $size;
    $this->bottom = $bottom;
    $this->topping = $topping;

    $this->calculate_price();
  }

  public function calculate_price() {
    $type_price = Config::$pizza_types[$this->type];
    $size_price = Config::$pizza_sizes[$this->size];
    $bottom_price = Config::$pizza_bottoms[$this->bottom];
    $topping_price = Config::$pizza_toppings[$this->topping];

    $this->price = $type_price + $size_price + $bottom_price + $topping_price;
  }
}
