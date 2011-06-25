<?php

/**
* 
*/
class Model
{
	private $data = array();
	
	function __construct($data=array())
	{
		$this->data = $data;
	}
	
	function __get($property){
		if(isset($this->data[$property])){
			return $this->data[$property];
		} elseif(method_exists($this, 'get_' . $property)){
			return $this->{'get_' . $property}();
		} else {
			return $this->$property;
		}
	}
}

