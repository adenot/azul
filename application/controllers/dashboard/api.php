<?php

class Dashboard_Api_Controller extends Base_Controller
{

    public $restful = true;
    
    function __construct() 
	{
      $this->filter('before', 'auth');
      parent::__construct();
    }
    

	function get_site($region) 
	{
		return $region;
	
	}
	
	function get_site_list()
	{
		$sites = Config::get("sites.info");
	
		return json_encode($sites);
	}
		
	function post_execute()
	{
		$input = Input::json();
		//var_dump($input);exit();
		$cmds = Config::get('sites.commands');

		$log = array();
		
		foreach ($input->operations as $operation) {
			$site = $operation->site->key;
			$op = $operation->op;
			$source = $operation->source;
			$destination = $operation->destination;
		
			$cmd = $cmds->$op;
			
			$tokens = array("{site}", "{op}", "{source}", "{destination}");
			$replace = array($site, $op, $source, $destination);
			
			$cmd = str_replace($tokens, $replace, $cmd);
			
			$cmd = new Command();
			$cmd->setOperation($op);
			$cmd->setCommand($cmd);
			$cmd->execute();
			$log[] = $cmd->getLogId();
		
		}
		
		return json_encode($log);
	
	}
	
}