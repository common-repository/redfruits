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
 
/**
 * RedFruits :: ADWPMetaBox
 *
 * 2009-2010 (c) arohadigital
 */
class ADWPMetaBox
{
	protected $metaBoxName;
	protected $title;
	protected $filePath;
	protected $className;
	protected $page;
	protected $context;
	protected $priority;

	function __construct($metaBoxName, $title, $filePath, $className, $page='post' ,$context='advanced', $priority='high') {
		$this->meta_box_name = $metaBoxName;
		$this->title = $title;
		$this->filePath = $filePath;
		$this->className = $className;
		$this->page = $page;
		$this->context = $context;
		$this->priority = $priority;
	}

	function register() {
		include_once($this->filePath);
		$clazz = new $this->className();
		add_meta_box($this->meta_box_name, $this->title, array($clazz, 'render'), $this->page, $this->context);//, $this->priority);
	}
}
?>
