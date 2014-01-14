<?php
namespace ZendServerWebApi\Model;

class ApiConfigManager
{
	/**
	 * Configuration
	 * @var unknown
	 */
	protected $config = array();
	
	/**
	 * Constructor
	 * 
	 * @param array $configFileDir
	 * @return boolean
	 */
	public function __construct($apiConfigFileDir, $mainConfigFile)
	{
		$mainConfig = include $mainConfigFile;
        $mainConfig['min-zsversion'] = array();
        $apiConf = array();
        foreach (scandir($apiConfigFileDir) as $confFile) {
            if ($confFile == '.' || $confFile == '..')
                continue;
            $tmp = preg_split('@-@', $confFile);
            $apiVersion = preg_replace('@\.config\.php@', '', $tmp[1]);
            $apiConf[$apiVersion] = include $apiConfigFileDir .'/' . $confFile;
            $mainConfig['min-zsversion'][$apiVersion] = $apiConf[$apiVersion]['min-zsversion'];
            unset($apiConf[$apiVersion]['min-zsversion']);
        }
        ksort($apiConf);
        foreach ($apiConf as $version => $config) {
            if (isset($config['console']['router']['routes'])) {
                foreach ($config['console']['router']['routes'] as &$router) {
                    if (! isset($router['options']['no-target'])) {
                        $router['options']['route'] .= ' [--target=] [--zsurl=] [--zskey=] [--zssecret=] [--zsversion=] [--http=]';
                        $router['options']['arrays'][] = 'http';
                    }
                }
            }
            $mainConfig = array_merge_recursive($mainConfig, $config);
        }
        $this->config =  $mainConfig;
	}
	
	/**
	 * Return config
	 * 
	 * @return Array
	 */
	public function getConfig()
	{
		return $this->config;
	}
	
}