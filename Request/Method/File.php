<?php


namespace Strud\Request\Method
{
	
	use Strud\Request\Method;
	
	class File extends Method
	{
		private static $instance;
		
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
		
		public function has($property)
		{
			return !empty($_FILES[$property]);
		}
		
		public function get($property, $defaultValue = [])
		{
			return $this->has($property) ? $this->normalize($_FILES[$property]) : $defaultValue;
		}

		private function normalize($file)
		{
			$isMultiple = is_array($file['name']);

			if ($isMultiple)
			{
				$files = [];
				$length = count($file['name']);
				$keys = array_keys($file);

				for($i = 0; $i < $length; $i++)
				{
					$files[$i] = [];

					foreach($keys as $key)
					{
						$files[$i][$key] = $file[$key][$i];
					}
				}

				return $files;
			}
			else
			{
				return $file;
			}

		}

		public function getSource()
		{
			return $_POST;
		}
	}
}


