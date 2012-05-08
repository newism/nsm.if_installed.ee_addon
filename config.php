<?php

/**
 * Config file for NSM If Installed
 *
 * @package			NsmIfInstalled
 * @version			0.0.1
 * @author			Leevi Graham <http://leevigraham.com>
 * @copyright 		Copyright (c) 2007-2010 Newism <http://newism.com.au>
 * @license 		Commercial - please see LICENSE file included with this distribution
 * @link			http://expressionengine-addons.com/nsm-if-installed
 */

if(!defined('NSM_IF_INSTALLED_VERSION')) {
	define('NSM_IF_INSTALLED_VERSION', '0.0.1');
	define('NSM_IF_INSTALLED_NAME', 'NSM If Installed');
	define('NSM_IF_INSTALLED_ADDON_ID', 'nsm_if_installed');
}

$config['name'] 	= NSM_IF_INSTALLED_NAME;
$config["version"] 	= NSM_IF_INSTALLED_VERSION;

$config['nsm_addon_updater']['versions_xml'] = 'http://github.com/newism/nsm.if_installed.ee_addon/raw/master/versions.xml';
