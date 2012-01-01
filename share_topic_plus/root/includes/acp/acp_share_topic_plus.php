<?php
/**
*
* @package Share Topic Plus
* @version $Id$
* @copyright (c) _Vinny_, vinny@suportephpbb.com.br , http://www.suportephpbb.com.br
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
* @ Based on acp_board.php
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* @package acp
*/
class acp_share_topic_plus
{
	var $u_action;
	var $new_config = array();

	function main($id, $mode)
	{
		global $db, $user, $auth, $template, $cache;
		global $config, $phpbb_root_path, $phpbb_admin_path, $phpEx;

		$user->add_lang('mods/info_acp_share_topic_plus');

		$action	= request_var('action', '');
		$submit = (isset($_POST['submit'])) ? true : false;

		$form_key = 'acp_share';
		add_form_key($form_key);
		// Version Check
		$config['SHARETOPIC_VERSION'] = (isset($config['SHARETOPIC_VERSION'])) ? $config['SHARETOPIC_VERSION'] : '1.0.0-RC1';
		
		switch ($mode)
		{
			case 'settings':
				$display_vars = array(
					'title'	=> 'ACP_SHARE_TOPIC',
					'vars'	=> array(
						'legend1'				=> 'ACP_SHARE_SETTINGS',
						'enable_share_plus'         => array('lang' => 'ACP_SHARE_ENABLE',         'validate' => 'bool',   'type' => 'radio:yes_no', 'explain' => false),
						
						'legend2'				=> 'ACP_SHARE_SETTINGS_FACEBOOK',
						'enable_share_plus_facebook'         => array('lang' => 'ACP_SHARE_FACEBOOK',         'validate' => 'bool',   'type' => 'radio:yes_no', 'explain' => false),
						'facebook_layout'		=> array('lang' => 'ACP_SHARE_FACEBOOK_LAYOUT',        'validate' => 'string', 'type' => 'select', 'method' => 'facebook_layout', 'explain' => true),
						'facebook_send'		=> array('lang' => 'ACP_SHARE_FACEBOOK_SEND',				'validate' => 'string',	'type' => 'custom', 'method' => 'facebook_send', 'explain' => true),
						'facebook_face'		=> array('lang' => 'ACP_SHARE_FACEBOOK_FACE',				'validate' => 'string',	'type' => 'custom', 'method' => 'facebook_face', 'explain' => true),
						'facebook_action'		=> array('lang' => 'ACP_SHARE_FACEBOOK_ACTION',        'validate' => 'string', 'type' => 'select', 'method' => 'facebook_action', 'explain' => true),
						'facebook_font'		=> array('lang' => 'ACP_SHARE_FACEBOOK_FONT',        'validate' => 'string', 'type' => 'select', 'method' => 'facebook_font', 'explain' => true),
						'facebook_color'		=> array('lang' => 'ACP_SHARE_FACEBOOK_COLOR',        'validate' => 'string', 'type' => 'select', 'method' => 'facebook_color', 'explain' => true),
						'facebook_lang'		=> array('lang' => 'ACP_SHARE_FACEBOOK_LANG',        'validate' => 'string', 'type' => 'select', 'method' => 'facebook_lang', 'explain' => true),
						'facebook_width'		=> array('lang' => 'ACP_SHARE_FACEBOOK_WIDTH',        'validate' => 'string', 'type' => 'text:12:12', 'explain' => true, 'append' => ' ' . $user->lang['PIXEL']),
						
						'legend3'				=> 'ACP_SHARE_SETTINGS_TWITTER',
						'enable_share_plus_twitter'         => array('lang' => 'ACP_SHARE_TWITTER',         'validate' => 'bool',   'type' => 'radio:yes_no', 'explain' => false),
						'twitter_button'		=> array('lang' => 'ACP_SHARE_TWITTER_LAYOUT',	'validate' => 'string',	'type' => 'select', 'method' => 'twitter_button', 'explain' => true),
						'twitter_lang'			=> array('lang' => 'ACP_SHARE_TWITTER_LANG',	'validate' => 'string', 'type' => 'select', 'method' => 'twitter_lang', 'explain' => true),
						'twitter_via'			=> array('lang' => 'ACP_SHARE_TWITTER_VIA',        'validate' => 'string', 'type' => 'text:20:25', 'explain' => true),
						
						'legend4'				=> 'ACP_SHARE_SETTINGS_GOOGLE',
						'enable_share_plus_google'         => array('lang' => 'ACP_SHARE_GOOGLE',         'validate' => 'bool',   'type' => 'radio:yes_no', 'explain' => false),
						'google_size'			=> array('lang' => 'ACP_SHARE_GOOGLE_SIZE',        'validate' => 'string', 'type' => 'select', 'method' => 'google_size', 'explain' => true),
						'google_lang'			=> array('lang' => 'ACP_SHARE_GOOGLE_LANG',        'validate' => 'string', 'type' => 'text:10:6', 'explain' => true),
						'google_count'			=> array('lang' => 'ACP_SHARE_GOOGLE_LAYOUT',        'validate' => 'string', 'type' => 'select', 'method' => 'google_count', 'explain' => true),

						'legend5'					=> 'ACP_SUBMIT_CHANGES',
					)
				);
			break;

			default:
				trigger_error('NO_MODE', E_USER_ERROR);
			break;
		}

		if (isset($display_vars['lang']))
		{
			$user->add_lang($display_vars['lang']);
		}

		$this->new_config = $config;
		$cfg_array = (isset($_REQUEST['config'])) ? utf8_normalize_nfc(request_var('config', array('' => ''), true)) : $this->new_config;
		$error = array();

		// We validate the complete config if whished
		validate_config_vars($display_vars['vars'], $cfg_array, $error);

		if ($submit && !check_form_key($form_key))
		{
			$error[] = $user->lang['FORM_INVALID'];
		}
		// Do not write values if there is an error
		if (sizeof($error))
		{
			$submit = false;
		}

		// We go through the display_vars to make sure no one is trying to set variables he/she is not allowed to...
		foreach ($display_vars['vars'] as $config_name => $null)
		{
			if (!isset($cfg_array[$config_name]) || strpos($config_name, 'legend') !== false)
			{
				continue;
			}


			$this->new_config[$config_name] = $config_value = $cfg_array[$config_name];

			if ($submit)
			{
				set_config($config_name, $config_value);
			}
		}

		if ($submit)
		{
			//add_log('admin', 'LOG_CONFIG_' . strtoupper($mode));

			trigger_error($user->lang['CONFIG_UPDATED'] . adm_back_link($this->u_action));
		}

		$this->tpl_name = 'acp_share';
		$this->page_title = $display_vars['title'];

		$template->assign_vars(array(
			'L_TITLE'			=> $user->lang[$display_vars['title']],
			'L_TITLE_EXPLAIN'	=> $user->lang[$display_vars['title'] . '_EXPLAIN'],

			'S_ERROR'			=> (sizeof($error)) ? true : false,
			'ERROR_MSG'			=> implode('<br />', $error),

			'U_ACTION'			=> $this->u_action,
			'SHARETOPIC_VERSION'	=> $config['SHARETOPIC_VERSION'],
			'S_VERSION_UP_TO_DATE'	=> $this->sharetopic_version_compare($config['SHARETOPIC_VERSION'])
			)
		);

		// Output relevant page
		foreach ($display_vars['vars'] as $config_key => $vars)
		{
			if (!is_array($vars) && strpos($config_key, 'legend') === false)
			{
				continue;
			}

			if (strpos($config_key, 'legend') !== false)
			{
				$template->assign_block_vars('options', array(
					'S_LEGEND'		=> true,
					'LEGEND'		=> (isset($user->lang[$vars])) ? $user->lang[$vars] : $vars)
				);

				continue;
			}

			$type = explode(':', $vars['type']);

			$l_explain = '';
			if ($vars['explain'] && isset($vars['lang_explain']))
			{
				$l_explain = (isset($user->lang[$vars['lang_explain']])) ? $user->lang[$vars['lang_explain']] : $vars['lang_explain'];
			}
			else if ($vars['explain'])
			{
				$l_explain = (isset($user->lang[$vars['lang'] . '_EXPLAIN'])) ? $user->lang[$vars['lang'] . '_EXPLAIN'] : '';
			}
			
			$content = build_cfg_template($type, $config_key, $this->new_config, $config_key, $vars);
			
			if (empty($content))
			{
				continue;
			}
			
			$template->assign_block_vars('options', array(
				'KEY'			=> $config_key,
				'TITLE'			=> (isset($user->lang[$vars['lang']])) ? $user->lang[$vars['lang']] : $vars['lang'],
				'S_EXPLAIN'		=> $vars['explain'],
				'TITLE_EXPLAIN'	=> $l_explain,
				'CONTENT'		=> $content,
				)
			);

			unset($display_vars['vars'][$config_key]);
		}
		
	}
	
