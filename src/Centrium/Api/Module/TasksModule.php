<?php

namespace Innodia\Centrium\Api\Module;

use Innodia\Centrium\Api\Client;

use Innodia\Centrium\Api\Model\Task;
use Innodia\Centrium\Api\Model\ResultSet;

class TasksModule extends BaseModule {
	
	public function listTasks($searchParams = array()) {
		$data = $this->apiClient->call(Client::METHOD_GET, '/tasks', array(), $searchParams);
		
		$rs = new ResultSet($data, Task::class);
		
		return $rs;
	}
	
	/**
	 * @param integer $id
	 * 
	 * @return \Innodia\Centrium\Api\Model\Task
	 */
	public function getTask($id) {
		$data = $this->apiClient->call(Client::METHOD_GET, '/tasks/' . $id, array(), array());

		$task = new Task();
		$task->fill($data['body']);
		
		return $task;
	}
	
	public function createTask(Task $task) {
		$data = $this->apiClient->call(Client::METHOD_POST, '/tasks', $task->toArray());
		
		$task->fill($data['body']);
		
		return $task;		
	}
	
	public function updateTask($id, Task $task) {
		$data = $this->apiClient->call(Client::METHOD_PUT, '/tasks/' . $id, $task->toArray());
		
		$task->fill($data['body']);
		
		return $task;
	}
	
	public function deleteTask($id) {
		$this->apiClient->call(Client::METHOD_DELETE, '/tasks/' . $id);
	}
	
	
}