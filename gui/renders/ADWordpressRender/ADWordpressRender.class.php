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
require_once(dirname(dirname(__FILE__)).'/ADDefaultRender/ADDefaultRender.class.php');

class ADWordpressRender extends ADDefaultRender
{
	function render($component, $renderTheme = "ADDefaultRender")
	{
		if ($component->isVisible())
			if ($component instanceof ADWPMetaBoxForm)
				return $this->renderMetaBoxForm($component);
			else return parent::render($component, $renderTheme);
	}

	function renderPage($page)
	{
		return $this->renderContainer($page);
	}

	function renderFormHead($component)
	{
		$html  = '<div class="wrap">';
		$html .= '<form ';
		if (strlen($component->getName()) > 0)
			$html .= ' name="'.$component->getName().'"';
		else
			$html .= ' name="frm"';
		if (strlen($component->getId()) > 0)
			$html .= ' id="'.$component->getId().'"';
		if (strlen($component->getAction()) > 0) $html .= ' action="'.$component->getAction().'"';
		if (strlen($component->getMethod()) > 0) $html .= ' method="'.$component->getMethod().'"';
		if (strlen($component->getEnctype()) > 0) $html .= ' enctype="'.$component->getEnctype().'"';
		$html .= '>'."\n";
		return $html;
	}

	function renderFormBody($form)
	{
		$title = '';
		$otherControls = '';
		$table = '<table class="form-table">'."\n";
		foreach($form->getComponents() as $component)
			if ($component instanceof ADLabeledField)
			{
				$table .= '<tr valign="top">'."\n";
				$table .= '<th scope="row">'.$this->render($component->getLabel()).'</th>'."\n";
				$table .= '<td>'.$this->renderContainer($component);
				if (strlen($component->getDescription()) > 0) $table .= "\n".'<span class="description">'.$component->getDescription().'</span>';
				$table .= '</td>'."\n";
				$table .= '</tr>'."\n";
			}
			elseif ($component instanceof ADTitle2 || $component instanceof ADLayer || $component instanceof ADUList)
				$title .= $this->render($component);
			elseif ($component instanceof ADTitle3)
				if (strlen($table) > 18) $table .= '</table>'."\n".$this->render($component).'<table class="form-table">'."\n";
				else $otherControls .= $this->render($component);
			else if (!$component instanceof ADSubmit)
				$otherControls .= $this->render($component);
		if (strlen($table) > 18) $table .= '</table>'."\n";
		$html  = $title."\n";
		$html .= $otherControls."\n";
		$html .= '<div class="clear"></div>'."\n";
		$html .= $table."\n";
		$html .= $this->renderFormSubmit($form);
		return $html;
	}

	function renderFormFoot($component)
	{
		$html  = '</form>'."\n";
		$html .= '</div>'."\n";
		return $html;
	}

	function renderFormSubmit($form)
	{
		$html = '';
		foreach($form->getComponents() as $component)
			if ($component instanceof ADSubmit)
			{
				$component->setClassStyle('button-primary');
				$html .= $component->render($this->renderTheme);
			}
		if (strlen($html) > 0) return '<p class="submit">'.$html.'</p>'."\n";
		else return '';
	}

	function renderTableHead($table)
	{
		return '<table class="widefat fixed" cellspacing="0">'."\n";
	}
	
	function renderTableRow($tableRow)
	{
		$th_s = '';
		$html = '';
		if ($tableRow->isHeadRow())
		{
			foreach($tableRow->getCells() as $cell)
			{
				$th_s .= '<th scope="col" class="manage-column"';
				if (strlen($cell->getStyle())) $th_s .= ' style="'.$cell->getStyle().'"';
				$th_s .= '>'.$cell->render().'</th>'."\n";
			}
			$html .= '<thead>'."\n";
			$html .= '<tr>'."\n".$th_s.'</tr>'."\n";
			$html .= '</thead>'."\n\n";

			$html .= '<tfoot>'."\n";
			$html .= '<tr>'."\n".$th_s.'</tr>'."\n";
			$html .= '</tfoot>'."\n";
		}
		else $html = parent::renderTableRow($tableRow);
		return $html;
	}

	/**
	 * Renders a ADWPMetaBoxForm object
	 *
	 * @param ADWPMetaBoxForm $component
	 */
	function renderMetaBoxForm($component)
	{
		return $this->renderFormBody($component);
	}
}
?>
