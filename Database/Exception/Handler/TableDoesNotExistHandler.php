<?php
/**
 * Created by PhpStorm.
 * User: Benjamin
 * Date: 2017-09-26
 * Time: 10:49 AM
 */
namespace Strud\Database\Exception\Handler
{

	use Strud\Database\Connection;
	use Strud\Database\Exception\TableDoesNotExistException;

	class TableDoesNotExistHandler
	{
		public function handle(TableDoesNotExistException $exception, Connection $connection)
		{

		}
	}
}
