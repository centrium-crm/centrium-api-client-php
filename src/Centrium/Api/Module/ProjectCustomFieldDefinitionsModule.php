<?php

namespace Centrium\Api\Module;

use Centrium\Api\Client;

use Centrium\Api\Model\ProjectCustomFieldDefinition;
use Centrium\Api\Model\ResultSet;

class ProjectCustomFieldDefinitionsModule extends BaseModule {
	
	public function listDefinitions() {
		$data = $this->apiClient->call(Client::METHOD_GET, '/settings/custom-fields/projects', array(), array());
		
		$rs = new ResultSet($data, ProjectCustomFieldDefinition::class);
		
		return $rs;
	}
	
	/**
	 * @param integer $id
	 * 
	 * @return \Centrium\Api\Model\ProjectCustomFieldDefinition
	 */
	public function getDefinition($id) {
		$data = $this->apiClient->call(Client::METHOD_GET, '/settings/custom-fields/projects/' . $id, array(), array());

		$customFieldDefinition = new ProjectCustomFieldDefinition();
		$customFieldDefinition->fill($data['body']);
		
		return $customFieldDefinition;
	}
	
}