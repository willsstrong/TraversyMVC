<?php

/**
 * @file
 * App Core Class.
 * Creates URL & loads core controller.
 * URL FORMAT - /controller/method/param.
 */

class Core
{
  protected $currentController = 'Pages';
  protected $currentMethod = 'index';
  protected $params = [];

  public function __construct() {
    // print_r($this->getURL());
    $url = $this->getUrl();
    // Look in controllers
    if (file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
      $this->currentController = ucwords($url[0]);
      unset($url[0]);
    }


  }

  public function getUrl() {
    if (isset($_GET['url'])) {
      $url = rtrim($_GET['url'], '/');
      $url = filter_var($url, FILTER_SANITIZE_URL);
      $url = explode('/', $url);
      return $url;
    }
  }

}
