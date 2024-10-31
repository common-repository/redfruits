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
require_once(dirname(__FILE__).'/ADTableRow.class.php');
require_once(dirname(__FILE__).'/ADTableCell.class.php');

/**
 * It's used to add components to an ADTable
 *
 * for example:
 * $tableRow = $this->addRow(new ADTableRow());
 * $tableCell = $tableRow->addCell(new ADTableCell('0, 0', true));
 * $tableCell = $tableRow->addCell(new ADTableCell('1, 0', true));
 * 
 * $tableRow = $this->addRow(new ADTableRow());
 * $tableCell = $tableRow->addCell(new ADTableCell('0, 1', true));
 * $tableCell = $tableRow->addCell(new ADTableCell('1, 1', true));
 * 
 */ 
class ADTableModel
{
	protected $lastRow = 0;
	protected $rows = array();

	/**
	 * Adds a new row to the table
	 *
	 * @param ADTableRow $tableRow the new table row. If it's empty	a new row is created.
	 * @return ADTableRow the new table row
	 */
	function addRow($tableRow = '')
	{
		$tr = $tableRow == ''?new ADTableRow():$tableRow;
		$this->rows[$this->lastRow++] = $tr;
		return $tr;
	}

	/**
	 * Returns all the table's rows
	 */
	function getRows()
	{
		return $this->rows;
	}

	/**
	 * Returns a row by his row number
	 * @param int $row the row number to return
	 */
	function getRow($row)
	{
		return isset($this->rows[$row])?$this->rows[$row]:null;
	}

	/**
	 * Return a cell at $col and $row
	 * @param $col
	 * @param $row
	 */
	function getCellAt($col, $row)
	{
		$tableRow = $this->rows[$row];
		if ($tableRow) return $tableRow->getCell($col);
		else return null;
	}
}
?>
