<?php
	return array(
		'doctrine' => array(
			'connection' => array(
				'orm_default' => array(
					'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
					'params' => array(
						'host' => 'localhost',
						'port' => '3306',
						'user' => 'usr_villagres',
						'password' => 'villa@123',
						'dbname' => 'db_villagres',
						'driverOptions' => array(
							PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"
						)
					)
				)
			)
		),
	);
?>