<?php
namespace Strud\Route
{

	use Strud\Collection\ArrayList;

	class Path
	{
		const NAMESPACE_SEPARATOR = "\\";

		private $parameters;
		private $namespace;
		private $pinnedNamespace;
		private $rootNamespace;

		public function __construct($rootNamespace)
		{
			$this->parameters = new ArrayList();
			$this->rootNamespace = $rootNamespace;
		}

		public function append($fragment)
		{
			if(empty($this->namespace))
			{
				$this->namespace = ucfirst($this->rootNamespace);
			}

			$this->namespace = $this->joinNamespaceLike($this->namespace, ucfirst($fragment));
		}

		private function joinNamespaceLike(...$fragments)
		{
			return join(self::NAMESPACE_SEPARATOR, $fragments);
		}

		public function pin()
		{
			$this->pinnedNamespace = $this->namespace;
		}

		public function addParameter($param)
		{
			$this->parameters->add($param);
		}

		public function getNamespace()
		{
			return $this->namespace;
		}

		public function getPinnedNamespace()
		{
			return $this->pinnedNamespace;
		}

		public function getParameters()
		{
			return $this->parameters;
		}
	}
}
