<?php


namespace Strud\Registry\Driver
{

	use Strud\Registry\Config;
	use Strud\Registry\Driver;
	
	class Cookie implements Driver
	{
		public function has($key)
		{
			return !empty($_COOKIE[$key]);
		}
		
		public function get($key, $defaultValue = null)
		{
			return $this->has($key) ? $_COOKIE[$key] : $defaultValue;
		}
		
		public function put($key, $value, Config $additionalParams = null)
		{
			setcookie(
				$key,
				$value,
				$additionalParams->getExpiryTime(),
				$additionalParams->getPath(),
				$additionalParams->getDomain(),
				$additionalParams->isRestrictAccessToHttpsProtocolOnly(),
				$additionalParams->isAccessibleToScriptingLanguages()
			);
		}
		
		public function remove($key)
		{
			unset($_COOKIE[$key]);
		}

		public function refresh()
		{

		}

		public function clear()
		{

		}
	}
}


