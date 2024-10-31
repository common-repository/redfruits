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
require_once('ADComponent.class.php');

class ADImage extends ADComponent {
	protected $url;
	protected $alt;
	protected $width;
	protected $height;
	protected $align;
	protected $border;

	function __construct($url = '', $alt = '', $id = '') {
		parent::__construct($id);
		$this->url = $url;
		$this->alt = $alt;
	}

	function getUrl() {
		return $this->url;
	}
	function setUrl($url) {
		$this->url = $url;
		return $this;
	}
	function getAlt() {
		return $this->alt;
	}
	function setAlt($alt) {
		$this->alt = $alt;
		return $this;
	}
	function setWidth($width)
	{
		$this->width = $width;
		return $this;
	}
	function getWidth()
	{
		return $this->width;
	}
	function setHeight($height)
	{
		$this->height = $height;
		return $this;
	}
	function getHeight()
	{
		return $this->height;
	}
	function setAlign($align)
	{
		$this->align = $align;
		return $this;
	}
	function getAlign()
	{
		return $this->align;
	}
	function setBorder($border)
	{
		$this->border = $border;
		return $this;
	}
	function getBorder()
	{
		return $this->border;
	}
}
?>
