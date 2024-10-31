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
 * RedFruits :: ADRequirement
 *
 * 2009-2010 (c) arohadigital
 *
 * Represents a Form tag
 */
require_once('ADContainer.class.php');
require_once('ADRequirement.class.php');

class ADForm extends ADContainer
{
	protected $name;
	protected $action;
	protected $method;
	protected $enctype;
	protected $requirement;

	/**
	 *
	 * @param $enctype possible values: multipart/form-data
	 */
	function __construct($id = '', $action = '', $method = 'post', $enctype = '')
	{
		parent::__construct('', $id);
		$this->action = $action;
		$this->method = $method;
		$this->enctype = $enctype;
		$this->requirement = new ADRequirement();
	}

	function getAction()
	{
		return $this->action;
	}

	function getMethod()
	{
		return $this->method;
	}

	function setEnctype($enctype)
	{
		$this->enctype = $enctype;
		return $this;
	}

	function getEnctype()
	{
		return $this->enctype;
	}

	function setError($error)
	{
		$this->error = $error;
		if (isset($this->error)) $this->assignError($this);
		return $this;
	}

	private function assignError($component)
	{
		if ($component instanceof ADContainer)
		{
			foreach($component->getComponents() as $comp) $this->assignError($comp);
		} else if (method_exists($component, 'setError'))
		{
			$id = $component->getId();
			if (is_array($this->error))
			{
				if (isset($this->error[$id]))
				{
					$error = $this->error[$id];
					$component->setError($error);
				}
			} else if (is_object($this->error))
			{
				if (isset($this->error->$id))
				{
					$error = $this->error->$id;
					$component->setError($error);
				}
			}
		}
	}

	function setValues($value)
	{
		$this->value = $value;
		if (isset($this->value)) $this->assignValue($this);
		return $this;
	}

	private function assignValue($component)
	{
		if ($component instanceof ADContainer)
		{
			foreach($component->getComponents() as $comp) $this->assignValue($comp);
		}
		else if (method_exists($component, 'setValue'))
		{
			$id = $component->getName();
			if ($this->endsWith($id, '[]')) $id = substr($id, 0, strlen($id) - 2);
			if (is_array($this->value))
			{
				if (isset($this->value[$id]))
				{
					$value = $this->value[$id];
					$component->setValue($value);
				}
			}
			elseif (is_object($this->value))
			{
				if (isset($this->value->$id))
				{
					$value = $this->value->$id;
					$component->setValue($value);
				}
			}
		}
	}

	function setValue($id, $value)
	{
		$this->value = $value;
		if (isset($this->value)) $this->assignValueByName($this, $id);
		return $this;
	}

	private function assignValueByName($component, $id)
	{
		if ($component instanceof ADContainer)
			foreach($component->getComponents() as $comp) $this->assignValueByName($comp, $id);
		else if (method_exists($component, 'setValue'))
			if ($id == $component->getId()) $component->setValue($this->value);
		return $this;
	}
	
	function addRequirement($input_name, $type, $err_msg)
	{
		$this->requirement->addRequirement($input_name, $type, $err_msg);
		return $this;
	}

	function runRequirements($request)
	{
		if (!$this->requirement->run($request))
		{
			$this->setError($this->requirement->getErrorMsg());
			return false;
		}
		else return true;
	}

	function setName($name)
	{
		$this->name = $name;
		return $this;
	}	
	function getName()
	{
		return $this->name;
	}

	//checks if the string $str ends with $end
	private function endsWith($str, $end)
	{
		return (substr($str, strlen($str) - strlen($end)) == $end);
	}
}
?>
