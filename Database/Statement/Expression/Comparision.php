<?php


namespace Strud\Database\Statement\Expression
{
	
	use Strud\Database\Statement\Expression;
	use Strud\Utils\StringUtil;
	
	class Comparision implements Expression
	{
		const TYPE_AND = "AND";
		const TYPE_OR = "OR";
		
		protected $column;
		protected $criteria;
		protected $value;
		protected $type;
		
		public function __construct($column, $criteria, $value, $type = self::TYPE_AND)
		{
			$this->column = $column;
			$this->criteria = $criteria;
			$this->value = $value;
			$this->type = $type;
		}
		
		public function generate()
		{
			return "{$this->column} {$this->criteria} " . StringUtil::quote($this->value);
		}
		
		/**
		 * @return string
		 */
		public function getType()
		{
			return $this->type;
		}
	}
}


