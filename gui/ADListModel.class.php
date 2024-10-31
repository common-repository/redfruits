<?php
/**
 * This file is part of Redfruits.
 * 
 * Redfruits is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Redfruits is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Redfruits.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * Represents a list model. It's usefull to load ADUList controls
 */
class ADListModel
{
	protected $data; // = array();//array(array('key'=> key, 'text'=> text), )

	protected $selectedIndex = -1;
	protected $selectedValue;

	function __construct($data = array())
	{
		$this->data = $data;
	}

	/**
	 * Add a pair (key, text) to the list
	 */
	function addValue($key, $value = '')
	{
		$this->data[] = array (
			'key'	=> $key,
			'text'	=> strlen($value) > 0?$value:$key,
		);
		return $this;
	}

	/**
	 * Returns the size of the list
	 */
	function getSize()
	{
		return count($this->data);
	}

	/**
	 * Returns the value indexed by the index param.
	 *
	 * This function is used by the renders engines to show
	 * the diferent elements of the list.
	 */
	function getElementAt($index)
	{
		return $this->data[$index];
	}

	/**
	 * Returns the index of the selected value of the list
	 */
	function getSelectedIndex()
	{
		return $this->selectedIndex;
	}
	
	/**
	 * Sets a value of the list to be selected by index
	 */
	function setSelectedIndex($selectedIndex)
	{
		$this->selectedIndex = $selectedIndex;
		//unset($this->selectedValue);
		$this->selectedValue = '';
		return $this;
	}

	/**
	 * Returns the selected value of the list
	 */
	function getSelectedValue()
	{
		return $this->selectedValue;
	}
	
	/**
	 * Sets one of the values of the list selected
	 */
	function setSelectedValue($selectedValue)
	{
		if ($this->selectedIndex == -1)
		{
			$this->selectedValue = $selectedValue;
			if (!is_array($selectedValue))
				if (strrpos($selectedValue, ','))
					$this->selectedValue = explode(',', $selectedValue);
			//$this->selectedIndex = -1;
		}
		return $this;
	}

	/**
	 * Returns a value from the list
	 *
	 * @param $key 
	 * @param $value (optional) if the key doesn't exists this value is returned
	 */
	function getValue($key, $value = '')
	{
		foreach($this->data as $pair)
			if ($pair['key'] == $key) return $pair['text'];
		return $value;
	}

	/**
	 * Removes a pair (key,value)
	 *
	 * @param $key to remove
	 * @return $text the text removed
	 */
	function removeValue($key, $value = '')
	{
		foreach($this->data as $index => $pair)
			if ($pair['key'] == $key)
			{
				$removed_text = $this->data[$index]['text'];
				unset($this->data[$index]);
				return $removed_text;
			}
		return $value;
	}
	
	function getData()
	{
		return $this->data;
	}
}
?>
