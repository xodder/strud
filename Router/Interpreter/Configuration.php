<?php
namespace Strud\Router\Interpreter
{
	class Configuration
	{
		private $rootFolder;
		private $defaultRouteAction;

		public function getRootFolder()
		{
			return $this->rootFolder;
		}

		/**
		 * @param $name string
		 * @return Configuration
		 */
		public function setRootFolder($name)
		{
			$this->rootFolder = $name;

			return $this;
		}

		public function getDefaultRouteAction()
		{
			return $this->defaultRouteAction;
		}

		/**
		 * @param $value string
		 * @return Configuration
		 */
		public function setDefaultRouteAction($value)
		{
			$this->defaultRouteAction = $value;

			return $this;
		}
	}
}
