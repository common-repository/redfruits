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
require_once('ADContainer.class.php');
require_once('ADListModel.class.php');

/**
 * Unordered list
 *
 * Examples to make a typical menu:
 * <code>
 * the menu:
 *	<ul>
 *		<li>Menu a
 *			<ul>
 *				<li> sub menu a a</li>
 *				<li> sub menu a b</li>
 *			</ul>
 *		</li>
 *		<li>Menu b
 *			<ul>
 *				<li> sub menu b a</li>
 *				<li> sub menu b b</li>
 *			</ul>
 *		</li>
 *	</ul>
 * RedFruits can meke the menu in this way:
 * $menu = new ADUList();
 * $menu->addContainer(array (
 * 		'Menu a',
 *		new ADUList(array(
 *			new ADLink('http://', 'menu a a'),
 *			'menu a b'
 *		)),
 * ));
 * $menu->addContainer(array (
 * 		'Menu b',
 *		new ADUList(array(
 *			'menu b a',
 *			'menu b b'
 *		))
 * ));
 * </code>
 */
class ADUList extends ADContainer
{
	protected $listModel;

	/**
	 * Sets the list model used to load the list.
	 * @param $listModel the list model to use
	 * @return the control to do more actions
	 */
	function setListModel($listModel)
	{
		$this->listModel = $listModel;
		return $this;
	}

	/**
	 * Add a pair (key, value) to the list model
	 */
	function addValue($key, $value)
	{
		if (!isset($this->listModel)) $this->listModel = new ADListModel();
		$this->listModel->addValue($key, $value);
		return $this;
	}

	function addContainer($component)
	{
		$cont = $this->add(new ADContainer($component));
		return $cont;
	}

	function render()
	{
		if (isset($this->listModel))
		{
			$this->removeAll();
			for($i = 0; $i < $this->listModel->getSize(); $i++)
				$this->add($this->listModel->getElementAt($i));
		}
		return parent::render();
	}
}
?>
