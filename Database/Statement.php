<?php


namespace Strud\Database
{

	use Strud\Database\Entity\Table;
	use Strud\Database\Exception\Handler;

	abstract class Statement
	{
		private $handler;

		/**
		 * @var Table
		 */
		protected $table;

		/**
		 * @param Connection
		 */
		protected $connection;
		
		public function __construct(Table $table, Connection $connection = null)
		{
			$this->table = $table;
			$this->connection = $connection;
			$this->handler = new Handler();
			$this->init();
		}

		protected function init()
		{

		}
		
		abstract function generate();
		
		/**
		 * @return Result
		 */
		public function execute()
		{
			return $this->connection->execute($this->generate());
		}
	}
}


