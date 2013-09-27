<?php
/***************************************************************************
 *  For license information see doc/license.txt
 *
 *  Unicode Reminder メモ
 ***************************************************************************/

/* check if cache is listed at cachelab.net
 *
 * This function required $opt['logic']['cachelab']['url'] and 
 * $opt['logic']['cachelab']['key'] to be set; if not, false is returned.
 * 
 * parameters
 *   wp    ... waypoint of cache
 * 
 * return value
 *   true  ... cache is listed
 *   false ... cache is not listed
 */
function cachelab_check($wp)
{
	global $opt;
	
	if (isset($opt['logic']['cachelab']['url']) && isset($opt['logic']['cachelab']['key']))
	{
		$url = $opt['logic']['cachelab']['url'];
		$key = $opt['logic']['cachelab']['key'];
		
		$data = array(
			'apikey' => $key, 
			'gcid' => $wp,
		);
		
		$options = array(
			'http' => array(
				'header'  => "Content-type: application/x-www-form-urlencoded; charset=utf-8\r\n",
				'method'  => 'POST',
				'timeout' => 5,
				'content' => http_build_query($data,'','&'),
			),
		);
		
		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
		if ($result === false)
		{
			return false;
		} 
		else
		{
			return $result != "0";
		} 
	}
	else
	{
		return false;
	}
}
?>
