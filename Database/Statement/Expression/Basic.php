<?php


namespace Strud\Database\Statement\Expression
{
	
	use Strud\Database\Statement\Expression;
	
	class Basic implements Expression
	{
		private $values;
		
		public function __construct(...$values)
		{
			$this->values = $values;
		}
		
		public function generate()
		{
			return join(" ", $this->values);
		}
	}
}


