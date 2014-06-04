<?php
namespace Peregrine\Application\Models;

use Peregrine\Application\Models\ApplicationModel;

class Payments extends ApplicationModel {
    public $id;
    public $invoices_id;
    public $payment_methods_id;
    public $date_created;

}
