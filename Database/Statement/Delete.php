<?php


namespace Strud\Database\Statement
{

	use Strud\Database\Statement;
	use Strud\Database\Statement\Clause\Builder;

	class Delete extends Statement
	{
		/**
		 * @var Builder\Where
		 */
		private $whereClauseBuilder;
		/**
		 * @var Builder\Limit
		 */
		private $limitClauseBuilder;

		protected function init()
		{
			$this->whereClauseBuilder = new Builder\Where();
			$this->limitClauseBuilder = new Builder\Limit();
		}

		/**
		 * @param Expression $expression
		 * @return $this
		 */
		public function addWhereExpression(Expression $expression)
		{
			$this->whereClauseBuilder->addExpression($expression);

			return $this;
		}

		/**
		 * @param $limit
		 * @return $this
		 */
		public function setLimit($limit)
		{
			$this->limitClauseBuilder->setLimit($limit);

			return $this;
		}

		/**
		 * @param $offset
		 * @return $this
		 */
		public function setOffset($offset)
		{
			$this->limitClauseBuilder->setOffset($offset);

			return $this;
		}
		
		public function generate()
		{
			$statement = "";
			
			$statement .= "DELETE FROM ";
			$statement .= $this->table->getQualifiedNameWithAlias();
			$statement .= $this->whereClauseBuilder->build();
			$statement .= $this->limitClauseBuilder->build();
			
			return $statement;
		}
	}
}


