<?php
namespace cmsgears\core\common\web;

class Application extends \cmsgears\core\common\base\Application {

	// Host and scheme
	public $hostname;
	public $protocol;

	// Page Url
	public $pageUrl;

	// Base Url
	public $baseUrl;

	// Resource & Assets URL
	public $resourcesUrl;
	public $assetsUrl;

	// Uploads
	public $uploadsUrl;

	// Request, Response
	public $request;
	public $response;

	// SEO & Open Graph
	public $title;
	public $desc;
	public $keywords;
	public $robots;
	public $metas = [];

	public function __construct() {

		parent::__construct();

		// Host and scheme
		$this->hostname	= $_SERVER[ 'HTTP_HOST' ];
		$this->protocol	= isset( $_SERVER[ 'HTTPS' ] ) ? 'https' : 'http';
	}

	/**
	 * Generates the Route from the given URI.
	 */
	protected function generateRoute() {

		// Router
		$this->uri = $_SERVER[ 'REQUEST_URI' ];

		// Clean base route
		$this->uri = str_replace( $this->baseRoute, '', $this->uri );
		$this->uri = preg_split( '/\?/', $this->uri );

		// Clean slashes
		$route = trim( $this->uri[ 0 ], '/' );

		return $route;
	}

}
