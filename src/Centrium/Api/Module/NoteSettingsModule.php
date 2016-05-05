<?php

namespace Innodia\Centrium\Api\Module;

use Innodia\Centrium\Api\Client;

use Innodia\Centrium\Api\Model\NoteType;
use Innodia\Centrium\Api\Model\ResultSet;

class NoteSettingsModule extends BaseModule {
	
	public function listNoteTypes() {
		$data = $this->apiClient->call(Client::METHOD_GET, '/settings/notes/types', array(), array());
		
		$rs = new ResultSet($data, NoteType::class);
		
		return $rs;
	}
	
	/**
	 * @param integer $id
	 * 
	 * @return \Innodia\Centrium\Api\Model\NoteType
	 */
	public function getNoteType($id) {
		$data = $this->apiClient->call(Client::METHOD_GET, '/settings/notes/types/' . $id, array(), array());

		$note = new NoteType();
		$note->fill($data['body']);
		
		return $note;
	}
	
}