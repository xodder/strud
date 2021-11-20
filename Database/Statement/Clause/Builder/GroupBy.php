<?php


namespace Strud\Database\Statement\Clause\Builder
{

	use Strud\Database\Statement\Expression;

	class GroupBy extends ExpressionOriented
	{
		/**
		 * @var Expression
		 */
		protected $havingExpression;

		public function setHavingExpression(Expression $expression)
		{
			$this->havingExpression = $expression;
		}
		
		/**
		 * @return string
		 */
		public function build()
		{
			$result = "";
			
			if(!empty($this->expressions))
			{
				$result .= " GROUP BY ";
				
				$generatedExpressions = [];

				/**
				 * @var $expression Expression
				 */
				foreach($this->expressions as $expression)
				{
					$generatedExpressions[] = $expression->generate();
				}

				$result .= join(", ", $generatedExpressions);

				if($this->havingExpression)
				{
					$result .= " HAVING ";
					$result .= $this->havingExpression->generate();
				}
			}
			
			return $result;
		}
	}
}