	/**
	* Facebook Settings
	*/
	// facebook layout
	function facebook_layout($value, $key = '')
	{
		global $user;

		return '<option value="standard"' . (($value == 'standard') ? ' selected="selected"' : '') . '>' . $user->lang['FACEBOOK_STANDARD'] . '</option><option value="button_count"' . (($value == 'button_count') ? ' selected="selected"' : '') . '>' . $user->lang['FACEBOOK_BUTTONCOUNT'] . '</option><option value="box_count"' . (($value == 'box_count') ? ' selected="selected"' : '') . '>' . $user->lang['FACEBOOK_BOXCOUNT'] . '</option>';
	}
	// facebook language
	function facebook_lang($default = '')
	{
		global $config, $phpbb_root_path ;
		$get_locale =	simplexml_load_file($phpbb_root_path . '/FacebookLocales.xml');
		$arr = $get_locale->locale;
		$fb_lang_options = '';
		foreach($arr as $locale)
		{
			$selected = ($locale->codes->code->standard->representation == $default) ? ' selected="selected"' : '';
			$fb_lang_options .= '<option id="' . $locale->codes->code->standard->representation . '" value="' . $locale->codes->code->standard->representation . '"' . $selected . '>' . $locale->englishName . '</option>';
		}
		return $fb_lang_options;

		$template->assign_vars(array(
			'S_FACEBOOK_LANG'  => (!isset($config['facebook_lang']) ? facebook_lang('en_US') : facebook_lang($config['facebook_lang'])),
		));
	}
	// facebook color
	function facebook_color($value, $key = '')
	{
		global $user;

		return '<option value="light"' . (($value == 'light') ? ' selected="selected"' : '') . '>' . $user->lang['FACEBOOK_LIGHT'] . '</option><option value="dark"' . (($value == 'dark') ? ' selected="selected"' : '') . '>' . $user->lang['FACEBOOK_DARK'] . '</option>';
	}
	// facebook action
	function facebook_action($value, $key = '')
	{
		global $user;

		return '<option value="like"' . (($value == 'like') ? ' selected="selected"' : '') . '>' . $user->lang['FACEBOOK_LIKE'] . '</option><option value="recommend"' . (($value == 'recommend') ? ' selected="selected"' : '') . '>' . $user->lang['FACEBOOK_RECOMMEND'] . '</option>';
	}
	// facebook send
	function facebook_send($value, $key = '')
	{
		$radio_ary = array("true" => 'ENABLE', "false" => 'DISABLE');

		return h_radio('config[facebook_send]', $radio_ary, $value, $key);
	}
	// facebook face
	function facebook_face($value, $key = '')
	{
		$radio_ary = array("true" => 'ENABLE', "false" => 'DISABLE');

		return h_radio('config[facebook_face]', $radio_ary, $value, $key);
	}
	// facebook font
	function facebook_font($value, $key = '')
	{
		global $user;

		return '<option value="arial"' . (($value == 'arial') ? ' selected="selected"' : '') . '>' . $user->lang['ARIAL'] . '</option><option value="lucida grande"' . (($value == 'lucida grande') ? ' selected="selected"' : '') . '>' . $user->lang['LUCIDA_GRANDE'] . '</option><option value="segoe ui"' . (($value == 'segoe ui') ? ' selected="selected"' : '') . '>' . $user->lang['SEGOE_UI'] . '</option><option value="tahoma"' . (($value == 'tahoma') ? ' selected="selected"' : '') . '>' . $user->lang['TAHOMA'] . '</option><option value="trebuchet ms"' . (($value == 'trebuchet ms') ? ' selected="selected"' : '') . '>' . $user->lang['TREBUCHET_MS'] . '</option><option value="verdana"' . (($value == 'verdana') ? ' selected="selected"' : '') . '>' . $user->lang['VERDANA'] . '</option>';
	}
	
