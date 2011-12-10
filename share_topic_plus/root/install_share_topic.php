<?php

/**
* @author _Vinny_ vinny@suportephpbb.com.br http://www.suportephpbb.com.br
* @package Share Topic Plus
* @version $Id install_share_topic.php
* @copyright (c) 2011 _Vinny_
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @ignore
*/
define('UMIL_AUTO', true);
define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
$user->session_begin();
$auth->acl($user->data);
$user->setup();


if (!file_exists($phpbb_root_path . 'umil/umil_auto.' . $phpEx))
{
   trigger_error('Please download the latest UMIL (Unified MOD Install Library) from: <a href="http://www.phpbb.com/mods/umil/">phpBB.com/mods/umil</a>', E_USER_ERROR);
}

/*
* The language file which will be included when installing
*/
$language_file = 'mods/info_acp_share_topic_plus';

// The name of the mod to be displayed during installation.
$mod_name = 'ACP_SHARE_TOPIC';

/*
* The name of the config variable which will hold the currently installed version
*/
$version_config_name = 'share_topic_plus_version';

/*
* The array of versions and actions within each.
*/
$versions = array(
	// Version 1.0.0
	'1.0.0'	=> array(
		// Lets add a config setting named test_enable and set it to true
		'config_add' => array(
         array('enable_share_plus', 1),
		 array('enable_share_plus_facebook', 1),
		 array('enable_share_plus_twitter', 1),
		 array('enable_share_plus_google', 1),
		 array('twitter_via'),
		 array('twitter_button', 'none'),
		 array('twitter_lang', 'en'),
		 array('google_size', 'standard'),
		 array('google_count', 'bubble'),
		 array('google_lang', 'en-US'),
		 array('facebook_layout', 'standard'),
		 array('facebook_send', 'true'),
		 array('facebook_face', 'true'),
		 array('facebook_action', 'like'),
		 array('facebook_font', 'verdana'),
		 array('facebook_color', 'light'),
		 array('facebook_lang', 'en_US'),
		 array('facebook_width', '400'),
		),
	
	
		// Alright, now lets add some modules to the ACP
		'module_add' => array(
			// First, lets add a new category named ACP_SHARE_TOPIC to ACP_CAT_DOT_MODS
			array('acp', 'ACP_CAT_DOT_MODS', 'ACP_SHARE_TOPIC'),

			// next let's add our module
			array('acp', 'ACP_SHARE_TOPIC', array(
					'module_basename'	=> 'share_topic_plus',
					'modes'				=> array('settings'),
				),
			),


		),
	
	),

);

// Include the UMIF Auto file and everything else will be handled automatically.
include($phpbb_root_path . 'umil/umil_auto.' . $phpEx);

?>