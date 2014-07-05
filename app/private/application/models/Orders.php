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

    public function initialize() {
        $this->belongsTo("users_id", "Users", "id");
        $this->belongsTo("order_statuses_id", "OrderStatuses", "id");
        $this->belongsTo("billing_address_id", "UserAddresses", "id");
        $this->belongsTo("shipping_address_id", "UserAddresses", "id");
        $this->hasMany("id", "OrderItems", "orders_id");

        $this->addBehavior(
            new Timestampable(
                array(
                    'beforeCreate' => array(
                        'field' => 'date_created',
                        'format' => 'Y-m-d'
                    )
                )
            )
        );
    }
}
