<?php

namespace Centrium\Api\Module;

use Centrium\Api\Client;
class BaseModule {

	/**
	 * 
	 * @var \Centrium\Api\Client apiClient
	 */
	protected $apiClient;
	
	public function __construct(Client $apiClient) {
		$this->apiClient = $apiClient;
	}
	
	
	
}