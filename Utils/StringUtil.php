<?php


namespace Strud\Utils
{
	class StringUtil
	{
		public static function toCamelCase($value)
		{
			$separators = "/[\\s\\\_\\-]+/";

			if(!empty(RegexUtil::match($separators, $value)))
			{
				$fragments = preg_split($separators, $value);

				return array_shift($fragments) . join(array_map("ucfirst", $fragments));
			}

			return $value;
		}

		public static function quote($value)
		{
			return is_string($value) ? "'" . addslashes($value) . "'" : (($value) ? $value : "''");
		}

		public static function getRandom($length = 8)
		{
			$values = array_merge(range('A', 'Z'), range(0, 9));
			$valuesLength = count($values);

			$result = "";

			for($i = 0; $i < $length; $i++)
			{
				$result .= strval($values[rand(0, $valuesLength - 1)]);
			}

			return $result;
		}

	}
}