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
 * The default render for the RedFruits API. It render the redfruits components
 * in html.
 */
class ADDefaultRender
{
	protected $renderTheme;
	protected $class_error = 'error';

	function render($component, $renderTheme = 'ADDefaultRender')
	{
		$this->renderTheme = $renderTheme;
		if ($component->isVisible())
			if ($component instanceof ADLabeledField)
				return $this->renderLabeledField($component);
			elseif ($component instanceof ADPasswordField)
				return $this->renderTextField($component, true);
			elseif ($component instanceof ADTextField)
				return $this->renderTextField($component);
			elseif ($component instanceof ADTextArea)
				return $this->renderTextArea($component);
			elseif ($component instanceof ADRadio)
				return $this->renderRadio($component);
			elseif ($component instanceof ADCheckbox)
				return $this->renderCheckbox($component);
			elseif ($component instanceof ADHiddenField)
				return $this->renderHiddenField($component);
			elseif ($component instanceof ADSubmit)
				return $this->renderSubmit($component);
			elseif ($component instanceof ADLabel)
				return $this->renderLabel($component);
			elseif ($component instanceof ADBreakLine)
				return $this->renderBreakLine($component);
			elseif ($component instanceof ADSpan)
				return $this->renderSpan($component);
			elseif ($component instanceof ADLayer)
				return $this->renderLayer($component);
			elseif ($component instanceof ADImageField)
				return $this->renderImage($component);
			elseif ($component instanceof ADForm)
				return $this->renderForm($component);
			elseif ($component instanceof ADTitle1)
				return $this->renderTitle($component, 1);
			elseif ($component instanceof ADTitle2)
				return $this->renderTitle($component, 2);
			elseif ($component instanceof ADTitle3)
				return $this->renderTitle($component, 3);
			elseif ($component instanceof ADTitle4)
				return $this->renderTitle($component, 4);
			elseif ($component instanceof ADParagraph)
				return $this->renderParagraph($component);
			elseif ($component instanceof ADLink)
				return $this->renderLink($component);
			elseif ($component instanceof ADImage)
				return $this->renderImage($component);
			elseif ($component instanceof ADText)
				return $this->renderText($component);
			elseif ($component instanceof ADUList)
				return $this->renderUList($component);
			elseif ($component instanceof ADTable)
				return $this->renderTable($component);
			elseif ($component instanceof ADSelectField)
				return $this->renderSelectField($component);
			elseif ($component instanceof ADFieldset)
				return $this->renderFieldset($component);
			elseif ($component instanceof ADButton)
				return $this->renderButton($component);
			elseif ($component instanceof ADFileField)
				return $this->renderFileField($component);
			elseif ($component instanceof ADPage)
				return $this->renderPage($component);
			elseif ($component instanceof ADJavaScript)
				return $this->renderJavaScript($component);
			elseif ($component instanceof ADContainer) //siempre el anteúltimo
				return $this->renderContainer($component);
			//elseif ($component instanceof ADComponent) //siempre el último
			//	return $this->renderComponent($component);
	}

	protected function renderComponent($component)
	{
		$html = '';
		if (!$component->isAutomaticId() && strlen($component->getId()) > 0) $html .= ' id="'.$component->getId().'"';
		if (strlen($component->getClassStyle()) > 0) $html .= ' class="'.$component->getClassStyle().'"';
		if (strlen($component->getStyle()) > 0) $html .= ' style="'.$component->getStyle().'"';
		if (strlen($component->getOnClick()) > 0) $html .= ' onClick="'.$component->getOnClick().'"';
		if (strlen($component->getOnChange()) > 0) $html .= ' onChange="'.$component->getOnChange().'"';
		if (strlen($component->getOnKeyPress()) > 0) $html .= ' onKeyPress="'.$component->getOnKeyPress().'"';
		if (strlen($component->getOnMouseOver()) > 0) $html .= ' onMouseOver="'.$component->getOnMouseOver().'"';
		if (strlen($component->getOnMouseOut()) > 0) $html .= ' onMouseOut="'.$component->getOnMouseOut().'"';
		if (strlen($component->getTitle()) > 0) $html .= ' title="'.$component->getTitle().'"';
		return $html;
	}

	protected function renderInputField($component, $show_value = true)
	{
		$html = $this->renderComponent($component);
		if (strlen($component->getName()) > 0) $html .= ' name="'.$component->getName().'"';
		else $html .= ' name="'.$component->getId().'"';
		if ($show_value) $html .= ' value="'.$component->getValue().'"';
		if (!$component->isEnabled()) $html .= ' disabled="disabled"';
		if ($component->isReadonly()) $html .= ' readonly="true"';
		return $html;
	}