	/**
	* Twitter Settings
	*/
	// twitter layout
	function twitter_button($value, $key = '')
	{
		global $user;

		return '<option value="none"' . (($value == 'none') ? ' selected="selected"' : '') . '>' . $user->lang['TWITTER_NONE'] . '</option><option value="vertical"' . (($value == 'vertical') ? ' selected="selected"' : '') . '>' . $user->lang['TWITTER_VERTICAL'] . '</option><option value="horizontal"' . (($value == 'horizontal') ? ' selected="selected"' : '') . '>' . $user->lang['TWITTER_HORIZONTAL'] . '</option>';
	}
	// twitter language
	function twitter_lang($value, $key = '')
	{
		global $user;

		return '<option value="nl"' . (($value == 'nl') ? ' selected="selected"' : '') . '>' . $user->lang['TWITTER_DUTCH'] . '</option><option value="en"' . (($value == 'en') ? ' selected="selected"' : '') . '>' . $user->lang['TWITTER_ENGLISH'] . '</option><option value="fr"' . (($value == 'fr') ? ' selected="selected"' : '') . '>' . $user->lang['TWITTER_FRENCH'] . '</option><option value="de"' . (($value == 'de') ? ' selected="selected"' : '') . '>' . $user->lang['TWITTER_GERMAN'] . '</option><option value="id"' . (($value == 'id') ? ' selected="selected"' : '') . '>' . $user->lang['TWITTER_INDONESIAN'] . '</option><option value="it"' . (($value == 'it') ? ' selected="selected"' : '') . '>' . $user->lang['TWITTER_ITALIAN'] . '</option><option value="ja"' . (($value == 'ja') ? ' selected="selected"' : '') . '>' . $user->lang['TWITTER_JAPANESE'] . '</option><option value="ko"' . (($value == 'ko') ? ' selected="selected"' : '') . '>' . $user->lang['TWITTER_KOREAN'] . '</option><option value="pt"' . (($value == 'pt') ? ' selected="selected"' : '') . '>' . $user->lang['TWITTER_PORTUGUESE'] . '</option><option value="ru"' . (($value == 'ru') ? ' selected="selected"' : '') . '>' . $user->lang['TWITTER_RUSSIAN'] . '</option><option value="es"' . (($value == 'es') ? ' selected="selected"' : '') . '>' . $user->lang['TWITTER_SPANISH'] . '</option><option value="tr"' . (($value == 'tr') ? ' selected="selected"' : '') . '>' . $user->lang['TWITTER_TURKISH'] . '</option>';
	}
	
