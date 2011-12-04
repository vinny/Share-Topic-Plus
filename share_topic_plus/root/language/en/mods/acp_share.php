<?php
/**
*
* @package Share Topic Plus [English]
* @version $Id$
* @copyright (c) 2011 _Vinny_ vinny@suportephpbb.com.br http://www.suportephpbb.com.br
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* DO NOT CHANGE
*/
if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine

$lang = array_merge($lang, array(
	// acp module - titles 
	'ACP_SHARE_TOPIC' 			=> 'Share Topic Plus',
	'ACP_SHARE_SETTINGS'		=> 'Settings',
	'ACP_SHARE_TOPIC_EXPLAIN'	=> 'Here you can manage the buttons to share topics on Facebook, Twitter and Google+ on your board.',
	
	// acp config
	'ACP_SHARE_ENABLE'			=> 'Enable',

	// FACEBOOK
	'ACP_SHARE_SETTINGS_FACEBOOK'	=> 'Facebook Settings',
	'ACP_SHARE_FACEBOOK'			=> 'Enable Facebook',
	'ACP_SHARE_FACEBOOK_LAYOUT'		=> 'Button Layout',
	'ACP_SHARE_FACEBOOK_LAYOUT_EXPLAIN'=> 'Choose the layout of the button from the following options: <em><strong>standard</strong></em>, <em><strong>button_count</strong></em> or <em><strong>box_count</strong></em>.',
	'ACP_SHARE_FACEBOOK_SEND'		=> 'Send Button',
	'ACP_SHARE_FACEBOOK_SEND_EXPLAIN'=> 'Enable/disable the <a href="http://developers.facebook.com/docs/reference/plugins/send/">Send Button</a>.' ,
	'ACP_SHARE_FACEBOOK_FACE'			=> 'Displays the profile picture. ',
	'ACP_SHARE_FACEBOOK_FACE_EXPLAIN'	=> 'Enable/disable to display the profile picture.',
	'ACP_SHARE_FACEBOOK_ACTION'			=> 'The verb to display on the button',
	'ACP_SHARE_FACEBOOK_ACTION_EXPLAIN'	=> 'Choose the verb to display on the button.',
	'ACP_SHARE_FACEBOOK_FONT'			=> 'The font to display in the button',
	'ACP_SHARE_FACEBOOK_FONT_EXPLAIN'	=> 'Options: arial, lucida grande, segoe ui, tahoma, trebuchet ms or verdana',
	'ACP_SHARE_FACEBOOK_COLOR'			=> 'The color for the like button',
	'ACP_SHARE_FACEBOOK_COLOR_EXPLAIN'	=> 'Choose the color scheme for the like button.',
	'ACP_SHARE_FACEBOOK_LANG'			=> 'Button Language',
	'ACP_SHARE_FACEBOOK_LANG_EXPLAIN'	=> 'This is the language in which the button will appear on your board. The following list are the languages supported by Facebook.',
	'ACP_SHARE_FACEBOOK_WIDTH'			=> 'Button Width',
	'ACP_SHARE_FACEBOOK_WIDTH_EXPLAIN'	=> 'The width of the Like button.',
	// facebook layout
	'FACEBOOK_STANDARD'		=> 'Standard',
	'FACEBOOK_BUTTONCOUNT'	=> 'Button Count',
	'FACEBOOK_BOXCOUNT'		=> 'Box Count',
	// facebook action
	'FACEBOOK_LIKE'			=> 'Like',
	'FACEBOOK_RECOMMEND'	=> 'Recommend',
	// facebook color
	'FACEBOOK_LIGHT'		=> 'Light',
	'FACEBOOK_DARK'			=> 'Dark',
	// facebook font
	'ARIAL'				=> 'Arial',
	'LUCIDA_GRANDE'		=> 'Lucida Grande',
	'SEGOE_UI'			=> 'Segoe UI',
	'TAHOMA'			=> 'Tahoma',
	'TREBUCHET_MS'		=> 'Trebuchet MS',
	'VERDANA'			=> 'Verdana',
	
	// TWITTER
	'ACP_SHARE_SETTINGS_TWITTER'	=> 'Twitter Settings',
	'ACP_SHARE_TWITTER'				=> 'Enable Twitter',
	'ACP_SHARE_TWITTER_LAYOUT'		=> 'Button Layout',
	'ACP_SHARE_TWITTER_LAYOUT_EXPLAIN'	=> 'Choose one of the following options: <em><strong>vertical</strong></em>, <em><strong>horizontal</strong></em> or <em><strong>none</strong></em>.',
	'ACP_SHARE_TWITTER_LANG'		=> 'Button Language',
	'ACP_SHARE_TWITTER_LANG_EXPLAIN'=> 'This is the language in which the button will appear on your board. The following list are the languages supported by Twitter.',
	'ACP_SHARE_TWITTER_VIA'			=> 'Your Twitter account',
	'ACP_SHARE_TWITTER_VIA_EXPLAIN'	=> 'Your account will be mentioned along the message shared.',
	// twitter layout
	'TWITTER_NONE'			=> 'None',
	'TWITTER_VERTICAL'		=> 'Vertical',
	'TWITTER_HORIZONTAL'	=> 'Horizontal ',
	// twitter language
	'TWITTER_DUTCH'			=> 'Dutch',
	'TWITTER_ENGLISH'		=> 'English',
	'TWITTER_FRENCH'		=> 'French',
	'TWITTER_GERMAN'		=> 'German',
	'TWITTER_INDONESIAN'	=> 'Indonesian',
	'TWITTER_ITALIAN'		=> 'Italian',
	'TWITTER_JAPANESE'		=> 'Japanese',
	'TWITTER_KOREAN'		=> 'Korean',
	'TWITTER_PORTUGUESE'	=> 'Portuguese',
	'TWITTER_RUSSIAN'		=> 'Russian',
	'TWITTER_SPANISH'		=> 'Spanish',
	'TWITTER_TURKISH'		=> 'Turkish',
	
	// GOOGLE+
	'ACP_SHARE_SETTINGS_GOOGLE'		=> 'Google+ Settings',
	'ACP_SHARE_GOOGLE'				=> 'Enable Google+',
	'ACP_SHARE_ENABLE_GOOGLE_EXPLAIN'	=> '',
	'ACP_SHARE_GOOGLE_SIZE'			=> 'Button Size',
	'ACP_SHARE_GOOGLE_SIZE_EXPLAIN'	=> 'Choose the size of the button from the following options: <em><strong>small</strong></em>, <em><strong>medium</strong></em>, <em><strong>standard</strong></em> or <em><strong>tall</strong></em>. To see examples of buttons and dimensions, <a href="https://developers.google.com/+/plugins/+1button/#button-sizes">click here</a>.',
	'ACP_SHARE_GOOGLE_LANG'			=> 'Button Language',
	'ACP_SHARE_GOOGLE_LANG_EXPLAIN'	=> 'Enter only the code for the language, according to the <a href="https://developers.google.com/+/plugins/+1button/#available-languages">list of languages available</a>.',
	'ACP_SHARE_GOOGLE_LAYOUT'			=> 'Button Layout',
	'ACP_SHARE_GOOGLE_LAYOUT_EXPLAIN'	=> 'Choose the layout of the button from the following options: <em><strong>none</strong></em>, <em><strong>bubble</strong></em> or <em><strong>inline</strong></em>.',
	// google+ size
	'GOOGLE_SMALL'		=> 'Small',
	'GOOGLE_MEDIUM'		=> 'Medium',
	'GOOGLE_STANDARD'	=> 'Standard',
	'GOOGLE_TALL'		=> 'Tall',
	// google+ layout
	'GOOGLE_NONE'		=> 'None',
	'GOOGLE_BUBBLE'		=> 'Bubble',
	'GOOGLE_INLINE'		=> 'Inline',
	
	//
	'SHARE_TWITTER'		 		=> 'Tweet',

));
?>