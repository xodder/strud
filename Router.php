<?php


namespace Strud
{

	use ArrayObject;
	use Strud\Router\Exception\RouteNotFoundException;
	use Strud\Router\Interpreter;

	class Router
	{
		/**
		 * @var ArrayObject
		 */
		private $interpreters;
		
		public function __construct()
		{
			$this->interpreters = new ArrayObject();
		}
		
		/**
		 * @param Interpreter $interpreter
		 */
		public function register($interpreter)
		{
			$this->interpreters->append($interpreter);
		}

		/**
		 * @param $url
		 * @return Route
		 * @throws \Exception
		 */
		public function find($url)
		{
			foreach($this->interpreters as $interpreter)
			{
				if($interpreter->understands($url))
				{
					$route = $interpreter->interpret($url);

					if(!empty($route))
					{
						return $route;
					}
				}
			}

			throw new RouteNotFoundException("Route with url ({ $url }) not found");
		}
	}
}

