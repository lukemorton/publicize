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
		
		// Send last modified headers so browsers have a chance
		$this->response->headers('Last-Modified', 
			date(DATE_RFC1123, filemtime($asset)));
		
		// Show live copy
		$this->response->send_file($asset, NULL, array('inline' => TRUE));
	}
	
}