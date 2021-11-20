<?php


namespace Strud\Route\Component
{

	use Strud\Collection\ArrayList;
	use Strud\Registry;
	use Strud\Request;
	use Strud\Response;
	use Strud\Route\Component;

	abstract class Controller extends Component
	{
		/**
		 * @var ArrayList
		 */
		protected $parameters;
		
		/**
		 * @var Model
		 */
		protected $model;
		
		/**
		 * @var Request
		 */
		protected $request;
		
		/**
		 * @var Response
		 */
		protected $response;
		
		/**
		 * @var Registry
		 */
		protected $registry;
		
		public function __construct($model, ArrayList $parameters = null)
		{
			$this->model = $model;
			$this->parameters = $parameters ? $parameters : new ArrayList();
			$this->request = Request::getInstance();
			$this->registry = Registry::getInstance();
			$this->response = Response::getInstance();
			
			$this->init();
		}

		protected function init()
		{

		}
		
		abstract public function run();
		
		/**
		 * @return Response
		 */
		public function getResponse()
		{
			return $this->response;
		}
	}
}


