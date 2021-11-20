<?php
namespace Strud\Application
{

	use Strud\Application;

	abstract class APIOrientedApplication extends Application
	{
		public function run()
		{
			header("Access-Control-Allow-Origin: *");

			if($this->request->getActualType() === "OPTIONS")
			{
				$this->handlePreflight();
				return;
			}

			if($this->route->hasController())
			{
				$controller = $this->route->getController();
				$controller->run();

				header("Content-Type: text/json");
				echo $controller->getResponse()->toJSON();
			}
		}

		private function handlePreflight()
		{
			header("Access-Control-Allow-Methods: POST, DELETE, GET");
			header("Access-Control-Allow-Credentials: true");
			header("Access-Control-Allow-Headers: Content-Type, X-Requested-With, Cache-Control");
		}
	}
}
