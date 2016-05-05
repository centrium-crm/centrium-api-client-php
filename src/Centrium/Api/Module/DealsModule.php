<?php

namespace Innodia\Centrium\Api\Module;

use Innodia\Centrium\Api\Client;

use Innodia\Centrium\Api\Model\Deal;
use Innodia\Centrium\Api\Model\ResultSet;

class DealsModule extends BaseModule {
	
	public function listDeals($searchParams = array()) {
		$data = $this->apiClient->call(Client::METHOD_GET, '/deals', array(), $searchParams);
		
		$rs = new ResultSet($data, Deal::class);
		
		return $rs;
	}
	
	/**
	 * @param integer $id
	 * 
	 * @return \Innodia\Centrium\Api\Model\Deal
	 */
	public function getDeal($id) {
		$data = $this->apiClient->call(Client::METHOD_GET, '/deals/' . $id, array(), array());

		$deal = new Deal();
		$deal->fill($data['body']);
		
		return $deal;
	}
	
	public function createDeal(Deal $deal) {
		$data = $this->apiClient->call(Client::METHOD_POST, '/deals', $deal->toArray());
		
		$deal->fill($data['body']);
		
		return $deal;		
	}
	
	public function updateDeal($id, Deal $deal) {
		$data = $this->apiClient->call(Client::METHOD_PUT, '/deals/' . $id, $deal->toArray());
		
		$deal->fill($data['body']);
		
		return $deal;
	}
	
	public function deleteDeal($id) {
		$this->apiClient->call(Client::METHOD_DELETE, '/deals/' . $id);
	}
	
	
}