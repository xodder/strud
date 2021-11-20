<?php


namespace Strud\Route\Component
{

	use Strud\Route\Component;

	abstract class View extends Component
	{
		/**
		 * @var Model
		 */
		protected $model;
		
		public function __construct($model)
		{
			$this->model = $model;

			$this->init();
		}

		protected function init()
		{

		}
		
		/**
		 * @return string
		 */
		abstract public function render();
	}
}


