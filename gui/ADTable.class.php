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
require_once(dirname(__FILE__).'/ADComponent.class.php');
require_once(dirname(__FILE__).'/ADTableModel.class.php');

/**
 * Represents a table object
 */
class ADTable extends ADContainer {
	protected $tableModel;

	protected $description;
	protected $caption;
	protected $border;

	function __construct($id = '', $description = '', $caption = '', $border = 0) {
		parent::__construct(false, $id);
		$this->description = $description;
		$this->caption = $caption;
		$this->border = $border;
	}

	/**
	 * Sets the table model that configure and load the table
	 *
	 *@param $tableModel the table model (ADTableModel class) that configures the table
	 */
	function setTableModel($tableModel) {
		$this->tableModel = $tableModel;
		return $tableModel;
	}

	/**
	 * Returns the table model
	 */
	function getTableModel() {
		return $this->tableModel;
	}

	/**
	 * ADTable is an ADContainer, but not has got $components property.
	 * It has got a tableListModel to generate the inner components.
	 */
	function getComponents() {
		$components = array();
		if (isset($this->tableModel))
			foreach($this->tableModel->getRows() as $row)
				$components = array_merge($components, $row->getCells());
		return $components;
	}

	/**
	 * Sets the caption value of the table. 
	 * In HTML is represented with the tag CAPTION
	 */
	function setCaption($caption) {
		$this->caption = $caption;
		return $this;
	}

	/**
	 * Returns the caption of the table
	 */
	function getCaption() {
		return $this->caption;
	}

	/**
	 * Sets the border of the table
	 */
	function setBorder($border) {
		$this->border = $border;
		return $this;
	}

	/**
	 * Returns the boder of the table
	 */
	function getBorder() {
		return $this->border;
	}

	/**
	 * Adds a new row to the table
	 *
	 * @param ADTableRow $tableRow the new table row. If it's empty	a new row is created.
	 * @return ADTableRow the new table row
	 */
	function addRow($tableRow = '')
	{
		if (!isset($this->tableModel)) $this->tableModel = new ADTableModel();
		return $this->tableModel->addRow($tableRow);
	}
}
?>
