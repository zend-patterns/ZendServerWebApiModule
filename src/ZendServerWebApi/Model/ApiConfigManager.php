<?php
namespace ZendServerWebApi\Model;

/**
 * This class merge the API configuration
 *
 */
class ApiConfigManager
{
	/**
	 * Configuration
	 * 
	 * @var array
	 */
	protected $config = array();
	
	/**
	 * Constructor
	 * 
	 * Manage api version router configuration
	 * @param string $configFileDir
	 * @return boolean
	 */
	public function __construct($apiConfigFileDir)
	{
		$this->config  = array();
		foreach (scandir($apiConfigFileDir) as $confFile) {
			if ($confFile == '.' || $confFile == '..') continue;
			$tmp = preg_split('@-@', $confFile);
			$apiVersion = preg_replace('@\.config\.php@', '', $tmp[1]);
			$this->config [$apiVersion] = include $apiConfigFileDir .'/' . $confFile;
		}
        ksort($this->config);
        $this->addDefaultTargetParameters();
	}
	
	/**
	 * Add default target parameter to every methods
	 */
	protected function addDefaultTargetParameters()
	{
		foreach ($this->config as $version => $config) {
			if (isset($config['console']['router']['routes'])) {
				foreach ($config['console']['router']['routes'] as &$router) {
					if (! isset($router['options']['no-target'])) {
						$router['options']['route'] .= ' [--target=] [--zsurl=] [--zskey=] [--zssecret=] [--zsversion=] [--http=]';
						$router['options']['arrays'][] = 'http';
					}
				}
			}
		}
	}
	
	/**
	 * Return config to added to the whole application
	 * 
	 * Merge all api version router config in one array
	 * @return Array
	 */
	public function getRouterConfig()
	{
		$mergedConfig = array();
		foreach ($this->config as $version => $config) {
			$mergedConfig = array_merge_recursive($mergedConfig, $config);
		}
		unset($mergedConfig['min-zsversion']);
		return $mergedConfig;
	}
	
	/**
	 * Retunr the api configuration for a given version
	 * 
	 * @param string $apiVersion
	 * @return array
	 */
	public function getApiConfig($apiVersion)
	{
		if ( ! isset($this->config[$apiVersion])) return null;
		$mergedConfig = array();
		foreach ($this->config as $version => $config){
			$mergedConfig = array_merge($mergedConfig, $config);
			if ($version == $apiVersion) return $mergedConfig;
		}
		return array();
	}
	
	/**
	 * Return api configuration corresponding to zend server version
	 * 
	 * @param string $zsversion
	 * @return multitype:
	 */
	public function getApiConfigFromZsVersion($zsversion)
	{
		$mergedConfig = array();
		foreach ($this->config as $version => $config){
			$mergedConfig = array_merge($mergedConfig, $config);
			if ($config['min-zsversion'] == $zsversion) return $mergedConfig;
		}
		return array();
	}
	
}