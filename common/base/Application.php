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
	public $title;
	public $desc;
	public $keywords;
	public $robots;
	public $metas = [];

	// Page
	public $page;

	public function __construct() {

		// Host and scheme
		$this->hostname	= $_SERVER[ 'HTTP_HOST' ];
		$this->protocol	= isset( $_SERVER[ 'HTTPS' ] ) ? 'https' : 'http';
	}

	public function init() {

		// Initialize the Application
	}

	/**
	 * Initialize the router to identify the request URL and the corresponding page.
	 */
	public function initRouter() {

		// Router
		$uri = $_SERVER[ 'REQUEST_URI' ];

		// Clean base route
		$uri = str_replace( $this->baseRoute, '', $uri );
		$uri = preg_split( '/\?/', $uri );

		// Clean slashes
		$route = trim( $uri[ 0 ], '/' );

		$this->page = empty( $route ) ? "{$this->basePath}/pages/index.php" : "{$this->basePath}/pages/{$route}.php";

		$this->page	= FileUtility::normalizePath( $this->page );

		if( !file_exists( $this->page ) ) {

			$this->page = "{$this->basePath}/pages/{$route}/index.php";

			if( !file_exists( $this->page ) ) {

				$this->page = "{$this->basePath}/pages/404.php";
			}
		}
	}

	/**
	 * Page Output
	 */
	public function renderPage() {

		$app = $this;

		if( file_exists( $this->page ) ) {

			include $this->page;
		}
		else {

			echo "Page not found.";
		}
	}

}
