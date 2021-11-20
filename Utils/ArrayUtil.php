<?php


namespace Strud\Utils
{
	class ArrayUtil
	{
		public static function isEmpty(array $array)
		{
			return empty($array);
		}
		
		public static function join(array $firstArray, array $secondArray)
		{
			return array_merge($firstArray, $secondArray);
		}
		
		public static function quote(array $values)
		{
			return array_map(function($value) {
				return StringUtil::quote($value);
			}, $values);
		}
	}
}


