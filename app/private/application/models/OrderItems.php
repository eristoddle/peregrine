<?php
namespace Peregrine\Application\Models;

use Peregrine\Application\Models\ApplicationModel;

class OrderItems extends ApplicationModel {
    public $id;
    public $orders_id;
    public $products_id;
    public $quantity;
    public $line_total;

}
