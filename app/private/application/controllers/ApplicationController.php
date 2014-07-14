<?php
namespace Peregrine\Application\Controllers;

use Phalcon\Mvc\Controller;

class ApplicationController extends Controller {
    public function initialize(){
        $this->config = $this->di->get('config')->peregrine;
    	$this->tag->setDoctype(\Phalcon\Tag::HTML5);
        $this->tag->setTitle($this->config->storeName);
        $this->view->header = $this->config->storeName;
        $this->view->subHeader = ucFirst($this->dispatcher->getModuleName())
            . "/" . ucFirst($this->dispatcher->getControllerName());
        $this->acl = $this->di->get('acl');
    }
}
