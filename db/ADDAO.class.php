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
include_once(dirname(__FILE__).'/ez_sql/ez_sql_core.php');
include_once(dirname(__FILE__).'/ez_sql/ez_sql_mysql.php');

/**
 * Defines:
 *   resources_db_adapter posibles values: pdo_mysql, pdo_msql, wordpress
 *   resources_db_params_host
 *   resources_db_params_username
 *   resources_db_params_password
 *   resources_db_params_dbname
 *   resources_db_prefix
 */
class ADDAO
{
	protected $db;
	public $prefix = '';

	function __construct($resources_db_adapter = '', $resources_db_params_username = '', $resources_db_params_password = '', $resources_db_params_dbname = '', $resources_db_params_host = '', $resources_db_prefix = '')
	{
		if ($resources_db_adapter == 'pdo_mysql')
		{
			$this->db = new ezSQL_mssql($resources_db_params_username, $resources_db_params_password, $resources_db_params_dbname, $resources_db_params_host);
			$this->prefix = $resources_db_prefix;
		}
		elseif ($resources_db_adapter == 'pdo_mssql')
		{
			$this->db = new ezSQL_mssql($resources_db_params_username, $resources_db_params_password, $resources_db_params_dbname, $resources_db_params_host);
			$this->prefix = $resources_db_prefix;
		}
		elseif (resources_db_adapter == 'pdo_mysql')
		{
			$this->db = new ezSQL_mysql(resources_db_params_username, resources_db_params_password, resources_db_params_dbname, resources_db_params_host);
			$this->prefix = resources_db_prefix;
		}
		elseif (resources_db_adapter == 'pdo_mssql')
		{
			$this->db = new ezSQL_mssql(resources_db_params_username, resources_db_params_password, resources_db_params_dbname, resources_db_params_host);
			$this->prefix = resources_db_prefix;
		}
		elseif (resources_db_adapter == 'wordpress')
		{
			global $wpdb;
			$this->db = $wpdb;
			$this->prefix = $wpdb->prefix;
		}
		else die(_('Error. Not database properties defined'));
		//if (defined('ADDAO_DEBUG') and ADDAO_DEBUG == true) $this->db->show_errors();
	}

	/**
	 * Sets all the properties from an array or an object
	 */
	function setValues($values)
	{
		$vs = $values;
		if (is_object($vs)) $vs = get_object_vars($vs);
		if (is_array($vs))
			foreach($vs as $name => $value)
			{
				$first = strtoupper(substr($name, 0, 1));
				$name = 'set'.$first.substr($name, 1);
				if (method_exists($this, $name)) $this->$name($value);
			}
	}

	function get_results($sql, $params = false)
	{
		if ($params)
		{
			$ps = $params;
			if (is_object($ps)) $ps = get_object_vars($ps);
			$aux = $sql;
			foreach($ps as $field => $value)
				$aux = $this->str_replace_once(':'.$field.':', $this->db->escape($value), $aux);
//echo $aux.'<br>';
			return $this->db->get_results($aux);
		}
		else return $this->db->get_results($sql);
	}

	function get_row($sql, $params = false)
	{
		if ($params)
		{
			$aux = $sql;
			$ps = $params;
			if (is_object($ps)) $ps = get_object_vars($ps);
			foreach($ps as $field => $value)
				$aux = $this->str_replace_once(':'.$field.':', $this->db->escape($value), $aux);
//echo  $aux.'<br>';
			return $this->db->get_row($aux);
		}
		else return $this->db->get_row($sql);
	}

	function get_var($sql, $params = false)
	{
		if ($params)
		{
			$aux = $sql;
			$ps = $params;
			if (is_object($ps)) $ps = get_object_vars($ps);
			foreach($ps as $field => $value)
				$aux = $this->str_replace_once(':'.$field.':', $this->db->escape($value), $aux);
//echo  $aux.'<br>';
			return $this->db->get_var($aux);
		}
		else return $this->db->get_var($sql);
	}

	function query($sql, $params = false) {
		if ($params) {
			$aux = $sql;
			$ps = $params;
			if (is_object($ps)) $ps = get_object_vars($ps);
			foreach($ps as $field => $value)
				$aux = $this->str_replace_once(':'.$field.':', $this->db->escape($value), $aux);
//echo $aux.'<br>';
			return $this->db->query($aux);
		} else 
			return $this->db->query($sql);
	}

	/**
	 * Obtiene el último id de un insert sobre una tabla con un id autonumérico.
	 */
	function get_insert_id()
	{
		return $this->db->insert_id;
	}
	
	/**
	 * Por compatibilidad con versiones anteriores.
	 *
	 * @see get_insert_id;
	 * @deprecated
	 */
	function insert_id()
	{
		return $this->get_insert_id();
	}

	private function str_replace_once($needle , $replace , $haystack)
	{
		// Looks for the first occurence of $needle in $haystack
		// and replaces it with $replace.
		$pos = strpos($haystack, $needle);
		if ($pos === false)
		    // Nothing found
			return $haystack;
		return substr_replace($haystack, $replace, $pos, strlen($needle));
	}
	
	public function get_value($params, $value_id, $value = '')
	{
		if (is_object($params)) return $params->$value_id;
		else if (is_array($params)) return $params[$value_id];
		else return $value;
	}
}
?>
