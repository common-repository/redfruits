<?php

class ADModel
{
	function setValues($param)
	{
		if ($param)
		{
			if (is_object($param)) $p = get_object_vars($param);
			else $p = $param;
			foreach($p as $key => $value)
				if (property_exists($this, $key))
					if (is_array($value)) $this->$key = implode(",", $value);
					else $this->$key = $value;
		}
		return $this;
	}
}
?>
