<?php
return array(
	'controllers' => array(
		'invokables' => array(
			'Login\Controller\Index' => 'Login\Controller\IndexController',			
		),
	),	
	'router' => array(
		'routes' => array(
			'login' => array(
				'type' => 'Literal',
				'options' => array(
					'route' => '/login',
					'defaults' => array(
						'__NAMESPACE__' => 'Login\Controller',
						'controller' => 'Index',
						'action' => 'index',
					),
				),
				'may_terminate' => true,
				'child_routes' => array(
					'default' => array(
						'type' => 'Segment',
						'options' => array(
							'route' => '/[:controller[/:action]]',
							'constraints' => array(
								'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
								'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							),
							'defaults' => array(),
						),
					),
				),
			),							
		),
		'success' => array(
			'type'    => 'Literal',
			'options' => array(
				// Change this to something specific to your module
				'route'    => '/success',
				'defaults' => array(
					// Change this value to reflect the namespace in which
					// the controllers for your module are found
					'__NAMESPACE__' => 'Login\Controller',
					'controller'    => 'Index',
					'action'        => 'success',
				),
			),
		),
	),
	'view_manager' => array(
		'template_path_stack' => array(
		'login' => __DIR__ . '/../view',
		),
	),			
);
?>