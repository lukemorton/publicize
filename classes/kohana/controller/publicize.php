<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Controller for [Publicize].
 *
 * @package    Publicize
 * @category   Helpers
 * @author     Luke Morton
 * @copyright  Luke Morton, 2011
 * @license    MIT
 */
class Kohana_Controller_Publicize extends Controller {
	
	/**
	 * When not in development mode this action will copy the
	 * file into DOCROOT and redirect the request to the static
	 * file. However in development mode the file will be served
	 * by Kohana to allow for faster development.
	 * 
	 * @return  void
	 */
	public function action_copy()
	{
		$asset = $this->request->param('asset');
	
		if (Publicize::should_copy_to_docroot())
		{
			$uri = $this->request->param('uri');
			
			// Copy and redirect
			Publicize::copy_to_docroot($asset, $uri);
			//$this->request->redirect($uri);
		}

    // Find the file extension
    $extension = pathinfo($asset, PATHINFO_EXTENSION);

    // Prepare header
    // Bug in 3.2 prevents 'Content-Type' to work as expected -> 'content-type'
    // see: https://github.com/kohana/core/commit/4605ccb6957a7b3a9854792328c937d1db003502
    $this->response->headers(array(
        'content-type'   => File::mime_by_ext($extension),
        'Content-Length' => (string) filesize($asset),
        'Last-Modified'  => date(DATE_RFC1123, filemtime($asset)),
    ));

    // Serve the resource
    $this->response->body(file_get_contents($asset));
	}
	
}