<?php
/**
 * Created by PhpStorm.
 * User: Benjamin
 * Date: 2017-09-22
 * Time: 11:23 AM
 */
namespace Strud
{

	use Strud\Autoloader\Module;

	class Autoloader
	{
		private $modules;

		public function __construct()
		{
			$this->modules = new \ArrayObject();
		}

		public function register(Module $module)
		{
			$this->modules->append($module);
		}

		public function run()
		{
			foreach($this->modules as $module)
			{
				$module->run();
			}
		}
	}
}
