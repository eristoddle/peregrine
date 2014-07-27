<?php
namespace Peregrine\Admin\Controllers;

use \Peregrine\Admin\Controllers\ModuleController,
    \Peregrine\Application\Models;

class UsersController extends ModuleController{

	public function indexAction(){
		$this->view->users = Models\Users::find();
	}

    public function newAction(){
    	$this->view->roles = Models\Roles::find();
        $this->view->pick("users/edit");
    }

	public function editAction($id){
        $user = Models\Users::findFirstById($id);
        if($user){
            $this->tag->setDefaults(
                array(
                    "id" => $user->id,
                    "roles_name" => $user->roles_name,
                    "username" => $user->username,
                    "email" => $user->email,
                )
            );
            $this->view->roles = Models\Roles::find();
        }else{
            $this->flash->error("User was not found.");
            $this->goHome();
        }
	}

	public function saveAction(){
		if ($this->request->isPost()) {
            $user = Models\Users::findFirstById($this->request->getPost('id'));
            if(!$user){
                $user = new Models\Users();
            }
            $user->email = $this->request->getPost('email');
            $user->username = $this->request->getPost('username');
            $user->password = $this->security->hash($this->request->getPost('password'));
            $user->roles_name = $this->request->getPost('roles_name');
            $success = $user->save();
            if($success){
                $this->flash->success("User saved.");
            }else{
                $this->flash->error(implode('<br>', $user->getMessages()));
            }
        }
        $this->goHome();
	}

	public function deleteAction($id){
        $user = Models\Users::findFirstById($id);
        if($user){
            $success = $user->delete();
            if($success){
                $this->flash->success("User deleted.");
            }else{
                $this->flash->error("Error deleting User.");
            }
        }else{
            $this->flash->error("User was not found.");
        }
        $this->goHome();
	}

	public function viewAction($id){
		$user = Models\Users::findFirstById($id);
        if($user){
            $this->tag->setDefaults(
                array(
                    "id" => $user->id,
                    "roles_name" => $user->roles_name,
                    "username" => $user->username,
                    "password" => $user->password,
                    "email" => $user->email,
                )
            );
            //Addresses

			//Orders

        }else{
            $this->flash->error("User was not found.");
            $this->goHome();
        }
	}

	public function addAddressAction(){

	}

	public function deleteAddressAction(){

	}

    protected function goHome(){
        return $this->dispatcher->forward(
            array(
                "module" => "admin",
                "controller" => "users",
                "action" => "index"
            )
        );
    }

}