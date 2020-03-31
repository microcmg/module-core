<?php
namespace cmsgears\core\common\utilities;

class MathUtility {

	public static function getBytes( $val ) {

		$val = trim( $val );

		$last = strtolower( substr( $val, -1 ) );

		if( $last == 'g' ) {

			$val = $val*1024*1024*1024;
		}
		else if( $last == 'm' ) {

			$val = $val*1024*1024;
		}
		else if( $last == 'k' ) {

			$val = $val*1024;
		}

		return $val;
	}

}