	function renderLayer($component)
	{
		$html  = '<div';
		$html .= $this->renderComponent($component);
		$html .= '>'."\n";
		foreach($component->getComponents() as $comp) $html .= $this->render($comp);
		$html .= '</div>'."\n";
		return $html;
	}

	function renderBreakLine($component)
	{
		$html = '<br';
		if (strlen($component->getClassStyle()) > 0) $html .= ' class="'.$component->getClassStyle().'"';
		if (strlen($component->getStyle()) > 0) $html .= ' style="'.$component->getStyle().'"';
		$html .= '/>'."\n";
		return $html;
	}

	function renderLabeledField($component)
	{
		$html  = $this->render($component->getLabel());
		$html .= $this->renderContainer($component);
		if (strlen($component->getDescription()) > 0) $html .= '<span>'.$component->getDescription().'</span>'."\n";
		return $html;
	}

	function renderLabel($component)
	{
		$html  = '<label ';
		if (strlen($component->getFor()) > 0) $html .= ' for="'.$component->getFor().'"';
		$html .= $this->renderComponent($component);
		$html .= '>'.$component->getCaption();
		foreach($component->getComponents() as $comp) $html .= $this->render($comp);
		$html .= '</label>'."\n";
		return $html;
	}

	function renderTextField($component, $pass = false)
	{
		if ($pass) $html  = '<input type="password"';
		else $html  = '<input type="text"';
		$html .= $this->renderInputField($component);
		$html .= ' size="'.$component->getSize().'"';
		if ($component->getMaxlength() > 0) $html .= ' maxlength="'.$component->getMaxlength().'"';
		$html .= '/>';
		$html .= $this->renderError($component);
		return $html;
	}

	function renderTextArea($component)
	{
		$html  = '<textarea';
		$html .= $this->renderInputField($component, false);
		$html .= ' cols="'.$component->getCols().'"';
		$html .= ' rows="'.$component->getRows().'"';
		if ($component->getMaxlength() > 0) $html .= ' maxlength="'.$component->getMaxlength().'"';
		$html .= '>'.$component->getValue().'</textarea>';
		$html .= $this->renderError($component);
		return $html;
	}

	function renderCheckbox($component)
	{
		$html  = '<input type="checkbox"';
		$html .= $this->renderInputField($component, false);
		$html .= ' value="'.$component->getCheckedValue().'"';
		if ($component->getValue() == $component->getCheckedValue()) $html .= ' checked="true"';
		$html .= '/>';
		$html .= $this->renderError($component);
		return $html;
	}

	function renderRadio($component)
	{
		$html  = '<input type="radio"';
		$html .= $this->renderInputField($component, false);
		$html .= ' value="'.$component->getCheckedValue().'"';
		if ($component->getValue() == $component->getCheckedValue()) $html .= ' checked="true"';
		$html .= '/>';
		$html .= $this->renderError($component);
		return $html;
	}

	function renderHiddenField($component)
	{
		$html = '<input type="hidden"';
		if (!$component->isAutomaticId()) $html .= ' id="'.$component->getId().'"';
		if (strlen($component->getName()) > 0) $html .= ' name="'.$component->getName().'"';
		else $html .= ' name="'.$component->getId().'"';
		$html .= ' value="'.$component->getValue().'"';
		$html .= '/>'."\n";
		return $html;
	}

	function renderSubmit($component)
	{
		$html  = '<input type="submit"';
		$html .= $this->renderInputField($component);
		$html .= '/>';
		return $html;
	}

	function renderForm($component)
	{
		$html  = $this->renderFormHead($component);
		$html .= $this->renderFormBody($component);
		$html .= $this->renderFormFoot($component);
		return $html;
	}
	
	function renderFormHead($component)
	{
		$html = '<form ';
		if (!$component->isAutomaticId()) $html .= ' name="'.$component->getId().'"';
		if (strlen($component->getAction()) > 0) $html .= ' action="'.$component->getAction().'"';
		if (strlen($component->getMethod()) > 0) $html .= ' method="'.$component->getMethod().'"';
		if (strlen($component->getEnctype()) > 0) $html .= ' enctype="'.$component->getEnctype().'"';
		$html .= $this->renderComponent($component);
		$html .= '>'."\n";
		return $html;
	}

	function renderFormBody($component)
	{
		$html = '';
		foreach ($component->getComponents() as $comp)
			$html .= $this->render($comp)."\n";
		return $html;
	}

	function renderFormFoot($component)
	{
		return '</form>'."\n";
	}

