<?php
namespace Peregrine\Application\Helpers;

use \Phalcon\Tag,
    \Peregrine\Application\Models\Categories;

class CategoryMenu extends Tag {

    static public function tag() {
        $categories = Categories::find();
        $menu ='<div class="btn-group-vertical col-xs-12">';
            foreach ($categories as $category){
            $menu .= Tag::linkTo(array(
                    'store/products/search?categories_id=' . $category->id, $category->name,
                    'class' => 'btn btn-default'
                )
            );
            }
        $menu .= '</div>';

        return $menu;
    }

}