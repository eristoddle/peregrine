<?php
namespace Peregrine\Application\Models;
use Peregrine\Application\Models\ApplicationModel;

class Payments extends ApplicationModel
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
    public $invoices_id;

    /**
     *
     * @var integer
     */
    public $payment_methods_id;

    /**
     *
     * @var string
     */
    public $date_created;

}
