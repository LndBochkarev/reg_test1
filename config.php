<?php

error_reporting(E_ALL);

$site_root = $_SERVER['DOCUMENT_ROOT'] . '/reg_test1/';

/**
 * @todo handle errors
 */
require_once $site_root . 'classes/Registry.php';
require_once $site_root . 'classes/ViewData.php';

$registry = Registry::getInstance();

//in seconds
$registry->set('min_reg_wait_time', 600);
$registry->set('mysql_datetime', 'Y-m-d H:i:s');

$registry->set('site_root', $site_root);
$registry->set('templates_path', $site_root . 'templates/');

$registry->set('db_host', 'localhost');
$registry->set('db_name', '');
$registry->set('db_username', '');
$registry->set('db_pass', '');//!!!

$irdata = ViewData::getInstance();
$registry->set('view_data', $irdata);