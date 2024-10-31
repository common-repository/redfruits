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
 * Implementa una forma de validar los datos de entrada de un formulario mediante
 * requisitos.
 *
 * Mediante la función add_requirement se añaden requisitos que deberán cumplir
 * los datos de entrada (Request). La función run es la encargada de validar los
 * requisitos con los datos de entrada.
 *
 * Un ejemplo de uso sería:
 *
 * class controller extends core_controller {
 *
 * function save_action($request) {
 * $this->add_requirement('user_name', 'required', 'El nombre de usuario es un campo obligatorio');
 * $this->add_requirement('user_pwd', 'required', 'La contraseña es un campo obligatorio');
 * if ($requirements->run($request)) {
 *     $err_msgs = $req->get_err_msgs();
 *     var_dump($err_msgs);
 * ...
 *
 * Otro ejemplo de uso sería:
 *
 * function save_action($request) {
 * $this->add_requirement('user_name', 'required', 'El nombre de usuario es un campo obligatorio')->add_requirement('user_pwd', 'required', 'La contraseña es un campo obligatorio')->run($request)) {
 *
 *
 * Otro ejemplo de uso sería:
 *
 * function save_action($request) {
 * $this->requirements = new core_requirement(array('user_name' => array('required' => 'El nombre de usuario es un campo obligatorio')),
 *   array('user_pwd' => array('required' => 'La contraseña es un campo obligatorio')));
 * if ($this->requirements->run($request, $err_msgs)) {
 * ...
 */

class ADRequirement
{
	protected $requirements;
	protected $err_msg = array();

	function __construct($requirements = array())
	{
		$this->requirements = $requirements;
	}

	function addRequirement($input_name, $type, $err_msg)
	{
		$this->requirements[$input_name][$type] = $err_msg;
		return $this;
	}

	//equal to addRequirement
	function addReq($input_name, $type, $err_msg)
	{
		return $this->addRequirement($input_name, $type, $err_msg);
	}

	function clear()
	{
		unset($this->requirements);
	}

	function run($request)
	{
		foreach($this->requirements as $input_name => $requirement)
			foreach($requirement as $type => $txt)
				if ($type == 'required')
				{
					$aux = strtoupper($input_name);
					if (strrpos($aux, ' OR ') > 0)
					{
						$input_names = explode($input_name, ' OR ');
						$cond = false;
						foreach($input_names as $input)
							$cond = $cond || (strlen($request[$input]) > 0);
						if (!$cond) $this->err_msg[$input_name][$type] = $txt;
					}
					else if (strlen($request[$input_name]) == 0) $this->err_msg[$input_name][$type] = $txt;
				}
				elseif ($type == 'numeric')
				{
					$value = trim($request[$input_name]);
					if (strlen($value) == 0 || !$this->isNumeric($value)) $this->err_msg[$input_name][$type] = $txt;
				}
				elseif ($type == 'date')
				{
					if (!$this->isDate($request[$input_name])) $this->err_msg[$input_name][$type] = $txt;
				}
				elseif ($type == 'datetime')
				{
					if (!$this->isDateTime($request[$input_name])) $this->err_msg[$input_name][$type] = $txt;
				}
				else
				{
					$arg = explode('?', $type);
					if (is_array($arg) && count($arg) == 2)
						if ($arg[0] == 'lessthan')
							if ($value >= $arg[1]) $this->err_msg[$input_name][$type] = $txt;
							else ;
						elseif ($arg[0] == 'lessequalthan')
							if ($value > $arg[1]) $this->err_msg[$input_name][$type] = $txt;
							else ;
						elseif ($arg[0] == 'greaterthan')
							if ($value <= $arg[1]) $this->err_msg[$input_name][$type] = $txt;
							else ;
						elseif ($arg[0] == 'greaterequalthan')
							if ($value < $arg[1]) $this->err_msg[$input_name][$type] = $txt;
							else ;

						else $this->err_msg[$input_name][$type] = _('requirement invaluable: '). $type;
					else $this->err_msg[$input_name][$type] = _('requirement invaluable: '). $type;
				}
		return count($this->err_msg) == 0;
	}

	function getErrorMsg()
	{
		return $this->err_msg;
	}

	/**
	 * Verify the data format (yyyy-mm-dd)
	 */
	function isDate($date)
	{
		if ($date == '0000-00-00') return true;
		if (strlen($date) > 0)
		{
			$dates = preg_split("/[\s-]+/", $date);
			if (count($dates) != 3) return false;
			$day = $dates[2];
			$month = $dates[1];
			$year = $dates[0];
			return checkdate($month, $day, $year);
		} else return true;
	}

	function isNumeric($num)
	{
		if (strlen($num) > 0) return is_numeric($num);
		else return true;
	}

	/**
	 * wait for: yyyy/mm/dd hh:mm:ss or yyyy/mm/dd hh:mm or yyyy/mm/dd
	 */
	function isDateTime($fecha)
	{
		$datetime = explode(' ', $fecha);
		if (is_array($datetime) && count($datetime) == 2)
		{
			$date = explode('/', $datetime[0]);
			if (is_array($date) && count($date) == 3)
			{
				$year	= $date[0];
				$month	= $date[1];
				$day	= $date[2];
			}
			else return false;
			$time = explode(':', $datetime[1]);
			if (is_array($time) && count($time) == 3)
			{
				$hour	= $time[0];
				$minute	= $time[1];
				$second	= $time[2];
			}
			elseif (is_array($time) && count($time) == 2)
			{
				$hour	= $time[0];
				$minute	= $time[1];
				$second	= 0;
			}

			else return false;
			return mktime(intval($hour), intval($minute), intval($second), intval($month), intval($day), intval($year)); 
		}
		else
		{
			$date = explode('/', $fecha);
			if (is_array($date) && count($date) == 3)
			{
				$year	= $date[0];
				$month	= $date[1];
				$day	= $date[2];
			}
			else return false;
			return mktime(0, 0, 0, intval($month), intval($day), intval($year)); 
		}
	}
}
?>
