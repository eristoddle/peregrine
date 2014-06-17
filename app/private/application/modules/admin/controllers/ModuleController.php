<?php

namespace Peregrine\Admin\Controllers;

use Peregrine\Application\Controllers\ApplicationController;

/**
 * Base class of Admin module controller
 */
class ModuleController extends ApplicationController {
    public function initialize(){
        parent::initialize();
        $this->view->subHeader .= "Admin";
    }

}
