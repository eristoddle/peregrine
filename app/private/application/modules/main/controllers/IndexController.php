<?php
namespace Peregrine\Main\Controllers;

use \Peregrine\Main\Controllers\ModuleController,
    \Peregrine\Application\Models;

class IndexController extends ModuleController {

    public function indexAction(){
        $products = Models\Products::find();
        $currentPage = (int) $_GET["page"] ? $_GET["page"] : 1;
        $paginator = new \Phalcon\Paginator\Adapter\Model(
            array(
                "data" => $products,
                "limit"=> $this->config->productsPerPage,
                "page" => $currentPage
            )
        );
        $this->view->categories = $this->categories;
        $this->view->page = $paginator->getPaginate();
    }
}
