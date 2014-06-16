<?php
error_reporting(E_ALL);
$debug = new \Phalcon\Debug();
$debug->listen();
use Phalcon\Logger\Adapter\File as FileAdapter,
	Phalcon\DI\FactoryDefault;

$logger = new FileAdapter(__DIR__ . '/../private/logs/error.log');

require __DIR__ . '/../private/application/Application.php';

/**
 * Instantiate the Application class to do the bootstrapping
 */
// try {
    $application = new Peregrine\Application\Application(new FactoryDefault());
    $application->main();
// } catch (\Phalcon\Exception $e) {
// 	//$logger->log('A Phalcon\Exception occurred: ' . $e->getMessage(), $e->getTraceAsString());
//     echo 'A Phalcon\Exception occurred: ', $e->getMessage(), $e->getTraceAsString();
// } catch (\PDOException $e) {
// 	//$logger->log('A PDOException occurred: ' . $e->getMessage(), $e->getTraceAsString());
//     echo 'A PDOException occurred: ', $e->getMessage(), $e->getTraceAsString();
// } catch (\Exception $e) {
// 	//$logger->log('An Exception occurred: ' . $e->getMessage(), $e->getTraceAsString());
//     echo 'An Exception occurred: ', $e->getMessage(), $e->getTraceAsString();
// }
