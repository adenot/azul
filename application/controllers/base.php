<?php

class Base_Controller extends Controller {

	/**
	 * Catch-all method for requests that can't be matched.
	 *
	 * @param  string    $method
	 * @param  array     $parameters
	 * @return Response
	 */
	public function __call($method, $parameters)
	{
		return Response::error('404');
	}
  public function __construct()
  {
    //Assets
    Asset::add('jquery', 'js/lib/jquery-1.8.2.min.js');
    Asset::add('bootstrap-js', 'js/lib/bootstrap.js');
    Asset::add('bootstrap-css', 'css/bootstrap.css');
    Asset::add('bootstrap-css-responsive', 'css/bootstrap-responsive.css', 'bootstrap-css');
    Asset::add('style', 'css/style.css');
    parent::__construct();
  }
}