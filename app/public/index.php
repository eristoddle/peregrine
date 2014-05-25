<?php
// error_reporting(E_ALL);
// $debug = new \Phalcon\Debug();
// $debug->listen();

use Phalcon\DI\FactoryDefault;

require __DIR__ . '/../private/application/Application.php';

/**
 * Instantiate the Application class to do the bootstrapping
 */
try {
    $application = new Peregrine\Application\Application(new FactoryDefault());
    $application->main();
} catch (\Phalcon\Exception $e) {
    echo 'A Phalcon\Exception occurred: ', $e->getMessage(), $e->getTraceAsString();
} catch (\PDOException $e) {
    echo 'A PDOException occurred: ', $e->getMessage(), $e->getTraceAsString();
} catch (\Exception $e) {
    echo 'An Exception occurred: ', $e->getMessage(), $e->getTraceAsString();
}
