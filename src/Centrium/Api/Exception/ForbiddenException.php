<?php 

namespace Innodia\Centrium\Api\Exception;

class ForbiddenException extends APIException {
	
	public function __construct($url) {
		parent::__construct('Forbidden', 403, $url);
	}
	
	
	
	
}