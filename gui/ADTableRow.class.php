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
require_once(dirname(__FILE__).'/ADTableCell.class.php');
/**
 * Represents a table row
 */
class ADTableRow extends ADContainer
{
	protected $lastCol = 0;

	function addCell($cell = '', $head = false)
	{
		if (!$cell instanceof ADTableCell || is_array($cell)) $cell = new ADTableCell($cell, $head);
		parent::add($cell, $this->lastCol++);
		return $cell;
		
	}

	public function getCells()
	{
		return $this->components;
	}

	public function getCell($col)
	{
		return $this->components[$col];
	}

	public function isHeadRow()
	{
		foreach($this->components as $tableCell)
			if (!$tableCell->isHead()) return false;
		return true;
	}

	/*public function setRow($row)
	{
		$this->row = $row;
	}
	public function getRow()
	{
		return $this->row;
	}*/
}
?>
