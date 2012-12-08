<?php

class LogShell {

	public static function create($op) 
	{
		$id = uniqid($op);

		$file = Config::get("sites.log_dir"). "/" . $id . ".log";

		return array($id, $file);
	}

	public static function read($id, $offset) 
	{

		$file = Config::get("sites.log_dir"). "/" . $id . ".log";

		$content = file_get_contents($file, false, NULL, $offset);

		$offset = $offset + strlen($content);

		return array($content, $offset);
    }

}
