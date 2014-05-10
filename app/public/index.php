<?php
/**
 * Change error reporting level for production use
 */
if (getenv('APPLICATION_ENV') == 'production'){
    error_reporting(0);
    ini_set('display_errors', 0);
}else{
    error_reporting(E_ALL);
    $debug = new \Phalcon\Debug();
    $debug->listen();
}

use Phalcon\DI\FactoryDefault;

require __DIR__ . '/../private/common/lib/application/Application.php';

/**
 * Instantiate the Application class to do the bootstrapping
 */
try {
    $application = new Af23\Application\Application(new FactoryDefault());
    $application->main();
} catch (\Phalcon\Exception $e) {
    echo 'A Phalcon\Exception occurred: ', $e->getMessage(), $e->getTraceAsString();
} catch (\PDOException $e) {
    echo 'A PDOException occurred: ', $e->getMessage(), $e->getTraceAsString();
} catch (\Exception $e) {
    echo 'An Exception occurred: ', $e->getMessage(), $e->getTraceAsString();
}
