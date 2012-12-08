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
			'name' => 'Suncorp Group',
			'key' => 'sungrp',
			'region' => array(
				'dev' => array(
					'url' => 'http://site1.local/',
					'repo' => 'https://git.local/site1.git',
					'repo_type' => 'GIT'
				),
				'stage' => array(
					'url' => 'http://site1.st/',
					'repo' => 'https://git.st/site1.git',
					'repo_type' => 'GIT'
				),
				'prod' => array(
					'url' => 'http://ec2-46-137-236-55.ap-southeast-1.compute.amazonaws.com/',
					'repo' => 'https://git.prod/site1.git',
					'repo_type' => 'GIT'
				)
			)
		)
	),

	'commands' => array(
		'db-refresh' =>	'drush -v -q sql-sync @{site}.{source} @{site}.{destination}',
		'info' =>	'drush -v -q @{site}.{destination} info',
		'update' => 	'drush -v -q @{site}.{destination} pull'
	)
);
