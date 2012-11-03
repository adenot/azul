<?php

class Shell {

	public $operation;
	public $command;
	public $log_file;
	public $log_id;

	public function setOperation($op)
	{
		$this->operation = $op;
		list($this->log_id, $this->log_file) = Log::create($op);
	}
	
	public function setCommand($cmd)
	{
		$this->command = $cmd;
	}

	public function execute()
	{
		shell_exec("./exec.sh " . $this->log_file . " " . $this->command);
	}
	
	public function getLogId() {
		return $this->log_id;
	}
	
}