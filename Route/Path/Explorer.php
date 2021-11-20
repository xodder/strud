<?php
namespace Strud\Route\Path
{

	use Strud\Route;
	use Strud\Route\Component\NullController;
	use Strud\Route\Component\NullModel;
	use Strud\Route\Component\NullView;
	use Strud\Route\Path;

	class Explorer
	{
		private $path;

		public function __construct(Path $path)
		{
			$this->path = $path;
		}

		public function isValid()
		{
			return $this->hasController() || $this->hasView();
		}

		public function generateRoute()
		{
			$model = $this->createModel();
			$controller = $this->createController($model);
			$view = $this->createView($model);

			return new Route($view, $controller);
		}

		protected function createModel()
		{
			if($this->hasModel())
			{
				$modelClass = $this->getModelClass();

				return new $modelClass($this->path->getParameters());
			}

			return new NullModel();
		}

		protected function createController($model)
		{
			if($this->hasController())
			{
				$controllerClass = $this->getControllerClass();

				return new $controllerClass($model, $this->path->getParameters());
			}

			return new NullController();
		}

		protected function createView($model)
		{
			if($this->hasView())
			{
				$viewClass = $this->getViewClass();

				return new $viewClass($model);
			}

			return new NullView();
		}

		public function hasModel()
		{
			return class_exists($this->getModelClass());
		}

		public function hasController()
		{
			return class_exists($this->getControllerClass());
		}

		public function hasView()
		{
			return class_exists($this->getViewClass());
		}

		protected function getModelClass()
		{
			return join(Path::NAMESPACE_SEPARATOR, [ $this->path->getPinnedNamespace(), "Model" ]);
		}

		protected function getControllerClass()
		{
			return join(Path::NAMESPACE_SEPARATOR, [ $this->path->getNamespace(), "Controller" ]);
		}

		protected function getViewClass()
		{
			return join(Path::NAMESPACE_SEPARATOR, [ $this->path->getNamespace(), "View" ]);
		}
	}
}
