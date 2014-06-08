<?php
namespace Peregrine\Application\Models;
use Peregrine\Application\Models\ApplicationModel;

class Categories extends ApplicationModel {
    public $id;
    public $name;
    public $parent_id;

    public function initialize(){
        $this->hasMany("id", "Products", "categories_id");
    }
}
