<?php
namespace Peregrine\Admin\Controllers;

use \Peregrine\Admin\Controllers\ModuleController,
    \Peregrine\Application\Models;

/**
 * Concrete implementation of Admin module controller
 */
class ProductsController extends ModuleController {
    public function initialize() {
        parent::initialize();
        $this->view->subHeader .= "/Products";
    }


    public function indexAction() {
        $this->view->products = Models\Products::find();
    }

    public function newAction() {
        $this->view->categories = Models\Categories::find();
        $this->view->pick("products/edit");
    }

    public function editAction($id) {
        if(!isset($id) && $this->request->getPost('id')){
            $id = $this->request->getPost('id');
        }
        $this->view->categories = Models\Categories::find();
        $product = Models\Products::findFirstById($id);
        if ($product) {
            $this->view->product = $product;
            $this->tag->setDefaults(
                array(
                    "id" => $product->id,
                    "categories_id" => $product->categories_id,
                    "name" => $product->name,
                    "description" => $product->description,
                    "price" => $product->price,
                )
            );
        } else {
            $this->flash->error("Product was not found.");
            $this->goHome();
        }
    }

    public function saveAction() {
        if ($this->request->isPost()) {
            $products = new Models\Products();
            $success = $products->save($_POST);
            if ($success) {
                $this->flash->success("Product saved.");
            } else {
                $this->flash->error("Error saving product.");
            }
        }
        $this->goHome();
    }

    public function deleteAction($id) {
        $product = Models\Products::findFirstById($id);
        if ($product) {
            $success = $product->delete();
            if ($success) {
                $this->flash->success("Product deleted.");
            } else {
                $this->flash->error("Error deleting product.");
            }
        } else {
            $this->flash->error("Product was not found.");
        }
        $this->goHome();
    }

    public function uploadAction() {
        if ($this->request->hasFiles() == true) {
            $id = $this->request->getPost('id');
            $product = Models\Products::findFirstById($id);
            $uploads = $this->request->getUploadedFiles();
            $isUploaded = false;
            foreach ($uploads as $upload) {
                $isUploaded = $product->uploadImage($upload);
            }
            ($isUploaded) ?  $this->flash->success('Images successfully uploaded.')
                : $this->flash->error('Some error occurred.');
        } else {
            $this->flash->error('Please choose at least one image to upload.');
        }
        return $this->dispatcher->forward(
            array(
                "module" => "admin",
                "controller" => "products",
                "action" => "edit",
                "parameters" => array(
                    $id
                )
            )
        );
    }

    protected function goHome() {
        return $this->dispatcher->forward(
            array(
                "module" => "admin",
                "controller" => "products",
                "action" => "index"
            )
        );
    }

}
