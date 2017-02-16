<?php

// Class to include view files through the controller

class View {

  public $views_folder = __DIR__.'/';

  function render($file, $data = array()) {
    include($this->views_folder.$file);
  }

}
