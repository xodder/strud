<?php


namespace Strud\Registry\Driver
{

	use Strud\Registry\Config;
	use Strud\Registry\Driver;
	
	class Session implements Driver
	{
		public function __construct()
		{
			session_start();
		}
		
		public function has($key)
		{
			return !empty($_SESSION[$key]);
		}
		
		public function get($key, $defaultValue = null)
		{
			return $this->has($key) ? $_SESSION[$key] : $defaultValue;
		}

		public function put($key, $value, Config $additionalParams = null)
		{
			$_SESSION[$key] = $value;
		}
		
		public function remove($key)
		{
			unset($_SESSION[$key]);
		}

		public function refresh()
		{
			session_regenerate_id();
		}

		public function clear()
		{
			session_destroy();
			session_gc();
		}
	}
}