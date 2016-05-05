<?php

namespace Centrium\Api\Module;

use Centrium\Api\Client;

use Centrium\Api\Model\TaskCustomFieldDefinition;
use Centrium\Api\Model\ResultSet;

class TaskCustomFieldDefinitionsModule extends BaseModule {
	
	public function listDefinitions() {
		$data = $this->apiClient->call(Client::METHOD_GET, '/settings/custom-fields/tasks', array(), array());
		
		$rs = new ResultSet($data, TaskCustomFieldDefinition::class);
		
		return $rs;
	}
	
	/**
	 * @param integer $id
	 * 
	 * @return \Centrium\Api\Model\TaskCustomFieldDefinition
	 */
	public function getDefinition($id) {
		$data = $this->apiClient->call(Client::METHOD_GET, '/settings/custom-fields/tasks/' . $id, array(), array());

		$customFieldDefinition = new TaskCustomFieldDefinition();
		$customFieldDefinition->fill($data['body']);
		
		return $customFieldDefinition;
	}
	
}