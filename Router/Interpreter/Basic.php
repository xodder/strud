<?php


namespace Strud\Router\Interpreter
{

	use Strud\Router\Interpreter;
	use Strud\Route\Path\Explorer as PathExplorer;
	use Strud\Router\Interpreter\Helper\PathHelper;

	class Basic extends Interpreter
	{
		public function interpret($url)
		{
			$explorer = new PathExplorer($this->getPathFromURL($url));

			if($explorer->isValid())
			{
				return $explorer->generateRoute();
			}

			return null;
		}

		public function getPathFromURL($url)
		{
			return PathHelper::createFromURL($url, $this->configuration);
		}

		protected function getUrlPatternUnderstood()
		{
			return "/.+/";
		}
	}
}


