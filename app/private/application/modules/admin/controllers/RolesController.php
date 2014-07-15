<?php
namespace Peregrine\Admin\Controllers;

use \Peregrine\Main\Controllers\ModuleController,
    \Peregrine\Application\Models;

class RolesController extends ModuleController {

	public function indexAction(){
		$this->view->roles = Models\Roles::find();
	}

    public function newAction(){
        $this->view->roles = Models\Roles::find();
        $this->view->pick("roles/edit");
    }

    public function editAction($name){
        $role = Models\Roles::findFirstByName($name);
        if($role){
            $this->view->roles = Models\Roles::find();
            $this->tag->setDefaults(
                array(
                    "name" => $role->name,
                    "description" => $role->description,
                )
            );
            $this->view->roles = Models\Roles::find();
        }else{
            $this->flash->error("Role was not found.");
            $this->goHome();
        }
	}

	public function saveAction(){
		if ($this->request->isPost()) {
            $Roles = new Models\Roles();
            $success = $Roles->save($_POST);
            if($success){
                if(strlen($_POST['role_inherits'])){
                    $this->acl->addInherit($_POST['role_inherits'],$_POST['name']);
                }
                $this->flash->success("Role saved.");
            }else{
                $this->flash->error("Error saving Role.");
            }
        }
        $this->goHome();
	}

	public function deleteAction($name){
        $role = Models\Roles::findFirstByName($name);
        if($role){
            $success = $role->delete();
            if($success){
                $this->flash->success("Role deleted.");
            }else{
                $this->flash->error("Error deleting Role.");
            }
        }else{
            $this->flash->error("Role was not found.");
        }
        $this->goHome();
	}

    public function addResourceAccess(){

    }

    public function dropResourceAccess(){

    }

    public function allowRole($roleName, $resourceName){

    }

    public function denyRole($roleName, $resourceName){

    }

	protected function goHome(){
        return $this->dispatcher->forward(
            array(
                "module" => "admin",
                "controller" => "roles",
                "action" => "index"
            )
        );
    }

}