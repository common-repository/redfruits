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

/**
 * A Container object is a component that can contain other RedFruits components.
 * All the contained components are in a list.
 */
class ADContainer extends ADComponent
{
	protected $components = array();

	function __construct($component = false, $id = '')
	{
		parent::__construct($id);
		if ($component) $this->add($component);
	}

	/**
	 * Adds a component to the container
	 *
	 * @param ADComponent/array $component component to add.
	 * 			If it is an array the param id must be omitted and the array must contains only components
	 * @param string $id key to indexed the list of container. If it is omitted
	 * 		and the component is an ADComponent the id of the component will be used.
	 * @return ADComponent/array the component added
	 */
	function add($component, $id = '')
	{
		if (strlen($id) > 0)
			if ($component instanceof ADComponent)
			{
				$this->components[$id] = $component;
				return $component;
			}
			else return $this->add(new ADText($component, $id));//string expected
		elseif ($component instanceof ADComponent)
		{
			$this->components[$component->getId()] = $component;
			return $component;
		}
		else if (is_array($component))
		{
			foreach($component as $comp)
				if ($comp instanceof ADComponent)
					$this->components[$comp->getId()] = $comp;
				else //string expected
					$this->add(new ADText($comp));
			return $this; //ATTENTION: the container is returned!!!!
		}
		else return $this->addText($component);
	}

	/**
	 * Inserts a component before the $id index or the component $id.
	 *
 	 * @param ADComponent/array $component component to insert.
	 * 			If it is an array the param new_id must be omitted and the array must contains only components
	 * @param string/int $id index or id of the array of components where the new component will be be inserted before
	 * @param string $new_id key to indexed the list of container. If it is omitted
	 * 		and the component is an ADComponent the id of the component will be used.
	 * @return ADComponent/array the component added
	 */
	function insert($component, $id = 0, $new_id = '')
	{
		if ($new_id == '') $new_id = $component->getId();
		if (is_numeric($id))
			$index = $id;
		else
		{
			$keys = array_keys($this->components);
			$index = array_keys($keys, $id);
			if ($index && count($index) > 0) $index = $index[0];
		}
		if (is_array($component))
			array_splice($this->components, $index, 0, $component);
		elseif (strlen($new_id) == 0)
		{
			if ($component instanceof ADComponent)
				$new_id = $component->getId();
			else
			{
				$component = new ADText($component);
				$new_id = $component->getId();
			}
		}
		array_splice($this->components, $index, 0, array($new_id => $component));
		if (is_array($component))
			return $this;
		else
			return $component;
	}

	function getLastClassStyle($classStyle)
	{
		$index = -1;
		$i = 0;
		foreach($this->components as $component)
			if ($component->getClassStyle() == $classStyle)
				$index = $i++;
			else
				$i++;
		return $index;
	}

	/**
	 * Helps creating text into the container.
	 * It's equal to add('some text') or add(new ADText('some text')
	 *
	 * @param string text to be added
	 */
	function addText($text = '')
	{
		if ($text && strlen($text) > 0) return $this->add(new ADText($text));
		else return null;
	}

	/**
	 * Removes a component from the container
	 *
	 * @param ADComponent $component component to be added
	 * @return the container
	 */
	function remove($component) {
		if ($component instanceof ADComponent) unset($this->components[$component->getId()]);
		else unset($this->components[$component]);
		return $this;
	}

	/**
	 * Removes all the components of this container
	 *
	 * @return the container
	 */
	function removeAll() {
		unset($this->components);
		$this->components = array();
		return $this;
	}

	/**
	 * Returns a component from the container by the id
	 */
	function getComponentById($id) {
		if (isset($this->components[$id])) return $this->components[$id];
		else return false;
	}

	/**
	 * Returns all the components contained in the container
	 */
	function getComponents() {
		return $this->components;
	}
	
	/**
	 * Returns the number of components contained in the container
	 */
	function getLength() {
		return count($this->components);
	}

	/**
	 * Returns the first component contained in the container
	 */
	function getFirstComponent() {
		if (count($this->components) > 0)
		{
			$values = array_values($this->components);
			return $values[0];
		}
		else return;
	}
}
?>
