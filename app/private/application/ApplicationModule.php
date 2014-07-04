<?php

namespace Peregrine\Application;

use \Phalcon\Mvc\ModuleDefinitionInterface,
    \Phalcon\Mvc\User\Module as UserModule;

abstract class ApplicationModule
    extends UserModule
    implements ModuleDefinitionInterface{

}
