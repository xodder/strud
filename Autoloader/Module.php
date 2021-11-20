<?php
/**
 * Created by PhpStorm.
 * User: Benjamin
 * Date: 2017-09-22
 * Time: 11:24 AM
 */
namespace Strud\Autoloader
{

	class Module
	{
		private $prefix;
		private $rootDirectory;

		public function __construct($prefix, $rootDirectory)
		{
			$this->prefix = $prefix;
			$this->rootDirectory = $rootDirectory;
		}

		public function run()
		{
			spl_autoload_register(array(__CLASS__, 'autoload'));
		}

		private function autoload($class)
		{
			$hasPrefix = strncmp($this->prefix, $class, strlen($this->prefix)) == 0;

			if(!$hasPrefix && !$this->isGlobal())
			{
				return;
			}

			$separator = "/\\\|_/";

			if(!$this->isGlobal())
			{
				$class = preg_replace("/^$this->prefix/", "", $class);
			}

			$fragments = array_filter(preg_split($separator, $class));

			$classPath = join(DIRECTORY_SEPARATOR, $fragments);

			$filePath = "";
			$filePath .= rtrim($this->rootDirectory, DIRECTORY_SEPARATOR);
			$filePath .= DIRECTORY_SEPARATOR;
			$filePath .= $classPath;
			$filePath .= ".php";

			if(file_exists($filePath))
			{
				require $filePath;
			}
		}

		private function isGlobal()
		{
			return $this->prefix == "*";
		}
	}
}
