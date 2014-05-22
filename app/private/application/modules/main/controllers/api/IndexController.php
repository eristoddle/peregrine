<?php

namespace Peregrine\Main\Controllers\API;

use \Peregrine\Main\Controllers\ModuleApiController;

/**
 * Concrete implementation of Main module controller
 *
 * @RoutePrefix("/main/api")
 */
class IndexController extends ModuleApiController
{
	/**
     * @Route("/index", paths={module="main"}, methods={"GET"}, name="main-index-index")
     */
    public function indexAction()
    {

    }
}
