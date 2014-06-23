<?php

namespace Peregrine\Store;

use \Phalcon\Mvc\Router\Group;

/**
 * This class defines routes for the Peregrine\Store module
 * which will be prefixed with '/store'
 */
class ModuleRoutes extends Group {
    /**
     * Initialize the router group for the Store module
     */
    public function initialize() {
        /**
         * In the URI this module is prefixed by '/store'
         */
        $this->setPrefix('/store');

        /**
         * Configure the instance
         */
        $this->setPaths(
            array(
                'module' => 'store',
                'namespace' => 'Peregrine\Store\Controllers\\',
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
         * Add all Peregrine\Store specific routes here
         */
    }
}
