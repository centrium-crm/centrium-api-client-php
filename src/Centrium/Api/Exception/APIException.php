<?php 

namespace Centrium\Api\Exception;

class APIException extends \Exception {
	
	private $body;
	private $url;
	
	public function __construct($message, $code, $url, $body = null, $previous = null) {
		parent::__construct($message, $code, $previous);

		$this->url = $url;
		$this->body = $body;
	}
	
	public function setUrl($url) {
		$this->url = $url;
	}
	
	public function getUrl() {
		return $this->url;
	}
	
	public function setBody($body) {
		$this->body = $body;
	}
	
	public function getBody() {
		return $this->body;
	}
	
	
	
	
}