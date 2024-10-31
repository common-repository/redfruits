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
require_once(dirname(__FILE__).'/ADText.class.php');

class ADLink extends ADContainer
{
	protected $href;
	protected $idText;
	protected $title;
	protected $params;
	protected $target;

	function __construct($href = '', $text = '', $title = '', $id = '', $params = '', $target = '')
	{
		parent::__construct($id);
		$this->href = $href;
		if (strlen($text) > 0)
		{
			$text = $this->add(new ADText($text));
			$this->idText = $text->getId();
		} else $this->idText = '';
		$this->title = $title;
		$this->params = $params;
		$this->target = $target;
	}

	function setHref($href) {
		$this->href = $href;
		return $this;
	}
	function getHref() {
		return $this->href;
	}
	function getText() {
		$adtext = $this->getComponentById($this->idText);
		if (method_exists($adtext, 'getText')) return $adtext->getText();
		else return '';
	}
	function setText($text) {
		$adtext = $this->getComponentById($this->idText);
		if (method_exists($adtext, 'setText')) $adtext->setText($text);
		return $this;
	}
	function setTitle($title) {
		$this->title = $title;
		return $this;
	}
	function getTitle() {
		return $this->title;
	}
	function setParams($params) {
		$this->params = $params;
		return $this;
	}
	function getParams() {
		return $this->params;
	}
	function setTarget($target) {
		$this->target = $target;
		return $this;
	}
	function getTarget() {
		return $this->target;
	}
}
?>
