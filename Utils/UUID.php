<?php
namespace Strud\Utils
{
	class UUID
	{
		/**
		 * Creates a UUID v4 as per RFC 4122
		 *
		 * The UUID contains 128 bits of data (where 122 are random), i.e. 36 characters
		 *
		 * @return string the UUID
		 * @author Jack @ Stack Overflow
		 */
		public static function get()
		{
			$data = openssl_random_pseudo_bytes(16);

			// set the version to 0100
			$data[6] = chr(ord($data[6]) & 0x0f | 0x40);
			// set bits 6-7 to 10
			$data[8] = chr(ord($data[8]) & 0x3f | 0x80);

			return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
		}
	}
}
