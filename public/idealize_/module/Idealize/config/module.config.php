<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Idealize;

return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/home',
                    'defaults' => array(
                        'controller' => 'Idealize\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            'pontuacao' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/pontuacao',
                    'defaults' => array(
                        'controller' => 'Idealize\Controller\Index',
                        'action'     => 'pontuacao',
                    ),
                ),
            ),
            'admin' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/admin',
                    'defaults' => array(
                        'controller' => 'Idealize\Controller\Index',
                        'action'     => 'admin',
                    ),
                ),
            ),
			
			'idealize-admin-pessoa' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/admin/[:controller/[:action]]',
                    'defaults' => array(                        
                        'action'     => 'new',						
                    ),
                ),
            ),
			
			'idealize-admin-ponto' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/admin/[:controller/[:action]]',
                    'defaults' => array(                        
                        'action'     => 'new',						
                    ),
                ),
            ),

            'idealize-admin-categoria' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/admin/[:controller/[:action]]',
                    'defaults' => array(                        
                        'action'     => 'new',                      
                    ),
                ),
            ),

            'idealize-admin-regulamento' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/admin/[:controller/[:action]]',
                    'defaults' => array(                        
                        'action'     => 'new',                      
                    ),
                ),
            ),

            'idealize-admin-premiacao' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/admin/[:controller/[:action]]',
                    'defaults' => array(                        
                        'action'     => 'new',                      
                    ),
                ),
            ),
			
            'idealize-admin-interna' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/admin/[:controller/:action][/:id]',                    
                    'constraints' => array(
                        'id' => '[0-9]+'
                    ),
					'defaults' => array(
					)
                ),
            ),
            'idealize-admin' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/admin/[:controller[/page/:page]]',
                    'defaults' => array(
                        'action' => 'index',
                        'page' => 1
                    ),
                ),
            ),
            'idealize-admin-auth' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/',
                    'defaults' => array(
                        'action' => 'index',
                        'controller' => 'idealize-admin/auth'
                    ),
                ),
            ),
            'idealize-admin-logout' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/admin/auth/logout',
                    'defaults' => array(
                        'action' => 'logout',
                        'controller' => 'idealize-admin/auth'
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'factories' => array(
            'translator' => 'Zend\Mvc\Service\TranslatorServiceFactory',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),

    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')  
            ),            
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ),
            ),
        ),
    ),

    'controllers' => array(
        'invokables' => array(
            'Idealize\Controller\Index' => 'Idealize\Controller\IndexController',
            'usuarios' => 'IdealizeAdmin\Controller\PessoaController',
            'pontos' => 'IdealizeAdmin\Controller\PontoController',
            'categoria' => 'IdealizeAdmin\Controller\CategoriaController',
            'regulamento' => 'IdealizeAdmin\Controller\RegulamentoController',
            'premiacao' => 'IdealizeAdmin\Controller\PremiacaoController',
            'idealize-admin/auth' => 'IdealizeAdmin\Controller\AuthController',
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'idealize/index/index' => __DIR__ . '/../view/idealize/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
);
