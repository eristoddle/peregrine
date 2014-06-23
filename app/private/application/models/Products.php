<?php
namespace Peregrine\Application\Models;

use Peregrine\Application\Models\ApplicationModel;

class Products extends ApplicationModel {
    public $id;
    public $name;
    public $price;
    public $description;
    public $categories_id;
    public $images = array();

    public function initialize(){
        $this->belongsTo("categories_id", "Categories", "id");
        $this->hasMany("id", "OrderItems", "products_id");
    }

    protected static function di(){
        return \Phalcon\DI\FactoryDefault::getDefault();
    }

    public function getImages(){
        if(!is_null($this->id)){
            $dir = $this->di()->get('config')->peregrine->productImagesDir . '/' . $this->id;
            if (is_dir($dir)) {
                $images = array_diff(
                    scandir($dir),
                    array('..', '.')
                );
                foreach($images as $k => $v){
                    $this->images[] = 'media/img/' . $this->id . '/' . $v;
                }
            }
        }
        return $this->images;
    }
}