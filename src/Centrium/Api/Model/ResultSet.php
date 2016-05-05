<?php 

namespace Innodia\Centrium\Api\Model;

class ResultSet implements \Iterator, \Countable {
	
	private $position = 0;
	
	private $headers;
	private $body;
	private $modelClass;
	
	public function __construct($data, $modelClass) {
		$this->modelClass = $modelClass;
		
		$this->headers = $data['headers'];
		$this->body = $data['body'];
		
		$this->hasNextPage = isset($this->headers['X-PAGINATION-MORE-RESULTS']) && $this->headers['X-PAGINATION-MORE-RESULTS'];
		
		
	}
	
	public function hasNextPage() {
		return $this->hasNextPage;
	}
	
	public function at($index) {
		$data = $this->body[$index];
		
		return new $this->modelClass($data);
	}
	
	public function count() {
		return count($this->body);
	}
	
	public function rewind() {
		$this->position = 0;
	}
	
	public function current() {
		return $this->at($this->position);
	}
	
	public function key() {
		return $this->position;
	}
	
	public function next() {
		++$this->position;
	}
	
	public function valid() {
		return isset($this->body[$this->position]);
	}
	
	
	
}