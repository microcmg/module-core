<?php
namespace cmsgears\core\common\utilities;

class UrlUtility {

	public static function getSiteProtocol() {

		//$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,strpos( $_SERVER["SERVER_PROTOCOL"],'/'))).'://';
		$protocol = strtolower( substr( $_SERVER[ 'SERVER_PROTOCOL' ], 0, strpos( $_SERVER[ 'SERVER_PROTOCOL' ], '/' ) ) );

		return $protocol;
	}

}
