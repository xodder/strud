<?php
/**
 * Created by PhpStorm.
 * User: Stephen
 * Date: 2018-12-07
 * Time: 7:13 AM
 */

namespace Strud\Database
{
	class ItemNotFoundException extends Exception
	{
		protected $message = "Item not found in database";
	}
}
