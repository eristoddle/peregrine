<?php

namespace Peregrine\Main;

use \Phalcon\Mvc\Router\Group;

/**
 * This class defines routes for the Peregrine\Main module
 * which will be prefixed with '/main'
 */
class ModuleRoutes extends Group {
    /**
     * Initialize the router group for the Main module
     */
    public function initialize() {
        /**
         * In the URI this module is prefixed by '/main'
         */
        $this->setPrefix('/main');

        /**
         * Configure the instance
         */
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

        /**
         * Add all Peregrine\Main specific routes here
         */
    }
}
