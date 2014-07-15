<?php
namespace Peregrine\Application\Models;

use Peregrine\Application\Models\ApplicationModel;

class RoleInherits extends ApplicationModel {
	public $name;
	public $description;

	public function initialize(){
		$this->hasMany("roles_name", "Roles", "name");
		$this->hasMany("roles_inherit", "Roles", "name");
	}
}