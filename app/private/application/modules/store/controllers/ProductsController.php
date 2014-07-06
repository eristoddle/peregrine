<?php
namespace Peregrine\Store\Controllers;

use \Peregrine\Store\Controllers\ModuleController,
    \Peregrine\Application\Models;

/**
 * Concrete implementation of Store module controller
 */
class ProductsController extends ModuleController {
    public function initialize() {
        parent::initialize();
    }

    public function viewAction($id) {
        $this->view->product = Models\Products::findFirstById($id);
        if (!$this->view->product) {
            $this->flash->error("Product was not found.");
            $this->goHome();
        }
    }

    public function searchAction() {
        $currentPage = isset($_GET["page"]) ? $_GET["page"] : 1;
        if ($this->request->isPost() == true) {
            $query = $this->request->getPost("query");
            $products = Models\Products::find(
                "(name LIKE '%$query%') OR (description LIKE '%$query%')"
            );
        }
        $filters = $this->request->getQuery();
        if(array_key_exists("categories_id",$filters)){
            $products = Models\Products::find(
                array(
                    "conditions" => "categories_id = ?1",
                    "bind" => array(
                        1 => $filters['categories_id']
                    )
                )
            );
        }

        $paginator = new \Phalcon\Paginator\Adapter\Model(
            array(
                "data" => $products,
                "limit" => $this->config->productsPerPage,
                "page" => $currentPage
            )
        );
        $this->view->page = $paginator->getPaginate();
    }

    protected function goHome() {
        return $this->dispatcher->forward(
            array(
                "module" => "main",
                "controller" => "products",
                "action" => "index"
            )
        );
    }

}
