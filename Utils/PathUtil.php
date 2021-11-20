<?php
/**
 * Created by PhpStorm.
 * User: Benjamin
 * Date: 2017-09-24
 * Time: 1:20 PM
 */
namespace Strud\Utils
{
	class PathUtil
	{
		public static function sanitize($fragment)
		{
			return ucfirst(StringUtil::toCamelCase($fragment));
		}
	}
}
