<?php

namespace Strud
{
	use Strud\Request\Method;
	use Strud\Route\Component\Controller;
	use Strud\Route\Component\NullModel;
	use Strud\Router\Exception\RouteNotFoundException;

	abstract class Application extends Controller
	{
		/**
		 * @var Application
		 */
		protected static $instance;

		/**
		 * @var Route
		 */
		protected $route;
		
		public static function getInstance()
		{
		    if(!static::$instance)
		    {
		        static::$instance = new static();
		    }
		    
		    return static::$instance;
		}
		
		public function __construct()
		{
			parent::__construct(new NullModel());

			$this->initializeRoute();
		}

		private function initializeRoute()
		{
			$router = $this->createRouter();

			try
			{
				$this->route = $router->find($this->getURL());
			}
			catch(RouteNotFoundException $exception)
			{
				$this->route = $router->find($this->getTheURLToUseWhenNoRouteIsFound());
			}
		}

		/**
		 * @return Router
		 */
		abstract protected function createRouter();

		private function getURL()
		{
			$handler = $this->request->using(Method::GET);

			return $handler->get("url", "index");
		}

		abstract protected function getTheURLToUseWhenNoRouteIsFound();
	}
}

