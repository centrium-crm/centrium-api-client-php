<?php 

namespace Innodia\Centrium\Api\Exception;

class NotAuthorizedException extends APIException {
	
	public function __construct($url) {
		parent::__construct('Not authorized', 401, $url);
	}
	
	
	
	
}