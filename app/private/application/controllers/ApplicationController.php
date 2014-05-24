<?php

namespace Peregrine\Application\Controllers;

use Phalcon\Mvc\Controller,
    Phalcon\Tag,
    Peregrine\Application\Helpers\MetaTags;

/**
 * Controller base class for all application controllers
 */
class ApplicationController extends Controller {
    public function initialize() {
        $this->tag->setTitle('Peregrine');
        $this->tag->setDoctype(Tag::HTML5);
        $this->tag->metaDescription = MetaTags::tag(array(
            'name' => 'description',
            'content' => 'Peregrine'
        ));
    }
}
