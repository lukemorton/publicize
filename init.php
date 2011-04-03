<?php defined('SYSPATH') or die('No direct script access.');

if (Publicize::should_set_route())
{
	// Set route
	Publicize::set_route();
}