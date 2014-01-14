<?php
// Composer autoloading
if (file_exists('vendor/autoload.php')) {
	$loader = include 'vendor/autoload.php';
}
if (is_dir('vendor/ZF2/library')) {
	$zf2Path = 'vendor/ZF2/library';
} elseif (getenv('ZF2_PATH')) {      // Support for ZF2_PATH environment variable or git submodule
	$zf2Path = getenv('ZF2_PATH');
} elseif (get_cfg_var('zf2_path')) { // Support for zf2_path directive value
	$zf2Path = get_cfg_var('zf2_path');
} elseif (is_readable('/usr/local/zend/var/libraries/Zend_Framework_2/default/library')) {
	$zf2Path = '/usr/local/zend/var/libraries/Zend_Framework_2/default/library';
}
if ($zf2Path) {
	if (isset($loader)) {
		$loader->add('Zend', $zf2Path);
	} else {
		include $zf2Path . '/Zend/Loader/AutoloaderFactory.php';
		Zend\Loader\AutoloaderFactory::factory(array(
			'Zend\Loader\StandardAutoloader' => array(
				'autoregister_zf' => true,
				'namespaces' => array(
					'ZendServerWebApi' => realpath(__DIR__ .'/../'),
				),
			),
		));
	}
}

//var_dump(realpath(__DIR__ . '/../../../Module.php'));
require_once realpath(__DIR__ . '/../../../Module.php');

if (!class_exists('Zend\Loader\AutoloaderFactory')) {
	throw new RuntimeException('Unable to load ZF2. Run `php composer.phar install` or define a ZF2_PATH environment variable.');
}


