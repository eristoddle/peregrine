<?php
namespace Peregrine\Admin\Controllers;
use \Peregrine\Admin\Controllers\ModuleController,
	\Peregrine\Application\Models;

class CategoriesController extends ModuleController {
    public function initialize(){
        parent::initialize();
        $this->view->subHeader .= "/Categories";
    }


	public function indexAction(){
		$this->view->categories = Models\Categories::find();
	}

    public function newAction(){
        $this->view->categories = Models\Categories::find();
        $this->view->pick("categories/edit");
    }

	public function editAction($id){
        $this->view->categories = Models\Categories::find();
        $category = Models\Categories::findFirstById($id);
        if($category){
            $this->tag->setDefaults(
                array(
                    "id" => $category->id,
                    "name" => $category->name,
                    "parent_id" => $category->parent_id
                )
            );
        }else{
            $this->flash->error("Category was not found.");
            $this->goHome();
        }
	}

	public function saveAction(){
		if ($this->request->isPost()) {
            $categories = new Models\Categories();
            if($_POST['parent_id'] == ''){
                $_POST['parent_id'] = null;
            }
            $success = $categories->save($_POST);
            if($success){
                $this->flash->success("Category saved.");
            }else{
                $this->flash->error("Error saving category.");
            }
        }
        $this->goHome();
	}

	public function deleteAction($id){
        $category = Models\Categories::findFirstById($id);
        if($category){
            $success = $category->delete();
            if($success){
                $this->flash->success("Category deleted.");
            }else{
                $this->flash->error("Error deleting category.");
            }
        }else{
            $this->flash->error("Category was not found.");
        }
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
