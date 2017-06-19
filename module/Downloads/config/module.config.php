<?php

return array(
	'controllers' => array(
		'invokables' => array(
			'Downloads\Controller\Downloads' => 'Downloads\Controller\DownloadsController',
		),
	),
	'router' => array(
		'routes' => array(
			'downloads' => array(
				'type' => 'segment',
				'options' => array(
					'route' => '/downloads[/:action][/:id]',
					'constraints' => array(
						'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
						'id' => '[0-9]+',
					),
					'defaults' => array(
						'controller' => 'Downloads\Controller\Downloads',
						'action' => 'index',
					),
				),
			),
		),
	),
	'view_manager' => array(
		'template_path_stack' => array(
			'downloads' => __DIR__ . '/../view',
		),
	),
);