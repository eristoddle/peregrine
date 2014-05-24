<?php
return new \Phalcon\Config(array(
    'database' => array(
        'adapter' => 'Mysql',
        'host' => 'localhost',
        'username' => 'root',
        'password' => 'root',
        'dbname' => 'peregrine',
        'persistent' => true,
        'charset' => 'utf8'
    ),
    'application' => array(
        'baseUri' => '/',
        'controllersDir' => __DIR__ . '/../application/controllers',
        'modelsDir' => __DIR__ . '/../application/models',
        'routerDir' => __DIR__ . '/../application/router',
        'pluginsDir' => __DIR__ . '/../plugins',
        'helpersDir' => __DIR__ . '/../application/helpers',
        'logsDir' => __DIR__ . '/../logs',
        'annotations' => array('adapter' => 'Memory'),
        'models' => array(
            'metadata' => array('adapter' => 'Memory')
        ),
        'encryptKey' => '2tx6]GD}532q4x_'
    )
));