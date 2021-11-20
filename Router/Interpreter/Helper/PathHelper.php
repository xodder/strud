<?php
namespace Strud\Router\Interpreter\Helper
{

	use Strud\Route\Path;
	use Strud\Router\Interpreter\Configuration;
	use Strud\Router\URLIterator;
	use Strud\Utils\DirectoryNavigator;
	use Strud\Utils\PathUtil;

	class PathHelper
	{
		public static function createFromURL($url, Configuration $configuration)
		{
			$iterator = new URLIterator($url);

			$navigator = new DirectoryNavigator("application");
			$navigator->navigateTo($configuration->getRootFolder());

			$path = new Path($configuration->getRootFolder());

			while($iterator->hasNext())
			{
				$fragment = $iterator->getFragment();

				if($navigator->hasDirectory(PathUtil::sanitize($fragment)))
				{
					self::updateNavigatorAndPathWithFragment($navigator, $path, $fragment);

					if($navigator->hasFile("Model"))
					{
						$path->pin();
					}
				}
				else
				{
					$path->addParameter($fragment);
				}

				$iterator->moveToNext();
			}

			$fragment = $configuration->getDefaultRouteAction();

			if($navigator->hasDirectory(ucfirst($fragment)))
			{
				self::updateNavigatorAndPathWithFragment($navigator, $path, $fragment);
			}

			return $path;
		}

		private static function updateNavigatorAndPathWithFragment(DirectoryNavigator $navigator, Path $path, $fragment)
		{
			$fragment = PathUtil::sanitize($fragment);

			$navigator->navigateTo($fragment);
			$path->append($fragment);
		}
	}
}
