<?php

namespace Peregrine\Application;

use \Phalcon\Mvc\ModuleDefinitionInterface,
    \Phalcon\Mvc\User\Module as UserModule,
    \Peregrine\Application\RoutedModule;

/**
 * Abstract application module base class
 */
abstract class ApplicationModule
    extends UserModule
    implements ModuleDefinitionInterface, RoutedModule
{

}
