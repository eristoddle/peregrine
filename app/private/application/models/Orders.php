<?php
namespace Peregrine\Application\Models;
use Peregrine\Application\Models\ApplicationModel;

class Orders extends ApplicationModel
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var integer
     */
    public $users_id;

    /**
     *
     * @var integer
     */
    public $order_statuses_id;

    /**
     *
     * @var integer
     */
    public $billing_address_id;

    /**
     *
     * @var integer
     */
    public $shipping_address_id;

    /**
     *
     * @var double
     */
    public $shipping_and_handling;

    /**
     *
     * @var double
     */
    public $subtotal;

    /**
     *
     * @var double
     */
    public $grand_total;

    /**
     *
     * @var string
     */
    public $date_created;

}
