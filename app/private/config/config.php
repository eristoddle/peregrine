<?php
return new \Phalcon\Config(array(
    'peregrine' => array(
        'productImagesDir' => __DIR__ . '/../../public/media/img',
        'productImagesWeb' => 'media/img'
    ),
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
        'pluginsDir' => __DIR__ . '/../application/plugins',
        'helpersDir' => __DIR__ . '/../application/helpers',
        'models' => array(
            'metadata' => array(
                'adapter' => 'Memory'
            )
        )
    )
));