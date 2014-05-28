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
         * Controller and action always default to 'index'
         */
        $this->setDefaults(
            array(
                'controller' => 'index',
                'action' => 'index'
            )
        );

        /**
         * Add global matching route for the default module 'Main'
         */
        $this->add(
            '/', array(
                'module' => 'main',
                'namespace' => 'Peregrine\Main\Controllers\\'
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
    }
}
