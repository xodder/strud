<?php


namespace Strud
{
	
	use Strud\Collection\ArrayMap;
	use Strud\Registry\Config;
	use Strud\Registry\Driver;
	
	class Registry
	{
		/**
		 * @var Registry
		 */
		private static $instance;
		
		/**
		 * @var ArrayMap
		 */
		protected $drivers;
		
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
			$this->initialize();
		}
		
		private function initialize()
		{
			$this->drivers = new ArrayMap();
			$this->drivers->put("session", new Driver\Session());
			$this->drivers->put("cookie", new Driver\Cookie());
		}
		
		public function has($key)
		{
			return $this->drivers->get("session")->has($key) || $this->drivers->get("cookie")->has($key);
		}
		
		public function get($key, $defaultValue = null)
		{
			if($this->drivers->get("session")->has($key))
			{
				return $this->drivers->get("session")->get($key);
			}
			elseif($this->drivers->get("cookie")->has($key))
			{
				return $this->drivers->get("cookie")->get($key);
			}
			else
			{
				return $defaultValue;
			}
		}

		public function put($key, $value, $persistent = false, Config $additionalParams = null)
		{
			if(empty($additionalParams))
			{
				$additionalParams = new Config();
			}

			if($persistent)
			{
				$this->drivers
					->get("cookie")
					->put($key, $value, $additionalParams);
			}
			else
			{
				$this->drivers
					->get("session")
					->put($key, $value, $additionalParams);
			}
		}
		
		public function remove($key)
		{
			$this->drivers->get("session")->remove($key);
			$this->drivers->get("cookie")->remove($key);
		}

		public function refresh()
		{
			$this->drivers->get("session")->refresh();
			$this->drivers->get("cookie")->refresh();
		}

		public function clear()
		{
			$this->drivers->get("session")->clear();
			$this->drivers->get("cookie")->clear();
		}
	}
}


