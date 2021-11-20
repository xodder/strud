<?php


namespace Strud\Registry
{
	interface Driver
	{
		public function has($key);
		public function get($key, $defaultValue = null);
		public function put($key, $value, Config $additionalParams = null);
		public function remove($key);
		public function refresh();
		public function clear();
	}
}


