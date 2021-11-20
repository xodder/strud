<?php


namespace Strud\Route
{

	abstract class Component
	{
		public function __get($name)
		{
			return call_user_func(array($this, "get" . ucfirst($name)));
		}
		
		public function __set($name, $value)
		{
			return call_user_func(array($this, "set" . ucfirst($name)), $value);
		}
		
		public function __call($method, $arguments)
		{
			$startsWith = function($word) use ($method) {
				return strncmp($word, $method, strlen($word)) == 0;
			};

			$property = preg_replace("/^(?:get|set)/", "", $method);

			if(property_exists($this, $property))
			{
				if($startsWith("get"))
				{
					return $this->{$property};
				}

				if($startsWith("set"))
				{
					return $this->{$property} = $arguments[0];
				}
			}

			throw new \BadMethodCallException();
		}
	}
}


