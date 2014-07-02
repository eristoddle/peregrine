<?php
namespace Peregrine\Application\Helpers;

use \Phalcon\Tag,
    \Peregrine\Application\Models\Categories;

class CategoryMenu extends Tag {

    static public function tag() {
        $menu = array();
        $category_ids = array();
        $categories = Categories::find();
        foreach($categories as $k => $v){
            $element = array(
                'id' => $v->id,
                'name' => $v->name,
                'parent_id' => $v->parent_id
            );
            if(is_null($v->parent_id) && !in_array($v->id, $category_ids)){
                $menu[$v->id] = array(
                    'self' => $element,
                    'children' => array()
                );
            }else if(is_null($v->parent_id) && in_array($v->id, $category_ids)){
                $menu[$v->id]['self'] = $element;
            }else if(!in_array($v->parent_id, $category_ids)){
                $menu[$v->parent_id] = array(
                    'children' => array($element)
                );
                $category_ids[] = $v->parent_id;
            }else{
                $menu[$v->parent_id]['children'][] = $element;
            }
            $category_ids[] = $v->id;
        }

        return $meta;
    }

}