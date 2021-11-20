<?php


namespace Strud\Router
{

	use Strud\Router\Interpreter\Configuration;
	use Strud\Utils\RegexUtil;
	
	abstract class Interpreter
	{
		protected $configuration;

		public function __construct(Configuration $configuration)
		{
			$this->configuration = $configuration;
		}

		public function understands($url)
		{
			return RegexUtil::match($this->getUrlPatternUnderstood(), $url);
		}

		abstract public function interpret($url);

		/**
		 * @return string
		 * @throws \Exception
		 */
		protected function getUrlPatternUnderstood()
		{
			throw new \Exception("URL Pattern not given for interpreter [" . __CLASS__ . "]");
		}
	}
}


