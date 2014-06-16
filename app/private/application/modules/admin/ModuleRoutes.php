<?php

namespace Peregrine\Admin;

use \Phalcon\Mvc\Router\Group;

/**
 * This class defines routes for the Peregrine\Admin module
 * which will be prefixed with '/admin'
 */
class ModuleRoutes extends Group {
    /**
     * Initialize the router group for the Admin module
     */
    public function initialize() {
        /**
         * In the URI this module is prefixed by '/admin'
         */
        $this->setPrefix('/admin');

        /**
         * Configure the instance
         */
        $this->setPaths(
            array(
                'module' => 'admin',
                'namespace' => 'Peregrine\Admin\Controllers\\',
                'controller' => 'index',
                'action' => 'index'
            )
        );

        $this->add('/:controller', 
            array(
                'controller' => 1
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

        /**
         * Add all Peregrine\Admin specific routes here
         */
    }
}
