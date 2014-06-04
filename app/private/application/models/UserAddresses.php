<?php
namespace Peregrine\Application\Models;

use Peregrine\Application\Models\ApplicationModel;

class UserAddresses extends ApplicationModel {
    public $id;
    public $users_id;
    public $user_address_type;
    public $first_name;
    public $last_name;
    public $address1;
    public $address2;
    public $city;
    public $state;
    public $postal_code;
    public $country;

}
