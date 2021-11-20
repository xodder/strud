<?php


namespace Strud\Database\Statement\Expression\Join
{
	
	use Strud\Database\Statement\Expression;
	
	class On implements Expression
	{
		private $firstColumnName;
		private $operator;
		private $secondColumnName;
		
		public function __construct($firstColumnName, $operator, $secondColumnName)
		{
			$this->firstColumnName = $firstColumnName;
			$this->operator = $operator;
			$this->secondColumnName = $secondColumnName;
		}
		
		public function generate()
		{
			return "ON " . $this->firstColumnName . " " . $this->operator . " " . $this->secondColumnName;
		}
	}
}


