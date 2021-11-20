<?php
/**
 * Created by PhpStorm.
 * User: Benjamin
 * Date: 2017-09-26
 * Time: 10:46 AM
 */
namespace Strud\Database\Exception
{

	use Strud\Database\Connection;
	use Strud\Database\Exception;

	class Handler
	{
		public function handle(Exception $exception, Connection $connection)
		{
			echo $exception->getMessage();
		}
	}
}
