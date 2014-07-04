<?php
namespace Peregrine\Admin;

use \Phalcon\Loader,
    \Phalcon\DI,
    \Phalcon\Mvc\View,
    \Phalcon\Mvc\Dispatcher,
    \Phalcon\Config,
    \Phalcon\DiInterface,
    \Phalcon\Mvc\Url as UrlResolver,
    \Peregrine\Application\ApplicationModule;

class Module extends ApplicationModule {

    public static function initRoutes(DiInterface $di) {
        $loader = new Loader();
        $loader->registerNamespaces(
            array(
                'Peregrine\Admin' => __DIR__,
                'Peregrine\Admin\Controllers' => __DIR__ . '/controllers/'
            ), true
        )
            ->register();

        $router = $di->getRouter();
        $router->mount(new ModuleRoutes());
    }

    public function registerAutoloaders() {
        $loader = new Loader();
        $loader->registerNamespaces(
            array(
                'Peregrine\Admin\Models' => __DIR__ . '/models/',
            ), true
        )
            ->register();
    }

    public function registerServices($di) {
        $appConfig = $di->get('config');

        $di->set(
            'view', function () {
                $view = new View();
                $view->setViewsDir(__DIR__ . '/../../../../public/themes/default/views/modules/admin/views')
                    ->setLayoutsDir('../../../layouts/')
                    ->setPartialsDir('../../../partials/')
                    ->setTemplateAfter('admin')
                    ->registerEngines(array('.phtml' => 'Phalcon\Mvc\View\Engine\Php'));
                return $view;
            }
        );

        $di->set(
            'url', function () use ($appConfig) {
                $url = new UrlResolver();
                $url->setBaseUri($appConfig->application->baseUri);
                return $url;
            }
        );

        $di->set(
            'dispatcher', function () use ($di) {
                $dispatcher = new Dispatcher();
                $dispatcher->setEventsManager($di->getShared('eventsManager'));
                $dispatcher->setDefaultNamespace('Peregrine\Admin\\');
                return $dispatcher;
            }
        );
    }
}