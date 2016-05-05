<?php

namespace Centrium\Api\Module;

use Centrium\Api\Client;

use Centrium\Api\Model\Contact;
use Centrium\Api\Model\ResultSet;

class ContactsModule extends BaseModule {
	
	public function listContacts($searchParams = array()) {
		$data = $this->apiClient->call(Client::METHOD_GET, '/contacts', array(), $searchParams);
		
		$rs = new ResultSet($data, Contact::class);
		
		return $rs;
	}
	
	/**
	 * @param integer $id
	 * 
	 * @return \Centrium\Api\Model\Contact
	 */
	public function getContact($id) {
		$data = $this->apiClient->call(Client::METHOD_GET, '/contacts/' . $id, array(), array());

		$contact = new Contact();
		$contact->fill($data['body']);
		
		return $contact;
	}
	
	public function createContact(Contact $contact) {
		$data = $this->apiClient->call(Client::METHOD_POST, '/contacts', $contact->toArray());
		
		$contact->fill($data['body']);
		
		return $contact;		
	}
	
	public function updateContact($id, Contact $contact) {
		$data = $this->apiClient->call(Client::METHOD_PUT, '/contacts/' . $id, $contact->toArray());
		
		$contact->fill($data['body']);
		
		return $contact;
	}
	
	public function deleteContact($id) {
		$this->apiClient->call(Client::METHOD_DELETE, '/contacts/' . $id);
	}
	
	
}