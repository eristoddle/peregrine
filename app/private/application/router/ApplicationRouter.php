<?php

namespace Peregrine\Application\Router;

use \Phalcon\Mvc\Router as Router;

/**
 * This class acts as the application router and defines global application routes.
 * Module specific routes are defined inside the ModuleRoutes classes.
 */
class ApplicationRouter extends Router {
    /**
     * Creates a new instance of ApplicationRouter class and defines standard application routes
     * @param boolean $defaultRoutes
     */
    public function __construct($defaultRoutes = false) {
        parent::__construct($defaultRoutes);

        $this->removeExtraSlashes(true);

        /**
         * Defaults
         */
        $this->setDefaults(
            array(
                'module' => 'main',
                'namespace' => 'Peregrine\Main\Controllers\\',
                'controller' => 'index',
                'action' => 'index'
            )
        );

        $this->add(
            "/:action/:params",
            array(
                'module' => 'main',
                'namespace' => 'Peregrine\Main\Controllers\\',
                'controller' => 'index',
                'action' => 1,
                'params' => 2,
            )
        );

        $this->add(
            "/:module",
            array(
                'module' => 1
            )
        );
    }
}
