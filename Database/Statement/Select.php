<?php


namespace Strud\Database\Statement
{
	use Strud\Database\Connection;
	use Strud\Database\Entity\Column;
	use Strud\Database\Statement\Expression;
	use Strud\Database\Entity\Table;
	use Strud\Database\Statement;
	use Strud\Database\Statement\Clause\Builder;

	class Select extends Statement
	{
		private $joinClauseBuilder;
		private $whereClauseBuilder;
		private $groupByClauseBuilder;
		private $orderByClauseBuilder;
		private $limitClauseBuilder;

		public function __construct(Table $table, Connection $connection = null)
		{
			parent::__construct($table, $connection);

			$this->joinClauseBuilder = new Builder\Join($this->table);
			$this->whereClauseBuilder = new Builder\Where();
			$this->groupByClauseBuilder = new Builder\GroupBy();
			$this->orderByClauseBuilder = new Builder\OrderBy();
			$this->limitClauseBuilder = new Builder\Limit();
		}
		
		/**
		 * @param Expression\Join $expression
		 * @return $this
		 */
		public function addJoinExpression(Expression\Join $expression)
		{
			$this->joinClauseBuilder->addExpression($expression);
			
			return $this;
		}
		
		
		/**
		 * @param Expression\Comparision $expression
		 * @return $this
		 */
		public function addWhereExpression(Expression\Comparision $expression)
		{
			$this->whereClauseBuilder->addExpression($expression);
			
			return $this;
		}
		
		/**
		 * @param Expression $expression
		 * @return $this
		 */
		public function addGroupByExpression(Expression $expression)
		{
			$this->groupByClauseBuilder->addExpression($expression);
			
			return $this;
		}
		
		/**
		 * @param Expression\Comparision $expression
		 * @return $this
		 */
		public function setHavingExpression(Expression\Comparision $expression)
		{
			$this->groupByClauseBuilder->setHavingExpression($expression);
			
			return $this;
		}
		
		/**
		 * @param Expression $expression
		 * @return $this
		 */
		public function addOrderByExpression(Expression $expression)
		{
			$this->orderByClauseBuilder->addExpression($expression);
			
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
			$statement .= "SELECT ";
			$statement .= $this->getColumnsWithQualifiedName();
			$statement .= " FROM ";
			$statement .= $this->table->getQualifiedNameWithAlias();
			$statement .= $this->joinClauseBuilder->build();
			$statement .= $this->whereClauseBuilder->build();
			$statement .= $this->groupByClauseBuilder->build();
			$statement .= $this->orderByClauseBuilder->build();
			$statement .= $this->limitClauseBuilder->build();

			return $statement;
		}
		
		private function getColumnsWithQualifiedName()
		{
			$columns = array_merge($this->table->getColumns(), $this->joinClauseBuilder->getColumns());
			
			$columnsWithQualifiedName = [];

			/**
			 * @var $column Column
			 */
			foreach($columns as $column)
			{
				$columnsWithQualifiedName[] = $column->getQualifiedNameWithAlias();
			}

			return join(", ", $columnsWithQualifiedName);
		}
	}
}


