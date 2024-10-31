<?php
/**
 * This file is part of RedFruits.
 * 
 * RedFrutis is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * RedFrutis is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with RedFrutis.  If not, see <http://www.gnu.org/licenses/>.
 */
require_once(dirname(dirname(__FILE__)).'/gui/ADCoreGui.php');

/**
 * RedFruits :: ADWordpressDashboardWidget
 *
 * 2009-2010 (c) arohadigital
 */
class ADWPDashboardWidget extends ADContainer
{
	protected $filePath;
	protected $className;
	protected $controlPanel;//TODO in the next version

	function __construct($filePath, $className)
	{
		$this->filePath = $filePath;
		$this->className = $className;
		$controlPanel = new ADContainer();
	}

	function register()
	{
		include_once($this->filePath);
		$obj = new $this->className();
		wp_add_dashboard_widget($obj->widgetId, $obj->widgetName, array($obj, 'render'));//, $obj->renderControl);
	}

	function render()
	{
		echo parent::render();
	}

	function renderControl()
	{
		echo $this->controlPanel->render();
	}
}
?>
