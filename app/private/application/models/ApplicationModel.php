<?php
namespace Peregrine\Application\Models;

use \Phalcon\Mvc\Model;

class ApplicationModel extends Model {
    protected static function di(){
        return \Phalcon\DI\FactoryDefault::getDefault();
    }
}
