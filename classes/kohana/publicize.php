<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Publicize is a small helper class that provides routing
 * functionality that enables modules to include files that are
 * publically available via your htdocs, public, html, www,
 * %%insert another public folder variation%%.
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
	 * Should we copy to docroot? We should if not in the
	 * development environment.
	 *
	 * @return  boolean
	 */
	public static function should_copy_to_docroot()
	{
		return Kohana::$environment !== Kohana::DEVELOPMENT;
	}

	/**
	 * Should we set route? We should if not in the
	 * production environment.
	 *
	 * @return  boolean
	 */
	public static function should_set_route()
	{
		return Kohana::$environment !== Kohana::PRODUCTION;
	}

	/**
	 * Set route functionality.
	 *
	 * @return  void
	 */
	public static function set_route()
	{
		Route::set('Publicize', array('Publicize', 'route_callback'));
	}

	/**
	 * Route callback sends request to [Controller_Publicize].
	 *
	 * @param   string  URI to search for
	 * @return  array   Params for Controler_Publicize::action_redirect()
	 * @return  void    If no file found
	 */
	public static function route_callback($uri)
	{
		if ($asset = Kohana::find_file(self::PUBLIC_FOLDER, $uri, FALSE))
		{
			return array(
				'controller' => 'publicize',
				'action'     => 'copy',
				'asset'      => $asset,
				'uri'        => $uri,
			);
		}
	}

	/**
	 * Copying functionality.
	 *
	 * @param   string  Full path to asset
	 * @param   string  The URI
	 * @return  void
	 */
	public static function copy_to_docroot($asset, $uri)
	{
		$public_asset = DOCROOT.$uri;
		$public_asset_dir = dirname($public_asset);

		if ( ! is_dir($public_asset_dir))
		{
			mkdir($public_asset_dir, 0777, TRUE);
		}

		copy($asset, $public_asset);
	}

}