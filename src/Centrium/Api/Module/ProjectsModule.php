<?php

namespace Innodia\Centrium\Api\Module;

use Innodia\Centrium\Api\Client;

use Innodia\Centrium\Api\Model\Project;
use Innodia\Centrium\Api\Model\ResultSet;

class ProjectsModule extends BaseModule {
	
	public function listProjects($searchParams = array()) {
		$data = $this->apiClient->call(Client::METHOD_GET, '/projects', array(), $searchParams);
		
		$rs = new ResultSet($data, Project::class);
		
		return $rs;
	}
	
	/**
	 * @param integer $id
	 * 
	 * @return \Innodia\Centrium\Api\Model\Project
	 */
	public function getProject($id) {
		$data = $this->apiClient->call(Client::METHOD_GET, '/projects/' . $id, array(), array());

		$project = new Project();
		$project->fill($data['body']);
		
		return $project;
	}
	
	public function createProject(Project $project) {
		$data = $this->apiClient->call(Client::METHOD_POST, '/projects', $project->toArray());
		
		$project->fill($data['body']);
		
		return $project;		
	}
	
	public function updateProject($id, Project $project) {
		$data = $this->apiClient->call(Client::METHOD_PUT, '/projects/' . $id, $project->toArray());
		
		$project->fill($data['body']);
		
		return $project;
	}
	
	public function deleteProject($id) {
		$this->apiClient->call(Client::METHOD_DELETE, '/projects/' . $id);
	}
	
	
}