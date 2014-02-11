<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Googleplus {
	
	public function __construct() {
		
		$CI =& get_instance();
		$CI->config->load('googleplus');
				
		include_once 'google-api-php-client/src/Google_Client.php';
		include_once 'google-api-php-client/src/contrib/Google_PlusService.php';
		include_once 'google-api-php-client/src/contrib/Google_Oauth2Service.php';
		
		$cache_path = $CI->config->item('cache_path');
		$GLOBALS['apiConfig']['ioFileCache_directory'] = ($cache_path == '') ? APPPATH .'cache/' : $cache_path;
		
		$this->client = new Google_Client();
		$this->client->setApplicationName($CI->config->item('application_name', 'googleplus'));
		$this->client->setScopes(array('https://www.googleapis.com/auth/userinfo.email', 'https://www.googleapis.com/auth/plus.me')); // set scope during user login
		$this->client->setClientId($CI->config->item('client_id', 'googleplus'));
		$this->client->setClientSecret($CI->config->item('client_secret', 'googleplus'));
		$this->client->setRedirectUri($CI->config->item('redirect_uri', 'googleplus'));
		$this->client->setDeveloperKey($CI->config->item('api_key', 'googleplus'));
		
		$this->plus = new Google_PlusService($this->client);
		$this->oauth2 = new Google_Oauth2Service($this->client);
		
	}

}
?>