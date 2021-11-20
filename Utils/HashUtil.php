<?php
namespace Strud\Utils
{
	class HashUtil
	{
		const DEFAULT_WORK_FACTOR = 12;
		const DEFAULT_IDENTIFIER = '2y';
		const VALID_HASH_IDENTIFIERS = ['2a', '2x', '2y'];

		public static function getHash($value, $workFactor = 0)
		{
			return crypt($value, self::generateSalt($workFactor));
		}

		public static function equals($value, $hash)
		{
			return self::isValid($hash) && (crypt($value, $hash) === $hash);
		}

		private static function isValid($hash)
		{
			return in_array(substr($hash, 1, 2), self::VALID_HASH_IDENTIFIERS);
		}

		private static function generateSalt($workFactor)
		{
			if($workFactor < 4 || $workFactor > 31)
			{
				$workFactor = self::DEFAULT_WORK_FACTOR;
			}

			$input = self::generateRandomBytes();

			$salt = '$' . self::DEFAULT_IDENTIFIER . '$';
			$salt .= str_pad($workFactor, 2, '0', STR_PAD_LEFT);
			$salt .= '$';
			$salt .= substr(strtr(base64_encode($input), '+', '.'), 0, 22);

			return $salt;
		}

		private static function generateRandomBytes()
		{
			if(!function_exists('openssl_random_pseudo_bytes'))
			{
//				throw new Exception('Unsupported hash format.');
			}

			return openssl_random_pseudo_bytes(16);
		}
	}
}