	function renderTitle($component, $level)
	{
		$html  = '<h'.$level.'';
		$html .= $this->renderComponent($component);
		$html .= '>';
		$html .= $this->renderContainer($component);
		$html .= '</h'.$level.'>'."\n";
		return $html;
	}

	function renderParagraph($component)
	{
		$html  = '<p';
		$html .= $this->renderComponent($component);
		$html .= '>'."\n";
		$html .= $this->renderContainer($component);
		$html .= '</p>'."\n";
		return $html;
	}

	function renderLink($component)
	{
		$html = '<a ';
		$html .= $this->renderComponent($component);
		$href = $component->getHref();
		$params = $component->getParams();
		if (is_array($params))
		{
			if (strpos($href, '?')) $href .= '?';
			else $href .= '&';
			foreach($params as $param => $value)
				$href .= $param.'='.$value.'&';
			$href = substr($href, 0, strlen($href) - 1);
		}
		if (substr_count($href, '?') > 1)
		{
			$i = strpos($href, '?');//the first is saved
			$i = strpos($href, '?', $i + 1);
			$dir = substr($href, 0, $i);
			$params = substr($href, $i);
			$params = str_replace('?', '&', $params);
			$href = $dir.$params;
		}
		$html .= ' href="'.$href.'"';
		if (strlen($component->getTitle()) > 0) $html .= ' title="'.$component->getTitle().'"';
		if (strlen($component->getTarget()) > 0) $html .= ' target="'.$component->getTarget().'"';
		$html .= '>';
		$html .= $this->renderContainer($component);
		$html .= '</a>';
		return $html;
	}

	function renderImage($component)
	{
		$html  = '<img ';
		$html .= $this->renderComponent($component);
		$html .= ' src="'.$component->getUrl().'"';
		if (strlen($component->getAlt()) > 0) $html .= ' alt="'.$component->getAlt().'"';
		if (strlen($component->getWidth()) > 0) $html .= ' width="'.$component->getWidth().'"';
		if (strlen($component->getHeight()) > 0) $html .= ' height="'.$component->getHeight().'"';
		if (strlen($component->getAlign()) > 0) $html .= ' align="'.$component->getAlign().'"';
		if (strlen($component->getBorder()) > 0) $html .= ' border="'.$component->getBorder().'"';
		$html .= '/>';
		return $html;
	}

	function renderSpan($component)
	{
		$html  = '<span';
		$html .= $this->renderComponent($component);
		$html .= '>';
		$html .= $this->renderContainer($component);
		$html .= '</span>'."\n";
		return $html;
	}

	function renderText($component)
	{
		return $component->getText();
	}

	function renderUList($component)
	{
		$html  = $this->renderUListHead($component);
		$html .= $this->renderUListBody($component);
		$html .= $this->renderUListFoot($component);
		return $html;
	}
	
	function renderUListHead($component)
	{
		$html  = '<ul';
		$html .= $this->renderComponent($component);
		$html .= '>'."\n";
		return $html;
	}

	function renderUListBody($component)
	{
		$html = '';
		foreach ($component->getComponents() as $comp) $html .= '<li>'.$this->render($comp).'</li>'."\n";
		return $html;
	}

	function renderUListFoot($component)
	{
		$html = '</ul>'."\n";
		return $html;
	}

	function renderTable($component)
	{
		$html  = $this->renderTableHead($component);
		$html .= $this->renderTableBody($component);
		$html .= $this->renderTableFoot($component);
		return $html;
	}

	function renderTableHead($component)
	{
		$html  = '<table';
		$html .= $this->renderComponent($component);
		if ($component->getBorder() > 0) $html .= ' border="'.$component->getBorder().'"';
		$html .= '>'."\n";
		return $html;
	}

	function renderTableBody($component)
	{
		$html = '';
		$tableModel = $component->getTableModel();
		if (isset($tableModel))
			foreach($tableModel->getRows() as $tableRow)
				$html .= $this->renderTableRow($tableRow);
		return $html;
	}

	function renderTableRow($component)
	{
		$html  = '<tr'.$this->renderComponent($component).'>'."\n";
		foreach($component->getComponents() as $tableCell)
			$html .= $this->renderTableCell($tableCell);
		$html .= '</tr>'."\n";
		return $html;
	}

	function renderTableCell($component)
	{
		if ($component->isHead()) $html = '<th';
		else $html = '<td';
		if (strlen($component->getScope())) $html .= ' scope="'.$component->getScope().'" ';
		if ($component->getColspan() > 0) $html .= ' colspan="'.$component->getColspan().'" ';
		$html .= $this->renderComponent($component);
		$html .= '>'."\n";
		$html .= $this->renderContainer($component);
		if ($component->isHead()) $html .= '</th>'."\n";
		else  $html .= '</td>'."\n";
		return $html;
	}

