<?php

namespace Innodia\Centrium\Api\Module;

use Innodia\Centrium\Api\Client;

use Innodia\Centrium\Api\Model\ProjectType;
use Innodia\Centrium\Api\Model\ResultSet;

class ProjectSettingsModule extends BaseModule {
	
	public function listProjectTypes() {
		$data = $this->apiClient->call(Client::METHOD_GET, '/settings/projects/types', array(), array());
		
		$rs = new ResultSet($data, ProjectType::class);
		
		return $rs;
	}
	
	/**
	 * @param integer $id
	 * 
	 * @return \Innodia\Centrium\Api\Model\ProjectType
	 */
	public function getProjectType($id) {
		$data = $this->apiClient->call(Client::METHOD_GET, '/settings/projects/types/' . $id, array(), array());

		$project = new ProjectType();
		$project->fill($data['body']);
		
		return $project;
	}
	
}