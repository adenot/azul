<?php


return array(

	"log_dir" => "/tmp/azul_logs",

	"info" => json_decode(file_get_contents(path("app") . "config/" . "sites_info.json")),
	
	"commands" => json_decode(file_get_contents(path("app") . "config/" . "sites_commands.json")),
);
	
	