<?php


namespace Strud\Database\Statement\Clause\Builder
{

	use Strud\Database\Entity\Table;
	use Strud\Database\Statement\Expression;

	class Join extends ExpressionOriented
	{
		public function addExpression(Expression $expression)
		{
			if(!is_a($expression, Expression\Join::class))
			{
				throw new \Exception("a join expression is expected");
			}

			parent::addExpression($expression);
		}

		public function build()
		{
			$statements = [];

			/**
			 * @var $expression Expression
			 */
			foreach($this->expressions as $expression)
			{
				$statements[] = $expression->generate();
			}
			
			return " " . join(" ", $statements);
		}

		public function getTables()
		{
			$tables = [];

			/**
			 * @var $expression Expression\Join
			 */
			foreach($this->expressions as $expression)
			{
				$tables[] = $expression->getTable();
			}

			return $tables;
		}
		
		public function getColumns()
		{
			$columns = [];

			/**
			 * @var $table Table
			 */
			foreach($this->getTables() as $table)
			{
				$columns = array_merge($columns, $table->getColumns());
			}
			
			return $columns;
		}
	}
}


