<?php
/**
 * This file is part of RedFruits.
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
require_once(dirname(__FILE__).'/ADTableModel.class.php');

/**
 * Represents a table cell
 */
class ADTableCell extends ADContainer {
	protected $head;
	protected $scope;
	protected $colspan = 0;

	public function __construct($component = '', $head = false)
	{
		if ($component instanceof ADComponent || is_array($component)) $this->add($component);
		elseif (strlen($component) > 0) $this->setText($component);
		$this->head = $head;
	}
	//TODO uhmmm, this is not the better way.
	public function setText($text)
	{
		$this->add(new ADText($text));
		return $this;
	}

	public function setHead($head)
	{
		$this->head = $head;
		return $this;
	}
	public function isHead()
	{
		return $this->head;
	}

	public function setColspan($colspan)
	{
		$this->colspan = $colspan;
		return $this;
	}
	public function getColspan()
	{
		return $this->colspan;
	}

	public function setScope($scope)
	{
		$this->scope = $scope;
		return $this;
	}
	public function getScope()
	{
		return $this->scope;
	}
}
?>
