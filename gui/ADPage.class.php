<?php
/**
 * This file is part of ADFrame.
 * 
 * ADFrame is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * ADFrame is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with ADFrame.  If not, see <http://www.gnu.org/licenses/>.
 */
require_once(dirname(__FILE__).'/ADContainer.class.php');

class ADPage extends ADContainer
{
	protected $cssPath = array();
	protected $jsPath = array();
	protected $title = "";
	//protected $metaKeywords //TODO
	//protected $metaDescription
	//...

	function __construct($title = '', $cssPath = '', $jsPath = '')
	{
		$this->title = $title;
		if (strlen($cssPath) > 0) $this->cssPath[] = $cssPath;
		if (strlen($jsPath) > 0) $this->jsPath[] = $jsPath;
	}

	function addCssPath($cssPath)
	{
		$this->cssPath[] = $cssPath;
	}

	function addJsPath($jsPath)
	{
		$this->jsPath[] = $jsPath;
	}

	function getCssPath() {
		return $this->cssPath;
	}

	function getJsPath() {
		return $this->jsPath;
	}

	function getTitle() {
		return $this->title;
	}

	function setTitle($title) {
		$this->title = $title;
		return $this;
	}
}
?>
