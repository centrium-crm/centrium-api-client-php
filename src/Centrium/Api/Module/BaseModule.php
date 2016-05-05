<?php

namespace Innodia\Centrium\Api\Module;

use Innodia\Centrium\Api\Client;
class BaseModule {

	/**
	 * 
	 * @var \Innodia\Centrium\Api\Client apiClient
	 */
	protected $apiClient;
	
	public function __construct(Client $apiClient) {
		$this->apiClient = $apiClient;
	}
	
	
	
}