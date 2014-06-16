<?php

namespace Peregrine\Application\Controllers;

use Phalcon\Mvc\Controller;

/**
 * Controller base class for all application controllers
 */
class ApplicationController extends Controller {
    public function initialize(){
    	$this->tag->setDoctype(\Phalcon\Tag::HTML5);
        $this->tag->setTitle("Peregrine");
        $this->view->header = "Peregrine";
        $this->view->subHeader = "";
    }
	
}
