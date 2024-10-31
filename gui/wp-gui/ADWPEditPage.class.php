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

require_once(dirname(dirname(__FILE__)).'/ADCoreGui.php');

abstract class ADWPEditPage extends ADLayer
{
	protected $pageTitle;
	protected $toolbar;
	protected $form;

	/**
	 * Returns the page's title
	 */
	abstract protected function getPageTitle();

	/**
	 * Returns a list of links (objects of type ADLink)
	 */
	abstract protected function getToolbarLinks();

	/**
	 * Returns the a list of elements of the form
	 */
	abstract protected function getControlsForm();

	function __construct()
	{
		$this->form = $this->add(new ADForm('frm'));
		$this->form->add(new ADTitle2($this->getPageTitle()));
		$this->toolbar = $this->form->add(new ADUList());
		$this->toolbar->setClassStyle('subsubsub');
		$links = $this->getToolbarLinks();
		foreach($links as $link)
			$this->toolbar->add($link);
		$components = $this->getControlsForm();
		foreach($components as $component)
			$this->form->add($component);
	}

	function render()
	{
		return parent::render('ADWordpressRender');
	}
}
?>
