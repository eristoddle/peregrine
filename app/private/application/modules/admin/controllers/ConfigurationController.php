<?php
namespace Peregrine\Admin\Controllers;
use \Peregrine\Admin\Controllers\ModuleController,
	\Peregrine\Application\Models;

class ConfigurationController extends ModuleController {

    public function initialize(){
        parent::initialize();
        $this->view->subHeader .= "/Configuration";
    }

	public function indexAction(){
		$this->view->configuration = Models\Configuration::find();
	}

    public function newAction(){
        $this->view->pick("configuration/edit");
    }

	public function editAction($id){
        $configuration = Models\Configuration::findFirstById($id);
        if($configuration){
            $this->tag->setDefaults(
                array(
                    "id" => $configuration->id,
                    "key" => $configuration->key,
                    "value" => $configuration->value
                )
            );
        }else{
            $this->flash->error("Configuration was not found.");
            $this->goHome();
        }
	}

	public function saveAction(){
		if ($this->request->isPost()) {
            $configuration = new Models\Configuration();
            $success = $configuration->save($_POST);
            if($success){
                $this->flash->success("Configuration saved.");
            }else{
                $this->flash->error("Error saving configuration.");
            }
        }
        $this->goHome();
	}

	public function deleteAction($id){
        $configuration = Models\Configuration::findFirstById($id);
        if($configuration){
            $success = $configuration->delete();
            if($success){
                $this->flash->success("Configuration deleted.");
            }else{
                $this->flash->error("Error deleting configuration.");
            }
        }else{
            $this->flash->error("Configuration was not found.");
        }
        $this->goHome();
	}

    protected function goHome(){
        return $this->dispatcher->forward(
            array(
                "module" => "admin",
                "controller" => "configuration",
                "action" => "index"
            )
        );
    }

}
