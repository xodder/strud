<?php


namespace Strud\Database
{
	class Result
	{
		/**
		 * @var \PDOStatement
		 */
		private $statement;
		
		public function __construct(\PDOStatement $statement)
		{
			$this->statement = $statement;
		}

		/**
		 * @param null $class
		 * @return mixed
		 * @throws ItemNotFoundException
		 */
		public function fetch($class = null)
		{
			$result = $class ? $this->statement->fetchObject($class) : $this->statement->fetch(\PDO::FETCH_ASSOC);

			if (empty($result))
			{
				throw new ItemNotFoundException();
			}

			return $result;
		}
		
		public function fetchAll($class = null)
		{
			if($class)
			{
				return $this->statement->fetchAll(\PDO::FETCH_CLASS, $class);
			}
			
			return $this->statement->fetchAll(\PDO::FETCH_ASSOC);
		}
		
		public function getLength()
		{
			return $this->statement->rowCount();
		}
	}
}


