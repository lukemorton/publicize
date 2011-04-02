<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Publicize is a small helper class that provides routing
 * functionality that enables modules to include files that are
 * publically available via your htdocs, public, html, www,
 * %%insert another public folder variation%%.
 *
 * When not in production mode going to the URL `css/screen.css`
 * (a file that does not exist in your public directory), the
 * Kohana Cascading File System will be searched for this path
 * within a folder called `public`, if found it is copied to the
 * public directory.
 *
 * In order to update the file you do need to delete it from
 * your public directory.
 *
 * @package    Publicize
 * @category   Helpers
 * @author     Luke Morton
 * @copyright  Luke Morton, 2011
 * @license    MIT
 */
class Kohana_Publicize {

	const PUBLIC_FOLDER = 'public';

	/**
	 * Sets route if not in production.
	 *
	 * @return  void
	 */
	public static function set_route()
	{
		if (Kohana::$environment !== Kohana::PRODUCTION)
		{
			self::_set_route();
		}
	}
	
	/**
	 * Set route functionality.
	 *
	 * @return  void
	 * @access  private
	 */
	private static function _set_route()
	{
		Route::set('Publicize', array('Publicize', 'route_callback'));
	}

	/**
	 * Route callback, contains the copying functionality.
	 *
	 * @param   string  URI to search for
	 * @return  array   Params for Controler_Publicize::action_redirect()
	 * @return  void    If no file found
	 */
	public static function route_callback($uri)
	{
		if ($asset = Kohana::find_file(self::PUBLIC_FOLDER, $uri, FALSE))
		{
			$public_asset = DOCROOT.$uri;
			
			if ( ! is_file($public_asset))
			{
				$public_asset_dir = dirname($public_asset);
				
				if ( ! is_dir($public_asset_dir))
				{
					mkdir($public_asset_dir, NULL, TRUE);
				}
			
				touch($public_asset);
			}
			
			file_put_contents($public_asset, file_get_contents($asset));
			
			return array(
				'controller' => 'publicize',
				'action'     => 'redirect',
				'uri'        => $uri,
			);
		}
	}

}