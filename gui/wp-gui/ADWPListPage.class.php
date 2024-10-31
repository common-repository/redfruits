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

/**
 * To make wordpress' list pages
 */
abstract class ADWPListPage extends ADLayer
{
	protected $pageTitle;
	protected $toolbar;
	protected $table;

	/**
	 * Returns the page's title
	 */
	abstract protected function getPageTitle();

	/**
	 * Returns a list of links (objects of type ADLink)
	 */
	abstract protected function getToolbarLinks();

	/**
	 * Used to returns components to render after the table
	 */
	protected function getAfterTable()
	{
	}
	
	/**
	 * Returns the table model for the main table
	 */
	abstract protected function getTableModel();

	/**
	 * Used to returns components to render before the table
	 */
	protected function getBeforeTable()
	{
	}

	function __construct()
	{
		$this->setClassStyle('wrap');
		$this->pageTitle = $this->add(new ADTitle2($this->getPageTitle()));
		$this->toolbar = $this->add(new ADUList());
		$this->toolbar->setClassStyle('subsubsub');
		$links = (array)$this->getToolbarLinks();
		foreach($links as $link)
			$this->toolbar->add($link);
		$layer = $this->add(new ADLayer());
		$layer->setClassStyle('clear');
		$this->add($this->getAfterTable());
		$this->table = $this->add(new ADTable());
		$this->table->setTableModel($this->getTableModel());
		$this->add($this->getBeforeTable());
	}

	function render()
	{
		return parent::render('ADWordpressRender');
	}
}
?>
