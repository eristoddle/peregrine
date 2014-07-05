<?php
namespace Peregrine\Admin\Controllers;

use Peregrine\Application\Controllers\ApplicationController;

class ModuleController extends ApplicationController {
    public function initialize(){
        parent::initialize();
        $this->view->subHeader .= "Admin";
    }
}
