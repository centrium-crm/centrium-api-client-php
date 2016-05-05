<?php

namespace Innodia\Centrium\Api\Module;

use Innodia\Centrium\Api\Client;

use Innodia\Centrium\Api\Model\TaskType;
use Innodia\Centrium\Api\Model\ResultSet;

class TaskSettingsModule extends BaseModule {
	
	public function listTaskTypes() {
		$data = $this->apiClient->call(Client::METHOD_GET, '/settings/tasks/types', array(), array());
		
		$rs = new ResultSet($data, TaskType::class);
		
		return $rs;
	}
	
	/**
	 * @param integer $id
	 * 
	 * @return \Innodia\Centrium\Api\Model\TaskType
	 */
	public function getTaskType($id) {
		$data = $this->apiClient->call(Client::METHOD_GET, '/settings/tasks/types/' . $id, array(), array());

		$task = new TaskType();
		$task->fill($data['body']);
		
		return $task;
	}
	
}