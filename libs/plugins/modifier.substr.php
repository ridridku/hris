<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */

/**
 * Smarty substr modifier plugin
 *
 * Type:     modifier<br>
 * Name:     substr<br>
 * Purpose:  -
 * by: 			web_lesson@yahoo.com
 * website: abbahatun.com
 */

function smarty_modifier_substr($string, $start=0,$length=50)
{
	return(substr($string,$start,$length));	
}

/* vim: set expandtab: */
?>