<?php

namespace Peregrine\Main\Controllers;

use \Peregrine\Main\Controllers\ModuleController;

/**
 * Concrete implementation of Main module controller
 *
 * @RoutePrefix("/main/api")
 */
class IndexController extends ModuleController {
    /**
     * @Route("/index", paths={module="main"}, methods={"GET"}, name="main-index-index")
     */
    public function indexAction() {
        $this->view->setVar('page', 'HI HOW ARE YOU');
        //var_dump($this->view);
    }
}
