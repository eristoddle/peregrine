<?php
namespace Peregrine\Application\Models;
use Peregrine\Application\Models\ApplicationModel;

class Configuration extends ApplicationModel
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $key;

    /**
     *
     * @var string
     */
    public $value;

}
