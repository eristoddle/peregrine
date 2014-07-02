<?php
namespace Peregrine\Store\Controllers;
use \Peregrine\Store\Controllers\ModuleController,
	\Peregrine\Application\Models;

/**
 * Concrete implementation of Store module controller
 */
class ProductsController extends ModuleController {
    public function initialize(){
        parent::initialize();
    }

	public function viewAction($id){
        $this->view->product = Models\Products::findFirstById($id);
        if(!$this->view->product){
            $this->flash->error("Product was not found.");
            $this->goHome();
        }
	}

    public function searchAction(){
        $currentPage = isset($_GET["page"]) ? $_GET["page"] : 1;
        $products = Models\Products::query();
        if ($this->request->isPost() == true) {
            $query = $this->request->getPost("query");
            $products->where("name LIKE '%:name%'")
                ->where("description LIKE '%:description%'")
                ->bind(
                array(
                    "name" => $query,
                    "description" => $query
                ));
        }
        $filters = $this->request->getQuery();
        unset($filters['_url']);
        if(count($filters) > 0) {
            $filtercount = 0;
            foreach($filters as $k => $v){
                if($filtercount == 0){
                    $products->where("$k = ':$k'");
                }else{
                    $products->andWhere("$k = ':$k'");
                }
                $filtercount = $filtercount + 1;
            }
            $products->bind($filters);
        }

        $paginator = new \Phalcon\Paginator\Adapter\Model(
            array(
                "data" => $products,
                "limit"=> $this->config->productsPerPage,
                "page" => $currentPage
            )
        );
        $this->view->page = $paginator->getPaginate();
    }

    protected function goHome(){
        return $this->dispatcher->forward(
            array(
                "module" => "main",
                "controller" => "products",
                "action" => "index"
            )
        );
    }

}
