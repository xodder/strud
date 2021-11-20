<?php


namespace Strud\Utils
{
	class DateUtil
	{
		public static function getCurrentDate($format = 'Y-m-d')
		{
			return (new \DateTime())->format($format);
		}
		
		public static function getCurrentDateWithTime()
		{
			return self::getCurrentDate('Y-m-d H:i:s');
		}

		public static function getCurrentDateInMilliseconds()
		{
			return time() * 1000;
		}
	}
}


