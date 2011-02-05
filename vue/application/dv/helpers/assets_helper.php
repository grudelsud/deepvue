<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('assets_url'))
{
	function assets_url($uri = '')
	{
		$CI =& get_instance();
		return $CI->config->slash_item('base_url').APPPATH.(empty($uri) ? '' : $uri);
	}
}

if ( ! function_exists('object_to_array'))
{
	function object_to_array( $object )
	{
		if( !is_object( $object ) && !is_array( $object ) )
		{
			return $object;
		}
		if( is_object( $object ) )
		{
			$object = get_object_vars( $object );
		}
		return array_map( 'object_to_array', $object );
	}
}

if ( ! function_exists('dv_code'))
{
	function dv_code( $email ) 
	{
		list( $name, $domain ) = explode( "@", $email );
		return substr( md5( $name | $domain ), 0, 4 );
	}
}
/* end of assets_helper.php */