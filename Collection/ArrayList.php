<?php

namespace Strud\Collection
{
	class ArrayList
	{
		private $source;

		public function __construct(array $source = [])
		{
			$this->source = $source;
		}

		public function get($index, $defaultValue = null)
		{
			return $this->indexExists($index) ? $this->source[$index] : $defaultValue;
		}

		public function add($value)
		{
			$this->source[] = $value;
		}

		public function isEmpty()
		{
			return empty($this->source);
		}

		public function getLength()
		{
			return count($this->source);
		}

		private function indexExists($index)
		{
			return key_exists($index, $this->source);
		}

		/**
		 * @return array
		 */
		public function getSource()
		{
			return $this->source;
		}
	}
}
