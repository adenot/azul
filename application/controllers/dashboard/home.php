<?php

class Dashboard_Home_Controller extends Base_Controller
{
  function __construct() {
    $this->filter('before', 'auth');
    parent::__construct();
  }
  
  public function action_index()
  {
    return View::make("dashboard.home");
    
  }
}