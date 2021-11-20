<?php


namespace Strud\Database\Statement\Clause
{

	use Strud\Database\Statement\Expression;

	interface Builder
	{
		/**
		 * @return string
		 */
		public function build();
	}
}


