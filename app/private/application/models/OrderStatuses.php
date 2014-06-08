<?php
namespace Peregrine\Application\Models;

use Peregrine\Application\Models\ApplicationModel;

class OrderStatuses extends ApplicationModel {
    public $id;
    public $status;

    public function initialize(){
        $this->hasMany("id", "Orders", "order_statuses_id");
    }
}
