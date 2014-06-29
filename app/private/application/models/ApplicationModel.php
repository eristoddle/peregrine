<?php

namespace Peregrine\Application\Models;

use \Phalcon\Mvc\Model;

/**
 * Application model base class
 */
class ApplicationModel extends Model {
    protected static function di(){
        return \Phalcon\DI\FactoryDefault::getDefault();
    }
}
