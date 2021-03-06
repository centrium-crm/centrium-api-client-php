<?php

namespace Centrium\Api\Module;

use Centrium\Api\Client;

use Centrium\Api\Model\DealStage;
use Centrium\Api\Model\ResultSet;
use Centrium\Api\Model\DealWonReason;
use Centrium\Api\Model\DealLostReason;
use Centrium\Api\Model\Centrium\Api\Model;

class DealSettingsModule extends BaseModule {
	
	public function listDealStages() {
		$data = $this->apiClient->call(Client::METHOD_GET, '/settings/deals/stages', array(), array());
		
		$rs = new ResultSet($data, DealStage::class);
		
		return $rs;
	}
	
	/**
	 * @param integer $id
	 * 
	 * @return \Centrium\Api\Model\DealStage
	 */
	public function getDealStage($id) {
		$data = $this->apiClient->call(Client::METHOD_GET, '/settings/deals/stages/' . $id, array(), array());

		$dealStage = new DealStage();
		$dealStage->fill($data['body']);
		
		return $dealStage;
	}
	
	public function listDealWonReasons() {
		$data = $this->apiClient->call(Client::METHOD_GET, '/settings/deals/reasons/won', array(), array());
	
		$rs = new ResultSet($data, DealWonReason::class);
	
		return $rs;
	}
	
	/**
	 * @param integer $id
	 *
	 * @return \Centrium\Api\Model\DealWonReason
	 */
	public function getDealWonReason($id) {
		$data = $this->apiClient->call(Client::METHOD_GET, '/settings/deals/reasons/won' . $id, array(), array());
	
		$dealWonReason = new DealWonReason();
		$dealWonReason->fill($data['body']);
	
		return $dealWonReason;
	}
	
	public function listDealLostReasons() {
		$data = $this->apiClient->call(Client::METHOD_GET, '/settings/deals/reasons/lost', array(), array());
	
		$rs = new ResultSet($data, DealLostReason::class);
	
		return $rs;
	}
	
	/**
	 * @param integer $id
	 *
	 * @return \Centrium\Api\Model\DealLostReason
	 */
	public function getDealLostReason($id) {
		$data = $this->apiClient->call(Client::METHOD_GET, '/settings/deals/reasons/lost' . $id, array(), array());
	
		$dealLostReason = new DealLostReason();
		$dealLostReason->fill($data['body']);
	
		return $dealLostReason;
	}
	
}