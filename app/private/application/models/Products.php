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
        $this->imagesDir = $this->di()->get('config')->peregrine->productImagesDir;
        $this->imagesWeb = $this->di()->get('config')->peregrine->productImagesWeb;
    }

    public function afterCreate(){
        $dirPath = $this->imagesDir . '/' . $this->id;
        if (!is_dir($dirPath)) {
            mkdir($pathname = $dirPath, $mode = 0777, $recursive = true);
        }
    }

    public function afterFetch(){
        if(!is_null($this->id)){
            $dir = $this->imagesDir . '/' . $this->id;
            if (is_dir($dir)) {
                $images = array_diff(
                    scandir($dir),
                    array('..', '.')
                );
                foreach($images as $k => $v){
                    $this->images[] = $this->imagesWeb . '/' . $this->id . '/' . $v;
                }
            }
        }
    }

    public function afterDelete(){
        foreach($this->images as $k => $v){
            $this->deleteImage($v);
        }
    }

    public function deleteImage($file){
        unlink($file);
    }

    public function uploadImage($upload){
        $isUploaded = false;
        $parts = explode('.', $upload->getname());
        $extension = $parts[count($parts) - 1];
        if(in_array($extension, array('jpg','gif','png'))){
            $path = $this->imagesDir . '/' . $this->id . "/" . strtolower($upload->getname());
            ($upload->moveTo($path)) ? $isUploaded = true : $isUploaded = false;
        }
        return $isUploaded;
    }
}