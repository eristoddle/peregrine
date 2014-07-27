<?php
namespace Peregrine\Application\Controllers;

use Phalcon\Mvc\Controller,
    Peregrine\Application\Models;

class ApplicationController extends Controller {
    public function initialize(){
        $this->config = $this->di->get('config')->peregrine;
    	$this->tag->setDoctype(\Phalcon\Tag::HTML5);
        $this->tag->setTitle($this->config->storeName);
        $this->view->header = $this->config->storeName;
        $this->view->subHeader = ucFirst($this->dispatcher->getModuleName())
            . "/" . ucFirst($this->dispatcher->getControllerName());
        $this->acl = $this->di->get('acl');

        if ($this->cookies->has('username')) {
            $username = trim($this->cookies
                ->get('username')
                ->getValue());
            $user = Models\Users::findFirst(
                array(
                    'username = :username:',
                    'bind' => array(
                        'username' => $username
                    )
                )
            );
            if ($user) {
                $this->persistent->user = serialize($user);
                $this->view->loggedIn = true;
                $this->user = $user;
            }
        }
    }
}
