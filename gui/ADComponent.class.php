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

//if (!defined('DEFAULT_RENDER')) define('DEFAULT_RENDER', 'ADDefaultRender');

/**
 * The base class for all RedFruits components
 * A component is an object having a graphical representation that can be
 * displayed on an explorer, like Labels, textboxes, etc.
 */
class ADComponent
{
	private static $lastId = 0;

	protected $id;
	protected $automaticId = false;
	protected $visible = true;
	protected $classStyle = '';
	protected $style = '';
	protected $onClick = '';
	protected $onChange = '';
	protected $onKeyPress = '';
	protected $onMouseOver = '';
	protected $onMouseOut = '';
	protected $title = '';

	function __construct($id = '')
	{
		if (strlen($id) > 0) $this->id = $id;
		else
		{
			$this->id = "internalId_".self::$lastId++;
			$this->automaticId = true;
		}
	}

	function render($renderTheme = "ADDefaultRender")
	{
		if (strlen($renderTheme) == 0) $renderEngine = $this->loadRenderEngine("ADDefaultRender");
		else $renderEngine = $this->loadRenderEngine($renderTheme);
		return $renderEngine->render($this, $renderTheme);
	}

	function __toString()
	{
		return $this->render();
	}

	protected function loadRenderEngine($renderTheme)
	{
		$renderPath = dirname(__FILE__)."/renders/".$renderTheme."/".$renderTheme.".class.php";
		if (file_exists($renderPath))
		{
			require_once($renderPath);
			return new $renderTheme();
		}
		else die("Error, render '".$renderTheme."' not exists!");
		
	}

	function setId($id)
	{
		$this->id = $id;
		$this->automaticId = false;
		return $this;
	}

	function getId()
	{
		return $this->id;
	}

	function isAutomaticId()
	{
		return $this->automaticId;
	}

	/**
	 * Sets if the id is automatic or not.
	 * This is used by the default render to render the id (setAutomaticId equal false) or not
	 * @param $automaticId true or false
	 */
	function setAutomaticId($automaticId)
	{
		$this->automaticId = $automaticId;
		return $this;
	}

	function setClassStyle($classStyle)
	{
		$this->classStyle = $classStyle;
		return $this;
	}

	function addClassStyle($classStyle)
	{
		if (strlen($this->classStyle) == 0) return $this->setClassStyle($classStyle);
		else $this->classStyle .= ' '.$classStyle;
		return $this;
	}

	function getClassStyle()
	{
		return $this->classStyle;
	}

	function setStyle($style)
	{
		$this->style = $style;
		return $this;
	}

	function addStyle($style)
	{
		if (strlen($this->style) == 0) return $this->setStyle($style);
		else $this->style .= ' '.$style;//TODO look for ;
		return $this;
	}

	function getStyle()
	{
		return $this->style;
	}

	function setVisible($visible)
	{
		$this->visible = $visible;
		return $this;
	}

	function isVisible()
	{
		return $this->visible;
	}
	
	function setOnClick($onclick)
	{
		$this->onClick = str_replace('"', '\'', $onclick);
		return $this;
	}
	function getOnClick()
	{
		return $this->onClick;
	}

	function setOnChange($onChange)
	{
		$this->onChange = str_replace('"', '\'', $onChange);
		return $this;
	}

	function getOnChange()
	{
		return $this->onChange;
	}

	function setOnKeyPress($onKeyPress)
	{
		$this->onKeyPress = $onKeyPress;
		return $this;
	}

	function getOnKeyPress()
	{
		return $this->onKeyPress;
	}

	function setOnMouseOver($onMouseOver)
	{
		$this->onMouseOver = $onMouseOver;
		return $this;
	}

	function getOnMouseOver()
	{
		return $this->onMouseOver;
	}

	function setOnMouseOut($onMouseOut)
	{
		$this->onMouseOut = $onMouseOut;
		return $this;
	}

	function getOnMouseOut()
	{
		return $this->onMouseOut;
	}

	function setTitle($title)
	{
		$this->title= $title;
		return $this;
	}

	function getTitle()
	{
		return $this->title;
	}
}
?>
