<?php
/**
*
* @package Share Topic Plus
* @version $Id$
* @copyright (c) 2011 _Vinny_ vinny@suportephpbb.com.br http://www.suportephpbb.com.br
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @package module_install
*/
class acp_share_topic_plus_info
{
	function module()
	{
		return array(
			'filename'	=> 'acp_share_topic_plus',
			'title'		=> 'ACP_SHARE_TOPIC',
			'version'	=> '1.0.0',
			'modes'		=> array(
				'settings'		=> array('title' => 'ACP_SHARE_SETTINGS', 'auth' => 'acl_a_board', 'cat' => array('ACP_SHARE_TOPIC')),
			),
		);
	}

	function install()
	{
	}

	function uninstall()
	{
	}
}

?>