<?php

namespace Downloads;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

use Downloads\Model\Downloads;
use Downloads\Model\DownloadsTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class Module implements AutoloaderProviderInterface, ConfigProviderInterface
{
	public function getAutoloaderConfig(){
		return array(
			'Zend\Loader\ClassMapAutoloader' => array(
				__DIR__ . '/autoload_classmap.php',
			),
			'Zend\Loader\StandardAutoloader' => array(
				'namespaces' => array(
					__NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
				),
			),
		);
	}

	public function getConfig()
	{
		return include __DIR__ . '/config/module.config.php';
	}

	public function getServiceConfig(){
		return array(
			'factories' => array(
				'Downloads\Model\DownloadsTable' => function($sm){
					$tableGateway = $sm->get('DownloadsTableGateway');
					$table = new DownloadsTable($tableGateway);
					return $table;
				},
				'DownloadsTableGateway' => function($sm){
					$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
					$resultSetPrototype = new ResultSet();
					$resultSetPrototype->setArrayObjectPrototype(new Downloads());
					return new TableGateway('downloads',$dbAdapter,null,$resultSetPrototype);
				},
			),
		);
	}
}