<?php

namespace Centrium\Api\Module;

use Centrium\Api\Client;

use Centrium\Api\Model\ProjectType;
use Centrium\Api\Model\ResultSet;

class ProjectSettingsModule extends BaseModule {
	
	public function listProjectTypes() {
		$data = $this->apiClient->call(Client::METHOD_GET, '/settings/projects/types', array(), array());
		
		$rs = new ResultSet($data, ProjectType::class);
		
		return $rs;
	}
	
	/**
	 * @param integer $id
	 * 
	 * @return \Centrium\Api\Model\ProjectType
	 */
	public function getProjectType($id) {
		$data = $this->apiClient->call(Client::METHOD_GET, '/settings/projects/types/' . $id, array(), array());

		$project = new ProjectType();
		$project->fill($data['body']);
		
		return $project;
	}
	
}