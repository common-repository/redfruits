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
require_once(dirname(__FILE__).'/ADInputField.class.php');

class ADCheckBox extends ADInputField {
	protected $checkedValue;

	function __construct($id = '', $checkedValue = '', $value = '', $readonly = false) {
		parent::__construct($id, $value, $readonly);
		$this->value = $value;
		$this->checkedValue = $checkedValue;
	}

	function getCheckedValue() {
		return $this->checkedValue;
	}
	function setCheckedValue($checkedValue) {
		$this->checkedValue = $checkedValue;
		return $this;
	}
}
?>
