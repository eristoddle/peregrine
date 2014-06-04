<?php
namespace Peregrine\Application\Models;

use Peregrine\Application\Models\ApplicationModel;
use Phalcon\Mvc\Model\Validator\Email as Email;

class Users extends ApplicationModel {
    public $id;
    public $roles_name;
    public $username;
    public $password;
    public $email;
    public $date_created;

    public function validation() {
        $this->validate(
            new Email(
                array(
                    'field' => 'email',
                    'required' => true,
                )
            )
        );
        if ($this->validationHasFailed() == true) {
            return false;
        }
    }

}
