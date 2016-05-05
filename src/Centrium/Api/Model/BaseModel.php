<?php 

namespace Centrium\Api\Model;

class BaseModel {
	
	private $attributes = array();
	
	public function __construct($data = array()) {
		$this->fill($data);
	}
	
	public function fill($data) {
		foreach ($data as $key => $value) {
			$this->attributes[$key] = $value; 
		}
	}
	
	public function toArray() {
		return $this->attributes;
	}
	
	public function __call($method, $arguments) {
		
		if (substr($method, 0, 3) == 'get') {
			return $this->attributes[lcfirst(substr($method, 3))];
		} elseif (substr($method, 0, 3) == 'set') {
			$this->attributes[lcfirst(substr($method, 3))] = $arguments[0];
		}
		
		
	}
	
	
	
}