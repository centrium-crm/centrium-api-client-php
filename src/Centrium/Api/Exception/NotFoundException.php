<?php 

namespace Centrium\Api\Exception;

class NotFoundException extends APIException {
	
	public function __construct($url) {
		parent::__construct('Not found', 404, $url);
	}
	
	
	
	
}