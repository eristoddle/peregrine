<?php
namespace Peregrine\Application\Models;

use Peregrine\Application\Models\ApplicationModel;

class OrderItems extends ApplicationModel {
    public $id;
    public $orders_id;
    public $products_id;
    public $quantity;
    public $line_total;

    public function initialize(){
        $this->belongsTo("orders_id", "Orders", "id");
        $this->belongsTo("products_id", "Products", "id");
    }
}
