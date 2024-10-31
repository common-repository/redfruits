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
require_once('ADInputField.class.php');
require_once('ADListModel.class.php');

class ADSelectField extends ADInputField
{
	protected $listModel;
	protected $is_multiple;
	protected $size;	

	function __construct($id = '', $value = '', $multiple = false, $size = '', $readonly = false)
	{
		parent::__construct($id, $value, $readonly);
		$this->is_multiple = $multiple;
		$this->size = $size;
	}

	function setListModel($listModel)
	{
		$this->listModel = $listModel;
		return $this;
	}

	function getListModel()
	{
		return $this->listModel;
	}

	/**
	 * Returns the number of rows in the list.
	 */
	function getValueCount()
	{
		if ($this->listModel) return $this->listModel->getSize();
		else return 0;
	}

	function setValue($value)
	{
		if (isset($this->listModel)) $this->listModel->setSelectedValue($value);
		else parent::setValue($value);
		return $value;
	}

	function getValue()
	{
		if (isset($this->listModel)) return $this->listModel->getSelectedValue();
		else return $value;
	}

	function refresh()
	{
		if (isset($this->listModel)) $this->listModel->refresh();
		return $this;
	}

	function setMultiple($multiple)
	{
		$this->is_multiple = $multiple;
		return $this;
	}

	function isMultiple()
	{
		return $this->is_multiple;
	}

	function getSize()
	{
		return $this->size;
	}

	function setSize($size)
	{
		$this->size = $size;
		return $this;
	}
}
?>
