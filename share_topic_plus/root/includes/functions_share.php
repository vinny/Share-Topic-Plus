<?php
/**
*
* @package Share Topic Plus
* @version $Id$ 1.0.0
* @copyright (c) 2012 _Vinny_ - www.suportephpbb.com.br
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

class share
{
	function share($topic_id, $forum_id, &$topic_data)
	{
		global $db, $template, $user, $config, $auth, $phpbb_root_path, $phpEx, $server_path;

		$topic_data['topic_title'] = censor_text($topic_data['topic_title']);
		// Generate all the URIs ...
		$view_topic_url = generate_board_url() . "viewtopic.$phpEx?f=$forum_id&amp;t=$topic_id";

		// Assign template variables
		$template->assign_block_vars('share', array(
			'SHARE_TOPIC_TITLE' 		=> htmlspecialchars($topic_data['topic_title'], ENT_QUOTES),
			'U_SHARE_TOPIC_URL'			=> $view_topic_url,

			'S_SHARE_ACTIVE'			=> ($auth->acl_get('f_share_topic', $forum_id)) && (!empty($config['enable_share_plus'])) ? true : false,

			'S_FACEBOOK_SHARE'			=> (!empty($config['enable_share_plus_facebook'])) ? true : false,
			'S_FACEBOOK_SHARE_SEND'		=> !empty($config['facebook_send']) ? $config['facebook_send'] : false,
			'S_FACEBOOK_SHARE_LAYOUT'	=> !empty($config['facebook_layout']) ? $config['facebook_layout'] : false,
			'S_FACEBOOK_SHARE_WIDTH'	=> !empty($config['facebook_width']) ? $config['facebook_width'] : false,
			'S_FACEBOOK_SHARE_FACE'		=> !empty($config['facebook_face']) ? $config['facebook_face'] : false,
			'S_FACEBOOK_SHARE_ACTION'	=> !empty($config['facebook_action']) ? $config['facebook_action'] : false,
			'S_FACEBOOK_SHARE_COLOR'	=> !empty($config['facebook_color']) ? $config['facebook_color'] : false,
			'S_FACEBOOK_SHARE_FONT'		=> !empty($config['facebook_font']) ? $config['facebook_font'] : false,
			'S_FACEBOOK_SHARE_LANG'		=> !empty($config['facebook_lang']) ? $config['facebook_lang'] : false,


			'S_TWITTER_SHARE'			=> (!empty($config['enable_share_plus_twitter'])) ? true : false,
			'S_TWITTER_SHARE_BUTTON'	=> !empty($config['twitter_button']) ? $config['twitter_button'] : false,
			'S_TWITTER_SHARE_VIA'		=> !empty($config['twitter_via']) ? $config['twitter_via'] : false,
			'S_TWITTER_SHARE_LANG'		=> !empty($config['twitter_lang']) ? $config['twitter_lang'] : false,
			
			
			'S_GOOGLE_SHARE'			=> (!empty($config['enable_share_plus_google'])) ? true : false,
			'S_GOOGLE_SHARE_LANG'		=> !empty($config['google_lang']) ? $config['google_lang'] : false,
			'S_GOOGLE_SHARE_SIZE'		=> !empty($config['google_size']) ? $config['google_size'] : false,
			'S_GOOGLE_SHARE_COUNT'		=> !empty($config['google_count']) ? $config['google_count'] : false,

		));
		return;	
	}
}
?>