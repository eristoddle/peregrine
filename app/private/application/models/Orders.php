<?php
namespace Peregrine\Application\Models;
use Peregrine\Application\Models\ApplicationModel;

class Orders extends ApplicationModel {
    public $id;
    public $users_id;
    public $order_statuses_id;
    public $billing_address_id;
    public $shipping_address_id;
    public $shipping_and_handling;
    public $subtotal;
    public $grand_total;
    public $date_created;

}
