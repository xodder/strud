<?php
namespace Strud\Utils
{
	class DirectoryNavigator
	{
		private $rootDirectory = "";
		private $directory;

		public function __construct($directory)
		{
			$this->rootDirectory = $directory;

			$this->initialize();
		}

		private function initialize()
		{
			$this->navigateTo($this->getStartingDirectory());
		}

		public function navigateTo($directory)
		{
			if(empty($this->directory))
			{
				$this->directory = $directory;

				return;
			}

			$this->directory = join(DIRECTORY_SEPARATOR, [ $this->directory, $directory ]);
		}

		public function goBack()
		{
			$directories = preg_split(DIRECTORY_SEPARATOR, $this->directory);
			array_pop($directories);

			$this->directory = join(DIRECTORY_SEPARATOR, $directories);
		}

		public function hasDirectory($directory)
		{
			return file_exists(join(DIRECTORY_SEPARATOR, [ $this->directory, $directory ]));
		}

		public function hasFile($name, $extension = "php")
		{
			return file_exists(join(DIRECTORY_SEPARATOR, [ $this->directory, "{$name}.{$extension}" ]));
		}

		public function getCurrentDirectory($absolutePath = false)
		{
			return $absolutePath ? $this->getAbsolutePathToCurrentDirectory() : $this->directory;
		}

		private function getAbsolutePathToCurrentDirectory()
		{
			return preg_replace($this->getStartingDirectory(), "", $this->directory);
		}

		private function getStartingDirectory()
		{
			return join(DIRECTORY_SEPARATOR, [ get_include_path(), $this->rootDirectory ]);
		}
	}
}
