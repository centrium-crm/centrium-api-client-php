<?php

namespace Innodia\Centrium\Api\Module;

use Innodia\Centrium\Api\Client;

use Innodia\Centrium\Api\Model\ContactCustomFieldDefinition;
use Innodia\Centrium\Api\Model\ResultSet;

class ContactCustomFieldDefinitionsModule extends BaseModule {
	
	public function listDefinitions() {
		$data = $this->apiClient->call(Client::METHOD_GET, '/settings/custom-fields/contacts', array(), array());
		
		$rs = new ResultSet($data, ContactCustomFieldDefinition::class);
		
		return $rs;
	}
	
	/**
	 * @param integer $id
	 * 
	 * @return \Innodia\Centrium\Api\Model\ContactCustomFieldDefinition
	 */
	public function getDefinition($id) {
		$data = $this->apiClient->call(Client::METHOD_GET, '/settings/custom-fields/contacts/' . $id, array(), array());

		$customFieldDefinition = new ContactCustomFieldDefinition();
		$customFieldDefinition->fill($data['body']);
		
		return $customFieldDefinition;
	}
	
}