<?php

namespace Centrium\Api\Module;

use Centrium\Api\Client;

use Centrium\Api\Model\DealCustomFieldDefinition;
use Centrium\Api\Model\ResultSet;

class DealCustomFieldDefinitionsModule extends BaseModule {
	
	public function listDefinitions() {
		$data = $this->apiClient->call(Client::METHOD_GET, '/settings/custom-fields/deals', array(), array());
		
		$rs = new ResultSet($data, DealCustomFieldDefinition::class);
		
		return $rs;
	}
	
	/**
	 * @param integer $id
	 * 
	 * @return \Centrium\Api\Model\DealCustomFieldDefinition
	 */
	public function getDefinition($id) {
		$data = $this->apiClient->call(Client::METHOD_GET, '/settings/custom-fields/deals/' . $id, array(), array());

		$customFieldDefinition = new DealCustomFieldDefinition();
		$customFieldDefinition->fill($data['body']);
		
		return $customFieldDefinition;
	}
	
}