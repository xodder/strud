<?php


namespace Strud\Route\Component
{

	use Strud\Collection\ArrayList;

	class NullController extends Controller
	{
		public function __construct($model = null, ArrayList $parameters = null)
		{
			parent::__construct($model, $parameters);
		}

		public function run()
		{
			// TODO: Implement run() method.
		}
	}
}


