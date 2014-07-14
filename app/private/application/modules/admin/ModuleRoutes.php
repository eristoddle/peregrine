<?php
namespace Peregrine\Admin;

use \Phalcon\Mvc\Router\Group;

class ModuleRoutes extends Group {
    public function initialize() {
        $this->setPrefix('/admin');

        $this->setPaths(
            array(
                'module' => 'admin',
                'namespace' => 'Peregrine\Admin\Controllers\\',
                'controller' => 'index',
                'action' => 'index'
            )
        );

        $this->add('', 
            array(
                'controller' => 'index',
                'action' => 'index'
            )
        );

        $this->add('/:controller', 
            array(
                'controller' => 1,
                'action' => 'index'
            )
        );

        $this->add('/:controller/:action', 
            array(
                'controller' => 1,
                'action' => 2
            )
        );

        $this->add(
            '/:controller/:action/:params', array(
                'controller' => 1,
                'action' => 2,
                'params' => 3
            )
        );
    }
}