	function renderTableFoot($component)
	{
		$html = '</table>'."\n";
		return $html;
	}

	function renderSelectField($component)
	{
		$html = '<select';
		$html .= $this->renderInputField($component, false);
		if (strlen($component->getSize()) > 0) $html .= ' size="'.$component->getSize().'"';
		if (strlen($component->isMultiple()) > 0) $html .= ' multiple';
		$html .= '>'."\n";
		$listModel = $component->getListModel();
		if (isset($listModel) && is_array($listModel->getData()))
		{
			$i = 0;
			foreach($listModel->getData() as $index => $value) {
				//$value = $listModel->getElementAt($i);
				$html .= '<option value="'.$value['key'].'"';
				if ($listModel->getSelectedIndex() == $i++) $html .= ' selected ';
				//if ($listModel->getSelectedIndex() == $index) $html .= ' selected ';
				elseif (is_array($listModel->getSelectedValue()))
				{
					if (in_array($value['key'], $listModel->getSelectedValue())) $html .= ' selected';
				}
				elseif ($listModel->getSelectedValue() == $value['key']) $html .= ' selected';
				$html .= '>'.$value['text'].'</option>'."\n";
			}
		}
		$html .= '</select>'."\n";
		$html .= $this->renderError($component);
		return $html;
	}

	function renderFieldset($component)
	{
		$html = '<fieldset'.$this->renderComponent($component).'>'."\n";
		if (strlen($component->getLegend()) > 0) $html .= '<legend>'.$component->getLegend().'</legend>'."\n";
		foreach($component->getComponents() as $comp) 
			//$html .= $this->render($component);
			if ($comp instanceof ADHiddenField || $comp instanceof ADSubmit) $html .= $this->render($comp)."\n";
			else $html .= $this->render($comp).'<br>'."\n";
		$html .= '</fieldset>'."\n";
		return $html;
	}

	function renderButton($component)
	{
		$html  = '<input type="button"';
		$html .= $this->renderComponent($component);
		$html .= 'value="'.$component->getCaption().'"/>'."\n";
		return $html;
	}

	function renderFileField($component)
	{
		$html  = '<input type="file"';
		$html .= $this->renderInputField($component, false);
		$html .= ' size="'.$component->getSize().'" />';
		$html .= $this->renderError($component);
		return $html;
	}

	function renderPage($component)
	{
		$html  = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'."\n";
		$html .= '<html xmlns="http://www.w3.org/1999/xhtml"  dir="ltr" lang="en-US">'."\n";
		$html .= $this->renderHead($component);
		$html .= '<body>'."\n";
		$html .= $this->renderContainer($component);
		$html .= '</body>'."\n";
		$html .= '</html>'."\n";
		return $html;
	}

	function renderHead($component)
	{
		$html  = $this->renderHeadHead($component);
		$html .= $this->renderHeadBody($component);
		$html .= $this->renderHeadFoot($component);
		return $html;
	}

	function renderHeadHead($component)
	{
		$html = '<head>'."\n";
		return $html;
	}

	function renderHeadBody($component)
	{
		$html = '';
		if (strlen($component->getTitle()) > 0) $html = '<title>'.$component->getTitle().'</title>'."\n";
		$html .= '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />'."\n";
		foreach($component->getCssPath() as $cssPath)
			$html .= '<link rel="stylesheet" href="'.$cssPath.'" type="text/css" />'."\n";
		foreach($component->getJsPath() as $jsPath)
			$html .= '<script src="$jsPath" type="text/javascript" charset="utf-8"></script>'."\n";
		return $html;
	}

	function renderHeadFoot($component)
	{
		$html = '</head>'."\n";
		return $html;
	}

	function renderJavaScript($component)
	{
		$html  = '<script type="text/javascript">'."\n";
		$html .= $component->getScript()."\n";
		$html .= '</script>'."\n";
		return $html;
	}

	function renderContainer($component) {
		$html = '';
		foreach($component->getComponents() as $comp) $html .= $this->render($comp);
		return $html;
	}
	
	function renderError($component)
	{
		$html = '';
		if (is_array($component->getError()))
		{
			$html = "\n".'<span class="'.$this->getClassError().'">';
			foreach($component->getError() as $type => $error)
				$html .= $error.'<br/>';
			$html = substr($html, 0, strlen($html) - 5);
			$html .= '</span>'."\n";
		}
		return $html;
	}
	
	public function getClassError()
	{
		return $this->class_error;
	}
}
?>
