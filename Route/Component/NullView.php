<?php


namespace Strud\Route\Component
{
	
	class NullView extends View
	{
		public function __construct($model = null)
		{
			parent::__construct($model);
		}

		/**
		 * @return string
		 */
		public function render()
		{
			return "";
		}
	}
}


