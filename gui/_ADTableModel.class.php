<?php
//Old!!!!!!!!!
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
class ADTableModel
{
	protected $columnNames = array('col 1', 'col 2');
	protected $hasHeadRow = true;
	protected $columnRows = 2;

	function getColumnCount()
	{
		return count($this->columnNames);
	}

	function getRowCount()
	{
		return $this->columnRows;
	}

	function getColumnName($col)
	{
		return $this->columnNames[$col];
	}

	function getValueAt($row, $col)
	{
		return 'value_'.$col.'_'.$row;
	}

	function setValueAt($row, $col)
	{
	}

	function setHasHeadRow($hasHeadRow)
	{
		$this->hasHeadRow = $hasHeadRow;
	}

	function getHasHeadRow()
	{
		return $this->hasHeadRow;
	}

	function getHeaderClass()
	{
		return ;
	}

	function getHeaderStyle()
	{
		return ;
	}

	function getRowClass($row)
	{
		return ;
	}

	function getRowStyle($row)
	{
		return ;
	}

	function getCellClass($row, $col)
	{
		return ;
	}

	function getCellStyle($row, $col)
	{
		return ;
	}
}
?>
