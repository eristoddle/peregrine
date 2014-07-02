<?php
namespace Peregrine\Main\Controllers;

use \Peregrine\Main\Controllers\ModuleController,
    \Peregrine\Application\Models;

class IndexController extends ModuleController {
    public function initialize(){
        parent::initialize();
        $this->categories = array();
        $category_ids = array();
        $categories = Models\Categories::find();
        foreach($categories as $k => $v){
            $element = array(
                'id' => $v->id,
                'name' => $v->name,
                'parent_id' => $v->parent_id
            );
            if(is_null($v->parent_id) && !in_array($v->id, $category_ids)){
                $this->categories[$v->id] = array(
                    'self' => $element,
                    'children' => array()
                );
            }else if(is_null($v->parent_id) && in_array($v->id, $category_ids)){
                $this->categories[$v->id]['self'] = $element;
            }else if(!in_array($v->parent_id, $category_ids)){
                $this->categories[$v->parent_id] = array(
                    'children' => array($element)
                );
                $category_ids[] = $v->parent_id;
            }else{
                $this->categories[$v->parent_id]['children'][] = $element;
            }
            $category_ids[] = $v->id;
        }
    }

    public function indexAction(){
        $products = Models\Products::find();
        $currentPage = (int) $_GET["page"] ? $_GET["page"] : 1;
        $paginator = new \Phalcon\Paginator\Adapter\Model(
            array(
                "data" => $products,
                "limit"=> $this->config->productsPerPage,
                "page" => $currentPage
            )
        );
        $this->view->categories = $this->categories;
        $this->view->page = $paginator->getPaginate();
    }
}
