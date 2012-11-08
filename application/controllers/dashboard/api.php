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
	
	function get_log($id, $offset=0)
	{
		// testing:
		return json_encode(array("content" => "test\n", "offset" => ($offset+5)));
		
	
		return json_encode(LogShell::read($id, $offset));
	
	}
		
	function post_execute()
	{
		$input = Input::json();
		//var_dump($input);exit();
		$cmds = Config::get('sites.commands');

		$log = array();
		
		$operation = $input->operation;
		
		$site = $operation->site->key;
		$op = $operation->op;
		$source = $operation->source;
		$destination = $operation->destination;
		
		// testing:
		list($log_id, $log_file) = LogShell::create($op);
		return json_encode(array("log_id" => $log_id));
		
		$cmd = $cmds->$op;
			
		$tokens = array("{site}", "{op}", "{source}", "{destination}");
		$replace = array($site, $op, $source, $destination);
			
		$cmd = str_replace($tokens, $replace, $cmd);
			
		$sh = new Shell();
		$sh->setOperation($op);
		$sh->setCommand($cmd);
		$sh->execute();
		$log = $sh->getLogId();
		
		
		
		return json_encode($log);
	
	}
	
}
