<?php
namespace Strud\Application
{
	use Strud\Application;
	use Strud\Request\Method;
	use Strud\Route;

	abstract class UIOrientedApplication extends Application
	{
		public function run()
		{
			if($this->route->hasController())
			{
				$controller = $this->route->getController();
				$controller->run();

				$handler = $this->request->using(Method::POST);

				if($this->request->isAjax() && $handler->get("_target") != Route::VIEW)
				{
					echo $controller->getResponse()->toJSON();

					return;
				}
			}

			if($this->route->hasView())
			{
				echo $this->route->getView()->render();
			}
		}
	}
}
