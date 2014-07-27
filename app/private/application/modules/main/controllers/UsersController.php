<?php
namespace Peregrine\Main\Controllers;

use \Peregrine\Main\Controllers\ModuleController,
    \Peregrine\Application\Models;

class UsersController extends ModuleController {

    public function indexAction() {
        if(isset($this->user)){
            $this->view->pick("users/index");
        }else{
            $this->view->pick("users/login");
        }
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
                if (!$this->security->checkHash($password, $user->password)) {
                    $this->flash->error("Password incorrect.");
                }else{
                    $this->persistent->user = serialize($user);
                    $this->cookies->set('username', $user->username, time() + 15 * 86400);
                    $this->flash->success("Welcome " . $username);
                }
            }else{
                $this->flash->error("User was not found.");
            }
        }
        $this->goHome();
    }

    public function logoutAction() {
        $this->session->destroy();
        $this->cookies->delete('username');
        $this->flash->success("You have been logged out");
    }

    public function registerAction() {

    }

    public function createAction(){
        if ($this->request->isPost()) {
            $user = new Models\Users();
            $user->username = $this->request->getPost('username');
            $user->password = $this->security->hash($this->request->getPost('password'));
            $user->email = $this->request->getPost('email');
            $user->roles_name = 'customer';
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
