<?php

namespace Peregrine\Application;

use \Phalcon\Mvc\Url as UrlResolver,
    \Phalcon\DiInterface,
    \Phalcon\Mvc\View,
    \Phalcon\Loader,
    \Phalcon\Http\ResponseInterface,
    \Phalcon\Events\Manager as EventsManager,
    \Phalcon\Session\Adapter\Files as SessionAdapter,
    \Phalcon\Flash\Direct as FlashDirect,
    \Phalcon\Crypt,
    \Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter,
    \Peregrine\Application\Router\ApplicationRouter;

/**
 * Application class for multi module applications
 * including HMVC internal requests.
 */
class Application extends \Phalcon\Mvc\Application {
    /**
     * Application Constructor
     *
     * @param \Phalcon\DiInterface $di
     */
    public function __construct(DiInterface $di) {
        /**
         * Sets the parent DI and register the app itself as a service,
         * necessary for redirecting HMVC requests
         */
        parent::setDI($di);
        $di->set('app', $this);

        /**
         * The application wide configuration
         */
        $this->config = include __DIR__ . '/../config/config.php';
        //TODO:USE THIS RATHER THAN $this->config
        $this->di->set('config', $this->config);

        /**
         * Register application wide accessible services
         */
        $this->_registerServices();

        //die(var_dump($this->config));

        /**
         * Register the installed/configured modules
         */
        $this->registerModules(require __DIR__ . '/../config/modules.php');
    }

    /**
     * Register the services here to make them general or register in the
     * ModuleDefinition to make them module-specific
     */
    protected function _registerServices() {
        $config = $this->config;
        /**
         * Register namespaces for application classes
         */
        $loader = new Loader();
        $loader->registerNamespaces(
            array(
                'Peregrine\Application' => __DIR__,
                'Peregrine\Application\Controllers' => $config->application->controllersDir,
                'Peregrine\Application\Models' => $config->application->modelsDir,
                'Peregrine\Application\Router' => $config->application->routerDir,
                'Peregrine\Application\Plugins' => $config->application->pluginsDir,
                'Peregrine\Application\Helpers' => $config->application->helpersDir
            ), 
            true
        )
            ->register();

        /**
         * Database connection is created based in the parameters defined in the configuration file
         */
        $this->di->set(
            'db', function () use ($config) {
                return new DbAdapter(array(
                    'host' => $config->database->host,
                    'username' => $config->database->username,
                    'password' => $config->database->password,
                    'dbname' => $config->database->dbname
                ));
            }
        );

        /**
         * Setup an events manager with priorities enabled
         */
        $eventsManager = new EventsManager();
        $eventsManager->enablePriorities(true);
        $this->setEventsManager($eventsManager);

        /**
         * Start the session the first time some component request the session service
         */
        $this->di->set(
            'session', function () {
                $session = new SessionAdapter();
                $session->start();
                return $session;
            }
        );

        /**
         * Register the flash service with custom CSS classes
         */
        $this->di->set(
            'flash', function () {
                return new FlashDirect(array(
                    'error' => 'danger alert',
                    'success' => 'success alert',
                    'notice' => 'primary alert',
                ));
            }
        );

        /**
         * Set up encryption key
         */
        //TODO:Use internal di config
        // $this->di->set(
        //     'crypt', function () use ('config') {
        //         $crypt = new Crypt();
        //         $crypt->setKey($config->application->encryptKey);
        //         return $crypt;
        //     }
        // );

        /**
         * Registering the application wide router with the standard routes set
         */
        $this->di->set('router', new ApplicationRouter());

        /**
         * Specify the use of metadata adapter
         */
        $this->di->set(
            'modelsMetadata', 
            '\Phalcon\Mvc\Model\Metadata\\' . $config->application->models->metadata->adapter
        );

        /**
         * Specify the annotations cache adapter
         */
        $this->di->set('annotations', 
            '\Phalcon\Annotations\Adapter\\' . $config->application->annotations->adapter
        );
    }

    /**
     * Register the given modules in the parent and prepare to load
     * the module routes by triggering the init routes method
     */
    public function registerModules($modules, $merge = null) {
        parent::registerModules($modules, $merge);

        $loader = new Loader();
        $modules = $this->getModules();

        /**
         * Iterate the application modules and register the routes
         * by calling the initRoutes method of the Module class.
         * We need to auto load the class
         */
        foreach ($modules as $module) {
            $className = $module['className'];

            if (!class_exists($className, false)) {
                $loader->registerClasses(
                    array($className => $module['path']), 
                    true)
                    ->register()
                    ->autoLoad($className);
            }

            /** @var \Peregrine\Application\ApplicationModule $className */
            $className::initRoutes($this->di);
        }
    }

    /**
     * Handles the request and echoes its content to the output stream.
     */
    public function main() {
        echo $this->handle()->getContent();
    }

    /**
     * Does a HMVC request inside the application
     *
     * Inside a controller we might do
     * <code>
     * $this->app->request([ 'controller' => 'do', 'action' => 'something' ], 'param');
     * </code>
     *
     * @param array $location Array with the route information: 'namespace', 'module', 'controller', 'action', 'params'
     * @return mixed
     */
    public function request(array $location) {
        /** @var \Phalcon\Mvc\Dispatcher $dispatcher */
        $dispatcher = clone $this->di->get('dispatcher');

        if (isset($location['module'])) {
            $dispatcher->setModuleName($location['module']);
        }

        if (isset($location['namespace'])) {
            $dispatcher->setNamespaceName($location['namespace']);
        }

        if (!isset($location['controller'])) {
            $location['controller'] = 'index';
        }

        if (!isset($location['action'])) {
            $location['action'] = 'index';
        }

        if (!isset($location['params'])) {
            $location['params'] = [];
        }

        $dispatcher->setControllerName($location['controller']);
        $dispatcher->setActionName($location['action']);
        $dispatcher->setParams((array)$location['params']);
        $dispatcher->dispatch();

        $response = $dispatcher->getReturnedValue();

        if ($response instanceof ResponseInterface) {
            return $response->getContent();
        }

        return $response;
    }
}
