<?php

$aliases['site1.dev'] = array(
  'root' => '/var/www',
  'uri' => 'ec2-175-41-190-227.ap-southeast-1.compute.amazonaws.com',
  'remote-host' => '10.130.78.26',
  'remote-user' => 'drush',
  'databases' => array (
	'default' =>
    array (
      'database' => 'drupal',
      'username' => 'drupal',
      'password' => 'drup4l',
      'host' => 'webinstance.c4ehyaspvwcj.ap-southeast-1.rds.amazonaws.com',
      'port' => '3306',
      'driver' => 'mysql',
      'prefix' => 'drupal_',
    ),
  ),
);
$aliases['site1.stage'] = array(
  'root' => '/var/www',
  'uri' => 'ec2-54-251-5-86.ap-southeast-1.compute.amazonaws.com',
  'remote-host' => '10.130.78.28',
  'remote-user' => 'drush',
  'databases' =>
  'default' =>
  'databases' => array (
	'default' =>
    array (
      'database' => 'drupal',
      'username' => 'drupal',
      'password' => 'drup4l',
      'host' => 'webinstance.c4ehyaspvwcj.ap-southeast-1.rds.amazonaws.com',
      'port' => '3306',
      'driver' => 'mysql',
      'prefix' => 'drupal2_',
    ),
  ),
);