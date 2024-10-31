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
 
/**
 * RedFruits :: ADWPMenu
 *
 * Allows to create WordPress plugin's menus
 */
class ADWPMenu
{
	protected $basePath;
	protected $menuHook;

	function __construct($name, $capability, $basePath, $icon = '', $position = 2)
	{
		$this->basePath = $basePath; //slug
		if ($name != '') $this->menuHook = add_menu_page($name, $name, $capability, $basePath, '', $icon); //, $position);
	}

	function addSubmenu($name, $capability, $pagePath)
	{
		return add_submenu_page($this->basePath, $name, $name, $capability, $pagePath);
	}

	/**
	 * Allows to register pages that are not show in the menu
	 */
	function registerPage($name, $capability, $pagePath)
	{
		return add_submenu_page($name, $name, $name, $capability, $pagePath);
	}

	function getMenuHook()
	{
		return $this->menuHook;
	}
}
?>
