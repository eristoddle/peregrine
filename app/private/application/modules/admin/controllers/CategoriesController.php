<?php
namespace Peregrine\Admin\Controllers;
use \Peregrine\Admin\Controllers\ModuleController,
	\Peregrine\Application\Models;

/**
 * Concrete implementation of Admin module controller
 */
class CategoriesController extends ModuleController {
    public function initialize(){
        parent::initialize();
        $this->view->subHeader .= "Categories";
    }


	public function indexAction(){
		$this->view->categories = Models\Categories::find();

	}

    public function newAction(){
        $this->view->categories = Models\Categories::find();
    }

	public function editAction($id){
        $this->view->categories = Models\Categories::find();
        $category = Models\Categories::findFirst("id = '$id'");
        $this->tag->setDefaults(
            array(
                "id" => $category->id,
                "name" => $category->name,
                "parent_id" => $category->parent_id
            )
        );
	}

	public function saveAction(){
		if ($this->request->isPost()) {
            $categories = new Models\Categories();
            if($_POST['parent_id'] == ''){
                $_POST['parent_id'] = null;
            }
            $categories->save($_POST);
        }
        $this->goHome();
	}

	public function deleteAction($id){
        $category = Models\Categories::findFirst("id = '$id'");
        $category->delete();
        $this->goHome();
	}

    protected function goHome(){
        return $this->dispatcher->forward(
            array(
                "module" => "admin",
                "controller" => "categories",
                "action" => "index"
            )
        );
    }

}
