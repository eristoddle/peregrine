<?php
namespace Peregrine\Main\Controllers;

use \Peregrine\Main\Controllers\ModuleController,
    \Peregrine\Application\Models;

/**
 * Concrete implementation of Main module controller
 */
class IndexController extends ModuleController {
    public function indexAction(){
        $this->view->products = Models\Products::find();
    }

}
