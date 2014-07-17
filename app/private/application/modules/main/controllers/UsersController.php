<?php
namespace Peregrine\Main\Controllers;

use \Peregrine\Main\Controllers\ModuleController,
    \Peregrine\Application\Models;

class UsersController extends ModuleController {

    public function indexAction() {

    }

    public function loginAction() {
        if ($this->request->isPost()) {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            $user = Models\Users::findFirst(
                array(
                    'username = :username: OR email = :email:',
                    'bind' => array(
                        'username' => $username,
                        'email' => $username
                    )
                )
            );

            if ($user) {
                if ($this->security->checkHash($password, $user->password)) {
                    $this->flash->error("Password incorrect.");
                }else{
                    $this->flash->success("Welcome " . $username);
                }
            }else{
                $this->flash->error("User was not found.");
            }
        }
        $this->goHome();
    }

    public function logoutAction() {

    }

    public function registerAction() {

    }

    public function createAction(){
        if ($this->request->isPost()) {
            $user = new Models\Users();
            $success = $user->save();
            if($success){
                $this->flash->success("Account created!");
            }else{
                $this->flash->error(implode('<br>', $user->getMessages()));
            }
        }
        $this->goHome();
    }

    protected function goHome(){
        return $this->dispatcher->forward(
            array(
                "module" => "main",
                "controller" => "users",
                "action" => "index"
            )
        );
    }
}
