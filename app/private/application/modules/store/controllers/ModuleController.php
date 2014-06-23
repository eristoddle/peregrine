<?php

namespace Peregrine\Store\Controllers;

use Peregrine\Application\Controllers\ApplicationController;

/**
 * Base class of Store module controller
 */
class ModuleController extends ApplicationController {
    public function initialize(){
        parent::initialize();
        $this->view->subHeader .= "Store";
    }

}
