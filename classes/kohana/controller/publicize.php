<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Controller for Publicize. Currently only contains a redirect
 * action.
 *
 * @package    Publicize
 * @category   Helpers
 * @author     Luke Morton
 * @copyright  Luke Morton, 2011
 * @license    MIT
 */
class Kohana_Controller_Publicize extends Controller {

	/**
	 * Simple redirect action for use by Publicize.
	 *
	 * @return  void
	 */
	public function action_redirect()
	{
		$this->request->redirect(
			$this->request->param('uri')
		);
	}
	
}