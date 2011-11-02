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
	 * When Kohana::$environment is set to Kohana::DEVELOPMENT
	 * the asset will be served from this Controller.
	 * Otherwise the file will be served here once and then
	 * copied to DOCROOT and subsequently served from there.
	 *
	 * @return  void
	 */
	public function action_copy()
	{
		$asset = $this->request->param('asset');
		$last_modified = date(DATE_RFC1123, filemtime($asset));
		
		if ($last_modified === $this->request->headers('if-modified-since'))
		{
			// Speed up the request by sending not modified
			$this->response->status(304);
			return;
		}
	
		if (Publicize::should_copy_to_docroot())
		{
			$uri = $this->request->param('uri');
			Publicize::copy_to_docroot($asset, $uri);
		}

		$extension = pathinfo($asset, PATHINFO_EXTENSION);

		// Bug in 3.2 prevents 'Content-Type' to work as expected -> 'content-type'
		// see: https://github.com/kohana/core/commit/4605ccb6957a7b3a9854792328c937d1db003502
		$this->response->headers(array(
			'content-type'   => File::mime_by_ext($extension),
			'Content-Length' => (string) filesize($asset),
			'Last-Modified'  => $last_modified,
		));

		$this->response->body(file_get_contents($asset));
	}
	
}
