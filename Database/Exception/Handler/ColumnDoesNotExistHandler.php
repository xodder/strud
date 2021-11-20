<?php
/**
 * Created by PhpStorm.
 * User: Benjamin
 * Date: 2017-09-26
 * Time: 10:51 AM
 */
namespace Strud\Database\Exception\Handler
{

	use Strud\Database\Connection;
	use Strud\Database\Exception\TableDoesNotExistException;

	class ColumnDoesNotExistHandler
	{
		public function handle(TableDoesNotExistException $exception, Connection $connection)
		{

		}
	}
}
