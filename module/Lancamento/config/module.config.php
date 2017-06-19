<?php

return array(
	'controllers' => array(
		'invokables' => array(
			'Lancamento\Controller\Lancamento' => 'Lancamento\Controller\LancamentoController',
		),
	),	
	'router' => array(
		'routes' => array(
			'lancamento' => array(
				'type' => 'segment',
				'options' => array(
					'route' => '/lancamentos[/:action][/:id]',
					'constraints' => array(
						'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
						'id' => '[0-9]+',
					),
					'defaults' => array(
						'controller' => 'Lancamento\Controller\Lancamento',
						'action' => 'index',
					),
				),
			),
		),
	),
	'view_manager' => array(
		'template_path_stack' => array(
			'lancamento' => __DIR__ . '/../view',
		),
	),
);