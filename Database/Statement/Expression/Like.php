<?php


namespace Strud\Database\Statement\Expression
{

	class Like extends Comparision
	{
		public function __construct($column, $pattern, $type = self::TYPE_AND)
		{
			parent::__construct($column, "LIKE", $pattern, $type);
		}
	}
}