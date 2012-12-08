<?php


return array(

	'log_dir' => '/tmp/azul_logs',

	'region' => array(
		array(
			'name' => 'dev',
			'commands' => array(
				'db-refresh-dev',
				'diff',
				'update',
				'on-server'
			)
		),
		array(
			'name' => 'stage',
			'commands' => array(
				'db-refresh-stage',
				'diff',
				'update',
			)
		),
		array(
			'name' => 'dev',
			'commands' => array(
				'db-refresh-dev',
				'diff',
				'update'
			)
		)
	),
		
	'info' => array(
		array(
			'name' => 'site 1',
			'key' => 'site1',
			'region' => array(
				'dev' => array(
					'url' => 'http://site1.local/',
					'repo' => 'https://git.local/site1.git',
					'repo_type' => 'GIT',
					'drush_alias' => 'site1.dev'
				),
				'stage' => array(
					'url' => 'http://site1.st/',
					'repo' => 'https://git.st/site1.git',
					'repo_type' => 'GIT',
					'drush_alias' => 'site1.stage'
				),
				'prod' => array(
					'url' => 'http://site1.prod/',
					'repo' => 'https://git.prod/site1.git',
					'repo_type' => 'GIT',
					'drush_alias' => 'site1.prod'
				)
			)
		)
	),
	
	'commands' => array(
		'db-refresh' =>	'drush -v -q sql-sync @{site}.{source} @{site}.{destination}',
		'info' =>	'drush -v -q @{site} info',
		'update' => 	'drush -v -q @{site} pull'
	)
);
	
	
