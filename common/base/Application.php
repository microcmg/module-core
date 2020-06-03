<?php
namespace cmsgears\core\common\base;

use cmsgears\core\common\utilities\FileUtility;

/**
 * The base application.
 */
class Application {

	// Type - web(default, backend, frontend, rest), others(console)
	public $type = 'default';

	// Site Url
	public $siteUrl;

	// Request URI
	public $uri;

	// Base Route
	public $baseRoute;

	// Base Path
	public $basePath;

	// Includes Path
	public $includesPath;

	// Resource & Assets Path
	public $resourcesPath;
	public $assetsPath;

	// Sub Includes - Layouts, Templates, Components, Headers, Footers, and Sidebars
	public $layoutsPath;
	public $templatesPath;
	public $componentsPath;
	public $headersPath;
	public $footersPath;
	public $sidebarsPath;

	// Uploads Path
	public $uploadsPath;

	// Site
	public $siteName;

	// Assets Version
	public $assetsVersion;

	// Page
	public $page;

	// MVC
	public $controller;

	public function __construct() {

		// The base contructor
	}

	public function init() {

		// Initialize the Application
	}

	/**
	 * Initialize the router to identify the corresponding page.
	 */
	public function initRouter() {

		// Request Route
		$route = $this->generateRoute();

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

		$app = $this; // Passed as variable to the page

		if( file_exists( $this->page ) ) {

			include $this->page;
		}
		else {

			echo "Page not found.";
		}
	}

	/**
	 * Generates the Route from the given URI.
	 */
	protected function generateRoute() {

		// Clean base route
		$this->uri = str_replace( $this->baseRoute, '', $this->uri );
		$this->uri = preg_split( '/\?/', $this->uri );

		// Clean slashes
		$route = trim( $this->uri[ 0 ], '/' );

		return $route;
	}

}
