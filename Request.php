<?php


namespace Strud
{
	
	use Strud\Request\Handler;
	use Strud\Request\Method;
	
	class Request
	{
		private static $instance;
		
		/**
		 * @return Request
		 */
		public static function getInstance()
		{
		    if(!static::$instance)
		    {
		        static::$instance = new static();
		    }
		    
		    return static::$instance;
		}
		
		private function __construct()
		{
		    
		}
		
		/**
		 * @param $method
		 * @return Handler
		 */
		public function using($method)
		{
			return new Handler($method);
		}
		
		public function isAjax()
		{
			return $this->using(Method::ANY)->has("_ajax");
		}
		
		public function getCurrentLocation()
		{
			return $_SERVER["REQUEST_URI"];
		}
		
		public function getPreviousLocation()
		{
			return $_SERVER["HTTP_REFERRER"];
		}
		
		public function getActualType()
		{
			return $_SERVER["REQUEST_METHOD"];
		}
		
	}
}