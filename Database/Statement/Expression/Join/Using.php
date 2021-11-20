<?php


namespace Strud\Database\Statement\Expression\Join
{

	use Strud\Database\Statement\Expression;

	class Using implements Expression
	{
		/**
		 * @var array
		 */
		private $columns;
		
		public function __construct($columnName, ... $columns)
		{
		    $this->columns[] = $columnName;
			
			if(!empty($columns))
			{
				array_merge($this->columns, $columns);
			}
		}
		
		public function generate()
		{
			return "USING" . "(" . join(", ", $this->columns) . ")";
		}
	}
}


