<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Idealize;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\ModuleManager\ModuleManager;
use Zend\Authentication\AuthenticationService as AuthenticationService;
use Zend\Authentication\Storage\Session as SessionStorage;

use Idealize\Service\Pessoa as PessoaService;
use Idealize\Service\Ponto as PontoService;
use Idealize\Service\Categoria as CategoriaService;
use Idealize\Service\Regulamento as RegulamentoService;
use Idealize\Service\Premiacao as PremiacaoService;
use Idealize\Service\User as UserService;
use IdealizeAdmin\Form\Ponto as PontoFrm;
use IdealizeAdmin\Form\Pessoa as PessoaFrm;
use IdealizeAdmin\Form\Premiacao as PremiacaoFrm;
use Idealize\Auth\Adapter as AuthAdapter;


class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);        

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
                    __NAMESPACE__ . 'Admin' => __DIR__ . '/src/' . __NAMESPACE__ . 'Admin',
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function init(ModuleManager $moduleManager){
        /*
        $sharedEvents = $moduleManager->getEventManager()->getSharedManager();

        $sharedEvents->attach("IdealizeAdminAuth",'dispatch',function($e){            
            $auth = new AuthenticationService;
            $auth->setStorage(new SessionStorage("IdealizeAdmin"));            
            $controller = $e->getTarget();
            $matchedRoute = $controller->getEvent()->getRouteMatch()->getMatchedRouteName();            
            if(!$auth->hasIdentity() and ($matchedRoute=="idealize-admin" or $matchedRoute=="idealize-admin-interna" or $matchedRoute=="home")){
                return $controller->redirect()->toRoute('idealize-admin-auth');
            }
        },99);        
        */
        $sharedEvents = $moduleManager->getEventManager()->getSharedManager();
        $sharedEvents->attach('Zend\Mvc\Controller\AbstractActionController', 
            MvcEvent::EVENT_DISPATCH,
            array($this, 'validaAcesso'),
        100);
    }

    public function validaAcesso(MvcEvent $e){
        $auth = new AuthenticationService;        
        $auth->setStorage(new SessionStorage("IdealizeAdmin"));            
        $controller = $e->getTarget();
        $matchedRoute = $controller->getEvent()->getRouteMatch()->getMatchedRouteName();            
        if(!$auth->hasIdentity() and ($matchedRoute=="idealize-admin" or $matchedRoute=="idealize-admin-interna" or $matchedRoute=="home" or $matchedRoute=="admin")){
            return $controller->redirect()->toRoute('idealize-admin-auth');
        }        
    }

    public function getServiceConfig(){
        return array(
            'factories' => array(
                'Idealize\Service\Pessoa' => function($service){
                    return new PessoaService($service->get('Doctrine\ORM\EntityManager'));
                },
                'Idealize\Service\Ponto' => function($service){
                    return new PontoService($service->get('Doctrine\ORM\EntityManager'));
                },
                'Idealize\Service\Categoria' => function($service){
                    return new CategoriaService($service->get('Doctrine\ORM\EntityManager'));
                },
                'Idealize\Service\Regulamento' => function($service){
                    return new RegulamentoService($service->get('Doctrine\ORM\EntityManager'));
                },
                'Idealize\Service\Premiacao' => function($service){
                    return new PremiacaoService($service->get('Doctrine\ORM\EntityManager'));
                },
                'Idealize\Service\User' => function($service){
                    return new UserService($service->get('Doctrine\ORM\EntityManager'));
                },                
                'Idealize\Auth\Adapter' => function($service){
                    return new AuthAdapter($service->get('Doctrine\ORM\EntityManager'));
                },                
                'IdealizeAdmin\Form\Ponto' => function($service){
                    $em = $service->get('Doctrine\ORM\EntityManager');
                    $repository = $em->getRepository('Idealize\Entity\Pessoa');
                    $pessoas = $repository->fetchPairs();
                    return new PontoFrm(null,$pessoas);
                },
                'IdealizeAdmin\Form\Pessoa' => function($service){
                    $em = $service->get('Doctrine\ORM\EntityManager');
                    $repository = $em->getRepository('Idealize\Entity\Categoria');
                    $repository2 = $em->getRepository('Idealize\Entity\Regulamento');
                    $categorias = $repository->fetchPairs();                    
                    $regulamentos = $repository2->fetchPairs();
                    return new PessoaFrm(null,$categorias,$regulamentos);
                },
                'IdealizeAdmin\Form\Premiacao' => function($service){
                    $em = $service->get('Doctrine\ORM\EntityManager');
                    $repository = $em->getRepository('Idealize\Entity\Regulamento');
                    $regulamentos = $repository->fetchPairs();                    
                    return new PremiacaoFrm(null,$regulamentos);
                },
            ),
        );
    }
}
