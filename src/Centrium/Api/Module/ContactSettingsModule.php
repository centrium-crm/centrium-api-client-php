<?php

namespace Innodia\Centrium\Api\Module;

use Innodia\Centrium\Api\Client;

use Innodia\Centrium\Api\Model\ContactType;
use Innodia\Centrium\Api\Model\ResultSet;

class ContactSettingsModule extends BaseModule {
	
	public function listContactTypes() {
		$data = $this->apiClient->call(Client::METHOD_GET, '/settings/contacts/types', array(), array());
		
		$rs = new ResultSet($data, ContactType::class);
		
		return $rs;
	}
	
	/**
	 * @param integer $id
	 * 
	 * @return \Innodia\Centrium\Api\Model\ContactType
	 */
	public function getContactType($id) {
		$data = $this->apiClient->call(Client::METHOD_GET, '/settings/contacts/types/' . $id, array(), array());

		$contact = new ContactType();
		$contact->fill($data['body']);
		
		return $contact;
	}
	
}