<?php


namespace Strud\Route\Component
{

	use Strud\Collection\ArrayList;
	use Strud\Route\Component;

	abstract class Model extends Component
	{
		/**
		 * @var ArrayList
		 */
		protected $parameters;
		
		public function __construct($parameters = null)
		{
			$this->parameters = $parameters ? $parameters : new ArrayList();
			
			if(!$this->parameters->isEmpty())
			{
				$this->fetch();
			}
		}

		public function exists()
		{
			throw new \BadMethodCallException("exists() is not overridden by the class");
		}
		
		public function save()
		{
			throw new \BadMethodCallException("save() is not overridden by the class");
		}
		
		public function delete()
		{
			throw new \BadMethodCallException("delete() is not overridden by the class");
		}
		
		public function fetch()
		{
			throw new \BadMethodCallException("fetch() is not overridden by the class");
		}

		public function refresh()
		{
			throw new \BadMethodCallException("refresh() is not overridden by the class");
		}
		
		public function toArray(array $propertiesToExclude = [])
		{
			$propertiesToExclude[] = "parameters";

			$properties = array_diff_key(get_object_vars($this), array_flip($propertiesToExclude));

			return $this->toJSON($properties);
		}

		private function toJSON(array $properties)
		{
			if(empty($properties))
			{
				return [];
			}

			$result = [];

			foreach($properties as $property => $value)
			{
				$getterFunc = 'get' . ucfirst($property);
				$actualValue = method_exists($this, $getterFunc) ? call_user_func(array($this, $getterFunc)) : $value;

				if(is_object($actualValue))
				{
					$actualValue = method_exists($actualValue, 'toArray') ? call_user_func(array($actualValue, 'toArray')) : json_encode($actualValue);
				}
				elseif(is_array($actualValue))
				{
					$actualValue = $this->toJSON($actualValue);
				}

				$result[$property] = $actualValue;
			}

			return $result;
		}
		
		protected function importFrom($source, array $propertiesToExclude = [])
		{
			$propertiesToExclude[] = "parameters";

			if(!empty($source))
			{
				if(is_object($source))
				{
					$source = get_object_vars($source);
				}

				$properties = array_diff_key($source, array_flip($propertiesToExclude));

				foreach($properties as $property => $value)
				{
					if(property_exists($this, $property))
					{
						$this->{$property} = $source[$property];
					}
				}
				
				$source = null;
			}
		}
	}
}