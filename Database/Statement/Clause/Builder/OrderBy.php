<?php


namespace Strud\Database\Statement\Clause\Builder
{

	use Strud\Database\Statement\Expression;

	class OrderBy extends ExpressionOriented
	{
		/**
		 * @return string
		 */
		public function build()
		{
			$result = "";
			
			if(!empty($this->expressions))
			{
				$result .= " ORDER BY ";
				
				$generatedExpressions = [];

				/**
				 * @var $expression Expression
				 */
				foreach($this->expressions as $expression)
				{
					$generatedExpressions[] = $expression->generate();
				}
				
				$result .= join(", ", $generatedExpressions);
			}
			
			return $result;
		}
	}
}


