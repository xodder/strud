<?php


namespace Strud\Database\Engine
{
	
	use Strud\Database\Configuration;
	use Strud\Database\Engine;
	use Strud\Database\Exception;
	use Strud\Database\Result;

	class SQL implements Engine
	{
		/**
		 * @var \PDO
		 */
		private $driver;
		
		public function __construct(Configuration $configuration)
		{
			$dsn = "mysql:dbname={$configuration->getDatabase()};host={$configuration->getHost()}";

			$this->driver = new \PDO($dsn, $configuration->getUsername(), $configuration->getPassword());
			$this->driver->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		}

		/**
		 * @param $statement
		 * @return Result
		 * @throws Exception
		 * @throws Exception\ColumnDoesNotExistException
		 * @throws Exception\TableDoesNotExistException
		 */
		public function execute($statement)
		{
			try
			{
				return new Result($this->driver->query($statement));
			}
			catch(\PDOException $exception)
			{
				$errorInfo = $this->driver->errorInfo();

				switch($errorInfo[0])
				{
					case "42S02":
						throw new Exception\TableDoesNotExistException($errorInfo[2]);
					case "42S22":
						throw new Exception\ColumnDoesNotExistException($errorInfo[2]);
					default:
						throw new Exception($errorInfo[2], $errorInfo[0]);
				}
			}
		}
		
		/**
		 * @param $value
		 * @return string
		 */
		public function quote($value)
		{
			return $this->driver->quote($value);
		}
		
		public function beginTransaction()
		{
			$this->driver->beginTransaction();
		}
		
		public function endTransaction()
		{
			$this->driver->commit();
		}
		
		public function rollbackTransaction()
		{
			$this->driver->rollBack();
		}
		
		public function getLastInsertId()
		{
			return $this->driver->lastInsertId();
		}
	}
}


