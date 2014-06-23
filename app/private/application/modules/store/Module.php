<?php

namespace Peregrine\Store;

use \Phalcon\Loader,
    \Phalcon\DI,
    \Phalcon\Mvc\View,
    \Phalcon\Mvc\Dispatcher,
    \Phalcon\Config,
    \Phalcon\DiInterface,
    \Phalcon\Mvc\Url as UrlResolver,
    \Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter,
    \Peregrine\Application\ApplicationModule;

/**
 * Application module definition for multi module application
 * Defining the Store module
 */
class Module extends ApplicationModule {
    /**
     * Mount the module specific routes before the module is loaded.
     * Add ModuleRoutes Group and annotated controllers for parsing their routing information.
     *
     * @param \Phalcon\DiInterface $di
     */
    public static function initRoutes(DiInterface $di) {
        $loader = new Loader();
        $loader->registerNamespaces(
            array(
                'Peregrine\Store' => __DIR__,
                'Peregrine\Store\Controllers' => __DIR__ . '/controllers/'
            ), true
        )
            ->register();

        /**
         * Add ModuleRoutes Group and annotated controllers for parsing their routing information.
         * Be aware that the parsing will only be triggered if the request URI matches the third
         * parameter of addModuleResource.
         */
        $router = $di->getRouter();
        $router->mount(new ModuleRoutes());
    }

    /**
     * Registers the module auto-loader
     */
    public function registerAutoloaders() {
        $loader = new Loader();
        $loader->registerNamespaces(
            array(
                'Peregrine\Store' => __DIR__,
                'Peregrine\Store\Controllers' => __DIR__ . '/controllers/',
                'Peregrine\Store\Models' => __DIR__ . '/models/',
            ), true
        )
            ->register();
    }

    /**
     * Registers the module-only services
     *
     * @param \Phalcon\DiInterface $di
     */
    public function registerServices($di) {
        /**
         * Read application wide configuration
         */
        $appConfig = $di->get('config');

        /**
         * Setting up the view component
         */
        $di->set(
            'view', function () {
                $view = new View();
                $view->setViewsDir(__DIR__ . '/../../../../public/themes/default/views/modules/store/views')
                    ->setLayoutsDir('../../../layouts/')
                    ->setPartialsDir('../../../partials/')
                    ->setTemplateAfter('main')
                    ->registerEngines(array('.phtml' => 'Phalcon\Mvc\View\Engine\Php'));
                return $view;
            }
        );

        /**
         * The URL component is used to generate all kind of urls in the application
         */
        $di->set(
            'url', function () use ($appConfig) {
                $url = new UrlResolver();
                $url->setBaseUri($appConfig->application->baseUri);
                return $url;
            }
        );

        /**
         * Module specific dispatcher
         */
        $di->set(
            'dispatcher', function () use ($di) {
                $dispatcher = new Dispatcher();
                $dispatcher->setEventsManager($di->getShared('eventsManager'));
                $dispatcher->setDefaultNamespace('Peregrine\Store\\');
                return $dispatcher;
            }
        );
    }
}
