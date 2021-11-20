<?php
/**
 * Created by PhpStorm.
 * User: Benjamin
 * Date: 2017-09-25
 * Time: 11:42 PM
 */
namespace Strud\Database\Statement\Clause\Builder
{

	use Strud\Database\Statement\Clause\Builder;
	use Strud\Database\Statement\Expression;

	abstract class ExpressionOriented implements Builder
	{
		/**
		 * @var array
		 */
		protected $expressions;

		public function __construct()
		{
			$this->expressions = [];
		}

		public function addExpression(Expression $expression)
		{
			$this->expressions[] = $expression;
		}

	}
}
