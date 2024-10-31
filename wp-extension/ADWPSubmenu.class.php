<?php
/**
 * This file is part of RedFruits.
 * 
 * RedFruits is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * RedFruits is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with RedFruits.  If not, see <http://www.gnu.org/licenses/>.
 */
require_once(dirname(dirname(__FILE__)).'/gui/ADCoreGui.php'); 

/**
 * RedFruits :: ADWPSubmenu
 *
 * Allows to create WordPress submenus
 */
class ADWPSubmenu
{
	function __construct($parent, $pageTitle, $menuTitle, $level, $slug, $page, $class)
	{
		include_once($page);
		$object = new $class();
		add_submenu_page($parent, $pageTitle, $menuTitle, $level, $slug, array($object, 'render'));
		//add_submenu_page($parent, $pageTitle, $menuTitle, $level, $slug, $page);
	}

	/**
	 * Allows to register pages that are not show in the menu
	 */
	function registerPage($name, $capability, $pagePath)
	{
		return add_submenu_page($name, $name, $name, $capability, $pagePath);
	}
}
?>
