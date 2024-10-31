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
//require_once(dirname(dirname(__FILE__)).'/db/ADDAO.class.php');
require_once('ADWPPost.class.php');
require_once('ADWPDashboardWidget.class.php');
require_once('ADWPMenu.class.php');
require_once('ADWPSubmenu.class.php');
require_once('ADWPMetaBox.class.php');

/**
 * RedFruits :: ADWPPlugin
 *
 * 2009-2010 (c) arohadigital
 *
 * This class helps to create plugins for wordpress.
 */
class ADWPPlugin //extends ADDAO
{
	function __construct()
	{
//		parent::__construct();
	}

	function createPost($title, $content, $status = 'publish')
	{
		$post = new ADWordpressPost($title, $content, 'post');
		$post->setPostStatus($status);
		return $post->create();
	}

	function createPage($title, $content, $status = 'publish', $commentStatus = 'close')
	{
		$page = new ADWPPost($title, $content, 'page');
		$page->setPostStatus($status);
		$page->setCommentStatus($commentStatus);
		return $page->create();
	}

	/**
	 * This function allows to add shortcodes
	 */
	function addShortCode($shortCodeName, $shortCodePath, $className)
	{
		if (!class_exists($className)) require_once($shortCodePath);
		if (class_exists($className)) $shortCode = new $className;
		add_shortcode($shortCodeName, array($shortCode, 'render'));
	}

	/**
	 * Allows to add widgets
	 */
	function addWidget($widgetPath, $className)
	{
		require_once($widgetPath);
		register_widget($className);
	}

	/**
	 * Allows to add dashboard widgets
	 */
	function addDashboardWidget($widgetPath, $className)
	{
		$dashboardWidget = new ADWPDashboardWidget($widgetPath, $className);
		$dashboardWidget->register();
	}

	/**
	 * Allows to create a new menu level in the wordpress panel
	 */
	function createMenu($name, $capability, $pagePath, $icon = '')
	{
		$menu = new ADWPMenu($name, $capability, $pagePath, $icon);
		return $menu;
	}

	/**
	 * Allows to add submenus
	 */
	function addSubmenu($parent, $pageTitle, $menuTitle, $capability, $slug, $page, $class)
	{
		return new ADWPSubmenu($parent, $pageTitle, $menuTitle, $capability, $slug, $page, $class);
	}

	/**
	 * Allows to register pages that are not show in the menu
	 */
	function registerPage($name, $capability, $pagePath)
	{
		return add_submenu_page($name, $name, $name, $capability, $pagePath);
	}

	/**
	 * Allows to add a metabox in the post (or any other post type)
	 */
	function addMetaBoxPost($metaBoxName, $title, $metaBoxPage, $className, $post_type = 'post')
	{
		$metaBox = new ADWPMetaBox($metaBoxName, $title, $metaBoxPage, $className, $post_type, 'advanced');
		add_action('admin_menu', array($metaBox, 'register'));
	}

	/**
	 * Allows to add a filter to a post (to the exerpt and to the content).
	 *
	 * @param $filterPath
	 * @param $className 
	 */
	function addContentFilter($filterPath, $className)
	{
		if (!class_exists($className)) require_once($filterPath);
		if (class_exists($className)) $filter = new $className;
		add_filter('the_content', array($filter, 'render'));
	}

	/**
	 * Allows to add a filter to a post (to the exerpt and to the content).
	 *
	 * @param $filterPath
	 * @param $className 
	 */
	function addExcerptFilter($filterPath, $className)
	{
		if (!class_exists($className)) require_once($filterPath);
		if (class_exists($className)) $filter = new $className;
		add_filter('the_excerpt', array($filter, 'render'));
	}

	/**
	 * Allows to add a javascript.
	 *
	 * @param $scriptName
	 * @param $scriptPath
	 *
	function addJavaScript($scriptName, $scriptPath)
	{
		wp_enqueue_script($scriptName, $scriptPath);
	}

	/**
	 * Returns true if the logged user is an administrator.
	 */
	public static function isAdministrator()
	{
		return current_user_can('manage_options');
	}

	/**
	 * Returns the current user id
	 */
	public static function getCurrentUserId()
	{
		global $current_user;
		get_currentuserinfo();
		return $current_user->ID;
	}

	public static function getCurrentUserInfo()
	{
		global $current_user;
		get_currentuserinfo();
		return $current_user;
	}

	public static function isUserLoggedIn()
	{
		return is_user_logged_in();
	}
}
?>
