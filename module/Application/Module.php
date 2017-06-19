<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

use Application\Model\Filtro;
use Application\Model\FiltroTable;
use Application\Model\Banner;
use Application\Model\BannerTable;
use Application\Model\Chamada;
use Application\Model\ChamadaTable;
use Application\Model\Colecao;
use Application\Model\ColecaoTable;
use Application\Model\Departamento;
use Application\Model\DepartamentoTable;
use Application\Model\FaceProduto;
use Application\Model\FaceProdutoTable;
use Application\Model\ImagemProduto;
use Application\Model\ImagemProdutoTable;
use Application\Model\Legenda;
use Application\Model\LegendaTable;
use Application\Model\LegendaProduto;
use Application\Model\LegendaProdutoTable;
use Application\Model\Linha;
use Application\Model\LinhaTable;
use Application\Model\Materia;
use Application\Model\MateriaTable;
use Application\Model\Midia;
use Application\Model\MidiaTable;
use Application\Model\Produto;
use Application\Model\ProdutoTable;
use Application\Model\Product;
use Application\Model\ProductTable;
use Application\Model\Representante;
use Application\Model\RepresentanteTable;
use Application\Model\Texto;
use Application\Model\TextoTable;
use Application\Model\InfoTecnicas;
use Application\Model\InfoTecnicasTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);					
        
        $e->getApplication()->getEventManager()->getSharedManager()->attach('Zend\Mvc\Controller\AbstractActionController', 'dispatch', function($e){
			$language = $_COOKIE['language']; // locale string to change default language.
			$translator = $e->getApplication()->getServiceManager()->get('translator');
			$translator->setLocale($language)->setFallbackLocale('pt_BR');
		
        	$controller = $e->getTarget();
        	$controllerClass = get_class($controller);
        	$moduleNamespace = substr($controllerClass, 0, strpos($controllerClass, '\\'));
        	$config = $e->getApplication()->getServiceManager()->get('config');
        	if (isset($config['module_layouts'][$moduleNamespace])) {
        		$controller->layout($config['module_layouts'][$moduleNamespace]);
        	}
        }, 100);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
	
	public function getServiceConfig()
     {
         return array(
             'factories' => array(
                'Application\Model\FiltroTable' =>  function($sm) {
                    $tableGateway = $sm->get('FiltroTableGateway');
                    $table = new FiltroTable($tableGateway);
                    return $table;
                },
                'FiltroTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Filtro());
                    return new TableGateway('filtro', $dbAdapter, null, $resultSetPrototype);
                },
                'Application\Model\BannerTable' =>  function($sm) {
                    $tableGateway = $sm->get('BannerTableGateway');
                    $table = new BannerTable($tableGateway);
                    return $table;
                },
                'BannerTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Banner());
                    return new TableGateway('banner', $dbAdapter, null, $resultSetPrototype);
                },
                'Application\Model\ChamadaTable' =>  function($sm) {
                    $tableGateway = $sm->get('ChamadaTableGateway');
                    $table = new ChamadaTable($tableGateway);
                    return $table;
                },
                'ChamadaTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Chamada());
                    return new TableGateway('chamada', $dbAdapter, null, $resultSetPrototype);
                },
                'Application\Model\ColecaoTable' =>  function($sm) {
                    $tableGateway = $sm->get('ColecaoTableGateway');
                    $table = new ColecaoTable($tableGateway);
                    return $table;
                },
                'ColecaoTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Colecao());
                    return new TableGateway('colecao', $dbAdapter, null, $resultSetPrototype);
                },
                'Application\Model\DepartamentoTable' =>  function($sm) {
                    $tableGateway = $sm->get('DepartamentoTableGateway');
                    $table = new DepartamentoTable($tableGateway);
                    return $table;
                },
                'DepartamentoTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Departamento());
                    return new TableGateway('departamento', $dbAdapter, null, $resultSetPrototype);
                },
                'Application\Model\FaceProdutoTable' =>  function($sm) {
                    $tableGateway = $sm->get('FaceProdutoTableGateway');
                    $table = new FaceProdutoTable($tableGateway);
                    return $table;
                },
                'FaceProdutoTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new FaceProduto());
                    return new TableGateway('face_produto', $dbAdapter, null, $resultSetPrototype);
                },
                'Application\Model\ImagemProdutoTable' =>  function($sm) {
                    $tableGateway = $sm->get('ImagemProdutoTableGateway');
                    $table = new ImagemProdutoTable($tableGateway);
                    return $table;
                },
                'ImagemProdutoTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new ImagemProduto());
                    return new TableGateway('imagem_produto', $dbAdapter, null, $resultSetPrototype);
                },
                'Application\Model\LegendaTable' =>  function($sm) {
                    $tableGateway = $sm->get('LegendaTableGateway');
                    $table = new LegendaTable($tableGateway);
                    return $table;
                },
                'LegendaTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Legenda());
                    return new TableGateway('legenda', $dbAdapter, null, $resultSetPrototype);
                },
                'Application\Model\LegendaProdutoTable' =>  function($sm) {
                    $tableGateway = $sm->get('LegendaProdutoTableGateway');
                    $table = new LegendaProdutoTable($tableGateway);
                    return $table;
                },
                'LegendaProdutoTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new LegendaProduto());
                    return new TableGateway('legenda_produto', $dbAdapter, null, $resultSetPrototype);
                },
                'Application\Model\LinhaTable' =>  function($sm) {
                    $tableGateway = $sm->get('LinhaTableGateway');
                    $table = new LinhaTable($tableGateway);
                    return $table;
                },
                'LinhaTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Linha());
                    return new TableGateway('linha', $dbAdapter, null, $resultSetPrototype);
                },
                'Application\Model\LinhaFormatoTable' =>  function($sm) {
                    $tableGateway = $sm->get('LinhaFormatoTableGateway');
                    $table = new LinhaFormatoTable($tableGateway);
                    return $table;
                },
                'LinhaFormatoTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new LinhaFormato());
                    return new TableGateway('linha_formato', $dbAdapter, null, $resultSetPrototype);
                },
                'Application\Model\MateriaTable' =>  function($sm) {
                    $tableGateway = $sm->get('MateriaTableGateway');
                    $table = new MateriaTable($tableGateway);
                    return $table;
                },
                'MateriaTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Materia());
                    return new TableGateway('materia', $dbAdapter, null, $resultSetPrototype);
                },
                'Application\Model\MidiaTable' =>  function($sm) {
                    $tableGateway = $sm->get('MidiaTableGateway');
                    $table = new MidiaTable($tableGateway);
                    return $table;
                },
                'MidiaTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Midia());
                    return new TableGateway('midia', $dbAdapter, null, $resultSetPrototype);
                },
				'Application\Model\ProdutoTable' => function($sm){
					$tableGateway = $sm->get('ProdutoTableGateway');
					$table = new ProdutoTable($tableGateway);
					return $table;
				},
				'ProdutoTableGateway' => function($sm){
					$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
					$resultSetPrototype = new ResultSet();
					$resultSetPrototype->setArrayObjectPrototype(new Produto());
					return new TableGateway('produto',$dbAdapter,null,$resultSetPrototype);
				},
                'Application\Model\ProductTable' =>  function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $table = new ProductTable($dbAdapter);
                    return $table;
                },
                'ProductTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Product());
                    return new TableGateway('produto', $dbAdapter, null, $resultSetPrototype);
                },
                'Application\Model\RepresentanteTable' =>  function($sm) {
                    $tableGateway = $sm->get('RepresentanteTableGateway');
                    $table = new RepresentanteTable($tableGateway);
                    return $table;
                },
                'RepresentanteTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Representante());
                    return new TableGateway('representante', $dbAdapter, null, $resultSetPrototype);
                },
                'Application\Model\TextoTable' =>  function($sm) {
                    $tableGateway = $sm->get('TextoTableGateway');
                    $table = new TextoTable($tableGateway);
                    return $table;
                },
                'TextoTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Texto());
                    return new TableGateway('texto', $dbAdapter, null, $resultSetPrototype);
                },
				
				'Application\Model\InfoTecnicasTable' =>  function($sm) {
                    $tableGateway = $sm->get('InfoTecnicasTableGateway');
                    $table = new InfoTecnicasTable($tableGateway);
                    return $table;
                },
                'InfoTecnicasTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new InfoTecnicas());
                    return new TableGateway('info_tecnicas', $dbAdapter, null, $resultSetPrototype);
                },
				
             ),
         );
     }
    
}
