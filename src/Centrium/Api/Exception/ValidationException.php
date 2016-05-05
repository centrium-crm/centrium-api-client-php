<?php 

namespace Centrium\Api\Exception;

class ValidationException extends APIException {
	
	public function __construct($url, $body) {
		parent::__construct('Validation Exception', 400, $url, $body);
	}
	
	public function getErrors() {
		return $this->getBody();
	}
	
	
	
}