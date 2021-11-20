<?php
namespace Strud\Router
{
	class URLIterator
	{
		private $urlFragments;
		private $currentIndex;

		public function __construct($url)
		{
			$this->currentIndex = 0;
			$this->urlFragments = preg_split("/\//", $url, null, PREG_SPLIT_NO_EMPTY);
		}

		public function hasNext()
		{
			return $this->currentIndex < count($this->urlFragments);
		}

		public function moveToNext()
		{
			$this->currentIndex++;
		}

		public function moveToPrevious()
		{
			$this->currentIndex--;
		}

		public function getFragment()
		{
			return $this->urlFragments[$this->currentIndex];
		}
	}
}
