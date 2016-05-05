<?php

namespace Centrium\Api\Module;

use Centrium\Api\Client;

use Centrium\Api\Model\ContactType;
use Centrium\Api\Model\ResultSet;

class ContactSettingsModule extends BaseModule {
	
	public function listContactTypes() {
		$data = $this->apiClient->call(Client::METHOD_GET, '/settings/contacts/types', array(), array());
		
		$rs = new ResultSet($data, ContactType::class);
		
		return $rs;
	}
	
	/**
	 * @param integer $id
	 * 
	 * @return \Centrium\Api\Model\ContactType
	 */
	public function getContactType($id) {
		$data = $this->apiClient->call(Client::METHOD_GET, '/settings/contacts/types/' . $id, array(), array());

		$contact = new ContactType();
		$contact->fill($data['body']);
		
		return $contact;
	}
	
}