<?php 

namespace Innodia\Centrium\Api;

use Innodia\Centrium\Api\Exception\APIException;
use Innodia\Centrium\Api\Exception\ForbiddenException;
use Innodia\Centrium\Api\Exception\NotAuthorizedException;
use Innodia\Centrium\Api\Exception\NotFoundException;
use Innodia\Centrium\Api\Exception\ValidationException;

class Client {
	
	const METHOD_GET = 'GET';
	const METHOD_PUT = 'PUT';
	const METHOD_POST = 'POST';
	const METHOD_DELETE = 'DELETE';
	
	const API_DEFAULT_VERSION = 'alpha';
	
	const API_DEFAULT_ENDPOINT = 'https://app.centriumcrm.com';
	
	private $endpointUrl = '';
	private $version;
	private $key = '';
	private $secret = '';
	
	private $moduleCache = array();
	
	public function __construct($key, $secret, $version = null, $endpointUrl = null) {
		$this->key = $key;
		$this->secret = $secret;
		$this->endpointUrl = $endpointUrl;
		$this->version = $version;
		
		if (is_null($this->endpointUrl)) {
			$this->endpointUrl = self::API_DEFAULT_ENDPOINT;
		}
		
		if (is_null($this->version)) {
			$this->version = self::API_DEFAULT_VERSION;
		}
	}
	
	/**
	 * @return \Innodia\Centrium\Api\Module\AccountModule
	 */
	public function account()
	{
		return $this->module(\Innodia\Centrium\Api\Module\AccountModule::class);
	}
	
	/**
	 * @return \Innodia\Centrium\Api\Module\ContactsModule
	 */
	public function contacts() 
	{
		return $this->module(\Innodia\Centrium\Api\Module\ContactsModule::class);
	}
	
	/**
	 * @return \Innodia\Centrium\Api\Module\ContactSettingsModule
	 */
	public function contactSettings()
	{
		return $this->module(\Innodia\Centrium\Api\Module\ContactSettingsModule::class);
	}
	
	/**
	 * @return \Innodia\Centrium\Api\Module\ContactCustomFieldDefinitionsModule
	 */
	public function contactCustomFieldDefinitions()
	{
		return $this->module(\Innodia\Centrium\Api\Module\ContactCustomFieldDefinitionsModule::class);
	}
	
	/**
	 * @return \Innodia\Centrium\Api\Module\NotesModule
	 */
	public function notes()
	{
		return $this->module(\Innodia\Centrium\Api\Module\NotesModule::class);
	}
	
	/**
	 * @return \Innodia\Centrium\Api\Module\NoteSettingsModule
	 */
	public function noteSettings()
	{
		return $this->module(\Innodia\Centrium\Api\Module\NoteSettingsModule::class);
	}
	
	/**
	 * @return \Innodia\Centrium\Api\Module\TasksModule
	 */
	public function tasks()
	{
		return $this->module(\Innodia\Centrium\Api\Module\TasksModule::class);
	}
	
	/**
	 * @return \Innodia\Centrium\Api\Module\TaskSettingsModule
	 */
	public function taskSettings()
	{
		return $this->module(\Innodia\Centrium\Api\Module\TaskSettingsModule::class);
	}
	
	/**
	 * @return \Innodia\Centrium\Api\Module\TaskCustomFieldDefinitionsModule
	 */
	public function taskCustomFieldDefinitions()
	{
		return $this->module(\Innodia\Centrium\Api\Module\TaskCustomFieldDefinitionsModule::class);
	}
	
	/**
	 * @return \Innodia\Centrium\Api\Module\DealsModule
	 */
	public function deals()
	{
		return $this->module(\Innodia\Centrium\Api\Module\DealsModule::class);
	}
	
	/**
	 * @return \Innodia\Centrium\Api\Module\DealSettingsModule
	 */
	public function dealSettings()
	{
		return $this->module(\Innodia\Centrium\Api\Module\DealSettingsModule::class);
	}
	
	/**
	 * @return \Innodia\Centrium\Api\Module\DealCustomFieldDefinitionsModule
	 */
	public function dealCustomFieldDefinitions()
	{
		return $this->module(\Innodia\Centrium\Api\Module\DealCustomFieldDefinitionsModule::class);
	}
	
	/**
	 * @return \Innodia\Centrium\Api\Module\ProjectsModule
	 */
	public function projects()
	{
		return $this->module(\Innodia\Centrium\Api\Module\ProjectsModule::class);
	}
	
	/**
	 * @return \Innodia\Centrium\Api\Module\ProjectSettingsModule
	 */
	public function projectSettings()
	{
		return $this->module(\Innodia\Centrium\Api\Module\ProjectSettingsModule::class);
	}
	
	/**
	 * @return \Innodia\Centrium\Api\Module\ProjectCustomFieldDefinitionsModule
	 */
	public function projectCustomFieldDefinitions()
	{
		return $this->module(\Innodia\Centrium\Api\Module\ProjectCustomFieldDefinitionsModule::class);
	}
	
	
	protected function module($class) {
		if (!isset($this->moduleCache[$class])) {
			$module = new $class($this);
			$this->moduleCache[$class] = $module;
		}

		return $this->moduleCache[$class];
		
	}
	
	public function call($method, $url, $bodyParams = array(), $queryParams = array()) {
		
		$callUrl = $this->endpointUrl . '/api/' . $this->version . $url;
		
		$query = http_build_query($queryParams);
		
		if ($query) {
			$callUrl .= '?' . $query;
		}
		
		$body = json_encode($bodyParams);		
		
		$ch = curl_init($callUrl);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
		curl_setopt($ch, CURLOPT_USERPWD, $this->key . ":" . $this->secret);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, true);
		
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'Content-Type: application/json',
				'Accept: ' . 'application/json',
				'Content-Length: ' . strlen($body))
		);
		
		$response = curl_exec($ch);
		
		if ($response === false) {
			throw new APIException('No response from api server: ' . $callUrl, 0);
		}
		
		$headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
		$allHeaders = explode("\r\n", substr($response, 0, $headerSize));
		$body = substr($response, $headerSize);
		
		$headers = array();
		foreach ($allHeaders as $header) {
			$header = trim($header);
			
			if (!empty($header)) {
				$header = explode(': ', $header);
				if (count($header) == 2) {
					$headers[strtoupper($header[0])] = $header[1];
				}
			}			
			
		}
		
		$info = curl_getinfo($ch);
		
		curl_close($ch);
		
		if ($info['http_code'] == 401) {
			throw new NotAuthorizedException($callUrl);
		} elseif ($info['http_code'] == 403) {
			throw new ForbiddenException($callUrl);
		} elseif ($info['http_code'] == 404) {
			throw new NotFoundException($callUrl);
		} elseif ($info['http_code'] == 400) {
			throw new ValidationException($callUrl, json_decode($body, true));
			$errors = json_decode($response, true);
		} elseif ($info['http_code'] == 500) {
			throw new APIException('Internal Server Error', 500, $callUrl);
		} elseif ($info['http_code'] > 400) {
			throw new APIException('HTTP Exception', $info['http_code'], $callUrl, $body);
		}
		
		if ($info['content_type'] == 'application/json') {
			return array('headers' => $headers, 'body' => json_decode($body, true));
		}
				
		return $response;
	}
	
}