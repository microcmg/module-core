<?php
namespace cmsgears\core\common\base;

use cmsgears\core\common\utilities\FileUtility;

class Application {

	// Host and scheme
	public $hostname;
	public $protocol;

	// Site & Page Url
	public $siteUrl;
	public $pageUrl;

	// Base Url
	public $baseUrl;

	// Base Route
	public $baseRoute;

	// Base Path - Used to refer local files
	public $basePath;
	public $includesPath;

	// Resource URL & Path - Used to refer the resources
	public $resourcesUrl;
	public $resourcesPath;
	public $assetsUrl;
	public $assetsPath;

	// Layouts & Templates
	public $layoutsPath;
	public $templatesPath;

	// Site
	public $siteName;

	// Assets
	public $assetsVersion;

	// SEO
	public $robots;

	public function __construct() {

		// Host and scheme
		$this->hostname	= $_SERVER[ 'HTTP_HOST' ];
		$this->protocol	= isset( $_SERVER[ 'HTTPS' ] ) ? 'https' : 'http';
	}

	public function init() {

		// Initialize the Application
	}

	public function initRouter() {

		// Router
		$uri = $_SERVER[ 'REQUEST_URI' ];

		// Clean base route
		$uri = str_replace( $this->baseRoute, '', $uri );
		$uri = preg_split( '/\?/', $uri );

		// Clean slashes
		$route = trim( $uri[ 0 ], '/' );

		$script = empty( $route ) ? "{$this->basePath}/pages/index.php" : "{$this->basePath}/pages/{$route}.php";

		$script	= FileUtility::normalizePath( $script );

		if( file_exists( $script ) ) {

			include $script;
		}
		else {

			$script = "{$this->basePath}/pages/{$route}/index.php";

			if( file_exists( $script ) ) {

				include $script;
			}
			else {

				$script = "{$this->basePath}/pages/404.php";

				if( file_exists( $script ) ) {

					include $script;
				}
				else {

					echo "Page not found.";
				}
			}
		}

	}

}
