<?php

namespace Innodia\Centrium\Api\Module;

use Innodia\Centrium\Api\Client;

use Innodia\Centrium\Api\Model\Note;
use Innodia\Centrium\Api\Model\ResultSet;

class NotesModule extends BaseModule {
	
	public function listNotes($searchParams = array()) {
		$data = $this->apiClient->call(Client::METHOD_GET, '/notes', array(), $searchParams);
		
		$rs = new ResultSet($data, Note::class);
		
		return $rs;
	}
	
	/**
	 * @param integer $id
	 * 
	 * @return \Innodia\Centrium\Api\Model\Note
	 */
	public function getNote($id) {
		$data = $this->apiClient->call(Client::METHOD_GET, '/notes/' . $id, array(), array());

		$note = new Note();
		$note->fill($data['body']);
		
		return $note;
	}
	
	public function createNote(Note $note) {
		$data = $this->apiClient->call(Client::METHOD_POST, '/notes', array('model' => $note->toArray()));
		
		$note->fill($data['body']);
		
		return $note;		
	}
	
	public function updateNote($id, Note $note) {
		$data = $this->apiClient->call(Client::METHOD_PUT, '/notes/' . $id, $note->toArray());
		
		$note->fill($data['body']);
		
		return $note;
	}
	
	public function deleteNote($id) {
		$this->apiClient->call(Client::METHOD_DELETE, '/notes/' . $id);
	}
	
	
}