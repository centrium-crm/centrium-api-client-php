<?php

namespace Centrium\Api\Module;

use Centrium\Api\Client;

use Centrium\Api\Model\User;
use Centrium\Api\Model\Group;
use Centrium\Api\Model\ResultSet;

class AccountModule extends BaseModule {
	
	public function listUsers() {
		$data = $this->apiClient->call(Client::METHOD_GET, '/account/users', array(), array());
		
		$rs = new ResultSet($data, User::class);
		
		return $rs;
	}
	
	/**
	 * @param integer $id
	 * 
	 * @return \Centrium\Api\Model\User
	 */
	public function getUser($id) {
		$data = $this->apiClient->call(Client::METHOD_GET, '/account/users/' . $id, array(), array());

		$user = new User();
		$user->fill($data['body']);
		
		return $user;
	}
	
	public function listGroups() {
		$data = $this->apiClient->call(Client::METHOD_GET, '/account/groups', array(), array());
	
		$rs = new ResultSet($data, Group::class);
	
		return $rs;
	}
	
	/**
	 * @param integer $id
	 *
	 * @return \Centrium\Api\Model\Group
	 */
	public function getGroup($id) {
		$data = $this->apiClient->call(Client::METHOD_GET, '/account/groups/' . $id, array(), array());
	
		$group = new Group();
		$group->fill($data['body']);
	
		return $group;
	}
	
}