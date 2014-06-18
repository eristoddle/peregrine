<?php
namespace Peregrine\Admin\Controllers;
use \Peregrine\Admin\Controllers\ModuleController,
	\Peregrine\Application\Models;

/**
 * Concrete implementation of Admin module controller
 */
class ProductsController extends ModuleController {
    public function initialize(){
        parent::initialize();
        $this->view->subHeader .= "/Products";
    }


	public function indexAction(){
		$this->view->products = Models\Products::find();
	}

    public function newAction(){
        $this->view->categories = Models\Categories::find();
        $this->view->products = Models\Products::find();
        $this->view->pick("products/edit");
    }

	public function editAction($id){
        $this->view->categories = Models\Categories::find();
        $this->view->products = Models\Products::find();
        $product = Models\Products::findFirstById($id);
        if($product){
            $this->tag->setDefaults(
                array(
                    "id" => $product->id,
                    "categories_id" => $product->categories_id,
                    "name" => $product->name,
                    "description" => $product->description,
                    "price" => $product->price
                )
            );
        }else{
            $this->flash->error("Product was not found.");
            $this->goHome();
        }
	}

	public function saveAction(){
		if ($this->request->isPost()) {
            $products = new Models\Products();
            $success = $products->save($_POST);
            if($success){
                $this->flash->success("Product saved.");
            }else{
                $this->flash->error("Error saving product.");
            }
        }
        $this->goHome();
	}

	public function deleteAction($id){
        $product = Models\Products::findFirstById($id);
        if($product){
            $success = $product->delete();
            if($success){
                $this->flash->success("Product deleted.");
            }else{
                $this->flash->error("Error deleting product.");
            }
        }else{
            $this->flash->error("Product was not found.");
        }
        $this->goHome();
	}

    protected function goHome(){
        return $this->dispatcher->forward(
            array(
                "module" => "admin",
                "controller" => "products",
                "action" => "index"
            )
        );
    }

}
