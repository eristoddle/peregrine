<?php
namespace Peregrine\Application\Models;

use Peregrine\Application\Models\ApplicationModel,
    Phalcon\Mvc\Model\Behavior\Timestampable,
    Phalcon\Mvc\Model\Validator\Email as Email;

class Users extends ApplicationModel {
    public $id;
    public $roles_name;
    public $username;
    public $password;
    public $email;
    public $date_created;

    public function initialize(){
        $this->hasMany("id", "UserAddresses", "users_id");
        $this->hasMany("id", "Orders", "users_id");

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
