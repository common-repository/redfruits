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
require_once(dirname(__FILE__).'/ADContainer.class.php');
require_once(dirname(__FILE__).'/ADLabel.class.php');

/**
 * Define an input field with an associated label
 */
class ADLabeledField extends ADContainer {
	protected $label;
	protected $description;

	/**
	 * Constructs the label and the input field.
	 *
	 *@param $caption The label's caption
	 *@param $input Input field object (ADTextField, ADCheckBox, etc)
	 *@param $description A text description associated with the input field
	 */
	function __construct($caption, $input, $description = '') {
		parent::__construct(false, $input->getId());
		//$this->components['label'] = new ADLabel($caption, $input->getId());
		$this->label = new ADLabel($caption, $input->getId());
		$this->components['main_input'] = $input;
		$this->description = $description;
	}

	/**
	 * Sets the label's caption
	 */
	function setCaption($caption) {
		//$this->components['label']->setCaption($caption);
		$this->label->setCaption($caption);
		return $this;
	}

	/**
	 * Returns the label's caption
	 */
	function getCaption() {
		//return $this->components['label']->getCaption();
		return $this->label->getCaption();
	}

	/**
	 * Returns the label object 
	 */
	function getLabel() {
		//return $this->components['label'];
		return $this->label;
	}

	/**
	 * Returns the input field object 
	 */
	function getInput() {
		return $this->components['main_input'];
	}

	//function setValue($value)
	//{
	//	$component = $this->getInput();
	//	if ($this->component instanceof ADInput) $this->component->setValue($value);
	//	$component->setValue($value);
	//}

	//function getValue()
	//{
	//	$component = $this->getInput();
	//	if ($this->component instanceof ADInput) $this->component->setValue($value);
	//	return $component->getValue();
	//}
	
	function setDescription($description) {
		$this->description = $description;
		return $this;
	}

	function getDescription() {
		return $this->description;
	}

	function setClassStyle($classStyle)
	{
		$this->label->setClassStyle($classStyle);
		return $this;
	}

	function addClassStyle($classStyle)
	{
		if (strlen($this->getClassStyle()) == 0) return $this->setClassStyle($classStyle);
		else $this->setClassStyle($this->getClassStyle().' '.$classStyle);
		return $this;
	}

	function getClassStyle()
	{
		return $this->label->getClassStyle();
	}

	function setStyle($style)
	{
		$this->label->setStyle($style);
		return $this;
	}

	function addStyle($style)
	{
		if (strlen($this->getStyle()) == 0) return $this->setStyle($style);
		else $this->setStyle($this->getStyle().' '.$style);//TODO look for ;
		return $this;
	}

	function getStyle()
	{
		return $this->label->getStyle();
	}

	function setVisible($visible)
	{
		$this->label->setVisible($visible);
		return $this;
	}

	function isVisible()
	{
		return $this->label->isVisible();
	}
	
	function setOnClick($onclick)
	{
		$this->label->setOnClick($onclick);
		return $this;
	}

	function getOnClick()
	{
		return $this->label->getOnClick();
	}

	function setOnChange($onChange)
	{
		$this->label->setOnChange($onChange);
		return $this;
	}

	function getOnChange()
	{
		return $this->label->getOnChange();
	}

	function setOnKeyPress($onKeyPress)
	{
		$this->label->setOnKeyPress($onKeyPress);
		return $this;
	}

	function getOnKeyPress()
	{
		return $this->label->getOnKeyPress();
	}

	function setOnMouseOver($onMouseOver)
	{
		$this->label->setOnMouseOver($onMouseOver);
		return $this;
	}

	function getOnMouseOver()
	{
		return $this->label->getOnMouseOver();
	}

	function setOnMouseOut($onMouseOut)
	{
		$this->label->setOnMouseOut($onMouseOut);
		return $this;
	}

	function getOnMouseOut()
	{
		return $this->label->getOnMouseOut();
	}

	function setTitle($title)
	{
		$this->label->setTitle($title);
		return $this;
	}
}
?>
