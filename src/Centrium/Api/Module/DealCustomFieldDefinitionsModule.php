<?php

namespace Innodia\Centrium\Api\Module;

use Innodia\Centrium\Api\Client;

use Innodia\Centrium\Api\Model\DealCustomFieldDefinition;
use Innodia\Centrium\Api\Model\ResultSet;

class DealCustomFieldDefinitionsModule extends BaseModule {
	
	public function listDefinitions() {
		$data = $this->apiClient->call(Client::METHOD_GET, '/settings/custom-fields/deals', array(), array());
		
		$rs = new ResultSet($data, ContactCustomFieldDefinition::class);
		
		return $rs;
	}
	
	/**
	 * @param integer $id
	 * 
	 * @return \Innodia\Centrium\Api\Model\DealCustomFieldDefinition
	 */
	public function getDefinition($id) {
		$data = $this->apiClient->call(Client::METHOD_GET, '/settings/custom-fields/deals/' . $id, array(), array());

		$customFieldDefinition = new DealCustomFieldDefinition();
		$customFieldDefinition->fill($data['body']);
		
		return $customFieldDefinition;
	}
	
}