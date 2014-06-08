<?php
namespace Peregrine\Application\Models;

use Peregrine\Application\Models\ApplicationModel;

class Products extends ApplicationModel {
    public $id;
    public $name;
    public $price;
    public $description;
    public $categories_id;

    public function initialize(){
        $this->belongsTo("categories_id", "Categories", "id");
        $this->hasMany("id", "OrderItems", "products_id");
    }
}