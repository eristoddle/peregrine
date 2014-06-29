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
