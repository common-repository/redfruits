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

class ADSimpleRender extends ADDefaultRender
{
	function renderFormBody($form)
	{
		$html = '';
		foreach ($form->getComponents() as $component)
		{
			//if ($component instanceof ADHiddenField || $component instanceof ADSubmit) $html .= $this->render($component)."\n";
			//else $html .= '<p class="labeled">'.$this->render($component).'</p>'."\n";
			if ($component instanceof ADLabeledField) $html .= '<p class="labeled">'.$this->render($component).'</p>'."\n";
			else $html .= $this->render($component)."\n";
		}
		return $html;
	}

	function renderError($component)
	{
		$html = '';
		if (is_array($component->getError()))
		{
			$html = "\n".'<br/><span class="'.$this->getClassError().'">';
			foreach($component->getError() as $type => $error)
				$html .= $error.'<br/>';
			$html = substr($html, 0, strlen($html) - 5);
			$html .= '</span>'."\n";
		}
		return $html;
	}

}
?>
