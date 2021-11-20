<?php


namespace Strud\Database\Statement\Clause\Builder
{

	use Strud\Database\Statement\Expression;

	class Where extends ExpressionOriented
	{
		/**
		 * @return string
		 */
		public function build()
		{
			$result = "";
			
			if(!empty($this->expressions))
			{
				$result .= " WHERE ";

				/**
				 * @var $expression Expression
				 */
				foreach($this->expressions as $index => $expression)
				{
					if($index > 0)
					{
						$result .= " ";
						$result .= $this->getConjunction($expression);
						$result .= " ";
					}
					
					$result .= $expression->generate();
				}
			}
			
			return $result;
		}

		/**
		 * @param Expression | Expression\Comparision $expression
		 * @return string
		 */
		private function getConjunction(Expression $expression)
		{
			if(is_a($expression, Expression\Comparision::class))
			{
				return $expression->getType();
			}

			return Expression\Comparision::TYPE_AND;
		}
	}
}


