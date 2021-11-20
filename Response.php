<?php


namespace Strud
{
	
	use Strud\Collection\ArrayMap;
	
	class Response
	{
		/**
		 * @var Response
		 */
		private static $instance;
		
		/**
		 * @var ArrayMap
		 */
		private $entries;
		
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
		    $this->entries = new ArrayMap();
		}

		public function merge(array $data)
		{
			foreach($data as $key => $value)
			{
				$this->entries->put($key, $value);
			}

			return $this;
		}
		
		/**
		 * @param $key
		 * @param $value
		 * @return $this
		 */
		public function put($key, $value)
		{
			$this->entries->put($key, $value);
			
			return $this;
		}
		
		/**
		 * @param $key
		 * @return $this
		 */
		public function remove($key)
		{
			$this->entries->remove($key);
			
			return $this;
		}
		
		public function toJSON()
		{
			return json_encode($this->entries->getSource());
		}
	}
}


