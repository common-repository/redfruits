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
require_once(dirname(__FILE__).'/ADComponent.class.php');

/**
 * Esta clase será extendida por todo control de usuario que quiera disponer de
 * un propiedad value
 */
class ADInputField extends ADComponent {
	protected $value;
	protected $enabled = true;
	protected $readonly = false;
	protected $name = '';
	protected $error;

	function __construct($id = '', $value = '', $readonly = false) {
		parent::__construct($id);
		$this->value = $value;
		$this->readonly = $readonly;
	}

	function getValue() {
		return $this->value;
	}

	function setValue($value) {
		$this->value = $value;
		return $this;
	}

	function getError() {
		return $this->error;
	}

	function setError($error) {
		//$this->addClassStyle('error');
		$this->error = $error;
		return $this;
	}

	/**
	 * Sets whether or not this component is enabled
	 * A component that is enabled may respond to user input, while a component
	 * that is not enabled cannot respond to user input.
	 *
	 * @param $enabled true or false
	 * @see isEnabled
	 */
	function setEnabled($enabled)
	{
		$this->enabled = $enabled;
		return $this;
	}
	function isEnabled()
	{
		return $this->enabled;
	}

	/**
	 * Sets whether or not this component is readonly
	 * A component that is readonly cannot change its value, while a component
	 * that is not readonly can can change its value.
	 *
	 * @param $readonly true or false
	 * @see isReadonly
	 */
	function setReadonly($readonly)
	{
		$this->readonly = $readonly;
		return $this;
	}

	function isReadonly()
	{
		return $this->readonly;
	}

	function setName($name)
	{
		$this->name = $name;
		return $this;
	}

	function getName()
	{
		if (strlen($this->name) == 0) return $this->id;
		else return $this->name;
	}
}
?>