	/**
	* Google Plus Settings
	*/
	// google plus size
	function google_size($value, $key = '')
	{
		global $user;

		return '<option value="small"' . (($value == 'small') ? ' selected="selected"' : '') . '>' . $user->lang['GOOGLE_SMALL'] . '</option><option value="medium"' . (($value == 'medium') ? ' selected="selected"' : '') . '>' . $user->lang['GOOGLE_MEDIUM'] . '</option><option value="standard"' . (($value == 'standard') ? ' selected="selected"' : '') . '>' . $user->lang['GOOGLE_STANDARD'] . '</option><option value="tall"' . (($value == 'tall') ? ' selected="selected"' : '') . '>' . $user->lang['GOOGLE_TALL'] . '</option>';
	}
	// google plus layout
	function google_count($value, $key = '')
	{
		global $user;

		return '<option value="none"' . (($value == 'none') ? ' selected="selected"' : '') . '>' . $user->lang['GOOGLE_NONE'] . '</option><option value="bubble"' . (($value == 'bubble') ? ' selected="selected"' : '') . '>' . $user->lang['GOOGLE_BUBBLE'] . '</option><option value="inline"' . (($value == 'inline') ? ' selected="selected"' : '') . '>' . $user->lang['GOOGLE_INLINE'] . '</option>';
	}

	/**
	* Obtains the latest version information
	* @param string    $current_version    version information
	* @param int       $ttl             Cache version information for $ttl seconds. Defaults to 86400 (24 hours).
	* 
	* @return bool       false on failure.
	**/
	function sharetopic_version_compare($current_version = '', $version_up_to_date = true, $ttl = 86400)
	{
		global $cache, $template;

		$info = $cache->get('sharetopic_versioncheck');

		if ($info === false)
		{
		$errstr = '';
		$errno = 0;

		$info = get_remote_file('www.suportephpbb.com.br', '/vinny', 'sharetopic.txt', $errstr, $errno);
		if ($info === false)
		{
			$template->assign_var('S_VERSIONCHECK_FAIL', true);
			$cache->destroy('sharetopic_versioncheck');
		}
		}

		if ($info !== false)
	{
		$cache->put('sharetopic_versioncheck', $info, $ttl);
		$latest_version_info = explode("\n", $info);

		$latest_version = strtolower(trim($latest_version_info[0]));
		$current_version = strtolower(trim($current_version));
		$version_up_to_date = version_compare($current_version, $latest_version, '<') ? false : true;

		$template->assign_vars(array(
			'U_VERSIONCHECK'	=> ($version_up_to_date) ? false : $latest_version_info[1],
			'S_VERSIONCURRENT'	=> $current_version,
			'S_VERSIONNEW'		=> ($version_up_to_date) ? false : $latest_version_info[0],
		));
	}

		return $version_up_to_date;
	}
}

?>