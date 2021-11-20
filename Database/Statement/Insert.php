<?php


namespace Strud\Database\Statement
{

	use Strud\Collection\ArrayMap;
	use Strud\Database\Connection;
	use Strud\Database\Entity\Table;
	use Strud\Database\Statement;
	use Strud\Utils\StringUtil;

	class Insert extends Statement
	{
		/**
		 * @var ArrayMap
		 */
		private $columnToValueMap;


		public function __construct(Table $table, Connection $connection = null)
		{
			parent::__construct($table, $connection);
			$this->columnToValueMap = new ArrayMap();
		}

		/**
		 * @param $columnName
		 * @param $value
		 * @return $this
		 */
		public function addValue($columnName, $value)
		{
			$this->columnToValueMap->put($columnName, $value);

			return $this;
		}
		
		public function generate()
		{
			$statement = "";
			
			$statement .= "INSERT INTO ";
			$statement .= $this->table->getQualifiedNameWithoutAlias();
			$statement .= " ";
			$statement .= $this->buildColumnString();
			$statement .= " VALUES ";
			$statement .= $this->buildValuesString();
			
			return $statement;
		}
		
		private function buildColumnString()
		{
			return "(" . join(", ", $this->columnToValueMap->getKeys()) . ")";
		}
		
		private function buildValuesString()
		{
			return "(" . join(", ", $this->getSanitizedColumnValues()) . ")";
		}

		private function getSanitizedColumnValues()
		{
			$sanitize = function($value) {
				return StringUtil::quote($value);
			};

			return array_map($sanitize, $this->columnToValueMap->getValues());
		}
	}
}


