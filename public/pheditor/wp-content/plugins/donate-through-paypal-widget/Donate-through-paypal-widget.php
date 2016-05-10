<?php
/*
Plugin Name: Donate through paypal
Plugin URI: http://phppoet.com/donate-via-paypal-wordpress-plugin/
Description: A wordpress plugins to add paypal donation widget in the sidebar . It has been developed for not profiting organizations . 
Version: 1.1.8
Author: Parbat patel
Author URI: http://phppoet.com/
Author admin@fastanswers.net
License: GPLv2
*/

/**********************
* Global variables  ***
**********************/
$dtpw_prefix = 'dtpw_';
$dtpw_plugin_name="Donate through paypal";
$dtpw_options = get_option('dtpw_settings'); // Retrive our plugins options from database

/**********************
*include scripts file*
**********************/

include ('dtpw-scripts.php');

/**********************
*include other files***
**********************/

include ('dtpw-widget.php');//it creates widget for plugin
include ('dtpw-adminsettings.php');

/**********************
*Create Plugin links***
**********************/

include ('dtpw-pluginlinks.php');

/**********************
*include function file*
**********************/

include ('dtpw-functions.php');

/**********************
*include plugin options page*
**********************/

include ('dtpw-plugin-options.php');


?>