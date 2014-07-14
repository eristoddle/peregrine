<?php
namespace Peregrine\Main;

use \Phalcon\Mvc\Router\Group;

class ModuleRoutes extends Group {
    public function initialize() {
        $this->setPrefix('/');

        $this->setPaths(
            array(
                'module' => 'main',
                'namespace' => 'Peregrine\Main\Controllers\\',
                'controller' => 'index',
                'action' => 'index'
            )
        );

        $this->addGet(
            '/:controller/:action/:params', array(
                'controller' => 1,
                'action' => 2,
                'params' => 3
            )
        );

        $this->addGet(
            '/:controller', array(
                'controller' => 1,
                'action' => 'index'
            )
        );
    }
}
