<?php
namespace Peregrine\Application\Models;
use Peregrine\Application\Models\ApplicationModel;

class OrderItems extends ApplicationModel
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
    public $orders_id;

    /**
     *
     * @var integer
     */
    public $products_id;

    /**
     *
     * @var integer
     */
    public $quantity;

    /**
     *
     * @var double
     */
    public $line_total;

}
